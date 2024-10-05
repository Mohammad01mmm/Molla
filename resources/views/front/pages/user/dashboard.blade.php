@extends('front.master')
@section('main')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('front/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">داشبورد<span>فروشگاه</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <br>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab"
                                        href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                        aria-selected="true">داشبورد</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders"
                                        role="tab" aria-controls="tab-orders" aria-selected="false">سفارشات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address"
                                        role="tab" aria-controls="tab-address" aria-selected="false">آدرس</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                        role="tab" aria-controls="tab-account" aria-selected="false">جزئیات حساب
                                        کاربری</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-bottom-0" href="{{ route('logout-user') }}">خروج از حساب
                                        کاربری</a>
                                </li>
                            </ul>
                        </aside><!-- End .col-lg-3 -->

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"
                                    aria-labelledby="tab-dashboard-link">
                                    <p>سلام <span class="font-weight-normal text-dark"> {{ $user->name }} </span>
                                        <br>
                                        شما در اینجا میتوانید <a href="#tab-orders"
                                            class="tab-trigger-link link-underline">سفارشات خود را ببینید</a>، وضعیت
                                        ارسال <a href="#tab-address" class="tab-trigger-link">سفارشات خود را مشاهده
                                            کنید وآدرس خود را تغییر دهید</a>، و همچنین <a href="#tab-account"
                                            class="tab-trigger-link">می توانید رمز عبور یا جزئیات حساب کاربری خود را
                                            ویرایش کنید </a>.
                                    </p>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                    aria-labelledby="tab-orders-link">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <td class="text-center"> # </td>
                                                <td class="text-center"> کد تراکنش </td>
                                                <td class="text-center"> وضعیت پرداخت </td>
                                                <td class="text-center"> درگاه پرداخت </td>
                                                <td class="text-center"> فاکتور </td>
                                            </thead>
                                            <tbody>
                                                @forelse ($payments as $key => $payment)
                                                    <tr>
                                                        <td class="text-center"> {{ $key + 1 }} </td>
                                                        <td class="text-center"> {{ $payment->transaction_id }} </td>
                                                        <td class="text-center d-flex m-auto justify-content-center">
                                                            @if ($payment->status == 'successful')
                                                                <div class="btn bg-success text-white rounded"
                                                                    style="cursor: default"> موفق </div>
                                                            @elseif ($payment->status == 'failed')
                                                                <div class="btn bg-danger text-white rounded"
                                                                    style="cursor: default"> ناموفق </div>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($payment->payment_gateway == 'zarinpal')
                                                                زرین پال
                                                            @elseif ($payment->payment_gateway == 'melat')
                                                                ملت
                                                            @elseif ($payment->payment_gateway == 'meli')
                                                                ملی
                                                            @elseif ($payment->payment_gateway == 'shapark')
                                                                شاپرک
                                                            @endif
                                                        </td>
                                                        <td class="text-center d-flex m-auto justify-content-center">
                                                            <button type="button" class="btn btn-primary rounded"
                                                                data-toggle="modal"
                                                                data-target="#exampleModalf{{ $key }}"> فاکتور
                                                            </button>
                                                        </td>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalLong" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLongTitle"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                                            Modal title</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ...
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="button"
                                                                            class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="modal fade shadow rounded"
                                                            id="exampleModalf{{ $key }}" tabindex="-1"
                                                            aria-labelledby="exampleModalfLabel{{ $key }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header p-4">
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <small class="modal-title fw-bold"
                                                                            id="exampleModalfLabel{{ $key }}">
                                                                            فاکتور
                                                                            {{ $payment->user['name'] }}
                                                                            {{ $payment->user['lname'] }}
                                                                        </small>
                                                                    </div>
                                                                    <div class="modal-body text-right p-4">
                                                                        <h6> مشخصات کاربر </h6>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-6 my-2">
                                                                                <span> نام : </span>
                                                                                <span> {{ $payment->user['name'] }} </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> نام خانوادگی : </span>
                                                                                <span> {{ $payment->user['lname'] }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> ایمیل : </span>
                                                                                <span> {{ $payment->user['email'] }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> تلفن : </span>
                                                                                <span> {{ $payment->user['phone'] }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> شهر : </span>
                                                                                <span> {{ $payment->user['city'] }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> کد پستی : </span>
                                                                                <span> {{ $payment->user['zip_code'] }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-12 my-2">
                                                                                <span> آدرس : </span>
                                                                                <span> {{ $payment->user['address'] }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <h6> مشخصات تراکنش </h6>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-6 my-2">
                                                                                <span> درگاه پرداخت : </span>
                                                                                <span>
                                                                                    @if ($payment->payment_gateway == 'zarinpal')
                                                                                        زرین پال
                                                                                    @elseif($payment->payment_gateway == 'melat')
                                                                                        ملت
                                                                                    @elseif($payment->payment_gateway == 'meli')
                                                                                        ملی
                                                                                    @elseif($payment->payment_gateway == 'shapark')
                                                                                        شاپرک
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> کد تراکنش : </span>
                                                                                <span> {{ $payment->transaction_id }}
                                                                                </span>
                                                                            </div>
                                                                            <div
                                                                                class="col-12 my-2 d-flex align-items-center text-right">
                                                                                <span>
                                                                                    @if ($payment->status == 'successful')
                                                                                        <div class="btn btn-success rounded"
                                                                                            style="cursor: default"> موفق
                                                                                        </div>
                                                                                    @elseif($payment->status == 'failed')
                                                                                        <div class="btn btn-danger rounded"
                                                                                            style="cursor: default"> ناموفق
                                                                                        </div>
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> مجموع مبلغ قابل پرداخت : </span>
                                                                                <span>
                                                                                    {{ number_format($payment->total_price_payable) }}
                                                                                    تومان
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-6 my-2">
                                                                                <span> مجموع مبلغ پرداخت شده : </span>
                                                                                <span>
                                                                                    {{ number_format($payment->total_price) }}
                                                                                    تومان
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <h6> لیست محصولات </h6>
                                                                        <hr>
                                                                        @foreach ($payment->product_id as $product)
                                                                            @php
                                                                                $productcheckout = App\Models\ProductCheckout::where(
                                                                                    'id',
                                                                                    $product,
                                                                                )->first();
                                                                            @endphp
                                                                            <div class="d-flex justify-content-between">
                                                                                <h5>
                                                                                    {{ $productcheckout->title }}
                                                                                </h5>
                                                                                <small class="text-muted small">
                                                                                    #{{ $productcheckout->code }}
                                                                                </small>
                                                                            </div>
                                                                            <small> {{ $productcheckout->category }}
                                                                            </small>
                                                                            <div>
                                                                                <span> تعداد سفارش داده شده : </span>
                                                                                <span>
                                                                                    {{ $productcheckout->count }}
                                                                                </span>
                                                                            </div>
                                                                            <br>
                                                                            <h6> رنگ سفارش داده </h6>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="mx-1 ml-3 p-1 rounded border border-dark"
                                                                                    style="background: {{ $productcheckout->color['hex'] }}">
                                                                                    {{ str_replace('#', '', $productcheckout->color['hex']) }}
                                                                                </div>
                                                                                <span>
                                                                                    {{ $productcheckout->color['color'] }}
                                                                                </span>
                                                                            </div>
                                                                            <br>
                                                                            <div>
                                                                                <span> قیمت قابل پرداخت : </span>
                                                                                <span>
                                                                                    {{ number_format($productcheckout->final_price) }}
                                                                                    تومان
                                                                                </span>
                                                                            </div>
                                                                            <br>
                                                                            <h6> ویژگی های محصول </h6>
                                                                            @foreach ($productcheckout->properties as $property)
                                                                                <span class="ml-3">
                                                                                    {{ $property['title'] }} </span>
                                                                                <span class="ml-3">
                                                                                    {{ $property['name_property'] }}
                                                                                </span>
                                                                                <span class="ml-3">
                                                                                    {{ $property['value'] }} </span>
                                                                                <span class="ml-3">
                                                                                    {{ $property['unit'] }} </span>
                                                                                @if (!$loop->last)
                                                                                    <hr>
                                                                                @endif
                                                                            @endforeach
                                                                            <br>
                                                                            @if (!$loop->last)
                                                                                <hr>
                                                                            @endif
                                                                        @endforeach

                                                                    </div>
                                                                    <div class="modal-footer p-4">
                                                                        <button type="button"
                                                                            class="btn btn-danger w-100 rounded"
                                                                            data-bs-dismiss="modal">
                                                                            بستن
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @empty
                                                    <p>سفارش جدیدی وجود ندارد</p>
                                                    <a href="{{ route('products.list') }}"
                                                        class="btn btn-outline-primary-2"><span>رفتن
                                                            به
                                                            فروشگاه</span><i class="icon-long-arrow-left"></i></a>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-address" role="tabpanel"
                                    aria-labelledby="tab-address-link">
                                    <p>آدرسی که اینجا ثبت می کنید به صورت پیش فرض برای ارسال محصولات به شما استفاده
                                        می شود.</p>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">آدرس شما</h3><!-- End .card-title -->
                                                    <p>
                                                        {{ $user->name }} <br>
                                                        {{ $user->address }} <br>
                                                        کد پستی : {{ $user->zip_code }} <br>
                                                        {{ $user->email }} <br>
                                                        <a href="#tab-account" class="tab-trigger-link"> ویرایش <i
                                                                class="icon-edit"></i> </a>
                                                    </p>
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-12 -->
                                    </div><!-- End .row -->
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                    aria-labelledby="tab-account-link">
                                    <form action="{{ route('front.edit') }}" method="POST">
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
                                        <label>نام *</label>
                                        <input name="name" type="text" class="form-control" required
                                            value="{{ $user->name }}">
                                        <label> آدرس </label>
                                        <textarea name="address" class="form-control"> {{ $user->address }} </textarea>

                                        <label> کد پستی </label>
                                        <input name="zip_code" type="text" class="form-control"
                                            value="{{ $user->zip_code }}" max="10" min="10">

                                        <label>پسورد فعلی</label>
                                        <input name="old_password" type="password" class="form-control">

                                        <label>پسورد جدید</label>
                                        <input name="new_password" type="password" class="form-control">

                                        <label>تکرار پسورد جدید</label>
                                        <input name="re_new_password" type="password" class="form-control mb-2">

                                        <button type="submit" class="btn btn-outline-primary-2 float-right">
                                            <span>ذخیره تغییرات</span>
                                            <i class="icon-long-arrow-left"></i>
                                        </button>
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
