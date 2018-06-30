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
                            <div class="col-md-12">

                                <div class="col-md-3">
                                    <input type="text" name="book_writer" placeholder="@lang('book.web.writer')"
                                           class="form-control" value="{{app('request')->input('book_writer')}}"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="book_publisher" placeholder="@lang('book.web.publisher')"
                                           class="form-control" value="{{app('request')->input('book_publisher')}}"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="book_inquisitor" placeholder="@lang('book.web.inquisitor')"
                                           class="form-control" value="{{app('request')->input('book_inquisitor')}}"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="book_name" placeholder="@lang('book.web.name')"
                                           class="form-control" value="{{app('request')->input('book_name')}}"/>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="col-md-6">
                                    <div class="input-group date-picker input-daterange" data-date="10/11/2012"
                                         data-date-format="yyyy-mm-dd" style="width: 100%;">
                                        <input type="text" class="form-control" name="from" id="from"
                                               placeholder="@lang('request.created_at')"
                                               value="{{app('request')->input('from')}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="bs-select form-control" name="category_id" data-live-search="true">
                                        <option value="-1">@lang('book.web.choose_category')</option>
                                        @foreach(categories() as $category)
                                            <option value="{{$category->id}}" {{app('request')->input('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="bs-select form-control" name="library_id" data-live-search="true">
                                        <option value="-1">@lang('book.web.choose_library')</option>
                                        @foreach(libraries() as $library)
                                            <option value="{{$library->id}}" {{app('request')->input('library_id') == $library->id ? 'selected' : ''}}>{{$library->name}}</option>
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
                    <!-- BOOK - START -->
                    @if($books->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            <b>@lang('lang.web.excuse')</b> @lang('book.web.no_available_results')</div>
                    @endif


                @includeIf('Books.web.partials.searched_books')

                <!-- BOOK - END -->
                </div>
                @if(TRUE)
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            {{ $books->links() }}
                        </ul>
                    </div>
                @endif
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