{{--{{dd(user())}}--}}
<style>
    .col-sm-7.text-right > ul > li > a > i {
        margin-left: 10px;
    }

    .top-header .links a:after {
        content: none !important;
    }

    .product-rating {
        direction: rtl;
    }
</style>
<div class="top-header hidden-xs">
    <div class="container">
        <div class="row" style="display: none">
            <div class="alert alert-danger"></div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <ul class="list-inline contacts">
                    <li> 754 213 456 <i class="fa fa-phone"></i></li>
                    <li> help@umarket.com <i class="fa fa-envelope"></i></li>
                </ul>
            </div>
            <div class="col-sm-7 text-right">
                <ul class="list-inline links">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li><a href="my-account.html">@lang('lang.web.my_account') </a></li>
                    @endif
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <li><a href="{{route('web.register.show')}}">@lang('login.web.new_account')<i
                                        class="fa fa-user-plus"></i>
                            </a>
                        </li>
                        <li><a href="{{route('web.login.show')}}">@lang('lang.web.login')<i class="fa fa-key"></i> </a>
                        </li>
                    @else
                        <li><a href="{{route('web.logout.action')}}">@lang('login.web.sign_out')<i
                                        class="fa fa-power-off"></i> </a></li>
                    @endif
                </ul>
                <ul class="list-inline languages hidden-sm" style="display: none">
                    <li><a href="#"><img src="assets/images/flags/cz.png" alt="cs_CZ"></a></li>
                    <li><a href="#"><img src="assets/images/flags/us.png" alt="en_US"></a></li>
                    <li><a href="#"><img src="assets/images/flags/de.png" alt="de_DE"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<header class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">


                <li class="dropdown navbar-cart hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300"
                       data-close-others="true"><i class="fa fa-shopping-cart"></i></a>
                    <ul class="dropdown-menu">
                        <!-- CART ITEM - START -->

                        {{--{{dd(cart())}}--}}
                        <li>
                            <div class="row">

                                <div class="col-sm-9">

                                    <a href="#" class="remove"><i class="fa fa-times-circle"></i></a>
                                    <h4>
                                        <a href="single-product.html">Fusce Aliquam</a>
                                    </h4>
                                    <p>1x - $20.00</p>
                                </div>
                                <div class="col-sm-3">
                                    <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                                </div>
                            </div>
                        </li>
                        <!-- CART ITEM - END -->

                        <!-- CART ITEM - START -->
                        <li>
                            <div class="row">

                                <div class="col-sm-9">

                                    <a href="#" class="remove"><i
                                                class="fa fa-times-circle"></i></a>
                                    <h4>
                                        <a href="single-product.html">Fusce Aliquam</a>
                                    </h4>
                                    <p>1x - $20.00</p>
                                </div>
                                <div class="col-sm-3">
                                    <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                                </div>
                            </div>
                        </li>
                        <!-- CART ITEM - END -->

                        <!-- CART ITEM - START -->
                        <li>
                            <div class="row">

                                <div class="col-sm-9">

                                    <a href="#" class="remove"><i
                                                class="fa fa-times-circle"></i></a>
                                    <h4>
                                        <a href="single-product.html">Fusce Aliquam</a>
                                    </h4>
                                    <p>1x - $20.00</p>
                                </div>
                                <div class="col-sm-3">
                                    <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                                </div>
                            </div>
                        </li>
                        <!-- CART ITEM - END -->

                        <!-- CART ITEM - START -->
                        <li>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="cart.html"
                                       class="btn btn-primary btn-block">@lang('lang.web.view_cart')</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="checkout.html"
                                       class="btn btn-primary btn-block">@lang('lang.web.checkout')</a>
                                </div>
                            </div>
                        </li>
                        <!-- CART ITEM - END -->

                    </ul>
                </li>
                <li class="dropdown navbar-search hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{route('web.book.search.show')}}" method="GET">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control" name="book_name"
                                           placeholder="@lang('lang.web.search') ..." value="">
                                    <span class="input-group-btn">
                                            <input class="btn btn-primary"
                                                    type="submit" value="@lang('lang.web.search')"/>
                                        </span>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>@lang('lang.web.who_we_are')</a>
                </li>

                <li class="dropdown megamenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300"
                       data-close-others="true">@lang('lang.web.favourite_list')</a>
                    <ul class="dropdown-menu">
                        @includeIf('web_base_layout.partials.header_patials.liked_books')
                    </ul>
                </li>
                {{----}}
                {{--<li>--}}
                {{--<a>@lang('lang.web.favourite_list')</a>--}}
                {{--</li>--}}
                <li class="dropdown megamenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300"
                       data-close-others="true" style="display: none">@lang('lang.web.books')</a>
                    <ul class="dropdown-menu books-header">
                        <li class="col-sm-4">
                            <ul class="list-unstyled">
                                <li><a href="components.html#headings">Headings</a></li>
                                <li><a href="components.html#paragraphs">Paragraphs</a></li>
                                <li><a href="components.html#lists">Lists</a></li>
                                <li><a href="components.html#tabs">Tabs</a></li>
                                <li><a href="components.html#accordition">Accordition</a></li>
                            </ul>
                        </li>
                        <li class="col-sm-4">
                            <ul class="list-unstyled">
                                <li><a href="components.html#collapse">Collapse</a></li>
                                <li><a href="components.html#buttons">Buttons</a></li>
                                <li><a href="components.html#tables">Tables</a></li>
                                <li><a href="components.html#grids">Grids</a></li>
                                <li><a href="components.html#responsive-video-audio">Responsive Video &amp; Audio</a>
                                </li>
                            </ul>
                        </li>
                        <li class="col-sm-4">
                            <ul class="list-unstyled">
                                <li><a href="components.html#alerts">Alerts</a></li>
                                <li><a href="components.html#forms">Forms</a></li>
                                <li><a href="components.html#labels">Labels</a></li>
                                <li><a href="components.html#paginations">Paginations</a></li>
                                <li><a href="components.html#carousels">Carrousels</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown megamenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300"
                       data-close-others="true">@lang('lang.web.libraries')</a>
                    <ul class="dropdown-menu">
                        @includeIf('web_base_layout.partials.header_patials.libraries')
                    </ul>
                </li>
                <li class="dropdown megamenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300"
                       data-close-others="true">@lang('lang.web.categories')</a>
                    <ul class="dropdown-menu " style="">
                        @includeIf('web_base_layout.partials.header_patials.categories')
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{route('web.home.show')}}" class="">@lang('lang.web.home')</a>
                </li>

            </ul>

        </div>
        <div class="navbar-header">
            <a href="{{route('web.home.show')}}" class="navbar-brand">
                <img src="{{asset('assets/logo.png')}}" class="img-responsive"/>
            </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i
                        class="fa fa-bars"></i></button>
        </div>

    </div>
</header>
