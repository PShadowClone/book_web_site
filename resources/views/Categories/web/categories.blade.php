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
        .form-control{
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
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <input type="text" name="book_name" placeholder="@lang('book.web.name')"
                                           class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="book_writer" placeholder="@lang('book.web.writer')"
                                           class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="book_publisher" placeholder="@lang('book.web.publihser')"
                                           class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="book_inquisitor" placeholder="@lang('book.web.inquisitor')"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="col-md-6">
                                    <div class="input-group date-picker input-daterange" data-date="10/11/2012"
                                         data-date-format="yyyy-mm-dd" style="width: 100%;">
                                        <input type="text" class="form-control" name="from" id="from"
                                               placeholder="@lang('request.created_at')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="bs-select form-control" name="category_id" data-live-search="true">
                                        @foreach(categories() as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="bs-select form-control" name="library_id" data-live-search="true">
                                        @foreach(libraries() as $library)
                                            <option value="{{$library->id}}">{{$library->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="col-md-3">
                                    <input class="btn btn-default" type="reset" value="@lang('lang.web.reset')"/>
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
                    <!-- PRODUCT - START -->
                    @foreach($books as $book)
                        <div class="col-sm-3 col-xs-6 product-panel">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{\Illuminate\Support\Facades\URL::to('/').$book->image}}"
                                             class="img-responsive" alt="" style="height: 350px">
                                        <div class="product-quickview">
                                            <a class="btn btn-quickview"
                                               href="{{route('web.book.show',['id' => $book->id])}}">@lang('lang.web.details')</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="product-body">
                                            <h3>{{$book->name}}</h3>
                                            <div class="product-labels" style="display: none">
                                                <span class="label label-info">@lang('lang.web.new')</span>
                                            </div>
                                            <div class="product-rating">
                                                {!! show_book_rating($book) !!}
                                            </div>
                                            <span class="price">
                        <span class="amount">{{$book->price}}</span>
                        <ins> <span class="amount">{{$book->price }}</span> </ins>
                        <span>{{CURRENCY_NAME}}</span>
                        </span>
                                            <p>
                                                {{$book->description}}
                                            </p>
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
                @endforeach
                <!-- PRODUCT - END -->
                </div>
                {{--@if($books->count() > CATEGORY_BOOKS)--}}
                {{--<div class="pagination-wrapper">--}}
                {{--<ul class="pagination">--}}
                {{--{{ $books->links() }}--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--@endif--}}

                {{--@includeIf('web_base_layout.partials.side_bar')--}}
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