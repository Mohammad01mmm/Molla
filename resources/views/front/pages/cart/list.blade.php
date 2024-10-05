@extends('front.master')
@section('main')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('front/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">سبد خرید<span>فروشگاه</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <br>
        @if ($groupedCarts->count() == 0)
            <h3 class="text-center"> سبد خرید خالی است </h3>
            <h4 class="text-center">
                <a href="{{ route('products.list') }}" class="text-center"> فروشگاه </a>
            </h4>
            <br>
        @else
            <div class="page-content">
                <div class="cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <table class="table table-cart table-mobile">
                                    <thead>
                                        <tr>
                                            <th>محصول</th>
                                            <th>قیمت</th>
                                            <th>تعداد</th>
                                            <th>مجموع</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($groupedCarts as $productId => $cartGroup)
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media rounded">
                                                            <a href="product/{{ $cartGroup->first()->product->slag_url }}">
                                                                <img src="{{ $cartGroup->first()->product->image }}"
                                                                    alt="{{ $cartGroup->first()->product->title }}"
                                                                    class="rounded">
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a href="product/{{ $cartGroup->first()->product->slag_url }}">
                                                                {{ $cartGroup->first()->product->title }}
                                                            </a>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                    <br>
                                                    <div class="d-flex">
                                                        @foreach ($cartGroup as $color)
                                                            <div class="m-1 mx-2 rounded-pill border border-dark"
                                                                style="cursor:pointer;background: {{ $color->color->hex }}; width:20px;height:20px"
                                                                id="color_{{ $color->color_id }}_product_{{ $cartGroup->first()->product->code }}"
                                                                data-quantity="{{ $color->count }}"
                                                                data-price="{{ $color->product->colors()->get()->where('id', $color->color->id)->first()->pivot->final_price }}"
                                                                data-color="{{ $color->color_id }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="price-col">
                                                    <span
                                                        id="price_list_cart_{{ $cartGroup->first()->product->code }}"></span>
                                                </td>
                                                <td class="quantity-col">
                                                    <span
                                                        id="quantity_list_cart_{{ $cartGroup->first()->product->code }}"></span>
                                                </td>
                                                <td class="total-col">
                                                    <span
                                                        id="total_list_cart_{{ $cartGroup->first()->product->code }}"></span>
                                                </td>
                                                <td class="remove-col">
                                                    <form
                                                        action="{{ route('carts.destroy', ['cart' => $cartGroup->first()->product_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="color_id"
                                                            id="color_id_{{ $cartGroup->first()->product->code }}"
                                                            value="">
                                                        <button class="btn-remove" type="submit">
                                                            <i class="icon-close"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <table class="table table-summary">
                                        <tbody>
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
                                                <td class="text-left"> <span>
                                                        {{ number_format(array_sum($total_price_carts)) }} </span> تومان
                                                </td>
                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->

                                    <a href="{{ route('checkout.index') }}"
                                        class="btn btn-outline-primary-2 btn-order btn-block">رفتن
                                        به صفحه پرداخت</a>
                                </div><!-- End .summary -->

                                <a href="{{ route('products.list') }}"
                                    class="btn btn-outline-dark-2 btn-block mb-3"><span>ادامه
                                        خرید</span><i class="icon-refresh"></i></a>
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        @endif
    </main><!-- End .main -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            function updateCartDetails(productId, colorElement) {
                var price = $(colorElement).data('price');
                var quantity = $(colorElement).data('quantity');
                var color = $(colorElement).data('color');

                $('#price_list_cart_' + productId).text(price);
                $('#quantity_list_cart_' + productId).text(quantity);

                $('#color_id_' + productId).val(color);
                var total = price * quantity;
                $('#total_list_cart_' + productId).text(total);
            }

            $('div[id^=color_]').on('click', function() {
                var elementId = $(this).attr('id');
                var productId = elementId.split('_')[3];

                updateCartDetails(productId, this);
            });

            $('div[id^=color_]').each(function() {
                var productId = $(this).attr('id').split('_')[3];

                if (!$('#price_list_cart_' + productId).text()) {
                    var firstColor = $('div[id^=color_][id$=_product_' + productId + ']').first();
                    updateCartDetails(productId, firstColor);
                }
            });
        });
    </script>
@endsection
