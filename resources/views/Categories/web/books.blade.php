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
                        <li class="active">{{$category->name}}</li>
                        <li><a href="products.html">@lang('lang.web.categories')</a></li>
                        <li><a href="{{route('web.home.show')}}">@lang('lang.web.home')</a></li>

                    </ol>
                </div>
                <div class="col-xs-6">
                    <h2>{{$category->name}}</h2>
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
                    <div class="products-header" style="display: none">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4" style="display: none">
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
                        @foreach($books as $book)
                            <div class="col-sm-4 col-xs-6">
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
                                                {{--<span class="amount">{{$book->price}}</span>--}}
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


                    @if($books->count() > CATEGORY_BOOKS)
                        <div class="pagination-wrapper">
                            <ul class="pagination">
                                {{ $books->links() }}
                            </ul>
                        </div>
                    @endif

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