@extends('front.master')
@section('main')
    <main class="main">
        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
            style="background-image: url('front/assets/images/backgrounds/login-bg.jpg')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab"
                                    aria-controls="signin" aria-selected="true"> ورود </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                    aria-controls="register" aria-selected="false">ثبت نام</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                aria-labelledby="signin-tab">
                                <form action="{{ route('front.login') }}" method="post">
                                    @csrf
                                    @if ($errors->all())
                                        <ul class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li class="m-1 mx-4">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <br>
                                    @endif
                                    @if (Session::has('error'))
                                        <ul class="alert alert-danger">
                                            <li class="mx-4">{{ Session::get('error') }}</li>
                                        </ul>
                                        <br>
                                    @endif
                                    <div class="form-group">
                                        <label for="email">آدرس ایمیل شما *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="password">رمز عبور *</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer border-0">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <span>ورود</span>
                                            <i class="icon-long-arrow-left"></i>
                                        </button>

                                        <a href="#" class="forgot-link">رمز عبور خود را فراموش کرده اید؟</a>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="{{ route('front.register') }}" method="post">
                                    @csrf
                                    @if ($errors->all())
                                        <ul class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li class="m-1 mx-4">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <br>
                                    @endif
                                    @if (Session::has('error'))
                                        <ul class="alert alert-danger">
                                            <li class="mx-4">{{ Session::get('error') }}</li>
                                        </ul>
                                        <br>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">نام شما *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="email">آدرس ایمیل شما *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="password">رمز عبور *</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer border-0">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <span>ثبت نام</span>
                                            <i class="icon-long-arrow-left"></i>
                                        </button>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .container -->
        </div><!-- End .login-page section-bg -->
    </main><!-- End .main -->
@endsection
