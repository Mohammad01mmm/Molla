@extends('admin.master')
@section('title', 'ویرایش دسته بندی ' . $category->title)
@section('main')
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-9 my-2">
            <div class="card dir-rtl shadow">
                <div class="card-header fw-bold">
                    ویرایش دسته بندی {{ $category->title }}
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post"
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
                                placeholder="عنوان . . ." value="{{ $category->title }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="image" class="pb-3"> تصویر </label>
                            <input id="image" name="image" type="file" class="form-control">
                            <span class="text-muted fw-bold fs-6 p-4">
                            </span>
                            <div class="dir-ltr">
                                <div id ="preview" class="w-25 shadow mt-3"></div>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            @foreach ($properties as $key => $property)
                                <input id="property[{{ $property->name_property }}]" name="property[{{ $property->id }}]"
                                    type="checkbox" class="form-check-input mx-1" value="{{ $property->id }}"
                                    @foreach ($category->properties()->get() as $item)
                                        @if ($item->id == $property->id)
                                            checked
                                        @endif @endforeach>
                                <label for="property[{{ $property->name_property }}]" class="pb-3"> {{ $property->title }}
                                    |
                                    {{ $property->name_property }}
                                </label>

                                <!-- Button trigger modal -->
                                <span data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key }}">
                                    <i class="bi bi-info-circle-fill text-primary" style="cursor: pointer"></i>
                                </span>

                                <!-- Modal -->
                                <div class="modal fade shadow" id="exampleModal{{ $key }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel{{ $key }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <h5 class="modal-title" id="exampleModalLabel{{ $key }}">
                                                    {{ $property->title }} |
                                                    {{ $property->name_property }}
                                                </h5>

                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <tr class="text-center">
                                                                    <td> نوع ورودی </td>
                                                                    <td> {{ $property->type_input['type_input'] }} </td>
                                                                </tr>
                                                                @php
                                                                    $i = 0;
                                                                @endphp
                                                                @foreach ($property->type_input as $value)
                                                                    @if (!$loop->first)
                                                                        <tr class="text-center">
                                                                            @php
                                                                                $i++;
                                                                            @endphp
                                                                            <td> مقدار {{ $i }} </td>
                                                                            <td> {{ $value }} </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-6">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <tr class="text-center">
                                                                    <td> واحد دارد </td>
                                                                    <td>
                                                                        @if ($property->have_unit['have_unit'] == 1)
                                                                            <span class="text-success"> دارد </span>
                                                                        @else
                                                                            <span class="text-danger"> ندارد </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $i = 0;
                                                                @endphp
                                                                @foreach ($property->have_unit as $value)
                                                                    @if (!$loop->first)
                                                                        <tr class="text-center">
                                                                            @php
                                                                                $i++;
                                                                            @endphp
                                                                            <td> واحد {{ $i }} </td>
                                                                            <td> {{ $value }} </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                                    بستن
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                        <div class="form-group py-2">
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1"
                                    {{ $category->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="active"> فعال </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="passive" value="0"
                                    {{ $category->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning text-light fw-bold my-3 w-100 " value="ویرایش">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 my-2">
            <div class="card mb-3 shadow">
                <div class="card-header text-center fw-bold ">
                    تصویر دسته بندی
                </div>
                <div class="card-body">
                    <div>
                        <img class="img-fluid img-thumbnail " src="{{ asset($category->image) }}"
                            alt="{{ $category->title }}">
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
    </div>
@endsection
@section('script')
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
@endsection
