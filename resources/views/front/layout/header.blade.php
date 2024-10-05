<header class="header header-intro-clearance header-4">

    <div class="header-top">
        <div class="container py-3 px-4">
            <div class="header-left">
                <a href="tel_3A#" class="font-weight-bolder"><i class="icon-phone"></i>تلفن تماس : 02155667788</a>
            </div><!-- End .header-left -->
            <div class="header-right">
                @if (Session()->has('userLogin'))
                    <a href="{{ route('front.dashboard') }}" class="font-weight-bolder"> داشبورد </a>
                @else
                    <a href="{{ route('front.login') }}" class="font-weight-bolder"> ورود | ثبت نام </a>
                @endif
            </div><!-- End .header-right -->

        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">فهرست</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ asset(route('front.index')) }}" class="logo">
                    <img src="front/assets/images/demos/demo-4/logo.png" alt="Molla Logo" width="105" height="25">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="q" class="sr-only">جستجو</label>
                        <input type="search" class="form-control p-3" id="search" placeholder="جستجوی محصول . . .">
                    </div>
                </div><!-- End .header-search -->
            </div>

            <div class="header-right">

                <div class="wishlist">
                    <a href="{{ route('wishlists.index') }}" title="لیست محصولات مورد علاقه شما">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            <span class="wishlist-count badge">
                                {{ $header['wishlists'] == null ? 0 : $header['wishlists']->count() }}
                            </span>
                        </div>
                        <p>علاقه مندی</p>
                    </a>
                </div><!-- End .compare-dropdown -->

                <div class="dropdown cart-dropdown">
                    <a href="{{ route('carts.index') }}" class="dropdown-toggle">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">
                                {{ $header['carts'] == null ? 0 : $header['carts']->count() }}
                            </span>
                        </div>
                        <p>سبد خرید</p>
                    </a>
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            @if (count($header['categories']->get()) != 0)
                <div class="header-left">
                    <div class="dropdown category-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                            فهرست دسته بندی ها <i class="icon-angle-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">
                                    @foreach ($header['categories']->get() as $category)
                                        <li class="text-right"><a href="{{ $category->url }}"> {{ $category->title }}
                                            </a></li>
                                    @endforeach
                                </ul><!-- End .menu-vertical -->
                            </nav><!-- End .side-nav -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .category-dropdown -->
                </div><!-- End .header-left -->
            @endif

            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        @if (count($header['menus']->get()) == 0)
                            <li class="active">
                                <a href="{{ route('front.index') }}"> خانه </a>
                            </li>
                        @else
                            @foreach ($header['menus']->where('sub_menu', '0')->get() as $menu)
                                <li class="@if (request()->is($menu->url)) active @endif">
                                    <a href="{{ $menu->url }}"> {{ $menu->title }}
                                    </a>
                                    @php
                                        $sub_menus = App\Models\Menu::whereStatus('1')
                                            ->where('sub_menu', $menu->id)
                                            ->get();
                                    @endphp
                                    @if (count($sub_menus) > 0)
                                        <ul>
                                            @foreach ($sub_menus as $sub_menu)
                                                <li> <a href="{{ $sub_menu->url }}"> {{ $sub_menu->title }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-center -->

        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
