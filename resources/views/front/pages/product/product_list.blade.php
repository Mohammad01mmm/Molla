<div class="toolbox">
    <div class="toolbox-left">
        <div class="toolbox-info">
            نمایش
            <span> {{ $products->count() }} </span>
            از
            <span> {{ $products->total() }} </span>
            محصول
        </div><!-- End .toolbox-info -->
    </div><!-- End .toolbox-left -->
</div><!-- End .toolbox -->
@forelse ($products as $product)
    @php
        $color = $product->colors()->orderBy('inventory', 'DESC')->first();
    @endphp
    <div class="product product-list">
        <div class="row">
            <div class="col-6 col-lg-3">
                <figure class="product-media">
                    @if ($product->status_off != 'none')
                        <span class="product-label label-sale rounded"> فروش ویژه </span>
                    @endif
                    <a href="{{ route('single-product', ['product' => $product->slag_url]) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}" class="product-image rounded">
                    </a>
                </figure><!-- End .product-media -->
            </div><!-- End .col-sm-6 col-lg-3 -->

            <div class="col-6 col-lg-3 order-lg-last">
                <div class="product-list-action">
                    @if ($product->status_off != 'none')
                        <span class="new-price">
                            {{ number_format($color->pivot->final_price) }}
                            تومان
                        </span>
                        <span class="old-price">
                            {{ number_format($color->pivot->price) }}
                            تومان
                        </span>
                    @else
                        <div class="product-price">
                            {{ number_format($color->pivot->price) }}
                            تومان
                        </div>
                    @endif
                    {{-- <div class="product-price">
                                                    60,000 تومان
                                                </div><!-- End .product-price --> --}}
                    <div class="ratings-container">
                    </div><!-- End .rating-container -->

                    <form action="{{ route('carts.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="1" name="count">
                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                        <input type="hidden" value="{{ $color->id }}" name="color">
                        <button type="submit" class="btn btn-product btn-cart" title="افزودن به سبد خرید"><span>افزودن
                                به سبد
                                خرید</span></button>
                    </form>
                </div><!-- End .product-list-action -->
            </div><!-- End .col-sm-6 col-lg-3 -->

            <div class="col-lg-6">
                <div class="product-body product-action-inner">
                    <form action="{{ route('wishlists.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                        <button type="submit" class="btn btn-product btn-wishlist"
                            title="افزودن به لیست علاقه مندی"></button>
                    </form>
                    <div class="product-cat">
                        <a href=""> {{ $product->category->title }} </a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title">
                        <a href="{{ route('single-product', ['product' => $product->slag_url]) }}">
                            {{ $product->title }}
                        </a>
                    </h3><!-- End .product-title -->

                    <div class="product-content">
                        <p> {{ Str::limit($product->description, 150, ' . . . ') }} </p>
                    </div><!-- End .product-content -->

                </div><!-- End .product-body -->
            </div><!-- End .col-lg-6 -->
        </div><!-- End .row -->
    </div><!-- End .product -->
@empty
    <br><br>
    <h3 class="text-center"> محصولی موجود نیست </h3>
@endforelse

@php
    $currentPage = $products->currentPage(); // صفحه فعلی
    $lastPage = $products->lastPage(); // تعداد کل صفحات
    $startPage = max(1, $currentPage - 1); // محاسبه شروع صفحات
    $endPage = min($lastPage, $currentPage + 1); // محاسبه پایان صفحات
@endphp
@if ($lastPage > 1 && $products->count() > 0)
    <nav aria-label="Page navigation" class="m-auto w-50">
        <ul class="pagination">
            {{-- لینک قبلی --}}
            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                <a class="page-link page-link-prev" href="{{ $products->previousPageUrl() }}" aria-label="Previous"
                    tabindex="-1" aria-disabled="{{ $currentPage == 1 ? 'true' : 'false' }}">
                    <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span> قبلی
                </a>
            </li>

            {{-- نمایش لینک صفحه اول در صورت نیاز --}}
            @if ($startPage > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $products->url(1) }}">1</a>
                </li>
                @if ($startPage > 2)
                    <li class="page-item"><span class="page-link"> . . . </span></li>
                @endif
            @endif

            {{-- حلقه برای نمایش ۳ صفحه (صفحه فعلی و صفحات مجاور) --}}
            @for ($i = $startPage; $i <= $endPage; $i++)
                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- نمایش نقطه‌چین و لینک آخرین صفحه در صورت نیاز --}}
            @if ($endPage < $lastPage)
                @if ($endPage < $lastPage - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $products->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif

            {{-- لینک بعدی --}}
            <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                <a class="page-link page-link-next" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                    بعدی <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>
                </a>
            </li>
        </ul>
    </nav>
@endif
