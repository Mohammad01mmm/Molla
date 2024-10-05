@extends('admin.master')
@section('title', 'فاکتور ها')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            فاکتور ها
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> نام کاربر </td>
                        <td> نام خانوادگی کاربر </td>
                        <td> ایمیل کاربر </td>
                        <td> شماره تلفن کاربر </td>
                        <td> شهر کاربر </td>
                        <td> آدرس کاربر </td>
                        <td> کد پستی کاربر </td>
                        <td> وضعیت پرداخت </td>
                        <td> کد تراکنش </td>
                        <td> درگاه پرداخت </td>
                        <td> محصولات سفارش داده شده </td>
                        <td> فاکتور </td>
                    </thead>
                    <tbody>
                        @foreach ($checkouts as $key => $checkout)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $checkout->user['name'] }} </td>
                                <td> {{ $checkout->user['lname'] }} </td>
                                <td> {{ $checkout->user['email'] }} </td>
                                <td> {{ $checkout->user['phone'] }} </td>
                                <td> {{ $checkout->user['city'] }} </td>
                                <td> {{ $checkout->user['address'] }} </td>
                                <td> {{ $checkout->user['zip_code'] }} </td>
                                <td>
                                    @if ($checkout->status == 'successful')
                                        <div class="btn btn-success"> موفق </div>
                                    @elseif ($checkout->status == 'failed')
                                        <div class="btn btn-danger"> نا موفق </div>
                                    @endif
                                </td>
                                <td> {{ $checkout->transaction_id }} </td>
                                <td>
                                    @if ($checkout->payment_gateway == 'zarinpal')
                                        زرین پال
                                    @elseif ($checkout->payment_gateway == 'melat')
                                        ملت
                                    @elseif ($checkout->payment_gateway == 'meli')
                                        ملی
                                    @elseif ($checkout->payment_gateway == 'shapark')
                                        شاپرک
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning text-light" title=" محصولات سفارش داده شده "
                                        data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade shadow" id="exampleModal{{ $key }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel{{ $key }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <small class="modal-title fw-bold"
                                                    id="exampleModalLabel{{ $key }}">
                                                    محصولات سفارش داده
                                                    {{ $checkout->user['name'] }} {{ $checkout->user['lname'] }}
                                                </small>

                                            </div>
                                            <div class="modal-body">
                                                @foreach ($checkout->product_id as $product)
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
                                                    <small> {{ $productcheckout->category }} </small>
                                                    <div>
                                                        <span> تعداد سفارش داده شده : </span>
                                                        <span>
                                                            {{ $productcheckout->count }}
                                                        </span>
                                                    </div>
                                                    <br>
                                                    <h6> رنگ سفارش داده </h6>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mx-1 ms-3 p-1 rounded border border-dark"
                                                            style="background: {{ $productcheckout->color['hex'] }}">
                                                            {{ str_replace('#', '', $productcheckout->color['hex']) }}
                                                        </div>
                                                        <span> {{ $productcheckout->color['color'] }} </span>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <span> قیمت قابل پرداخت : </span>
                                                        <span>
                                                            {{ number_format($productcheckout->final_price) }} تومان
                                                        </span>
                                                    </div>
                                                    <br>
                                                    <h6> ویژگی های محصول </h6>
                                                    @foreach ($productcheckout->properties as $property)
                                                        <span class="ms-3"> {{ $property['title'] }} </span>
                                                        <span class="ms-3"> {{ $property['name_property'] }} </span>
                                                        <span class="ms-3"> {{ $property['value'] }} </span>
                                                        <span class="ms-3"> {{ $property['unit'] }} </span>
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                                    بستن
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td>
                                    <button class="btn btn-primary" title="فاکتور" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalf{{ $key }}">
                                        <i class="bi bi-receipt-cutoff"></i>
                                    </button>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade shadow" id="exampleModalf{{ $key }}" tabindex="-1"
                                    aria-labelledby="exampleModalfLabel{{ $key }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <small class="modal-title fw-bold"
                                                    id="exampleModalfLabel{{ $key }}">
                                                    فاکتور
                                                    {{ $checkout->user['name'] }} {{ $checkout->user['lname'] }}
                                                </small>
                                            </div>
                                            <div class="modal-body">
                                                <h6> مشخصات کاربر </h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6 my-2">
                                                        <span> نام : </span>
                                                        <span> {{ $checkout->user['name'] }} </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> نام خانوادگی : </span>
                                                        <span> {{ $checkout->user['lname'] }} </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> ایمیل : </span>
                                                        <span> {{ $checkout->user['email'] }} </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> تلفن : </span>
                                                        <span> {{ $checkout->user['phone'] }} </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> شهر : </span>
                                                        <span> {{ $checkout->user['city'] }} </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> کد پستی : </span>
                                                        <span> {{ $checkout->user['zip_code'] }} </span>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <span> آدرس : </span>
                                                        <span> {{ $checkout->user['address'] }} </span>
                                                    </div>
                                                </div>
                                                <br>
                                                <h6> مشخصات تراکنش </h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6 my-2">
                                                        <span> درگاه پرداخت : </span>
                                                        <span>
                                                            @if ($checkout->payment_gateway == 'zarinpal')
                                                                زرین پال
                                                            @elseif ($checkout->payment_gateway == 'melat')
                                                                ملت
                                                            @elseif ($checkout->payment_gateway == 'meli')
                                                                ملی
                                                            @elseif ($checkout->payment_gateway == 'shapark')
                                                                شاپرک
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> کد تراکنش : </span>
                                                        <span> {{ $checkout->transaction_id }} </span>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <span> وضعیت : </span>
                                                        <span>
                                                            @if ($checkout->status == 'successful')
                                                                <div class="btn btn-success"> موفق </div>
                                                            @elseif ($checkout->status == 'failed')
                                                                <div class="btn btn-danger"> ناموفق </div>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> مجموع مبلغ قابل پرداخت : </span>
                                                        <span>
                                                            {{ number_format($checkout->total_price_payable) }}
                                                            تومان
                                                        </span>
                                                    </div>
                                                    <div class="col-6 my-2">
                                                        <span> مجموع مبلغ پرداخت شده : </span>
                                                        <span>
                                                            {{ number_format($checkout->total_price) }}
                                                            تومان
                                                        </span>
                                                    </div>
                                                </div>
                                                <br>
                                                <h6> لیست محصولات </h6>
                                                <hr>
                                                @foreach ($checkout->product_id as $product)
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
                                                    <small> {{ $productcheckout->category }} </small>
                                                    <div>
                                                        <span> تعداد سفارش داده شده : </span>
                                                        <span>
                                                            {{ $productcheckout->count }}
                                                        </span>
                                                    </div>
                                                    <br>
                                                    <h6> رنگ سفارش داده </h6>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mx-1 ms-3 p-1 rounded border border-dark"
                                                            style="background: {{ $productcheckout->color['hex'] }}">
                                                            {{ str_replace('#', '', $productcheckout->color['hex']) }}
                                                        </div>
                                                        <span> {{ $productcheckout->color['color'] }} </span>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <span> قیمت قابل پرداخت : </span>
                                                        <span>
                                                            {{ number_format($productcheckout->final_price) }} تومان
                                                        </span>
                                                    </div>
                                                    <br>
                                                    <h6> ویژگی های محصول </h6>
                                                    @foreach ($productcheckout->properties as $property)
                                                        <span class="ms-3"> {{ $property['title'] }} </span>
                                                        <span class="ms-3"> {{ $property['name_property'] }} </span>
                                                        <span class="ms-3"> {{ $property['value'] }} </span>
                                                        <span class="ms-3"> {{ $property['unit'] }} </span>
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                                    بستن
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
