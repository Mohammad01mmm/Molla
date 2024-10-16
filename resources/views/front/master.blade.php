<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <base href="{{ asset('') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> </title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="front/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="front/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="front/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="front/assets/images/icons/site.webmanifest">
    <link rel="mask-icon" href="front/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="front/assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="front/assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="front/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="front/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="front/assets/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="front/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="front/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="front/assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="front/assets/css/style.css">
    <link rel="stylesheet" href="front/assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="front/assets/css/demos/demo-4.css">
    @yield('style')
</head>

<body>
    <div class="page-wrapper">
        @include('front.layout.header')

        @yield('main')

        @include('front.layout.footer')
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">جستجو</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                    placeholder="جستجو در ..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                        role="tab" aria-controls="mobile-menu-tab" aria-selected="true">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab"
                        aria-controls="mobile-cats-tab" aria-selected="false">دسته بندی ها</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                    aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="index-1.html">خانه</a>
                                <ul>
                                    <li><a href="index-1.html">01 - فروشگاه مبلمان</a></li>
                                    <li><a href="index-2.html">02 - فروشگاه مبلمان</a></li>
                                    <li><a href="index-3.html">03 - فروشگاه لوازم الکترونیکی</a></li>
                                    <li><a href="index-4.html">04 - فروشگاه لوازم الکترونیکی</a></li>
                                    <li><a href="index-5.html">05 - فروشگاه مد و لباس</a></li>
                                    <li><a href="index-6.html">06 - فروشگاه مد و لباس</a></li>
                                    <li><a href="index-7.html">07 - فروشگاه مد و لباس</a></li>
                                    <li><a href="index-8.html">08 - فروشگاه مد و لباس</a></li>
                                    <li><a href="index-9.html">09 - فروشگاه مد و لباس</a></li>
                                    <li><a href="index-10.html">10 - فروشگاه کفش</a></li>
                                    <li><a href="index-11.html">11 - فروشگاه مبل</a></li>
                                    <li><a href="index-12.html">12 - فروشگاه مد</a></li>
                                    <li><a href="index-13.html">13 - بازار</a></li>
                                    <li><a href="index-14.html">14 - بازار تمام عرض</a></li>
                                    <li><a href="index-15.html">15 - مد و زیبایی</a></li>
                                    <li><a href="index-16.html">16 - مد و زیبایی</a></li>
                                    <li><a href="index-17.html">17 - فروشگاه مد و لباس</a></li>
                                    <li><a href="index-18.html">18 - فروشگاه مد (با سایدبار)</a></li>
                                    <li><a href="index-19.html">19 - فروشگاه بازی</a></li>
                                    <li><a href="index-20.html">20 - فروشگاه کتاب</a></li>
                                    <li><a href="index-21.html">21 - فروشگاه ورزشی</a></li>
                                    <li><a href="index-22.html">22 - فروشگاه ابزار</a></li>
                                    <li><a href="index-23.html">23 - فروشگاه مد با نوبار سمت راست</a></li>
                                    <li><a href="index-24.html">24 - فروشگاه ورزشی</a></li>
                                    <li><a href="index-25.html">25 - فروشگاه زیورآلات</a></li>
                                    <li><a href="index-26.html">26 - فروشگاه بازار</a></li>
                                    <li><a href="index-27.html">27 - فروشگاه مُد</a></li>
                                    <li><a href="index-28.html">28 - فروشگاه مواد غذایی</a></li>
                                    <li><a href="index-29.html">29 - فروشگاه تی شرت</a></li>
                                    <li><a href="index-30.html">30 - فروشگاه هدفون</a></li>
                                    <li><a href="index-31.html">31 - فروشگاه یوگا</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="category.html">فروشگاه</a>
                                <ul>
                                    <li><a href="category-list.html">فروشگاه لیست</a></li>
                                    <li><a href="category-2cols.html">2 ستونه</a></li>
                                    <li><a href="category.html">3 ستونه</a></li>
                                    <li><a href="category-4cols.html">4 ستونه</a></li>
                                    <li><a href="category-boxed.html"><span>فروشگاه با حالت بسته بدون سایدبار<span
                                                    class="tip tip-hot">ویژه</span></span></a></li>
                                    <li><a href="category-fullwidth.html">فروشگاه تمام عرض بدون سایدبار</a></li>
                                    <li><a href="product-category-boxed.html">دسته بندی محصولات با حالت بسته</a></li>
                                    <li><a href="product-category-fullwidth.html"><span>دسته بندی محصولات تمام عرض<span
                                                    class="tip tip-new">جدید</span></span></a></li>
                                    <li><a href="cart.html">سبد خرید</a></li>
                                    <li><a href="checkout.html">پرداخت</a></li>
                                    <li><a href="compare.html">مقایسه محصولات</a></li>
                                    <li><a href="wishlist.html">لیست علاقه مندی</a></li>
                                    <li><a href="dashboard.html">داشبورد</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="product.html" class="sf-with-ul">محصولات</a>
                                <ul>
                                    <li><a href="product.html">پیش فرض</a></li>
                                    <li><a href="product-centered.html">توضیحات وسط چین</a></li>
                                    <li><a href="product-extended.html"><span>توضیحات گسترده<span
                                                    class="tip tip-new">جدید</span></span></a></li>
                                    <li><a href="product-gallery.html">گالری</a></li>
                                    <li><a href="product-sticky.html">اطلاعات چسبیده</a></li>
                                    <li class=""><a href="product-sidebar.html">صفحه جمع با سایدبار</a></li>
                                    <li><a href="product-fullwidth.html">تمام صفحه</a></li>
                                    <li><a href="product-masonry.html">اطلاعات چسبیده</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">صفحات</a>
                                <ul>
                                    <li>
                                        <a href="about.html" class="sf-with-ul">درباره ما</a>

                                        <ul style="display: none;">
                                            <li><a href="about.html">درباره ما 01</a></li>
                                            <li><a href="about-2.html">درباره ما 02</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html" class="sf-with-ul">تماس با ما</a>

                                        <ul style="display: none;">
                                            <li><a href="contact.html">تماس با ما 01</a></li>
                                            <li><a href="contact-2.html">تماس با ما 02</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="login.html">ورود</a></li>
                                    <li><a href="faq.html">سوالات متداول</a></li>
                                    <li><a href="404.html">خطای 404</a></li>
                                    <li><a href="coming-soon.html">به زودی</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="blog.html">اخبار</a>

                                <ul>
                                    <li class=""><a href="blog.html">کلاسیک</a></li>
                                    <li><a href="blog-listing.html">لیست</a></li>
                                    <li>
                                        <a href="#" class="sf-with-ul">شبکه بندی</a>
                                        <ul style="display: none;">
                                            <li><a href="blog-grid-2cols.html">2 ستونه</a></li>
                                            <li><a href="blog-grid-3cols.html">3 ستونه</a></li>
                                            <li><a href="blog-grid-4cols.html">4 ستونه</a></li>
                                            <li><a href="blog-grid-sidebar.html">با سایدبار</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="sf-with-ul">سایز های مختلف</a>
                                        <ul style="display: none;">
                                            <li><a href="blog-masonry-2cols.html">2 ستونه</a></li>
                                            <li><a href="blog-masonry-3cols.html">3 ستونه</a></li>
                                            <li><a href="blog-masonry-4cols.html">4 ستونه</a></li>
                                            <li><a href="blog-masonry-sidebar.html">با سایدبار</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="sf-with-ul">ماسک</a>
                                        <ul style="display: none;">
                                            <li><a href="blog-mask-grid.html">نوع 1</a></li>
                                            <li><a href="blog-mask-masonry.html">نوع 2</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="sf-with-ul">پست تکی</a>
                                        <ul style="display: none;">
                                            <li><a href="single.html">پیش فرض با سایدبار</a></li>
                                            <li><a href="single-fullwidth.html">تمام صفحه بدون سایدبار</a></li>
                                            <li><a href="single-fullwidth-sidebar.html">تمام صفحه باسایدبار</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="elements-list.html">عناصر طراحی</a>
                                <ul>
                                    <li class=""><a href="elements-products.html">محصولات</a></li>
                                    <li><a href="elements-typography.html">تایپوگرافی</a></li>
                                    <li><a href="elements-titles.html">عناوین</a></li>
                                    <li><a href="elements-banners.html">بنرها</a></li>

                                    <li><a href="elements-product-category.html">دسته بندی محصولات</a></li>
                                    <li><a href="elements-video-banners.html">بنرهای ویدیویی</a></li>
                                    <li><a href="elements-buttons.html">دکمه ها</a></li>
                                    <li><a href="elements-accordions.html">آکاردئون</a></li>
                                    <li><a href="elements-tabs.html">تب ها</a></li>
                                    <li><a href="elements-testimonials.html">توصیف و نقل قول</a></li>
                                    <li><a href="elements-blog-posts.html">اخبار</a></li>
                                    <li><a href="elements-portfolio.html">نمونه کار</a></li>
                                    <li><a href="elements-cta.html">پاسخ به عمل</a></li>
                                    <li><a href="elements-icon-boxes.html">باکس های آیکون</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            <li><a class="mobile-cats-lead" href="#">پیشنهاد روزانه</a></li>
                            <li><a class="mobile-cats-lead" href="#">هدیه</a></li>
                            <li><a href="#">تخت خواب</a></li>
                            <li><a href="#">روشنایی</a></li>
                            <li><a href="#">مبلمان</a></li>
                            <li><a href="#">فضای ذخیره سازی</a></li>
                            <li><a href="#">میز وصندلی</a></li>
                            <li><a href="#">دکور </a></li>
                            <li><a href="#">کابینت</a></li>
                            <li><a href="#">قهوه</a></li>
                            <li><a href="#">مبلمان خارج از منزل </a></li>
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="فیسبوک"><i
                        class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="توییتر"><i
                        class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="اینستاگرام"><i
                        class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="یوتیوب"><i
                        class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">ورود</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="register" aria-selected="false">ثبت نام</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">نام کاربری یا آدرس ایمیل *</label>
                                            <input type="text" class="form-control" id="singin-email"
                                                name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">رمز عبور *</label>
                                            <input type="password" class="form-control" id="singin-password"
                                                name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ورود</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">مرا به خاطر
                                                    بسپار</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">فراموشی رمز عبور؟</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">یا ورود با</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    حساب گوگل
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    حساب فیسبوک
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel"
                                    aria-labelledby="register-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="register-email">آدرس ایمیل شما *</label>
                                            <input type="email" class="form-control" id="register-email"
                                                name="register-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">رمز عبور *</label>
                                            <input type="password" class="form-control" id="register-password"
                                                name="register-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ثبت نام</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">با
                                                    <a href="#">قوانین و مقررات </a>موافقم *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">یا عضویت با</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    حساب گوگل
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    حساب فیسبوک
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->
    <!-- Plugins JS File -->
    <script src="front/assets/js/jquery.min.js"></script>
    <script src="front/assets/js/bootstrap.bundle.min.js"></script>
    <script src="front/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="front/assets/js/jquery.waypoints.min.js"></script>
    <script src="front/assets/js/superfish.min.js"></script>
    <script src="front/assets/js/owl.carousel.min.js"></script>
    <script src="front/assets/js/bootstrap-input-spinner.js"></script>
    <script src="front/assets/js/jquery.plugin.min.js"></script>
    <script src="front/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="front/assets/js/jquery.countdown.min.js"></script>
    <!-- Main JS File -->
    <script src="front/assets/js/main.js"></script>
    <script src="front/assets/js/demos/demo-4.js"></script>
    <script>
        $("#search").on("keyup", function() {
            if (window.location.pathname != '/shop') {
                window.location.href = '/shop'; // ریدایرکت به صفحه shop
            }
        })
    </script>
    @yield('script')
</body>

</html>
