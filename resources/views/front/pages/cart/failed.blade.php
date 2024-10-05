@extends('front.master')
@section('main')
    <main class="main">
        <br>
        <div class="text-center">
            <div class="bg-danger rounded-pill d-flex m-auto"
                style="width: 100px;height: 100px;align-items: center;justify-content: center;">
                <h1 class="pt-2">
                    <i class="icon-times-circle-o text-white"></i>
                </h1>
            </div>
            <br>
            <h4> پرداخت نا موفق آمیز </h4>
            <h5> {{ $transaction_id }} </h5>
            <a href="{{ route('front.index') }}" class="btn btn-outline-warning rounded">
                بازگشت به صفحه اصلی
            </a>
        </div>
        <br>
    </main><!-- End .main -->
@endsection
