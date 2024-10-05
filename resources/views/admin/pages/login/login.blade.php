@extends('admin.master')
@section('style')
    <style>
        #card_login_admin {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .input_login_admin,
        .input_login_admin:active,
        .input_login_admin:focus {
            background: transparent;
            box-shadow: none;
        }

        .input_login_admin::placeholder {
            color: #ffffffaa;
        }
    </style>
@endsection
@section('title', 'ورود')
@section('main')
    <div class="vh-100"
        style="background-image: url({{ asset('admin/asset/images/background.png)') }};
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;">
        <div class="row">
            <div class="col-lg-4 col-md-7 position-absolute top-50 start-50" style="transform: translate(-50%, -50%);">
                <div class="card border text-light" id="card_login_admin">
                    <div class="card-header border dir-rtl">
                        <h5> ورود </h5>
                    </div>
                    <div class="card-body dir-rtl">
                        <form action="{{ route('auth-admin') }}" method="post">
                            @csrf
                            @if ($errors->all() || Session::has('error'))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li class="mx-4">{{ $error }}</li>
                                    @endforeach
                                    @if (Session::has('error'))
                                        <li class="mx-4">{{ Session::get('error') }}</li>
                                    @endif
                                </ul>
                            @endif
                            <div class="form-group my-3">
                                <label class="mb-3" for="email"> آدرس ایمیل </label>
                                <input class="form-control border text-light input_login_admin" type="email"
                                    name="email" id="email" placeholder="لطفا ایمیل خود را وارد کنید . . .">
                            </div>
                            <div class="form-group my-3">
                                <label class="mb-3" for="password"> رمز عبور </label>
                                <input class="form-control border text-light input_login_admin" type="password"
                                    name="password" id="password" placeholder="لطفا رمز عبور خود را وارد کنید . . .">
                            </div>
                            <input class="btn btn-success w-100 mt-3 fw-bold" type="submit" value="ورود">
                            <a href="{{ route('front.index') }}" class="btn btn-warning w-100 mt-3 fw-bold text-light"> صفحه
                                اصلی </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
