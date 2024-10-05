@extends('front.master')
@section('main')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('front/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">
                    لیست علاقه مندی
                </h1>
                <a href="#"> فروشگاه </a>
            </div><!-- End .container -->
        </div><!-- End .page-header -->

        <div class="page-content">
            <div class="container">
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>محصول</th>
                            <th>قیمت</th>
                            <th>وضعیت محصول</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($wishlists == null)
                            <h4 class="text-center mt-2">
                                <a href="{{ route('front.login') }}"> ابتدا وارد شوید </a>
                            </h4>
                        @else
                            @forelse ($wishlists as $wishlist)
                                @foreach ($wishlist->product()->get() as $product)
                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="#"> {{ $product->title }} </a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">
                                            {{ number_format($product->colors()->orderBy('inventory', 'DESC')->first()->pivot->final_price) }}
                                            تومان
                                        </td>

                                        <td class="stock-col">
                                            @if ($product->colors()->where('inventory', '0')->count() == 0)
                                                <span class="in-stock"> موجود </span>
                                            @else
                                                <span class="out-of-stock"> نا موجود </span>
                                            @endif

                                        </td>
                                        <td class="action-col">
                                            @if ($product->colors()->where('inventory', '0')->count() == 0)
                                                @php
                                                    $color = $product->colors()->orderBy('inventory', 'DESC')->first();
                                                @endphp
                                                <form action="{{ route('carts.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="1" name="count">
                                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                    <input type="hidden" value="{{ $color->id }}" name="color">
                                                    <button type="submit" class="btn btn-block btn-outline-primary-2"
                                                        title="افزودن به سبد خرید">
                                                        <i class="icon-cart-plus"></i>
                                                        افزودن به سبد خرید
                                                    </button>
                                                </form>
                                            @else
                                                <button
                                                    class="btn btn-block btn-outline-primary-2 disabled">ناموجود</button>
                                            @endif

                                        </td>
                                        <td class="remove-col text-left">
                                            <form action="{{ route('wishlists.destroy', ['wishlist' => $wishlist->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove"><i
                                                        class="icon-close"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <h3 class="text-center mt-3"> محصولی موجود نیست </h3>
                            @endforelse
                        @endif
                    </tbody>
                </table><!-- End .table table-wishlist -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
