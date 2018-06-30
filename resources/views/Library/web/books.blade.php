@extends('web_base_layout._layout')
@section('style')
    <style>
        section > .container > .row > .col-sm-3 {
            direction: rtl;
        }

        .list-unstyled {
            padding-right: 5px;
        }

        .widget-categories .widget-body > ul > li > a:before {
            margin-left: 7px;
        }

        .sidebar .widget h3 a:after {
            float: left;
        }

        .product-labels {
            top: 0;
            right: initial;
            left: 0 !important;
            text-align: left;
        }
    </style>
@endsection
@section('breadcrumb')
    <!-- ==========================
    	BREADCRUMB - START
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li class="active">اسم المكتب</li>
                        <li><a href="products.html">@lang('lang.web.libraries')</a></li>
                        <li><a href="index.html">@lang('lang.web.home')</a></li>

                    </ol>
                </div>
                <div class="col-xs-6">
                    <h2>اسم المكتبة</h2>
                </div>

            </div>
        </div>
    </section>
    <!-- ==========================
        BREADCRUMB - END
    =========================== -->
@endsection
@section('body')
    <!-- ==========================
    	PRODUCTS - START
    =========================== -->
    <section class="content products">
        <div class="container">
            <h2 class="hidden">@lang('lang.web.books')</h2>
            <div class="row">
                <div class="col-sm-9">
                    <div class="products-header">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4">
                                <form class="form-inline products-per-page">

                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>6</option>
                                            <option selected="selected">12</option>
                                            <option>18</option>
                                            <option>24</option>
                                            <option>ALL</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>: @lang('lang.web.show')</label>
                                    </div>
                                </form>
                            </div>

                            <div class="col-xs-6 col-sm-8">
                                <div class="btn-group toggle-list-grid hidden-xs" role="group">
                                    <button type="button" class="btn btn-default active" id="toggle-grid"><i
                                                class="fa fa-th"></i></button>
                                    <button type="button" class="btn btn-default" id="toggle-list"><i
                                                class="fa fa-list"></i></button>
                                </div>
                                <form class="form-inline order-by" style="display: none">
                                    <div class="form-group">
                                        <label>Sort by:</label>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option selected="selected">Default</option>
                                            <option>Popularity</option>
                                            <option>Average rating</option>
                                            <option>Newness</option>
                                            <option>Price: low to high</option>
                                            <option>Price: high to low</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="row grid" id="products">

                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img src="assets/images/products/product-1.jpg" class="img-responsive"
                                                 alt="">
                                            <img src="assets/images/products/product-1b.jpg"
                                                 class="img-responsive product-image-2" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal"
                                                   data-target="#product-quickview">@lang('lang.web.details')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Ut feugiat mauris eget magna egestas</h3>
                                            <div class="product-labels">
                                                <span class="label label-info">@lang('lang.web.new')</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <del><span class="amount">$36.00</span></del>
                                                <ins><span class="amount">$30.00</span></ins>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat
                                                mauris eget magna egestas porta. Curabitur sagittis sagittis neque
                                                rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare,
                                                ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                            <div class="buttons">
                                                <a href="" class="btn btn-primary btn-sm add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>@lang('lang.web.add_to_cart')
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img src="assets/images/products/product-1.jpg" class="img-responsive"
                                                 alt="">
                                            <img src="assets/images/products/product-1b.jpg"
                                                 class="img-responsive product-image-2" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal"
                                                   data-target="#product-quickview">@lang('lang.web.details')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Ut feugiat mauris eget magna egestas</h3>
                                            <div class="product-labels">
                                                <span class="label label-info">@lang('lang.web.new')</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <del><span class="amount">$36.00</span></del>
                                                <ins><span class="amount">$30.00</span></ins>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat
                                                mauris eget magna egestas porta. Curabitur sagittis sagittis neque
                                                rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare,
                                                ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                            <div class="buttons">
                                                <a href="" class="btn btn-primary btn-sm add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>@lang('lang.web.add_to_cart')
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img src="assets/images/products/product-1.jpg" class="img-responsive"
                                                 alt="">
                                            <img src="assets/images/products/product-1b.jpg"
                                                 class="img-responsive product-image-2" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal"
                                                   data-target="#product-quickview">@lang('lang.web.details')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Ut feugiat mauris eget magna egestas</h3>
                                            <div class="product-labels">
                                                <span class="label label-info">@lang('lang.web.new')</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <del><span class="amount">$36.00</span></del>
                                                <ins><span class="amount">$30.00</span></ins>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat
                                                mauris eget magna egestas porta. Curabitur sagittis sagittis neque
                                                rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare,
                                                ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                            <div class="buttons">
                                                <a href="" class="btn btn-primary btn-sm add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>@lang('lang.web.add_to_cart')
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img src="assets/images/products/product-1.jpg" class="img-responsive"
                                                 alt="">
                                            <img src="assets/images/products/product-1b.jpg"
                                                 class="img-responsive product-image-2" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal"
                                                   data-target="#product-quickview">@lang('lang.web.details')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Ut feugiat mauris eget magna egestas</h3>
                                            <div class="product-labels">
                                                <span class="label label-info">@lang('lang.web.new')</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <del><span class="amount">$36.00</span></del>
                                                <ins><span class="amount">$30.00</span></ins>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat
                                                mauris eget magna egestas porta. Curabitur sagittis sagittis neque
                                                rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare,
                                                ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                            <div class="buttons">
                                                <a href="" class="btn btn-primary btn-sm add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>@lang('lang.web.add_to_cart')
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img src="assets/images/products/product-1.jpg" class="img-responsive"
                                                 alt="">
                                            <img src="assets/images/products/product-1b.jpg"
                                                 class="img-responsive product-image-2" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal"
                                                   data-target="#product-quickview">@lang('lang.web.details')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Ut feugiat mauris eget magna egestas</h3>
                                            <div class="product-labels">
                                                <span class="label label-info">@lang('lang.web.new')</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <del><span class="amount">$36.00</span></del>
                                                <ins><span class="amount">$30.00</span></ins>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat
                                                mauris eget magna egestas porta. Curabitur sagittis sagittis neque
                                                rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare,
                                                ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                            <div class="buttons">
                                                <a href="" class="btn btn-primary btn-sm add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>@lang('lang.web.add_to_cart')
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->

                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img src="assets/images/products/product-1.jpg" class="img-responsive"
                                                 alt="">
                                            <img src="assets/images/products/product-1b.jpg"
                                                 class="img-responsive product-image-2" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal"
                                                   data-target="#product-quickview">@lang('lang.web.details')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Ut feugiat mauris eget magna egestas</h3>
                                            <div class="product-labels">
                                                <span class="label label-info">@lang('lang.web.new')</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <del><span class="amount">$36.00</span></del>
                                                <ins><span class="amount">$30.00</span></ins>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat
                                                mauris eget magna egestas porta. Curabitur sagittis sagittis neque
                                                rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare,
                                                ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                            <div class="buttons">
                                                <a href="" class="btn btn-primary btn-sm add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>@lang('lang.web.add_to_cart')
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->

                    </div>

                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>

                </div>
                @includeIf('web_base_layout.partials.side_bar')
            </div>
        </div>
    </section>
    <!-- ==========================
    	PRODUCTS - END
    =========================== -->

    <!-- ==========================
    	PRODUCT QUICKVIEW - START
    =========================== -->
    @includeIf('Library.web.modals.details')
    <!-- ==========================
    	PRODUCT QUICKVIEW - END
    =========================== -->

@endsection