@extends('admin.master')
@section('title', 'ویرایش محصول ' . $product->title)
@section('main')
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-9 my-2">
            <div class="card dir-rtl shadow">
                <div class="card-header fw-bold">
                    ویرایش محصول {{ $product->title }}
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($errors->all())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li class="m-1 mx-4">{{ $error }}</li>
                                @endforeach
                                @if (session('error'))
                                    <li class="m-1 mx-4">{{ session('error') }}</li>
                                @endif
                            </ul>
                        @endif
                        @if (session('error'))
                            <li class="m-1 mx-4">{{ session('error') }}</li>
                        @endif
                        <div class="form-group py-2">
                            <label for="title" class="pb-3"> عنوان </label>
                            <input id="title" name="title" type="text" class="form-control"
                                placeholder="عنوان . . ." required value="{{ $product->title }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="description" class="pb-3"> توضیحات محصول </label>
                            <textarea id="description" name="description" class="form-control" placeholder="توضیحات محصول . . ." required>{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group py-2">
                            <label for="color" class="pb-3"> رنگ </label>
                            <br>
                            @if (count($colors) != 0)
                                <div class="d-flex flex-wrap">
                                    <div id="inputContainer" class="d-flex flex-wrap">
                                        @foreach ($product->colors()->get() as $key => $color_product)
                                            <div class="card border m-1 mainproperty"
                                                id="mainPropertyCard{{ $key + 1 }}">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <span> ویژگی {{ $key + 1 }} </span>
                                                    <button type="button" class="btn text-danger btn-sm rounded-pill"
                                                        id="close_{{ $key + 1 }}">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="w-100 rounded border border-dark my-2 text-center text-light"
                                                        id="prwColor_{{ $key + 1 }}"
                                                        style="background :{{ $color_product->hex }}; height:25px;">
                                                        {{ $color_product->hex }}
                                                    </div>
                                                    <label> رنگ </label>
                                                    <select name="main_property[color_{{ $key + 1 }}]"
                                                        class="form-control" id="color_{{ $key + 1 }}">
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}"
                                                                @if ($color_product->id == $color->id) selected @endif>
                                                                {{ $color->title }} </option>
                                                        @endforeach
                                                    </select>

                                                    <script>
                                                        $('#color_' + {{ $key + 1 }}).on('change', function() {
                                                            var valueSelectBox = $(this).val();
                                                            var a = {!! json_encode($colors->toArray()) !!};
                                                            a.forEach(function(el) {
                                                                if (el['id'] == valueSelectBox) {
                                                                    $('#prwColor_' + {{ $key + 1 }}).text(el['hex']).css(
                                                                        'background-color', el['hex']);
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                    <br>
                                                    <label> قیمت ( تومان ) </label>
                                                    <input type="number" class="form-control"
                                                        placeholder="قیمت برای این رنگ را وارد کنید . . ." required
                                                        value="{{ $color_product->pivot->price }}"
                                                        name="main_property[price_{{ $key + 1 }}]">
                                                    <br>
                                                    <label> موجودی </label>
                                                    <input type="number" class="form-control" placeholder="موجودی. . ."
                                                        required value="{{ $color_product->pivot->inventory }}"
                                                        name="main_property[inventory_{{ $key + 1 }}]">
                                                    <input id="main_propertyStatus_{{ $key + 1 }}"
                                                        name="main_property[status_{{ $key + 1 }}]" value="active"
                                                        type="hidden" required>
                                                    <input name="main_property[card_{{ $key + 1 }}]"
                                                        value="{{ $key + 1 }}" type="hidden" required>
                                                </div>
                                            </div>
                                            <script>
                                                function closeCard(id) {
                                                    var cardId = 'mainPropertyCard' + id;

                                                    $('#main_propertyStatus_' + id).val('delete');
                                                    $('#' + cardId).css('display', 'none');

                                                }



                                                $('#close_' + {{ $key + 1 }}).click(function() {
                                                    closeCard({{ $key + 1 }});
                                                });
                                            </script>
                                        @endforeach

                                    </div>
                                    <button class="btn btn-success m-2" id="btnCreateInput" type="button">
                                        <i class="bi bi-plus-circle-fill"></i>
                                    </button>
                                </div>
                            @else
                                <div class="text-center text-danger fw-bold">
                                    لطفا حداقل یک رنگ را اضافه کنید <br>
                                    <a class="text-center text-danger fw-bold" href="{{ route('colors.create') }}"> لینک
                                        افزودن رنگ
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="form-group py-2">
                            <label> نوع تخفیف </label>
                            <br>
                            <small class="text-muted"> تخفیف روی همه ویژگی های اصلی </small>
                            <br>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="off[status]" id="offNone"
                                    value="none" {{ $product->status_off == 'none' ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="offNone"> تخفیف ندارد </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="off[status]" id="offPercent"
                                    value="percent" {{ $product->status_off == 'percent' ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="offPercent"> تخفیف درصدی </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="off[status]" id="offPrice"
                                    value="price" {{ $product->status_off == 'price' ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="offPrice"> تخفیف عددی </label>
                            </div>
                            <div id="boxOffShow" class="my-3 ">
                                <div class="p-2 d-none" id="boxOffPercent">
                                    <div class="form-group p-2">
                                        <label> درصد تخفیف </label>
                                        <div class="input-group dir-ltr my-2">
                                            <span class="input-group-text"> % </span>
                                            <input type="number" class="form-control dir-rtl"
                                                placeholder=' درصد تخفیف را وارد کنید . . . '
                                                name="off[input_percent_num]"
                                                @if ($product->status_off == 'percent') value="{{ $product->number_off }}" @endif>
                                        </div>
                                    </div>
                                    <div class="form-group p-2">
                                        <label> مدت تخفیف </label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="number" class="form-control my-2"
                                                    placeholder=' مدت زمان تخفیف را وارد کنید . . . '
                                                    name="off[input_percent_time]"
                                                    @if ($product->status_off == 'percent') value="{{ $product->time_off }}" @endif>
                                                <del class="text-danger fw-bold small"> بدین شکل مورد قبول نمی باشد 10:30
                                                </del>
                                            </div>
                                            <div class="col-6">
                                                <select type="number" class="form-control my-2"
                                                    name="off[input_percent_unit_time]">
                                                    <option value="minutes"
                                                        @if ($product->status_off == 'percent' && $product->unit_time_off == 'minutes') selected @endif> دقیقه </option>
                                                    <option value="hour"
                                                        @if ($product->status_off == 'percent' && $product->unit_time_off == 'hour') selected @endif> ساعت </option>
                                                    <option value="day"
                                                        @if ($product->status_off == 'percent' && $product->unit_time_off == 'day') selected @endif> روز </option>
                                                    <option value="week"
                                                        @if ($product->status_off == 'percent' && $product->unit_time_off == 'week') selected @endif> هفته </option>
                                                    <option value="month"
                                                        @if ($product->status_off == 'percent' && $product->unit_time_off == 'month') selected @endif> ماه </option>
                                                    <option value="year"
                                                        @if ($product->status_off == 'percent' && $product->unit_time_off == 'year') selected @endif> سال </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 d-none" id="boxOffPrice">
                                    <div class="form-group p-2">
                                        <label> مبلغ تخفیف </label>
                                        <div class="input-group dir-ltr my-2">
                                            <span class="input-group-text"> تومان </span>
                                            <input type="number" class="form-control dir-rtl"
                                                placeholder=' مبلغ تخفیف را وارد کنید . . . ' name="off[input_price_num]"
                                                @if ($product->status_off == 'price') value="{{ $product->number_off }}" @endif>
                                        </div>
                                    </div>
                                    <div class="form-group p-2">
                                        <label> مدت تخفیف </label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="number" class="form-control my-2"
                                                    placeholder=' مدت زمان تخفیف را وارد کنید . . . '
                                                    name="off[input_price_time]"
                                                    @if ($product->status_off == 'price') value="{{ $product->time_off }}" @endif>
                                                <del class="text-danger fw-bold small"> بدین شکل مورد قبول نمی باشد 10:30
                                                </del>
                                            </div>
                                            <div class="col-6">
                                                <select type="number" class="form-control my-2"
                                                    name="off[input_price_unit_time]">
                                                    <option value="minutes"
                                                        @if ($product->status_off == 'price' && $product->unit_time_off == 'minutes') selected @endif> دقیقه </option>
                                                    <option value="hour"
                                                        @if ($product->status_off == 'price' && $product->unit_time_off == 'hour') selected @endif> ساعت </option>
                                                    <option value="day"
                                                        @if ($product->status_off == 'price' && $product->unit_time_off == 'day') selected @endif> روز </option>
                                                    <option value="week"
                                                        @if ($product->status_off == 'price' && $product->unit_time_off == 'week') selected @endif> هفته </option>
                                                    <option value="month"
                                                        @if ($product->status_off == 'price' && $product->unit_time_off == 'month') selected @endif> ماه </option>
                                                    <option value="year"
                                                        @if ($product->status_off == 'price' && $product->unit_time_off == 'year') selected @endif> سال </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="category" class="pb-3"> دسته بندی </label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($product->category_id == $category->id) selected @endif>
                                        {{ $category->title }} </option>
                                @endforeach
                            </select>

                            <div class="card my-2">
                                <div class="card-body">
                                    <label> ویژگی ها </label>
                                    <div id="propertiesShow">
                                        @php
                                            $properties_product = $product->properties()->whereStatus('1')->get();
                                            $category_properties = $categories
                                                ->find($product->category_id)
                                                ->properties()
                                                ->whereStatus('1')
                                                ->get();
                                        @endphp
                                    </div>
                                </div>
                            </div>

                            <div class="form-group py-2">
                                <label for="tags" class="pb-3"> تگ ها </label>
                                <input type="text" name="tags" id="input-tag"
                                    class="form-control text-right dir-rtl"
                                    placeholder="لطفا تگ های محصول را وارد کنید . . . ">

                                <div class="d-flex justify-content-start align-items-center flex-wrap w-100 my-2"
                                    id="tags">
                                    @if ($product->tags)
                                        @foreach ($product->tags as $tag)
                                            <div class="bg-primary pe-3 rounded-pill m-1 text-light fw-bold">
                                                {{ $tag }} <div class="delete-button btn"> <i
                                                        class="bi bi-x-circle text-light"></i>
                                                </div>
                                                <input type="hidden" name="tags[{{ $tag }}]"
                                                    value="{{ $tag }}" />
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group py-2">
                                <label for="image" class="pb-3"> تصویر شاخص </label>
                                <input id="image" name="image" type="file" class="form-control">
                                <span class="text-muted fw-bold fs-6 p-4">
                                    بهترین اندازه برای اسلایدر عرض 600 و ارتفاع 600 است .
                                </span>
                                <div class="dir-ltr">
                                    <div id ="preview" class="w-25 shadow mt-3"></div>
                                </div>
                            </div>
                            <div class="form-group py-2">
                                <label for="images" class="pb-3"> تصاویر محصول </label>
                                <input id="images" name="images[]" type="file" class="form-control" multiple>
                                <span class="text-muted fw-bold fs-6 p-4">
                                    بهترین اندازه برای اسلایدر عرض 600 و ارتفاع 600 است .
                                </span>
                            </div>
                            <div class="form-group py-2">
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                        value="1" {{ $product->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label mx-1" for="active"> فعال </label>
                                </div>
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input" type="radio" name="status" id="passive"
                                        value="0" {{ $product->status == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-warning text-light fw-bold my-3 w-100 "
                                value="ویرایش"@if (count($colors) == 0) disabled @endif>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 my-2">
        <div class="card mb-3 shadow">
            <div class="card-header text-center fw-bold ">
                تصویر محصول
            </div>
            <div class="card-body">
                <div>
                    <img class="img-fluid img-thumbnail " src="{{ asset($product->image) }}"
                        alt="{{ $product->title }}">
                    <br>
                    <b> Width × Highte : {{ $width . ' × ' . $highte }} </b>
                    <br>
                    <b> Size Image :
                        @if ($file_size < 100000)
                            {{ $file_size / 1024 . ' KB' }}
                        @elseif($file_size < 100000000)
                            {{ $file_size / 1024 / 1024 . ' MB' }}
                        @elseif($file_size < 100000000000)
                            {{ $file_size / 1024 / 1024 / 1024 . ' GB' }}
                        @endif
                    </b>
                </div>
            </div>
        </div>
        <div class="card mb-3 shadow">
            <div class="card-header text-center fw-bold ">
                تصاویر محصول
            </div>
            <div class="card-body">
                <div>
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner rounded">
                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item @if ($key == 0) active @endif">
                                    <img src="{{ asset($image) }}" class="d-block w-100 object-fit-cover">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card dir-rtl mb-5 shadow">
            <div class="card-body">
                <div class="form-group py-2">
                    <label for="created_at" class="pb-3"> تاریخ ساخت </label>
                    <input type="text" disabled class="form-control dir-ltr" value="{{ $category->created_at }}">
                </div>
                <div class="form-group py-2">
                    <label for="updated_at" class="pb-3"> تاریخ آخرین ویرایش </label>
                    <input type="text" disabled class="form-control dir-ltr" value="{{ $category->updated_at }}">
                </div>
            </div>
        </div>
    </div>
    @if (count($colors->toArray()) != 0)
        @php
            $colors_index_0 = $colors[0]['hex'];
        @endphp
    @else
        @php
            $colors_index_0 = 'یک رنگ را اضافه کنید';
        @endphp
    @endif

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Get the tags and input elements from the DOM
            const tags = $('#tags');
            const input = $('#input-tag');
            // Add an event listener for keydown on the input element
            input.on('keydown', function(event) {
                // Check if the key pressed is 'Enter'
                if (event.which == 13) {
                    // Prevent the default action of the keypress event (submitting the form)
                    event.preventDefault();

                    // Get the trimmed value of the input element
                    let tagContent = input.val().trim();

                    // If the trimmed value is not an empty string
                    if (tagContent !== '') {
                        // Create a new list item element for the tag

                        const tag = $('<div class="bg-primary pe-3 rounded-pill m-1 fw-bold text-light"></div>').text(
                            tagContent);
                        const inputHidden = $('<input type="hidden" name="tags[' + tagContent + ']"/>').val(
                            tagContent);
                        tag.append(inputHidden);

                        // Append a delete button to the tag
                        tag.append(
                            '<div class="delete-button btn"> <i class="bi bi-x-circle text-light"></i> </div>'
                        );

                        // Append the tag to the tags list
                        tags.append(tag);
                        // Clear the input element's value
                        input.val('');
                    }
                }
            });
            // Add an event listener for click on the tags list
            tags.on('click', '.delete-button', function() {
                // Remove the parent element (the tag)
                $(this).parent().remove();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function toggleOffDisplay(idOff) {
                const boxOffShow = $('#boxOffShow');
                const boxOffPrice = $('#boxOffPrice');
                const boxOffPercent = $('#boxOffPercent');

                const isCardClass = boxOffShow.hasClass('card');
                if (idOff === 'offNone') {
                    if (isCardClass) boxOffShow.removeClass('card');
                    boxOffPrice.addClass('d-none');
                    boxOffPercent.addClass('d-none');
                } else {
                    if (!isCardClass) boxOffShow.addClass('card');
                    boxOffPrice.toggleClass('d-none', idOff !== 'offPrice');
                    boxOffPercent.toggleClass('d-none', idOff !== 'offPercent');
                }
            }

            const checkedRadioButtonOff = $('input[name="off[status]"]:checked');
            if (checkedRadioButtonOff.length) {
                toggleOffDisplay(checkedRadioButtonOff.attr('id'));
            }

            $('input[name="off[status]"]').change(function() {
                toggleOffDisplay($(this).attr('id'));
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function getInputValue(item, response, categoryId) {
                for (const element of response.properties_product) {
                    if (item.id == element.id && categoryId == element.pivot.category_id) {
                        return element.pivot.value;
                    }
                }
                return '';
            }

            function createInputField(type, item, response, categoryId) {
                let inputValue = getInputValue(item, response, categoryId);
                return $(
                    `<input required class="form-control" type="${type}" placeholder="${item.title} . . ." name="properties[${item.id}]" value="${inputValue}">`
                );
            }

            function createSelectField(item, response, categoryId) {
                let selectBoxProperties = $(`<select class="form-control" name="properties[${item.id}]"></select>`);
                for (let key in item.type_input) {
                    if (key != 'type_input') {
                        let isSelected = response.properties_product.some(element => item.id == element.id &&
                            categoryId == element.pivot.category_id && key == element.pivot.value);
                        selectBoxProperties.append(
                            `<option value="${key}" ${isSelected ? 'selected' : ''}>${item.type_input[key]}</option>`
                        );
                    }
                }
                return selectBoxProperties;
            }

            function createRadioField(item, response, categoryId) {
                function isChecked(value) {
                    return response.properties_product.some(element => item.id == element.id && categoryId ==
                        element.pivot.category_id && element.pivot.value == value);
                }
                return `
                <div class="form-check form-check-inline py-2">
                    <label for="properties1[${item.id}]">بله</label>
                    <input class="form-check-input" type="radio" value="1" name="properties[${item.id}]" id="properties1[${item.id}]" ${isChecked(1) ? 'checked' : ''}>
                </div>
                <div class="form-check form-check-inline py-2">
                    <label for="properties0[${item.id}]">خیر</label>
                    <input class="form-check-input" type="radio" value="0" name="properties[${item.id}]" id="properties0[${item.id}]" ${isChecked(0) ? 'checked' : ''}>
                </div>`;
            }

            function createUnitSelectField(item, response, categoryId) {
                let selectBoxUnits = $(`<select class="form-control" name="unit[${item.id}]"></select>`);
                for (let key in item.have_unit) {
                    if (key != 'have_unit') {
                        let isSelected = response.properties_product.some(element => item.id == element.id &&
                            categoryId == element.pivot.category_id && key == element.pivot.unit);
                        selectBoxUnits.append(
                            `<option value="${key}" ${isSelected ? 'selected' : ''}>${item.have_unit[key]}</option>`
                        );
                    }
                }
                return selectBoxUnits;
            }

            function showCategory() {
                let categoryId = $('#category').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('products.category_info') }}',
                    data: {
                        id: categoryId,
                        url: "{{ $_SERVER['REQUEST_URI'] }}",
                        product_id: '{{ $product->id }}',
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        let propertiesShow = $('#propertiesShow');
                        propertiesShow.empty();

                        if (response.data.length === 0) {
                            propertiesShow.append(`
                            <div class="text-center">
                                <h6 class="text-center text-danger fw-bold">هیچ ویژگی برا این دسته بندی تعریف نشده</h6>
                                <a href="{{ route('properties.create') }}" class="text-center text-danger fw-bold">لینک افزودن ویژگی</a>
                            </div>`);
                            return;
                        }

                        response.data.forEach(item => {
                            let rowFormGroupProperties = $(
                                '<div class="row py-2" style="align-items: flex-end !important;"></div>'
                            );
                            let colSize = item.have_unit['have_unit'] ? '6' : '12';
                            let formGroup = $(
                                `<div class="form-group col-${colSize}"><label class="py-2">${item.title}</label></div>`
                            );

                            switch (item.type_input['type_input']) {
                                case 'text':
                                case 'number':
                                    formGroup.append(createInputField(item.type_input[
                                        'type_input'], item, response, categoryId));
                                    break;
                                case 'select':
                                    formGroup.append(createSelectField(item, response,
                                        categoryId));
                                    break;
                                case 'radio':
                                    formGroup.append(createRadioField(item, response,
                                        categoryId));
                                    break;
                            }
                            rowFormGroupProperties.append(formGroup);

                            if (item.have_unit['have_unit']) {
                                let unitForm = $('<div class="form-group col-6"></div>');
                                unitForm.append(createUnitSelectField(item, response,
                                    categoryId));
                                rowFormGroupProperties.append(unitForm);
                            } else {
                                rowFormGroupProperties.append(
                                    '<input type="hidden" name="unit[' + item.id +
                                    ']" value="null">');
                            }

                            propertiesShow.append(rowFormGroupProperties);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            const checkCategoryShow = $('#category option:selected');
            if (checkCategoryShow.length) {
                showCategory();
            }

            $('#category').on('change', showCategory);
        });
    </script>


    <script>
        $(document).ready(function() {
            $pic = $('<img class="img-thumbnail" id = "photo" width = "100%" height = "100%"/>');
            $("#image").change(function() {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) {
                    $("#photo").remove();
                    $lbl.appendTo("#preview");
                }
                if (/^image/.test(files[0].type)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function() {
                        $pic.appendTo("#preview");
                        $("#photo").attr("src", this.result);
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var mainproperty = document.getElementsByClassName('mainproperty');
            $('#btnCreateInput').click(function() {
                var newMainProperty = $('<div>').attr({
                    class: 'card border m-1 mainproperty',
                });
                // ------------
                $('#inputContainer').append(newMainProperty);
                // ------------
                newMainProperty.append($('<div>').text('ویژگی ' + $(mainproperty).length).attr({
                    class: 'card-header',
                }));
                // -----------------
                var cardBody = $('<div>').attr({
                    class: 'card-body',
                });
                newMainProperty.append(cardBody);
                // ----------
                var prwColor = $('<div>').text({!! json_encode($colors_index_0) !!}).attr({
                    id: 'prwColor_' + $(mainproperty).length,
                    class: 'w-100 rounded border border-dark my-2 text-center text-light',
                    style: 'background :' + {!! json_encode($colors_index_0) !!} + '; height:25px;'
                });
                cardBody.append(prwColor);

                // -----------
                cardBody.append($('<lable>').text('رنگ').attr({
                    class: 'my-3',
                }));
                var newSelectBox = $('<select>').attr({
                    class: 'form-control',
                    name: 'main_property[color_' + $(mainproperty).length + ']',
                });
                cardBody.append(newSelectBox);

                var a = {!! json_encode($colors->toArray()) !!};
                a.forEach(function(element) {
                    newSelectBox.append($('<option>').text(element['title']).attr({
                        value: element['id'],
                    }));
                });

                newSelectBox.on('change', function() {
                    var valueSelectBox = $(this).val();
                    a.forEach(function(el) {
                        if (el['id'] == valueSelectBox) {
                            prwColor.text(el['hex']).css('background-color', el['hex']);
                        }
                    });
                });


                cardBody.append($('<br>'));
                // ------------
                cardBody.append($('<lable>').text('قیمت ( تومان ) ').attr({
                    class: 'my-3',
                }));
                cardBody.append($('<input required>').attr({
                    class: 'form-control',
                    type: 'number',
                    placeholder: 'قیمت برای این رنگ را وارد کنید . . .',
                    name: 'main_property[price_' + $(mainproperty).length + ']',
                }));
                cardBody.append($('<br>'));
                // ------------
                cardBody.append($('<lable>').text('موجودی').attr({
                    class: 'my-3',
                }));
                cardBody.append($('<input required>').attr({
                    class: 'form-control',
                    type: 'number',
                    placeholder: 'موجودی . . .',
                    name: 'main_property[inventory_' + $(mainproperty).length + ']',

                }));
                // ------------
                cardBody.append($('<input required>').attr({
                    class: 'form-control',
                    type: 'hidden',
                    name: 'main_property[status_' + $(mainproperty).length + ']',
                    value: 'active',
                }));
                cardBody.append($('<input required>').attr({
                    class: 'form-control',
                    type: 'hidden',
                    name: 'main_property[card_' + $(mainproperty).length + ']',
                    value: $(mainproperty).length,
                }));

            });
        });
    </script>

@endsection
