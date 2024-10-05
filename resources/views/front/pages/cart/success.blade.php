@extends('front.master')
@section('main')
    <main class="main">
        <br>
        <div class="text-center">
            <div class="bg-success rounded-pill d-flex m-auto"
                style="width: 100px;height: 100px;align-items: center;justify-content: center;">
                <h2 class="pt-2">
                    <i class="icon-thumbs-up text-white"></i>
                </h2>
            </div>
            <br>
            <h4> پرداخت موفق آمیز </h4>
            <h5> {{ $transaction_id }} </h5>
            <a href="{{ route('front.index') }}" class="btn btn-outline-warning rounded">
                بازگشت به صفحه اصلی
            </a>
        </div>
        <br>
    </main><!-- End .main -->
@endsection
