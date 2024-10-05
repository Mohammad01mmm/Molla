@extends('front.master')
@section('main')
    <main class="main">
        <div class="intro-slider-container mb-5">
            <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
                data-owl-options='{
                            "dots": true,
                            "nav": false,
                            "rtl": true,
                            "responsive": {
                                "1200": {
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>

                @php
                    $slides = [
                        [
                            'slider' => $slider_random_off_pro,
                            'subtitle' => 'پیشنهاد ویژه روز',
                            'title_color' => 'text-third',
                            'price_color' => 'text-third',
                        ],
                        [
                            'slider' => $slider_new_off_pro,
                            'subtitle' => 'جدیدترین محصول تخفیف خورده',
                            'title_color' => 'text-third',
                            'price_color' => 'text-third',
                        ],
                        [
                            'slider' => $slider_new_pro,
                            'subtitle' => 'جدیدترین محصول',
                            'title_color' => 'text-primary',
                            'price_color' => 'text-primary',
                        ],
                        [
                            'slider' => $slider_random_pro,
                            'subtitle' => 'محصول پیشنهادی روز',
                            'title_color' => 'text-primary',
                            'price_color' => 'text-primary',
                        ],
                    ];
                @endphp

                @if ($slider_welcome == null)
                    @foreach ($slides as $slide)
                        @isset($slide['slider'][0])
                            @php
                                $product = $slide['slider'][0]->product()->first();
                                $color = $product->colors()->orderBy('inventory', 'DESC')->first();
                            @endphp

                            <div class="intro-slide" style="background-image: url({{ asset($product->image) }});">
                                <div class="container intro-content">
                                    <div class="row justify-content-end">
                                        <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                            <h3 class="intro-subtitle {{ $slide['title_color'] }}">{{ $slide['subtitle'] }}</h3>
                                            <h2 class="intro-title">{{ $product->title }}</h2>
                                            <div class="intro-price" dir="rtl">
                                                <sup class="intro-old-price">{{ number_format($color->pivot->price) }}</sup>
                                                <span
                                                    class="{{ $slide['price_color'] }}">{{ number_format($color->pivot->final_price) }}
                                                    تومان</span>
                                            </div>
                                            <a href="#" class="btn btn-primary btn-round">
                                                <span> خرید </span>
                                                <i class="icon-long-arrow-left"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                    @endforeach

                    @if ($sliders_select_pro != null)
                        @foreach ($sliders_select_pro as $slider)
                            @php
                                $product = $slider->product()->first();
                                $color = $product->colors()->orderBy('inventory', 'DESC')->first();
                                $image = $product->image;
                                $title = $product->title;
                                $priceText = number_format($color->pivot->final_price) . ' تومان';
                            @endphp

                            <div class="intro-slide" style="background-image: url({{ asset($image) }});">
                                <div class="container intro-content">
                                    <div class="row justify-content-end">
                                        <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                            <h3 class="intro-subtitle text-third">پیشنهادی</h3>
                                            <h2 class="intro-title">{{ $title }}</h2>
                                            <div class="intro-price" dir="rtl">
                                                <span class="text-third">{{ $priceText }}</span>
                                            </div>
                                            <a href="#" class="btn btn-primary btn-round">
                                                <span>خرید</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if ($sliders_select_cat != null)
                        @foreach ($sliders_select_cat as $slider)
                            @php
                                $category = $slider->category()->first();
                                $image = $category->image;
                                $title = $category->title;
                                $priceText = 'با ' . $category->products()->count() . ' محصول پیشنهادی';
                            @endphp

                            <div class="intro-slide" style="background-image: url({{ asset($image) }});">
                                <div class="container intro-content">
                                    <div class="row justify-content-end">
                                        <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                            <h3 class="intro-subtitle text-third">دسته بندی پیشنهادی</h3>
                                            <h2 class="intro-title">{{ $title }}</h2>
                                            <div class="intro-price" dir="rtl">
                                                <span class="text-third">{{ $priceText }}</span>
                                            </div>
                                            <a href="#" class="btn btn-primary btn-round">
                                                <span>مشاهده</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                    @isset($slider_new_blog[0])
                        @php
                            $blog = $slider_new_blog[0]->blog()->first();
                        @endphp
                        <div class="intro-slide" style="background-image: url({{ asset($blog->image) }});">
                            <div class="container intro-content">
                                <div class="row justify-content-end">
                                    <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                        <h3 class="intro-subtitle text-primary">بلاگ روز</h3>
                                        <h2 class="intro-title">{{ $blog->title }}</h2>
                                        <a href="#" class="btn btn-primary btn-round">
                                            <span>خواندن</span>
                                            <i class="icon-long-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset

                    @foreach ($sliders_select_blog ?? [] as $slider_select_blog)
                        @php
                            $blog = $slider_select_blog->blog()->first();
                        @endphp
                        <div class="intro-slide" style="background-image: url({{ asset($blog->image) }});">
                            <div class="container intro-content">
                                <div class="row justify-content-end">
                                    <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                        <h3 class="intro-subtitle text-third">بلاگ پیشنهادی</h3>
                                        <h2 class="intro-title">{{ $blog->title }}</h2>
                                        <a href="#" class="btn btn-primary btn-round">
                                            <span>مشاهده</span>
                                            <i class="icon-long-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($sliders_other ?? [] as $slider_other)
                        <div class="intro-slide" style="background-image: url({{ asset($slider_other->image) }});">
                            <div class="container intro-content">
                                <div class="row justify-content-end">
                                    <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                        <h2 class="intro-title">{{ $slider_other->title }}</h2>
                                        <div class="intro-price" dir="rtl">
                                            <span class="text-primary fs-6">{{ $slider_other->caption }}</span>
                                        </div>
                                        <a href="{{ $slider_other->url }}" class="btn btn-primary btn-round">
                                            <i class="icon-long-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="intro-slide">
                        <div class="container intro-content">
                            <div class="row justify-content-center">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5 text-center">
                                    <h2 class="intro-title">{{ $slider_welcome->title }}</h2>
                                    <div class="intro-price" dir="rtl">
                                        <span class="text-primary">{{ $slider_welcome->caption }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



            </div><!-- End .intro-slider owl-carousel owl-simple -->


            <span class="slider-loader"></span><!-- End .slider-loader -->
        </div><!-- End .intro-slider-container -->

        <div class="container">
            <h2 class="title text-center mb-4"> دسته بندی ها </h2><!-- End .title text-center -->

            <div class="cat-blocks-container">
                <div class="row">

                    @foreach ($categories as $category)
                        @if ($category->products()->count() >= 1)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <a href="{{ route('products.list', ['category' => $category->id]) }}" class="cat-block">
                                    <figure>
                                        <span>
                                            <img src="{{ $category->image }}" alt="{{ $category->image }}">
                                        </span>
                                    </figure>

                                    <h3 class="cat-block-title"> {{ $category->title }} </h3> <!-- End .cat-block-title -->
                                </a>
                            </div> <!-- End .col-sm-4 col-lg-2 -->
                        @endif
                    @endforeach

                </div><!-- End .row -->
            </div><!-- End .cat-blocks-container -->
        </div><!-- End .container -->

        <div class="mb-4"></div><!-- End .mb-4 -->

        <div class="container new-arrivals">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">محصولات</h2>
                </div>
                <div class="heading-right">
                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-all" role="tab"
                                aria-controls="tab-all" aria-selected="true">همه</a>
                        </li>
                        @foreach ($categories as $key => $category)
                            @if ($category->products()->count() >= 1)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-{{ $category->slug_url }}"
                                        role="tab" aria-controls="tab-{{ $category->slug_url }}"
                                        aria-selected="false">{{ $category->title }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content tab-content-carousel just-action-icons-sm">
                @foreach (collect(['all' => $products->whereStatus('1')->get()])->merge(
            $categories->mapWithKeys(
                fn($cat) => [
                    $cat->slug_url => $products->whereStatus('1')->get()->where('category_id', $cat->id),
                ],
            ),
        ) as $slug => $prods)
                    @if ($prods->count() >= 1)
                        <div class="tab-pane p-0 fade @if ($loop->first) show active @endif"
                            id="tab-{{ $slug }}" role="tabpanel" aria-labelledby="tab-{{ $slug }}">
                            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                                data-toggle="owl"
                                data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                                "responsive": {
                                    "0": {"items":2},
                                    "480": {"items":2},
                                    "768": {"items":3},
                                    "992": {"items":4},
                                    "1200": {"items":5}
                                }
                            }'>
                                @foreach ($prods as $product)
                                    @php
                                        $color = $product->colors()->orderBy('inventory', 'DESC')->first();
                                    @endphp
                                    <div class="product product-2">
                                        <figure class="product-media">
                                            @if ($product->status_off != 'none')
                                                <span class="product-label label-circle label-sale">فروش ویژه</span>
                                            @endif
                                            <a href="product.html">
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                                    class="product-image">
                                            </a>
                                            <form class="product-action-vertical" action="{{ route('wishlists.store') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <button type="submit" class="btn-product-icon btn-wishlist"
                                                    title="افزودن به لیست علاقه مندی"></button>
                                            </form>
                                            <form class="product-action" action="{{ route('carts.store') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" value="1" name="count">
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <input type="hidden" value="{{ $color->id }}" name="color">
                                                <button type="submit" class="btn btn-product btn-cart"
                                                    title="افزودن به سبد خرید"></button>
                                            </form>
                                        </figure>
                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="#"> {{ $product->category()->first()->title }} </a>
                                            </div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('single-product', ['product' => $product->slag_url]) }}">{{ $product->title }}</a>
                                            </h3>
                                            <div class="product-price">
                                                @if ($product->status_off != 'none')
                                                    <span
                                                        class="new-price">{{ number_format($color->pivot->final_price) }}
                                                        تومان</span>
                                                    <span class="old-price">{{ number_format($color->pivot->price) }}
                                                        تومان</span>
                                                @else
                                                    {{ number_format($color->pivot->price) }} تومان
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="mb-5"></div><!-- End .mb-5 -->

        <div class="container for-you">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">پیشنهاد برای شما</h2><!-- End .title -->
                </div><!-- End .heading-left -->

                <div class="heading-right">
                    <a href="{{ route('products.list') }}" class="title-link"> مشاهده همه <i
                            class="icon-long-arrow-left"></i></a>
                </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="products">
                <div class="row justify-content-center">
                    @foreach ($products->whereStatus('1')->limit(8)->get() as $product)
                        <div class="col-6 col-md-4 col-lg-3">
                            @php
                                $color = $product->colors()->orderBy('inventory', 'DESC')->first();
                            @endphp
                            <div class="product product-2">
                                <figure class="product-media">
                                    @if ($product->status_off != 'none')
                                        <span class="product-label label-circle label-sale">فروش ویژه</span>
                                    @endif
                                    <a href="product.html">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                            class="product-image">
                                    </a>
                                    <form class="product-action-vertical" action="{{ route('wishlists.store') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <button type="submit" class="btn-product-icon btn-wishlist"
                                            title="افزودن به لیست علاقه مندی"></button>
                                    </form>
                                    <form class="product-action" action="{{ route('carts.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="count">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input type="hidden" value="{{ $color->id }}" name="color">
                                        <button type="submit" class="btn btn-product btn-cart"
                                            title="افزودن به سبد خرید"></button>
                                    </form>
                                </figure>
                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#"> {{ $product->category()->first()->title }} </a>
                                    </div>
                                    <h3 class="product-title">
                                        <a
                                            href="{{ route('single-product', ['product' => $product->slag_url]) }}">{{ $product->title }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if ($product->status_off != 'none')
                                            <span class="new-price">{{ number_format($color->pivot->final_price) }}
                                                تومان</span>
                                            <span class="old-price">{{ number_format($color->pivot->price) }}
                                                تومان</span>
                                        @else
                                            {{ number_format($color->pivot->price) }} تومان
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    @endforeach

                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- End .container -->

        <div class="mb-4"></div><!-- End .mb-4 -->

        <div class="container">
            <hr class="mb-0">
        </div><!-- End .container -->

        <div class="icon-boxes-container bg-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-rocket"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">ارسال رایگان</h3><!-- End .icon-box-title -->
                                <p>برای سفارشات بالای 50 هزار تومان</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-rotate-left"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">بازگشت رایگان</h3><!-- End .icon-box-title -->
                                <p>تا 30 روز</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-info-circle"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">20% تخفیف برای اولین خرید</h3>
                                <!-- End .icon-box-title -->
                                <p>ثبت نام کنید</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-life-ring"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">پشتیبانی حرفه ای</h3><!-- End .icon-box-title -->
                                <p>خدمات 24 ساعته / 7 روز هفته</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .icon-boxes-container -->
    </main><!-- End .main -->
    <div class="cta bg-image bg-dark pt-4 pb-5 mb-0"
        style="background-image: url(front/assets/images/demos/demo-4/bg-5.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <div class="cta-heading text-center">
                        <h3 class="cta-title text-white">دریافت آخرین پیشنهادات</h3><!-- End .cta-title -->
                        <p class="cta-desc text-white text-center">و دریافت <span class="font-weight-normal">کد
                                تخفیف 20 هزار تومانی</span> برای اولین خرید</p><!-- End .cta-desc -->
                    </div><!-- End .text-center -->

                    <form action="#">
                        <div class="input-group input-group-round">
                            <input type="email" class="form-control form-control-white"
                                placeholder="آدرس ایمیل خود را وارد کنید" aria-label="Email Adress" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><span>عضویت</span><i
                                        class="icon-long-arrow-left"></i></button>
                            </div><!-- .End .input-group-append -->
                        </div><!-- .End .input-group -->
                    </form>
                </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->
@endsection
