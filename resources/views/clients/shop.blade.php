@extends('layouts.client')
@section('css')
@endsection
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Content Wrapper Area -->
    <div class="kenne-content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2 order-lg-1">
                    <div class="kenne-sidebar-catagories_area">
                        <div class="kenne-sidebar_categories">
                            <div class="kenne-categories_title first-child">
                                <h5>Lọc theo giá</h5>
                            </div>
                            <div class="price-filter">
                                <div id="slider-range"></div>
                                <div class="price-slider-amount">
                                    <div class="label-input">
                                        <label>Giá : </label>
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                        <button class="filter-btn">Lọc</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kenne-sidebar_categories category-module">
                            <div class="kenne-categories_title">
                                <h5>Danh mục sản phẩm</h5>
                            </div>
                            <div class="sidebar-categories_menu">
                                <ul>
                                    @foreach ($listCategory as $item)
                                        <li class="has-sub">
                                            <a href="{{ route('shop', ['category' => $item->id]) }}">{{ $item->name }}
                                                <i class="ion-ios-plus-empty"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                        <div class="kenne-sidebar_categories">
                            <div class="kenne-categories_title">
                                <h5>Color</h5>
                            </div>
                            <ul class="sidebar-checkbox_list">
                                <li>
                                    <a href="javascript:void(0)">Black (1)</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Blue (1)</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Gold (3)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="kenne-sidebar_categories">
                            <div class="kenne-categories_title kenne-tags_title">
                                <h5>Product Tags</h5>
                            </div>
                            <ul class="kenne-tags_list">
                                <li><a href="javascript:void(0)">Hoodie</a></li>
                                <li><a href="javascript:void(0)">Jacket</a></li>
                                <li><a href="javascript:void(0)">Frocks</a></li>
                                <li><a href="javascript:void(0)">Crochet</a></li>
                                <li><a href="javascript:void(0)">Scarf</a></li>
                                <li><a href="javascript:void(0)">Shirts</a></li>
                                <li><a href="javascript:void(0)">Men</a></li>
                                <li><a href="javascript:void(0)">Women</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-1 order-lg-2">
                    <div class="shop-toolbar">
                        <div class="product-view-mode">
                            <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top"
                                title="Grid View"><i class="fa fa-th"></i></a>
                            <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top"
                                title="List View"><i class="fa fa-th-list"></i></a>
                        </div>
                        <div class="product-page_count">
                            <p>Showing 1–9 of 40 results)</p>
                        </div>
                        <div class="product-item-selection_area">
                            <div class="product-short">
                                <label class="select-label">Short By:</label>
                                <form method="GET" action="{{ route('shop') }}" id="sortForm">
                                    <select name="sort" class="nice-select myniceselect"
                                        onchange="document.getElementById('sortForm').submit()">
                                        <option value="">Default sorting</option>
                                        <option value="name_asc">Name, A to Z</option>
                                        <option value="name_desc">Name, Z to A</option>
                                        <option value="price_asc">Price, low to high</option>
                                        <option value="price_desc">Price, high to low</option>
                                        <option value="rating_high">Rating (Highest)</option>
                                        <option value="rating_low">Rating (Lowest)</option>
                                        <option value="model_asc">Model (A - Z)</option>
                                        <option value="model_desc">Model (Z - A)</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="shop-product-wrap grid gridview-3 row">
                        @foreach ($products as $item)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="product-item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('detail', $item->id) }}">
                                                <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                    alt="Kenne's Product Image">
                                            </a>
                                            <span class="sticker">HOT - Sale - New</span>
                                            <div class="add-actions">
                                                <ul>
                                                    <li class="quick-view-btn" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                            data-bs-toggle="tooltip" data-placement="right"
                                                            title="Quick View"><i class="ion-ios-search"></i></a>
                                                    </li>
                                                    <li><a href="wishlist.html" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Add To Wishlist"><i
                                                                class="ion-ios-heart-outline"></i></a>
                                                    </li>
                                                    <li><a href="compare.html" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Add To Compare"><i
                                                                class="ion-ios-reload"></i></a>
                                                    </li>
                                                    <form action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <li>
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $item->id }}">
                                                                <input value="1" type="hidden" name='quantity'>
                                                                <button type="submit" class="qty-cart_btn"><a
                                                                            href="cart.html" data-bs-toggle="tooltip"
                                                                            data-placement="right" title="Add To cart"><i
                                                                                class="ion-bag"></i></a></button>
                                                        </li>
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <h3 class="product-name" style="height: 40px"><a
                                                        href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0) }}...</a>
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
                                                        <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-product_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('detail', $item->id) }}">
                                                <img src="{{ Storage::url($item->image) }}" alt="Kenne's Product Image">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <div class="price-box">
                                                    <span class="new-price">{{ number_format($item->price, 0, '', '.') }}
                                                        VNĐ</span>
                                                    {{-- <span
                                                    class="old-price">{{ number_format($item->price, 0, '', '.') }}</span> --}}
                                                </div>
                                                <h6 class="product-name"><a
                                                        href="{{ route('detail', $item->id) }}">{{ $item->name }}</a>
                                                </h6>
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-short_desc">
                                                    <p>{{ $item->short_description }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li class="quick-view-btn" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                            data-bs-toggle="tooltip" data-placement="top"
                                                            title="Quick View"><i class="ion-ios-search"></i></a>
                                                    </li>
                                                    <li><a href="wishlist.html" data-bs-toggle="tooltip"
                                                            data-placement="top" title="Add To Wishlist"><i
                                                                class="ion-ios-heart-outline"></i></a>
                                                    </li>
                                                    <li><a href="compare.html" data-bs-toggle="tooltip"
                                                            data-placement="top" title="Add To Compare"><i
                                                                class="ion-ios-reload"></i></a>
                                                    </li>
                                                    <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Add To cart"><i class="ion-bag"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="kenne-paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="kenne-pagination-box primary-color">
                                            @if ($products->onFirstPage())
                                                <li class="disabled"><span>&laquo; Previous</span></li>
                                            @else
                                                <li><a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;
                                                        Previous</a></li>
                                            @endif

                                            {{-- Loop through the pages --}}
                                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                                <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                                    <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            {{-- Next Page Link --}}
                                            @if ($products->hasMorePages())
                                                <li><a href="{{ $products->nextPageUrl() }}" rel="next">Next
                                                        &raquo;</a></li>
                                            @else
                                                <li class="disabled"><span>Next &raquo;</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kenne's Content Wrapper Area End Here -->
@endsection
@section('js')
    <script>
        var sliderrange = $('#slider-range');
        var amountprice = $('#amount');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 20,
                max: 100,
                values: [0, 100],
                slide: function(event, ui) {
                    amountprice.val('$' + ui.values[0] + ' - $' + ui.values[1]);
                }
            });
            amountprice.val('$' + sliderrange.slider('values', 0) + ' - $' + sliderrange.slider('values', 1));
        });
    </script>
@endsection
