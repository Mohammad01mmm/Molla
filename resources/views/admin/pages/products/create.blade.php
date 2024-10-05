@extends('admin.master')
@section('title', 'افزودن محصول')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            افزودن محصول
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                    <input id="title" name="title" type="text" class="form-control" placeholder="عنوان . . ."
                        required>
                </div>
                <div class="form-group py-2">
                    <label for="description" class="pb-3"> توضیحات محصول </label>
                    <textarea id="description" name="description" class="form-control" placeholder="توضیحات محصول . . ." required></textarea>
                </div>
                <div class="form-group py-2">
                    <label for="color" class="pb-3"> رنگ </label>
                    <br>
                    @if (count($colors) != 0)
                        <div class="d-flex flex-wrap">
                            <div id="inputContainer" class="d-flex flex-wrap"></div>
                            <button class="btn btn-success m-2" id="btnCreateInput" type="button">
                                <i class="bi bi-plus-circle-fill"></i>
                            </button>
                        </div>
                    @else
                        <div class="text-center text-danger fw-bold">
                            لطفا حداقل یک رنگ را اضافه کنید <br>
                            <a class="text-center text-danger fw-bold" href="{{ route('colors.create') }}"> لینک افزودن رنگ
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
                        <input class="form-check-input" type="radio" name="off[status]" id="offNone" value="none">
                        <label class="form-check-label mx-1" for="offNone"> تخفیف ندارد </label>
                    </div>
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="off[status]" id="offPercent" value="percent"
                            checked>
                        <label class="form-check-label mx-1" for="offPercent"> تخفیف درصدی </label>
                    </div>
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="off[status]" id="offPrice" value="price">
                        <label class="form-check-label mx-1" for="offPrice"> تخفیف عددی </label>
                    </div>
                    <div id="boxOffShow" class="my-3 ">
                        <div class="p-2 d-none" id="boxOffPercent">
                            <div class="form-group p-2">
                                <label> درصد تخفیف </label>
                                <div class="input-group dir-ltr my-2">
                                    <span class="input-group-text"> % </span>
                                    <input type="number" class="form-control dir-rtl"
                                        placeholder=' درصد تخفیف را وارد کنید . . . ' name="off[input_percent_num]">
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <label> مدت تخفیف </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control my-2"
                                            placeholder=' مدت زمان تخفیف را وارد کنید . . . '
                                            name="off[input_percent_time]">
                                        <del class="text-danger fw-bold small"> بدین شکل مورد قبول نمی باشد 10:30 </del>
                                    </div>
                                    <div class="col-6">
                                        <select type="number" class="form-control my-2"
                                            name="off[input_percent_unit_time]">
                                            <option value="minutes"> دقیقه </option>
                                            <option value="hour"> ساعت </option>
                                            <option value="day"> روز </option>
                                            <option value="week"> هفته </option>
                                            <option value="month"> ماه </option>
                                            <option value="year"> سال </option>
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
                                        placeholder=' مبلغ تخفیف را وارد کنید . . . ' name="off[input_price_num]">
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <label> مدت تخفیف </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control my-2"
                                            placeholder=' مدت زمان تخفیف را وارد کنید . . . '
                                            name="off[input_price_time]">
                                        <del class="text-danger fw-bold small"> بدین شکل مورد قبول نمی باشد 10:30 </del>
                                    </div>
                                    <div class="col-6">
                                        <select type="number" class="form-control my-2"
                                            name="off[input_price_unit_time]">
                                            <option value="minutes"> دقیقه </option>
                                            <option value="hour"> ساعت </option>
                                            <option value="day"> روز </option>
                                            <option value="week"> هفته </option>
                                            <option value="month"> ماه </option>
                                            <option value="year"> سال </option>
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
                            <option value="{{ $category->id }}" @if ($loop->first) selected @endif>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>

                    <div class="card my-2">
                        <div class="card-body">
                            <label> ویژگی ها </label>
                            <div id="propertiesShow"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group py-2">
                    <label for="tags" class="pb-3"> تگ ها </label>
                    <input type="text" name="tags" id="input-tag"
                        class="form-control text-right dir-rtl"
                        placeholder="لطفا تگ های محصول را وارد کنید . . . ">

                    <div class="d-flex justify-content-start align-items-center flex-wrap w-100 my-2" id="tags"></div>
                </div>

                <div class="form-group py-2">
                    <label for="image" class="pb-3"> تصویر شاخص </label>
                    <input id="image" name="image" type="file" class="form-control" required>
                    <span class="text-muted fw-bold fs-6 p-4">
                        بهترین اندازه برای تصویر شاخص محصول عرض 600 و ارتفاع 600 است .
                    </span>
                    <div class="dir-ltr">
                        <div id ="preview" class="w-25 shadow mt-3"></div>
                    </div>
                </div>
                <div class="form-group py-2">
                    <label for="images" class="pb-3"> تصاویر محصول </label>
                    <input id="images" name="images[]" type="file" class="form-control" required multiple>
                    <span class="text-muted fw-bold fs-6 p-4">
                        بهترین اندازه برای تصاویر محصول عرض 600 و ارتفاع 600 است .
                    </span>
                </div>
                <div class="form-group py-2">
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="status" id="active" value="1"
                            checked>
                        <label class="form-check-label mx-1" for="active"> فعال </label>
                    </div>
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="status" id="passive" value="0">
                        <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                    </div>
                </div>
                <input type="submit" class="btn btn-success my-3 w-100 fw-bold" value="ثبت"
                    @if (count($colors) == 0) disabled @endif>
            </form>
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
                // console.log(event.which);
                
                // Check if the key pressed is 'Enter'
                if (event.which == 13) {
                    // Prevent the default action of the keypress event (submitting the form)
                    event.preventDefault();

                    // Get the trimmed value of the input element
                    let tagContent = input.val().trim();

                    // If the trimmed value is not an empty string
                    if (tagContent !== '') {
                        // Create a new list item element for the tag

                        const tag = $('<div class="bg-primary text-light fw-bold pe-3 rounded-pill m-1"></div>').text(
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

            function resetInputs() {
                $('#boxOffPercent input, #boxOffPrice input').val('');
            }

            function toggleOffBoxes(showCard, showPercent, showPrice) {
                $('#boxOffShow').toggleClass('card', showCard);
                $('#boxOffPercent').toggleClass('d-none', !showPercent);
                $('#boxOffPrice').toggleClass('d-none', !showPrice);
            }

            function checkRadioOff(idOff) {
                resetInputs();
                switch (idOff) {
                    case 'offNone':
                        toggleOffBoxes(false, false, false);
                        break;
                    case 'offPercent':
                        toggleOffBoxes(true, true, false);
                        break;
                    case 'offPrice':
                        toggleOffBoxes(true, false, true);
                        break;
                }
            }

            const checkedRadioButtonOff = $('input[name="off[status]"]:checked').attr('id');
            if (checkedRadioButtonOff) {
                checkRadioOff(checkedRadioButtonOff);
            }

            $('input[name="off[status]"]').change(function() {
                checkRadioOff($(this).attr('id'));
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function createFormGroup(colSize, label, input) {
                return `
                <div class="form-group col-${colSize}">
                    <label class="py-2">${label}</label>
                    ${input}
                </div>`;
            }

            function createRadioInput(itemId, value, labelText, checked = false) {
                return `
                <div class="form-check form-check-inline py-2">
                    <label for="properties${value}[${itemId}]">${labelText}</label>
                    <input class="form-check-input" type="radio" value="${value}" name="properties[${itemId}]" id="properties${value}[${itemId}]" ${checked ? 'checked' : ''}>
                </div>`;
            }

            function showCategory() {
                const categoryId = $('#category').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('products.category_info') }}',
                    data: {
                        id: categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        const propertiesShow = $('#propertiesShow');
                        propertiesShow.empty();

                        if (response.data.length === 0) {
                            const nullProperties = `
                            <div class="text-center">
                                <h6 class="text-center text-danger fw-bold">هیچ ویژگی برا این دسته بندی تعریف نشده</h6>
                                <a href="{{ route('properties.create') }}" class="text-center text-danger fw-bold">لینک افزودن ویژگی</a>
                            </div>`;
                            propertiesShow.append(nullProperties);
                            return;
                        }

                        response.data.forEach(item => {
                            const haveUnit = item.have_unit['have_unit'];
                            const colSize = haveUnit ? 6 : 12;
                            const inputType = item.type_input['type_input'];
                            let inputField = '';

                            switch (inputType) {
                                case 'text':
                                    inputField =
                                        `<input required class="form-control" type="text" placeholder="${item.title} . . ." name="properties[${item.id}]">`;
                                    break;
                                case 'number':
                                    inputField =
                                        `<input required class="form-control" type="number" placeholder="${item.title} . . ." name="properties[${item.id}]">`;
                                    break;
                                case 'select':
                                    const options = Object.keys(item.type_input)
                                        .filter(key => key !== 'type_input')
                                        .map(key =>
                                            `<option value="${key}">${item.type_input[key]}</option>`
                                        )
                                        .join('');
                                    inputField =
                                        `<select class="form-control" name="properties[${item.id}]">${options}</select>`;
                                    break;
                                case 'radio':
                                    inputField = `
                                    <br>
                                    ${createRadioInput(item.id, 1, 'بله', true)}
                                    ${createRadioInput(item.id, 0, 'خیر')}`;
                                    break;
                            }

                            const formGroup = createFormGroup(colSize, item.title, inputField);
                            let rowFormGroupProperties =
                                `<div class="row py-2" style="align-items: flex-end !important;">${formGroup}`;

                            if (haveUnit) {
                                const unitOptions = Object.keys(item.have_unit)
                                    .filter(key => key !== 'have_unit')
                                    .map(key =>
                                        `<option value="${key}">${item.have_unit[key]}</option>`
                                    )
                                    .join('');
                                const unitForm = createFormGroup(6, '',
                                    `<select class="form-control" name="unit[${item.id}]">${unitOptions}</select>`
                                );
                                rowFormGroupProperties += unitForm;
                            } else {
                                rowFormGroupProperties +=
                                    `<input value="null" name="unit[${item.id}]" type="hidden">`;
                            }

                            rowFormGroupProperties += `</div>`;
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
                    name: 'main_property[card_' + $(mainproperty).length + ']',
                    value: $(mainproperty).length,
                }));

            });
        });
    </script>
@endsection
