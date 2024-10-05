@extends('admin.master')
@section('title', 'ویرایش بلاگ ' . $blog->title)
@section('main')
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-9 my-2">
            <div class="card dir-rtl shadow">
                <div class="card-header fw-bold">
                    ویرایش بلاگ {{ $blog->title }}
                </div>
                <div class="card-body">
                    <form action="{{ route('blogs.update', ['blog' => $blog->id]) }}" method="post"
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
                                placeholder="عنوان . . ." value="{{ $blog->title }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="description" class="pb-3"> توضیحات </label>
                            <textarea id="description" name="description" class="form-control" placeholder="توضیحات . . .">{{ $blog->description }}</textarea>
                        </div>
                        <div class="form-group py-2">
                            <label for="image" class="pb-3"> تصویر </label>
                            <input id="image" name="image" type="file" class="form-control">
                            <span class="text-muted fw-bold fs-6 p-4">
                                بهترین اندازه برای بلاگ عرض 600px و ارتفاع 600px است .
                            </span>
                            <div class="dir-ltr">
                                <div id ="preview" class="w-25 shadow mt-3"></div>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1"
                                    {{ $blog->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="active"> فعال </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="passive" value="0"
                                    {{ $blog->status == 0 ? 'checked' : '' }}>
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
                    تصویر بلاگ
                </div>
                <div class="card-body">
                    <div>
                        <img class="img-fluid img-thumbnail " src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
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
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $blog->created_at }}">
                    </div>
                    <div class="form-group py-2">
                        <label for="updated_at" class="pb-3"> تاریخ آخرین ویرایش </label>
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $blog->updated_at }}">
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
