        <!-- Begin Main Header Area Two -->
        <header class="main-header_area-2">
            <div class="header-top_area d-none d-lg-block">
                <div class="container">
                    <div class="header-top_nav">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
                                <div class="header-top_right">
                                    <ul>
                                        @guest
                                            @if (Route::has('login'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                </li>
                                            @endif

                                            @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
                                            @endif
                                        @else
                                            <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="#">View profile</a>
                                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                                        <a class="dropdown-item"
                                                            href="{{ route('admins.dashboard') }}">Admin</a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @endguest
                                        <li>
                                            <a href="checkout.html">Checkout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-middle_nav">
                                <div class="header-logo_area">
                                    {{-- <a href="{{ route('index') }}"> --}}
                                    <img src="{{ asset('assets/client/images/menu/logo/1.png') }}" alt="Header Logo">
                                    </a>
                                </div>
                                <div class="header-search_area d-none d-lg-block">
                                    <form class="search-form" action="#">
                                        <input type="text" placeholder="Tìm sản phẩm...">
                                        <button class="search-button"><i class="ion-ios-search"></i></button>
                                    </form>
                                </div>
                                <div class="header-right_area d-none d-lg-inline-block">
                                    <ul>
                                        <li class="mobile-menu_wrap d-flex d-lg-none">
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                                <i class="ion-android-menu"></i>
                                            </a>
                                        </li>
                                        <li class="minicart-wrap">
                                            {{-- <a href="{{route('cart.list')}}" class="minicart-btn">
                                                <div class="minicart-count_area">
                                                    <span class="item-count">{{ session('cart') ? count(session('cart')) : '0'}}</span>
                                                    <i class="ion-bag"></i>
                                                </div>
                                                <div class="minicart-front_text">
                                                    <span>Cart:</span>
                                                </div>
                                            </a> --}}
                                            {{-- <span class="total-price">{{ number_format($subtotal, 0, '', '.') }}đ</span> --}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-right_area header-right_area-2 d-inline-block d-lg-none">
                                    <ul>
                                        <li class="mobile-menu_wrap d-inline-block d-lg-none">
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                                <i class="ion-android-menu"></i>
                                            </a>
                                        </li>
                                        <li class="minicart-wrap">
                                            <a href="#miniCart" class="minicart-btn toolbar-btn">
                                                <div class="minicart-count_area">
                                                    <span class="item-count">03</span>
                                                    <i class="ion-bag"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#searchBar" class="search-btn toolbar-btn">
                                                <i class="pe-7s-search"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#offcanvasMenu"
                                                class="menu-btn toolbar-btn color--white d-none d-lg-block">
                                                <i class="ion-android-menu"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom_area d-none d-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-menu_area position-relative">
                                <nav class="main-nav d-flex justify-content-center">
                                    <ul>
                                        <li><a href="{{ route('index') }}">Home</a></li>
                                        <li><a href="{{ route('shop') }}">Shop</a></li>
                                        <li><a href="contact-us.html">Page</a></li>
                                        <li><a href="contact-us.html">Blog</a></li>
                                        {{-- <li><a href="{{route('contact')}}">Contact Us</a></li>
                                        <li><a href="{{route('about')}}">About Us</a></li> --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="header-sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sticky-header_nav position-relative">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-lg-2 col-sm-6">
                                        <div class="header-logo_area">
                                            <a href="index.html">
                                                <img src="{{ asset('assets/client/images/menu/logo/1.png') }}"
                                                    alt="Header Logo">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 d-none d-lg-block position-static">
                                        <div class="main-menu_area">
                                            <nav class="main-nav d-flex justify-content-center">
                                                <ul>
                                                    <li><a href="{{ route('index') }}">Home</a></li>
                                                    <li><a href="{{ route('shop') }}">Shop</a></li>
                                                    <li><a href="contact-us.html">Page</a></li>
                                                    <li><a href="contact-us.html">Blog</a></li>
                                                    {{-- <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                            <li><a href="{{ route('about') }}">About Us</a></li> --}}
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="header-right_area header-right_area-2">
                                            <ul>
                                                <li class="mobile-menu_wrap d-inline-block d-lg-none">
                                                    <a href="#mobileMenu"
                                                        class="mobile-menu_btn toolbar-btn color--white">
                                                        <i class="ion-android-menu"></i>
                                                    </a>
                                                </li>
                                                <li class="minicart-wrap">
                                                    {{-- <a href="{{route('cart.list')}}" class="minicart-btn">
                                                        <div class="minicart-count_area">
                                                            <span class="item-count">{{ session('cart') ? count(session('cart')) : '0'}}</span>
                                                            <i class="ion-bag"></i>
                                                        </div>
                                                    </a> --}}
                                                </li>
                                                <li>
                                                    <a href="#searchBar" class="search-btn toolbar-btn">
                                                        <i class="ion-ios-search"></i>
                                                    </a>
                                                </li>
                                                <li class="d-none d-lg-inline-block">
                                                    <a href="#offcanvasMenu"
                                                        class="menu-btn toolbar-btn color--white">
                                                        <i class="ion-android-menu"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-search_wrapper" id="searchBar">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        <!-- Begin Offcanvas Search Area -->
                        <div class="offcanvas-search">
                            <form action="{{ route('shop') }}" class="hm-searchbox" method="GET">
                                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm...">
                                <button class="search_btn" type="submit"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <!-- Offcanvas Search Area End Here -->
                    </div>
                </div>
            </div>
            <div class="global-overlay"></div>

        </header>
        <!-- Main Header Area End Here Two -->
