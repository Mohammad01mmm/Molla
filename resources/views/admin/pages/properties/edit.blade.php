@extends('admin.master')
@section('title', 'ویرایش ویژگی ' . $property->title)
@section('main')
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-9 my-2">
            <div class="card dir-rtl shadow">
                <div class="card-header fw-bold">
                    ویرایش ویژگی {{ $property->title }}
                </div>
                <div class="card-body">
                    <form action="{{ route('properties.update', ['property' => $property->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($errors->all())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li class="m-1 mx-4">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group py-2">
                            <label for="title" class="pb-3"> عنوان </label>
                            <input id="title" name="title" type="text" class="form-control"
                                placeholder="عنوان . . ." value="{{ $property->title }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="name_property" class="pb-3"> نام ویژگی </label>
                            <input id="name_property" name="name_property" type="text" class="form-control"
                                placeholder="نام ویژگی . . ." value="{{ $property->name_property }}">
                            <small class="text-muted fw-bold"> نام ویژگی را به انگلیسی وارد کنید </small>
                            <br>
                            <small class="text-danger fw-bold"> از گذاشتن فاصله <u> خوداری </u> کنید </small>
                        </div>
                        <div class="card shadow p-2">
                            <div class="form-group py-2">
                                <label for="title" class="pb-3"> نوع ورودی </label>
                                <br>
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input" type="radio" name="type_input" id="text"
                                        value="text" onclick="checkRadio()"
                                        {{ $property->type_input['type_input'] == 'text' ? 'checked' : '' }}>
                                    <label class="form-check-label mx-1" for="text"> Text </label>
                                </div>
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input" type="radio" name="type_input" id="number"
                                        value="number" onclick="checkRadio()"
                                        {{ $property->type_input['type_input'] == 'number' ? 'checked' : '' }}>
                                    <label class="form-check-label mx-1" for="number"> Number </label>
                                </div>
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input" type="radio" name="type_input" id="select"
                                        value="select" onclick="checkRadio()"
                                        {{ $property->type_input['type_input'] == 'select' ? 'checked' : '' }}>
                                    <label class="form-check-label mx-1" for="select"> Select </label>
                                </div>
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input" type="radio" name="type_input" id="radio"
                                        value="radio" onclick="checkRadio()"
                                        {{ $property->type_input['type_input'] == 'radio' ? 'checked' : '' }}>
                                    <label class="form-check-label mx-1" for="radio"> Radio </label>
                                </div>
                            </div>
                            <div class="form-group py-2">
                                <label for="have_unit" class="pb-3"> واحد دارد ؟ </label>
                                <input id="have_unit" name="have_unit" type="checkbox" class="form-check-input"
                                    onclick="checkCheckbox()" value="check"
                                    {{ $property->have_unit['have_unit'] == true ? 'checked' : '' }}>
                            </div>
                            <div class="py-2" id="textElement" style="display: block;">
                            </div>
                            <div class="py-2" id="numberElement" style="display: none;">
                            </div>
                            <div class="py-2" id="selectElement" style="display: none;">
                                <div class="text-left mx-3">
                                    <div
                                        class="btn-group dir-ltr border rounded-3 border-bottom-0 rounded-bottom-0 border-secondary-subtle">
                                        <button type="button" class="btn border rounded-bottom-0 btn-light"
                                            title="چپ به راست" id="ltr_type_input"> LTR
                                        </button>
                                        <button type="button" class="btn border rounded-bottom-0 btn-light"
                                            title="راست به چپ" id='rtl_type_input'> RTL
                                        </button>
                                    </div>
                                </div>
                                <textarea class="form-control" id="textarea_select_input" name="textarea_select_input"
                                    placeholder="لطفا آپشن های سلکت باکس را وارد کنید . . .">{{ implode(' | ', array_slice($property->type_input, 1)) }}</textarea>
                                <small class="text-muted fw-bold"> بدین شکل مقادیر را قرار دهید </small>
                                <br>
                                <small class="text-muted fw-bold"> مقدار 1 | مقدار 2 | مقدار 3 | . . . </small>
                            </div>
                            <div class="py-2" id="radioElement" style="display: none;">
                            </div>
                            <div id="unit" class="py-2" style="display: none;">
                                <div class="text-left mx-3">
                                    <div
                                        class="btn-group dir-ltr border rounded-3 border-bottom-0 rounded-bottom-0 border-secondary-subtle">
                                        <button type="button" class="btn border rounded-bottom-0 btn-light"
                                            title="چپ به راست" id="ltr_unit"> LTR
                                        </button>
                                        <button type="button" class="btn border rounded-bottom-0 btn-light"
                                            title="راست به چپ" id='rtl_unit'> RTL
                                        </button>
                                    </div>
                                </div>
                                <textarea class="form-control" id="textarea_unit"
                                    placeholder="لطفا مقدار های واحد اندازه گیری ویژگی را وارد کنید . . ." name="textarea_unit">
{{ implode(' | ', array_slice($property->have_unit, 1)) }}
</textarea>
                                <small class="text-muted fw-bold"> بدین شکل مقادیر را قرار دهید </small>
                                <br>
                                <small class="text-muted fw-bold"> مقدار 1 | مقدار 2 | مقدار 3 | . . . </small>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="active"
                                    value="1" {{ $property->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="active"> فعال </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="passive"
                                    value="0" {{ $property->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning text-light fw-bold my-3 w-100 " value="ویرایش">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 my-2">
            <div class="card dir-rtl mb-5 shadow">
                <div class="card-body">
                    <div class="form-group py-2">
                        <label for="created_at" class="pb-3"> تاریخ ساخت </label>
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $property->created_at }}">
                    </div>
                    <div class="form-group py-2">
                        <label for="updated_at" class="pb-3"> تاریخ آخرین ویرایش </label>
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $property->updated_at }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById('ltr_type_input').addEventListener('click', function() {
            document.getElementById('textarea_select_input').setAttribute("dir", "ltr");
        });
        document.getElementById('rtl_type_input').addEventListener('click', function() {
            document.getElementById('textarea_select_input').setAttribute("dir", "rtl");
        });

        document.getElementById('ltr_unit').addEventListener('click', function() {
            document.getElementById('textarea_unit').setAttribute("dir", "ltr");
        });
        document.getElementById('rtl_unit').addEventListener('click', function() {
            document.getElementById('textarea_unit').setAttribute("dir", "rtl");
        });

        // ---------------------------------------------------------------------------------------------
        var radios = document.getElementsByName('type_input');


        var isTextSelected = false;
        var isNumberSelected = false;
        var isSelectSelected = false;
        var isRadioSelected = false;


        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked && radios[i].value === 'text') {
                isTextSelected = true;
                break;
            }
            if (radios[i].checked && radios[i].value === 'number') {
                isNumberSelected = true;
                break;
            }
            if (radios[i].checked && radios[i].value === 'select') {
                isSelectSelected = true;
                break;
            }
            if (radios[i].checked && radios[i].value === 'radio') {
                isRadioSelected = true;
                break;
            }
        }

        var textElement = document.getElementById('textElement');
        if (isTextSelected) {
            textElement.style.display = 'block';
        } else {
            textElement.style.display = 'none';
        }

        var numberElement = document.getElementById('numberElement');
        if (isNumberSelected) {
            numberElement.style.display = 'block';
        } else {
            numberElement.style.display = 'none';
        }

        var selectElement = document.getElementById('selectElement');
        var textarea_select_input = document.getElementById('textarea_select_input');
        if (isSelectSelected) {
            selectElement.style.display = 'block';
            textarea_select_input.required = true;
        } else {
            selectElement.style.display = 'none';
            textarea_select_input.required = false;
        }

        var radioElement = document.getElementById('radioElement');
        if (isRadioSelected) {
            radioElement.style.display = 'block';
        } else {
            radioElement.style.display = 'none';
        }
        // ------------------------------------------------------------------------------------------------------
        function checkRadio() {
            var radios = document.getElementsByName('type_input');


            var isTextSelected = false;
            var isNumberSelected = false;
            var isSelectSelected = false;
            var isRadioSelected = false;


            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked && radios[i].value === 'text') {
                    isTextSelected = true;
                    break;
                }
                if (radios[i].checked && radios[i].value === 'number') {
                    isNumberSelected = true;
                    break;
                }
                if (radios[i].checked && radios[i].value === 'select') {
                    isSelectSelected = true;
                    break;
                }
                if (radios[i].checked && radios[i].value === 'radio') {
                    isRadioSelected = true;
                    break;
                }
            }

            var textElement = document.getElementById('textElement');
            if (isTextSelected) {
                textElement.style.display = 'block';
            } else {
                textElement.style.display = 'none';
            }

            var numberElement = document.getElementById('numberElement');
            if (isNumberSelected) {
                numberElement.style.display = 'block';
            } else {
                numberElement.style.display = 'none';
            }

            var selectElement = document.getElementById('selectElement');
            var textarea_select_input = document.getElementById('textarea_select_input');
            if (isSelectSelected) {
                selectElement.style.display = 'block';
                textarea_select_input.value = '';
                textarea_select_input.required = true;
            } else {
                selectElement.style.display = 'none';
                textarea_select_input.value = '';
                textarea_select_input.required = false;
            }

            var radioElement = document.getElementById('radioElement');
            if (isRadioSelected) {
                radioElement.style.display = 'block';
            } else {
                radioElement.style.display = 'none';
            }


        }

        var have_unit = document.getElementById('have_unit');
        var unit = document.getElementById('unit');
        var textarea_unit = document.getElementById('textarea_unit');
        if (have_unit.checked && have_unit.value === 'check') {
            unit.style.display = 'block';
            textarea_unit.required = true;
        } else {
            unit.style.display = 'none';
            textarea_unit.required = false;
        }


        function checkCheckbox() {
            var have_unit = document.getElementById('have_unit');
            var unit = document.getElementById('unit');
            var textarea_unit = document.getElementById('textarea_unit');
            if (have_unit.checked && have_unit.value === 'check') {
                unit.style.display = 'block';
                textarea_unit.value = '';
                textarea_unit.required = true;
            } else {
                unit.style.display = 'none';
                textarea_unit.value = '';
                textarea_unit.required = false;
            }
        }
    </script>
@endsection
