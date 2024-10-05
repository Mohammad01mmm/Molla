@extends('front.master')
@section('main')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('front/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">صفحه پرداخت<span>فروشگاه</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <br>
        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <form action="{{ route('checkout.checkout') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
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
                                <h2 class="checkout-title">جزئیات صورت حساب</h2><!-- End .checkout-title -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>نام *</label>
                                        <input type="text" class="form-control" placeholder="نام . . ."
                                            value="{{ $user->name }}" name="fname" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>نام خانوادگی *</label>
                                        <input type="text" class="form-control" name="lname"
                                            value="{{ $user->lname }}" placeholder="نام خانوادگی . . ." required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>شهر *</label>
                                        <input type="text" class="form-control" name="city"
                                            value="{{ $user->city }}" placeholder="شهر . . ." required>

                                    </div><!-- End .col-sm-6 -->

                                </div><!-- End .row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>آدرس *</label>
                                        <input type="text" class="form-control" placeholder="آدرس . . ."
                                            value="{{ $user->address }}" name="address" required>

                                    </div><!-- End .col-sm-12 -->

                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>کد پستی *</label>
                                        <input type="text" class="form-control" placeholder="کد پستی . . ."
                                            name="zip_code" value="{{ $user->zip_code }}" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>تلفن همراه *</label>
                                        <input type="tel" class="form-control" name="phone_number"
                                            placeholder="Phone . . ." value="{{ $user->phone }}" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>ایمیل *</label>
                                <input type="email" class="form-control" placeholder="ایمیل . . ." name="email"
                                    value="{{ $user->email }}" readonly required>

                                <label>توضیحات (اختیاری)</label>
                                <textarea class="form-control" cols="30" rows="4" name="discription"
                                    placeholder="شما میتوانید توضیحات اضافی خود را اینجا بنویسید"></textarea>
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">سفارش شما</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>محصول</th>
                                                <th class="text-left">جمع</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($carts as $cart)
                                                <tr>
                                                    <td>
                                                        <a href="product/{{ $cart->product->slag_url }}">
                                                            {{ $cart->product->title }}
                                                            <br>
                                                            {{ $cart->color->title }}
                                                            ×
                                                            {{ $cart->count }}
                                                        </a>
                                                    </td>
                                                    <td class="text-left">
                                                        {{ number_format($cart->product->colors()->where('color_id', $cart->color_id)->first()->pivot->final_price) }}
                                                        تومان
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="summary-total">
                                                <td>مبلغ قابل پرداخت :</td>
                                                @php
                                                    foreach ($carts as $key => $cart) {
                                                        $prices_total = $cart->product
                                                            ->colors()
                                                            ->get()
                                                            ->where('id', $cart->color->id)
                                                            ->first()->pivot->final_price;
                                                        $counts_total = $cart->count;

                                                        $total_price_carts[] = $prices_total * $counts_total;
                                                    }
                                                @endphp
                                                <td class="text-left">
                                                    {{ number_format(array_sum($total_price_carts)) }}
                                                    تومان
                                                </td>
                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->

                                    <div class="accordion-summary" id="accordion-payment">
                                        <div class="card">
                                            <div class="card-header" id="heading-1">
                                                <h2 class="card-title">
                                                    <a role="button" data-toggle="collapse" href="#collapse-1"
                                                        aria-expanded="true" aria-controls="collapse-1">
                                                        درگاه بانک ملت
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                                data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن
                                                    ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                                                    سادگی نامفهوم.
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-2">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-2" aria-expanded="false"
                                                            aria-controls="collapse-2">
                                                            درگاه شاپرک
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوملورم ایپسوم متن
                                                        ساختگی با تولید سادگی نامفهوم.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-3">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-3" aria-expanded="false"
                                                            aria-controls="collapse-3">
                                                            زرین پال <small class="float-left paypal-link">زرین پال
                                                                چیست؟</small>
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-4">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-4" aria-expanded="false"
                                                            aria-controls="collapse-4">
                                                            واریز بانک
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم
                                                        متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با
                                                        تولید سادگی نامفهوم.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-5">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-5" aria-expanded="false"
                                                            aria-controls="collapse-5">
                                                            کارت به کارت
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-5" class="collapse" aria-labelledby="heading-5"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body"> لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->
                                        </div><!-- End .accordion -->

                                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                            <span class="btn-text">ثبت</span>
                                            <span class="btn-hover-text">پرداخت</span>
                                        </button>
                                    </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
