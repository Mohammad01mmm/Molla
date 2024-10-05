@extends('admin.master')
@section('title', 'ویرایش کاربر ' . $user->name)
@section('main')
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row flex-lg-row-reverse">
            <div class="col-lg-9 my-2">
                <div class="card dir-rtl shadow">
                    <div class="card-header fw-bold">
                        ویرایش کاربر {{ $user->name }}
                    </div>
                    <div class="card-body">
                        @if ($errors->all())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li class="m-1 mx-4">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group py-2">
                            <label for="name" class="pb-3"> نام </label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="نام . . ."
                                value="{{ $user->name }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="password" class="pb-3"> پسورد </label>
                            <div class="input-group">
                                <input id="password" name="password" type="password" class="form-control rounded"
                                    placeholder="پسورد . . ."
                                    style="border-start-end-radius: 0px !important;border-end-end-radius: 0px !important;">

                                <button class="btn btn-outline-primary rounded" type="button" id="password-toggle"
                                    style="border-start-start-radius: 0px !important;border-end-start-radius: 0px !important;">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </button>
                            </div>
                            <div class="dir-ltr my-2">
                                <button class="btn btn-warning fw-bold text-light" type="button" id="randomPassword">
                                    <span> Random Password </span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="email" class="pb-3"> ایمیل </label>
                            <input id="email" name="email" type="email" class="form-control"
                                placeholder="ایمیل . . ." value="{{ $user->email }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="description" class="pb-3"> توضیحات </label>
                            <textarea id="description" name="description" class="form-control" placeholder="توضیحات . . .">{{ $user->description }}</textarea>
                        </div>
                        <div class="form-group py-2">
                            <label class="pb-3"> نوع کاربر </label>
                            <br>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="type" id="admin" value="admin"
                                    {{ $user->type == 'admin' ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="admin"> ادمین </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="type" id="user" value="user"
                                    {{ $user->type == 'user' ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="user"> کاربر </label>
                            </div>
                        </div>
                        @if ($user->type == 'admin')
                            <div class="form-group py-2">
                                @foreach ($roles as $key => $role)
                                    <input id="{{ $role->id }}" name="roles[{{ $role->id }}]" type="checkbox"
                                        class="form-check-input mx-1" value="{{ $role->id }}"
                                        @foreach ($user->roles()->get() as $item)
                                        @if ($item->id == $role->id)
                                            checked
                                        @endif @endforeach>

                                    <label for="{{ $role->id }}" class="pb-3">
                                        {{ $role->title }}
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
                                                    <button type="button" class="btn btn-danger w-100"
                                                        data-bs-dismiss="modal">
                                                        بستن
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            </div>
                        @endif
                        <hr>
                        <div class="form-group py-2">
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="active"
                                    value="1" {{ $user->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="active"> فعال </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="passive"
                                    value="0" {{ $user->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning text-light fw-bold my-3 w-100 " value="ویرایش">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 my-2">
                <div class="card mb-3 dir-rtl shadow">
                    <div class="card-header fw-bold">
                        تصویر کاربر {{ $user->name }}
                    </div>
                    <div class="card-body">
                        <label class="w-100 p-3 text-center bg-light rounded-3 shadow border border-secondary"
                            for="image" id="lblImage" style="height: 300px;">
                            <input name="image" type="file" accept="image/*" id="image" hidden>
                            <div id="imgPreview"
                                class="text-center w-100 h-100 rounded-3 border-primary d-flex flex-column justify-content-center align-items-center "
                                style="border: dashed 2px;background-color: #f7f8ff !important;cursor: pointer;">
                                <i class="bi bi-cloud-arrow-up-fill fs-1 fw-bold text-primary"></i>
                                <p> Drag and drop or click here <br> to upload image </p>
                                <small class="text-muted"> بهتره اندازه عکس 300 در 300 باشد </small>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="card mb-3 shadow">
                    <div class="card-header text-center fw-bold ">
                        تصویر کاربر
                    </div>
                    <div class="card-body">
                        <div>
                            <img class="img-fluid img-thumbnail " src="{{ asset($user->image) }}"
                                alt="{{ $user->title }}">
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
                <div class="card dir-rtl mb-3 shadow">
                    <div class="card-body">
                        <div class="form-group py-2">
                            <label for="created_at" class="pb-3"> تاریخ ساخت </label>
                            <input type="text" disabled class="form-control dir-ltr" value="{{ $user->created_at }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="updated_at" class="pb-3"> تاریخ آخرین ویرایش </label>
                            <input type="text" disabled class="form-control dir-ltr" value="{{ $user->updated_at }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        const $lblImage = $('#lblImage');
        const $image = $('#image');
        const $imgPreview = $('#imgPreview');

        $image.on('change', uploadImage);

        function uploadImage() {
            let imgLink = URL.createObjectURL($image[0].files[0]);
            $imgPreview.text('');
            $imgPreview.css('background-image', `url(${imgLink})`);
            $imgPreview.css('background-repeat', 'no-repeat');
            $imgPreview.css('background-position', 'center');
            $imgPreview.css('background-size', 'cover');
        }

        $lblImage.on('dragover', function(e) {
            e.preventDefault();
        });

        $lblImage.on('drop', function(e) {
            e.preventDefault();
            $image[0].files = e.originalEvent.dataTransfer.files;
            uploadImage();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#password-toggle').click(function() {
                var passwordInput = $('#password');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    $(this).find('i').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
                } else {
                    passwordInput.attr('type', 'password');
                    $(this).find('i').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function generatePassword(length) {
                var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789(!@#$%^&*()+)";
                var password = "";
                for (var i = 0; i < length; i++) {
                    password += charset[Math.floor(Math.random() * charset.length)];
                }
                return password;
            }

            $('#randomPassword').click(function() {
                var password = generatePassword(12);
                $('#password').val(password);
            });
        });
    </script>
@endsection
