@extends('admin.master')
@section('title', 'افزودن مدیر جدید')
@section('main')
    <form action="{{ route('managers.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row flex-lg-row-reverse">
            <div class="col-lg-9 my-2">
                <div class="card dir-rtl shadow">
                    <div class="card-header fw-bold">
                        افزودن مدیر جدید
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-1">
                            <div class="btn btn-warning px-4">
                                <a href="{{ route('roles.index') }}" class="text-light text-decoration-none fw-bold">
                                    نقش
                                </a>
                            </div>
                        </div>
                        @if ($errors->all())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li class="m-1 mx-4">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group py-2">
                            <label for="name" class="pb-3"> نام </label>
                            <input id="name" name="name" type="text" class="form-control"
                                placeholder="نام . . .">
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
                                placeholder="ایمیل . . .">
                        </div>
                        <div class="form-group py-2">
                            @foreach ($roles as $key => $role)
                                <input id="{{ $role->id }}" name="roles[{{ $role->id }}]" type="checkbox"
                                    class="form-check-input mx-1" value="{{ $role->id }}">

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
                            <label for="description" class="pb-3"> توضیحات </label>
                            <textarea id="description" name="description" class="form-control" placeholder="توضیحات . . ."></textarea>
                        </div>
                        <div class="form-group py-2">
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1"
                                    checked>
                                <label class="form-check-label mx-1" for="active"> فعال </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="passive"
                                    value="0">
                                <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success my-3 w-100 fw-bold" value="ثبت">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 my-2">
                <div class="card dir-rtl shadow">
                    <div class="card-header fw-bold">
                        تصویر مدیر جدید
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
