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

        .product-overlay > img {
            height: 350px;
        }

        article.product-item .product-quickview {
            top: 35%;
        }

        .custom {
            width: 100%;
            direction: rtl;
        }

        .panel-primary {
            border: none;
            margin-left: 5%;
            margin-right: 5%;
        }

        .custom-result {
            width: 90%;
        }

        .form-control {
            text-align: right;
        }

        .dropdown-menu.inner {
            text-align: right;
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
                        <li class="active"> @lang('lang.web.advance_search')</li>
                        {{--<li><a href="products.html">@lang('lang.web.categories')</a></li>--}}
                        <li><a href="{{route('web.home.show')}}">@lang('lang.web.home')</a></li>

                    </ol>
                </div>
                <div class="col-xs-6">
                    <h2>@lang('lang.web.search_result')</h2>
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
        <div class="panel panel-primary">
            <div class="panel-heading" role="tab">
                <h4 class="panel-title" style="direction: rtl">
                    <a role="button" data-toggle="collapse" data-parent="#demo-accordion" href="#demo-accordion-1"
                       aria-expanded="true" aria-controls="demo-accordion-1">
                        @lang('lang.web.advance_search')
                    </a>
                </h4>
            </div>
            <div id="demo-accordion-1" class="panel-collapse collapse in" role="tabpanel">
                <div class="panel-body">
                    <form action="" method="GET">
                        <div class="row">

                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="col-md-3" style="float: right;">
                                    <input type="text" name="delivery_time"
                                           placeholder="@lang('request.web.delivery_time')"
                                           class="form-control" value=""/>
                                </div>

                                <div class="col-md-3" style="float: right;">
                                    <select class="bs-select form-control" name="city_id" data-live-search="true">
                                        <option value="-1">@lang('request.web.city')</option>
                                        @foreach(cities() as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3" style="float: right;">
                                    <select class="bs-select form-control" name="quarter_id" data-live-search="true">
                                        <option value="-1">@lang('request.web.quarter')</option>
                                        @foreach(quarters() as $quarter)
                                            <option value="{{$quarter->id}}">{{$quarter->name}}</option>
                                        @endforeach
                                    </select>
                                </div>



                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="col-md-3">
                                    <input class="btn btn-default" type="reset" id="reset"
                                           value="@lang('lang.web.reset')"/>
                                    <input class="btn btn-primary" type="submit" value="@lang('lang.web.search')"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container custom-result">
            <h2 class="hidden">@lang('lang.web.books')</h2>
            <div class="row">
                <div class="row grid" id="products">

                </div>

                {{--@includeIf('web_base_layout.partials.side_bar')--}}
            </div>
        </div>
    </section>
    <!-- ==========================
    	PRODUCTS - END
    =========================== -->

    <!-- ==========================
    	PRODUCT MODALS VIEW - START
    =========================== -->
    @includeIf('Library.web.modals.details')
    <!-- ==========================
    	PRODUCT MODALS VIEW - END
    =========================== -->


    <!-- ==========================
       PRODUCT SCRIPTS - START
   =========================== -->
    @includeIf('Books.web.scripts.search')
    <!-- ==========================
    	PRODUCT SCRIPTS - END
    =========================== -->

@endsection