@extends('admin.master')
@section('title', 'افزودن بلاگ')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            افزودن بلاگ
        </div>
        <div class="card-body">
            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($errors->all())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="m-1 mx-4">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group py-2">
                    <label for="title" class="pb-3"> عنوان </label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="عنوان . . .">
                </div>
                <div class="form-group py-2">
                    <label for="description" class="pb-3"> توضیحات </label>
                    <textarea id="description" name="description" class="form-control" placeholder="توضیحات . . ."></textarea>
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
                        <input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
                        <label class="form-check-label mx-1" for="active"> فعال </label>
                    </div>
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="status" id="passive" value="0">
                        <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                    </div>
                </div>
                <input type="submit" class="btn btn-success my-3 w-100 fw-bold" value="ثبت">
            </form>
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
