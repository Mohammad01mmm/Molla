@extends('front.master')
@section('style')
    <link rel="stylesheet" href="front/assets/css/plugins/nouislider/nouislider.css">
@endsection
@section('main')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('front/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">لیست<span>فروشگاه</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <br>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div id="productList">
                            <div class="products mb-3">
                            </div>
                        </div><!-- End .products -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>فیلترها : </label>
                            </div><!-- End .widget widget-clean -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                        aria-controls="widget-1">
                                        دسته بندی
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach ($categories as $key => $category)
                                                @if ($category->products()->count() > 0)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="cat-{{ $key + 1 }}" name="category_id[]"
                                                                value="{{ $category->id }}"
                                                                {{ Request::input('category') == $category->id ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                for="cat-{{ $key + 1 }}">
                                                                {{ $category->title }} </label>
                                                        </div><!-- End .custom-checkbox -->
                                                        <span class="item-count">
                                                            {{ $category->products()->count() }}
                                                        </span>
                                                    </div><!-- End .filter-item -->
                                                @endif
                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"
                                        aria-controls="widget-3">
                                        رنگ
                                    </a>
                                </h3><!-- End .widget-title -->
                                <div class="collapse show" id="widget-3">
                                    <div class="widget-body">
                                        <div class="filter-colors">
                                            @foreach ($colors as $color)
                                                @if ($color->products()->whereStatus('1')->count() > 0)
                                                    <a style="background: {{ $color->hex }};" title="{{ $color->title }}"
                                                        id="color_"{{ $color->id }}></a>
                                                @endif
                                            @endforeach
                                        </div><!-- End .filter-colors -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        قیمت
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                محدوده قیمت :
                                                <span id="filter-price-range"></span>
                                            </div><!-- End .filter-price-text -->

                                            <div id="price-slider" data-step="50"
                                                data-end="{{ round($range['max'] / 1.1) }}" data-min="{{ $range['min'] }}"
                                                data-max="{{ $range['max'] }}"></div>
                                            <!-- End #price-slider -->
                                        </div><!-- End .filter-price -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->
                        </div><!-- End .sidebar sidebar-shop -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
    <script src="front/assets/js/wNumb.js"></script>
    <script src="front/assets/js/nouislider.min.js"></script>
    <script>
        $(document).ready(function() {

            // متغیرهای سراسری برای نگهداری فیلترهای انتخاب‌شده
            var categoryFilter = [];
            var colorFilter = [];
            var lowerPrice = '{{ $range['min'] }}';
            var upperPrice = '{{ $range['max'] }}';
            var searchQuery = '';

            // تابع مشترک برای ارسال درخواست AJAX
            function filterProducts(page = 1) {
                $.ajax({
                    url: "{{ route('products.filter') }}",
                    method: "GET",
                    data: {
                        color: colorFilter,
                        category: categoryFilter,
                        range: [lowerPrice, upperPrice],
                        search: searchQuery,
                        page: page // ارسال شماره صفحه به سرور
                    },
                    success: function(response) {
                        $('#productList').html(response.html); // بروزرسانی لیست محصولات
                        attachPaginationEvents(); // اضافه کردن رویداد کلیک به لینک‌های pagination
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            // تابع debounce برای جلوگیری از ارسال متعدد درخواست‌ها
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // رویداد تغییر چک‌باکس‌ها برای دسته‌بندی
            $('input[id^=cat-]').on('change', debounce(function() {
                categoryFilter = []; // فیلترهای انتخاب شده برای دسته‌بندی را بازنشانی کن
                $('input[id^=cat-]:checked').each(function() {
                    categoryFilter.push($(this).val()); // فیلترهای انتخاب شده
                });
                filterProducts(); // ارسال درخواست AJAX با فیلترهای جدید
            }, 300)); // تنظیم زمان debounce به 300 میلی‌ثانیه

            // رویداد کلیک برای رنگ‌ها
            $('a[id^=color_]').on('click', debounce(function() {
                $(this).toggleClass("selected"); // تغییر کلاس برای انتخاب یا عدم انتخاب رنگ
                colorFilter = []; // فیلترهای انتخاب شده برای رنگ‌ها را بازنشانی کن
                $('a[id^=color_].selected').each(function() {
                    colorFilter.push($(this).attr("style").split('background:')[1].trim()
                        .replace(';', '')); // فیلترهای انتخاب شده
                });
                filterProducts(); // ارسال درخواست AJAX با فیلترهای جدید
            }, 300)); // تنظیم زمان debounce به 300 میلی‌ثانیه

            // رویداد keyup برای جستجو
            $('#search').on('keyup', debounce(function() {
                searchQuery = $(this).val(); // مقدار جستجو
                filterProducts(); // ارسال درخواست AJAX برای فیلتر با مقدار جستجو
            }, 300)); // تنظیم زمان debounce به 300 میلی‌ثانیه

            $('#price-slider > *').on('click', debounce(function() {
                lowerPrice = $(".noUi-handle-lower").text().replace('تومان', '');
                upperPrice = $(".noUi-handle-upper").text().replace('تومان', '');
                filterProducts();
            }, 0));

            // تابع برای افزودن رویداد کلیک به لینک‌های pagination
            function attachPaginationEvents() {
                $('.pagination a').on('click', function(e) {
                    e.preventDefault();
                    var page = $(this).attr('href').split('page=')[1]; // دریافت شماره صفحه از URL
                    filterProducts(page); // ارسال درخواست AJAX با شماره صفحه
                });
            }

            // لود اولیه محصولات در صورت نبودن فیلتر دسته‌بندی
            if (!new URLSearchParams(window.location.search).has('category')) {
                filterProducts(); // ارسال درخواست AJAX بدون فیلتر
            }
        });
    </script>
@endsection
