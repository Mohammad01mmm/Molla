@extends('admin.master')
@section('title', 'ویرایش دسترسی ' . $permission->title)
@section('main')
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-9 my-2">
            <div class="card dir-rtl shadow">
                <div class="card-header fw-bold">
                    ویرایش دسترسی {{ $permission->title }}
                </div>
                <div class="card-body">
                    <form action="{{ route('permissions.update', ['permission' => $permission->id]) }}" method="post"
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
                                placeholder="عنوان . . ." value="{{ $permission->title }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="description" class="pb-3"> توضیحات </label>
                            <textarea id="description" name="description" class="form-control" placeholder="توضیحات . . .">{{ $permission->description }}</textarea>
                        </div>
                        <div class="form-group py-2">
                            @foreach ($roles as $key => $role)
                                <input id="{{ $role->id }}" name="roles[{{ $role->id }}]" type="checkbox"
                                    class="form-check-input mx-1" value="{{ $role->id }}"
                                    @foreach ($permission->roles()->get() as $item)
                                        @if ($item->id == $role->id)
                                            checked
                                        @endif @endforeach>

                                <label for="{{ $role->id }}" class="pb-3"> {{ $role->title }}
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
                                                <h5 class="modal-title dir-ltr text-left"
                                                    id="exampleModalLabel{{ $key }}">
                                                    {{ $role->title }}
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                <h5> {{ $role->title }} </h5>
                                                <hr>
                                                <p class="text-justify"> {{ $role->description }} </p>
                                                <hr>
                                                <h6> دسترسی های {{ $role->title }} </h6>
                                                <ul>
                                                    @foreach ($role->permissions()->get() as $permission)
                                                        <li> {{ $permission->title }} </li>
                                                    @endforeach
                                                </ul>
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
                                    {{ $permission->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="active"> فعال </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="passive" value="0"
                                    {{ $permission->status == 0 ? 'checked' : '' }}>
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
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $permission->created_at }}">
                    </div>
                    <div class="form-group py-2">
                        <label for="updated_at" class="pb-3"> تاریخ آخرین ویرایش </label>
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $permission->updated_at }}">
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
