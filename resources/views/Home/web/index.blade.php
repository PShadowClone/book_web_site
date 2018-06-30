@extends('web_base_layout._layout')
@section('style')
    <style>
        .navbar.navbar-default.navbar-static-top {
            height: auto;
        }

        .jumbotron h1 {
            font-size: 25px;
        }

        .grey-background.animation.top-to-bottom {
            margin-top: 100px;
        }

        .newest_books {
            border: 1px solid #D0D0D0;
            border-radius: 50%;
            padding: 5px;
            margin-left: 5px;
            margin-right: 5px;
        }

        .newest_item {
            margin-left: 5px;
            margin-right: 5px;
        }

        #map {
            width: 100%;
            height: 602px;
        }

        .content.our-stores {
            background-image: none;
            background-color: #ffffff;
        }

        .content.our-stores > .container {
            width: 100%;
            margin-left: 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 15px;
        }

        .owl-item > .item.newest_item > a:hover {
            background: none !important;
        }
    </style>
@endsection
@section('breadcrumb')
    <!-- ==========================
    	BREADCRUMB - START
    =========================== -->
    @includeIf('Home.web.patrials.advertisment')
    <!-- ==========================
        BREADCRUMB - END
    =========================== -->
@endsection
@section('body')
    <!-- ==========================
    	JUMBOTRON - START
    =========================== -->
    <section class="content jumbotron">
        <div id="homepage-3-carousel" class="nav-inside owl-animation">
            @if(available_ads()->count() > 0)
                @for($counter = 0; $counter < available_ads()->count() ; $counter++)
                    @if(isset(available_ads()[$counter]))
                        <div class="item slide-{{$counter}}"
                             style="background-image: url('{{available_ads()[$counter]->image}}')">
                            <div class="slide-mask"></div>
                            <div class="slide-body">
                                <div class="container">
                                    <h1 class="grey-background animation {{$counter % 2 == 0 ? 'top-to-bottom' : 'bottom-to-top'}}">{{available_ads()[$counter]->content}}</h1>
                                    <div>
                                        <h2 class="grey-background animation {{$counter % 2 == 0 ? 'top-to-bottom' : 'bottom-to-top'}} delay-1"
                                            style="display: none">All products 50%
                                            Off</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            @endif
        </div>
    </section>
    <!-- ==========================
    	JUMBOTRON - END
    =========================== -->
    @includeIf('Home.web.patrials.books_with_different_status')
    <!-- ==========================
    	GRID PRODUCTS - START
    =========================== -->
    <section class="content grid-products border-bottom">
        <div class="container">
            <div class="row">

                <div class="col-xs-6 col-sm-3">
                    <article class="product-item">
                        <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                        <h3><a href="single-product.html">Sunny Tank Selected Femme</a></h3>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="price">
                        	<del><span class="amount">$36.00</span></del>
                            <ins><span class="amount">$30.00</span></ins>
                        </span>
                    </article>
                </div>

                <div class="col-xs-6 col-sm-3">
                    <article class="product-item">
                        <img src="assets/images/products/product-2.jpg" class="img-responsive" alt="">
                        <h3><a href="single-product.html">Sunny Tank Selected Femme</a></h3>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="price">
                        	<del><span class="amount">$36.00</span></del>
                            <ins><span class="amount">$30.00</span></ins>
                        </span>
                    </article>
                </div>

                <div class="col-xs-12 col-sm-3">
                    <ul class="list-unstyled small-product">

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                                <del><span class="amount">$36.00</span></del>
                            	<ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-2.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                            	<del><span class="amount">$36.00</span></del>
                                <ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-3.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                            	<del><span class="amount">$36.00</span></del>
                                <ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-3.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                            	<del><span class="amount">$36.00</span></del>
                                <ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                    </ul>

                </div>

                <div class="col-xs-12 col-sm-3">
                    <ul class="list-unstyled small-product">

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                                <del><span class="amount">$36.00</span></del>
                            	<ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-2.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                            	<del><span class="amount">$36.00</span></del>
                                <ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-3.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                            	<del><span class="amount">$36.00</span></del>
                                <ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <a href="single-product.html">
                                <img src="assets/images/products/product-3.jpg" class="img-responsive" alt="">
                                <h3>Sunny Tank Selected Femme</h3>
                            </a>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="price">
                            	<del><span class="amount">$36.00</span></del>
                                <ins><span class="amount">$30.00</span></ins>
                            </span>
                        </li>
                        <!-- PRODUCT - END -->

                    </ul>

                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
    	GRID PRODUCTS - END
    =========================== -->

    <!-- ==========================
    	CATEGORIES - START
    =========================== -->
    @includeIf('Home.web.patrials.categories')
    <!-- ==========================
    	CATEGORIES - END
    =========================== -->

    <!-- ==========================
    	BRANDS - START
    =========================== -->
    @includeIf('Home.web.patrials.newest_books')
    <!-- ==========================
    	BRANDS - END
    =========================== -->

    <!-- ==========================
    	OUR STORES - START
    =========================== -->
    <section class="content our-stores">
        <div class="container">
            <h2 class="section-title" style="color: #666666;font-size: 32px">@lang('book.web.nearest_libraries')</h2>
            <div class="row">
                <div id="map"></div>
            </div>
        </div>
    </section>
    <!-- ==========================
    	OUR STORES - END
    =========================== -->
@endsection

@section('script')
    @include('Home.web.scripts.map')
@endsection
