@extends('layouts.client')
@section('css')
    <style>
        .btn-all {
            background-color: #a8741a;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size:
                20px;
            border: none;
            cursor: pointer;
            margin: 12px auto;

        }

        .btn-all:hover {
            background-color: black;
        }
    </style>
@endsection
@section('content')
    <div class="slider-area">

        <div class="kenne-element-carousel home-slider arrow-style"
            data-slick-options='{
        "slidesToShow": 1,
        "slidesToScroll": 1,
        "infinite": true,
        "arrows": true,
        "dots": false,
        "autoplay" : true,
        "fade" : true,
        "autoplaySpeed" : 7000,
        "pauseOnHover" : false,
        "pauseOnFocus" : false
        }'
            data-slick-responsive='[
        {"breakpoint":768, "settings": {
        "slidesToShow": 1
        }},
        {"breakpoint":575, "settings": {
        "slidesToShow": 1
        }}
    ]'>
            @foreach ($banner as $item)
                <div class="slide-item bg-1 animation-style-01"
                    style="background-image: url('{{ Storage::url($item->banner) }}');">
                    <div class="slider-progress"></div>
                    <div class="container">
                        <div class="slide-content">
                            <span>Ưu đãi đặc biệt - Giảm 20% trong tuần này</span>
                            <h2>{{ $item->title }} <br> Xu thế thời trang</h2>
                            <p class="short-desc">Khám phá các sản phẩm chất lượng cao, thiết kế độc đáo để tôn lên phong
                                cách của bạn. Nhanh tay nắm bắt ưu đãi hấp dẫn này ngay hôm nay!</p>
                            <div class="slide-btn">
                                <a class="kenne-btn" href="shop-left-sidebar.html">Khám phá ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!-- Begin Service Area -->
    <div class="service-area">
        <div class="container">
            <div class="service-nav">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <h4>Free Shipping</h4>
                                <p>Free shipping on all order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <h4>Money Return</h4>
                                <p>30 days for free return</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <h4>Online Support</h4>
                                <p>Support 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Area End Here -->

    <!-- Begin Banner Area -->
    <div class="banner-area">
        <div class="container">
            <div class="row">
                @foreach ($bannerSmall as $item)
                    <div class="col-md-4 col-6 custom-xxs-col" style="max-height: 300px; overflow: hidden;">
                        <div class="banner-item img-hover_effect" style="height: 100%;">
                            <div class="banner-img" style="height: 100%; overflow: hidden;">
                                <a href="javascript:void(0)">
                                    <img src="{{ Storage::url($item->banner) }}" alt="Banner"
                                        style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 8px;">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner Area End Here -->

    <!-- New product -->
    <div class="product-area ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>New Product</h3>
                        <div class="product-arrow"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="kenne-element-carousel product-slider slider-nav"
                        data-slick-options='{
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "infinite": false,
                            "arrows": true,
                            "dots": false,
                            "spaceBetween": 30,
                            "appendArrows": ".product-arrow"
                            }'
                        data-slick-responsive='[
                            {"breakpoint":992, "settings": {
                            "slidesToShow": 3
                            }},
                            {"breakpoint":768, "settings": {
                            "slidesToShow": 2
                            }},
                            {"breakpoint":575, "settings": {
                            "slidesToShow": 1
                            }}
                        ]'>

                        @foreach ($listProduct as $item)
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('detail', $item->id) }}">
                                            <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                alt="Kenne's Product Image">
                                        </a>
                                        <span class="sticker-2">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="right"
                                                        title="Add To cart"><i class="ion-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name" style="height: 40px"><a
                                                    href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                            </h3>
                                            <div class="price-box">
                                                <span class="new-price">{{ number_format($item->price, 0, '', '.') }}
                                                    VNĐ</span>
                                                {{-- <span
                                                    class="old-price">{{ number_format($item->price, 0, '', '.') }}</span> --}}
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                    <li class="silver-color"><i class="ion-ios-star-outline"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn-all">Xem tất cả</button>
        </div>
    </div>
    <!-- Product Area End Here -->

    <!-- Hot Product -->
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Hot Product</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="bag" class="tab-pane active show" role="tabpanel">
                            <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                                data-slick-options='{
                                        "slidesToShow": 4,
                                        "slidesToScroll": 1,
                                        "infinite": false,
                                        "arrows": true,
                                        "dots": false,
                                        "spaceBetween": 30
                                        }'
                                data-slick-responsive='[
                                        {"breakpoint":992, "settings": {
                                        "slidesToShow": 3
                                        }},
                                        {"breakpoint":768, "settings": {
                                        "slidesToShow": 2
                                        }},
                                        {"breakpoint":575, "settings": {
                                        "slidesToShow": 1
                                        }}
                                    ]'>

                                @foreach ($listProduct as $item)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('detail', $item->id) }}">
                                                    <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                        alt="Kenne's Product Image">
                                                </a>
                                                <span class="sticker-2">Hot</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a href="cart.html" data-bs-toggle="tooltip"
                                                                data-placement="right" title="Add To cart"><i
                                                                    class="ion-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name" style="height: 40px"><a
                                                            href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">{{ number_format($item->price, 0, '', '.') }}
                                                            VNĐ</span>
                                                        {{-- <span
                                                            class="old-price">{{ number_format($item->price, 0, '', '.') }}</span> --}}
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li class="silver-color"><i class="ion-ios-star-half"></i>
                                                            </li>
                                                            <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn-all">Xem tất cả</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Tab Area End Here -->

    <!-- Begin Kenne's Banner Area Four -->
    @foreach ($bannerBig as $item)
        <div class="kenne-banner_area kenne-banner_area-4"
            style="background-image: url('{{ Storage::url($item->banner) }}');">
            <div class="banner-img"></div>
            <div class="banner-content">
                <h3>{{ $item->title }}</h3>
                <p>Đừng bỏ lỡ cơ hội nâng tầm phong cách với ưu đãi độc quyền – Sản phẩm hot, giá siêu hời, chỉ có trong
                    tuần này! Khám phá ngay để không lỡ nhịp xu hướng!</p>
                <div class="contact-us">
                    <a href="callto://+123123321345">0976104939</a>
                </div>
                <div class="kenne-btn-ps_center">
                    <a class="kenne-btn transparent-btn" href="shop-left-sidebar.html">Khám phá ngay</a>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Kenne's Banner Area Four End Here -->

    <!-- Sale Product -->
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Sale Product</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="bag" class="tab-pane active show" role="tabpanel">
                            <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                                data-slick-options='{
                                                    "slidesToShow": 4,
                                                    "slidesToScroll": 1,
                                                    "infinite": false,
                                                    "arrows": true,
                                                    "dots": false,
                                                    "spaceBetween": 30
                                                    }'
                                data-slick-responsive='[
                                                    {"breakpoint":992, "settings": {
                                                    "slidesToShow": 3
                                                    }},
                                                    {"breakpoint":768, "settings": {
                                                    "slidesToShow": 2
                                                    }},
                                                    {"breakpoint":575, "settings": {
                                                    "slidesToShow": 1
                                                    }}
                                                ]'>

                                @foreach ($listProduct as $item)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('detail', $item->id) }}">
                                                    <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                        alt="Kenne's Product Image">
                                                </a>
                                                <span class="sticker">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a href="cart.html" data-bs-toggle="tooltip"
                                                                data-placement="right" title="Add To cart"><i
                                                                    class="ion-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name" style="height: 40px"><a
                                                            href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">{{ number_format($item->price, 0, '', '.') }}
                                                            VNĐ</span>
                                                        {{-- <span
                                                            class="old-price">{{ number_format($item->price, 0, '', '.') }}</span> --}}
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li class="silver-color"><i class="ion-ios-star-half"></i>
                                                            </li>
                                                            <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn-all">Xem tất cả</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale Product End Here -->

    <!-- All product -->
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>All Product</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="bag" class="tab-pane active show" role="tabpanel">
                            <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                                data-slick-options='{
                                        "slidesToShow": 4,
                                        "slidesToScroll": 1,
                                        "infinite": false,
                                        "arrows": true,
                                        "dots": false,
                                        "spaceBetween": 30
                                        }'
                                data-slick-responsive='[
                                        {"breakpoint":992, "settings": {
                                        "slidesToShow": 3
                                        }},
                                        {"breakpoint":768, "settings": {
                                        "slidesToShow": 2
                                        }},
                                        {"breakpoint":575, "settings": {
                                        "slidesToShow": 1
                                        }}
                                    ]'>

                                @foreach ($listProduct as $item)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('detail', $item->id) }}">
                                                    <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                        alt="Kenne's Product Image">
                                                </a>
                                                <span class="sticker-2">
                                                    Favourite</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a href="cart.html" data-bs-toggle="tooltip"
                                                                data-placement="right" title="Add To cart"><i
                                                                    class="ion-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name" style="height: 40px"><a
                                                            href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">{{ number_format($item->price, 0, '', '.') }}
                                                            VNĐ</span>
                                                        {{-- <span
                                                            class="old-price">{{ number_format($item->price, 0, '', '.') }}</span> --}}
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li class="silver-color"><i class="ion-ios-star-half"></i>
                                                            </li>
                                                            <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn-all">Xem tất cả</button>
                </div>
            </div>
        </div>
    </div>
    <!-- All product End Here -->
@endsection
@section('js')
@endsection
