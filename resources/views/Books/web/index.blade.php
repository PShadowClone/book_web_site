@extends('web_base_layout._layout')
@section('style')

    <style>
        .book-name {
            text-align: right;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        article.product-item.product-single {
            padding: 0 0 0 15px
        }

        .product-labels {
            top: 0;
            right: initial;
            left: 0 !important;
            text-align: left;
        }

        i {
            padding-left: 5px;
        }

        .reviews {
            float: right !important;
            margin-right: 0 !important;
        }

        .tabs.product-tabs > .tab-content {
            direction: rtl;
            margin-right: 0;
            padding-right: 15px;
            padding-left: 0;
        }

        .releated-products > h2 {
            margin-bottom: 13px;
        }

        article.product-item.product-single p {
            height: 74px !important;
        }
    </style>
@endsection
@section('breadcrumb')
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="{{route('web.book.search.show')}}">@lang('lang.web.books')</a></li>
                        <li><a href="{{route('web.home.show')}}">@lang('lang.web.home')</a></li>
                    </ol>
                </div>
                <div class="col-xs-6 book-name">
                    <h2>{{$book->name}}</h2>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('body')
    <!-- ==========================
        BREADCRUMB - END
    =========================== -->

    <!-- ==========================
    	PRODUCTS - START
    =========================== -->
    <section class="content products">
        <div class="container">
            <article class="product-item product-single">
                <div class="row">
                    <div class="col-xs-8 book-content">
                        <div class="product-body">
                            <h3>{{$book->name}}</h3>
                            <div class="product-labels">
                                <span class="label label-info">@lang('lang.web.new')</span>
                                @if($book->offeredPrice != 0)
                                    <span class="label label-danger">@lang('lang.web.offered')</span>
                                @endif
                                @if($book->checkRequestedBook())
                                    <span class="label label-success"><i class="fa fa-cart-arrow-down"
                                                                         style="font-size: 12px; padding-left: 0px !important;"></i></span>
                                @endif
                            </div>
                            <div class="product-rating">
                                {!! show_book_rating($book) !!}
                            </div>
                            <span class="price">
                                @if($book->offeredPrice != 0)
                                    <del><span class="amount">{{$book->price}}</span></del>
                                    <ins><span class="amount">{{$book->offeredPrice}}</span></ins>
                                @else
                                    <ins><span class="amount">{{$book->price}}</span></ins>
                                @endif
                                <span>{{CURRENCY_NAME}}</span>
                            </span>
                            <ul class="list-unstyled product-info">
                                <li><span>@lang('lang.web.author')</span>{{$book->writer}}</li>
                                <li><span>@lang('lang.web.library')</span>{{$book->getLibraryName()}}</li>
                                <li><span>@lang('lang.web.category')</span>{{$book->getCategoryName()}}</li>
                                <li><span>@lang('lang.web.publish_date')</span>{{$book->getPublishDate()}}</li>
                                <li><span>@lang('lang.web.amount')</span>{{$book->amount}} @lang('lang.web.book')</li>
                            </ul>
                            <p>{{$book->description}}</p>
                            {{--@if($book->checkRequestedBook())--}}
                            <div class="product-form clearfix">
                                <div class="row row-no-padding">


                                    <div class="col-md-6 col-sm-4">
                                        @if(!$book->checkRequestedBook())
                                            <div class="product-quantity clearfix">
                                                <a class="btn btn-default" id="qty-minus">-</a>
                                                <input type="text" class="form-control book-amount" id="qty" value="1">
                                                <a class="btn btn-default" id="qty-plus">+</a>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="col-md-6 col-sm-12">
                                        <a class="btn {{$book->checkRequestedBook() ? 'btn-success' : 'btn-primary add-to-cart'}}"
                                           data-value="{{$book->id}}"><i
                                                    class="fa {{$book->checkRequestedBook() ? 'fa-cart-arrow-down' : 'fa-shopping-cart'}} "></i>
                                            @if($book->checkRequestedBook())
                                                @lang('lang.web.add_to_cart_done')
                                            @else
                                                @lang('lang.web.add_to_cart')
                                            @endif
                                        </a>
                                    </div>

                                </div>
                            </div>
                            {{--@endif--}}
                            <ul class="list-inline product-links">
                                <li><a href="#"><i class="fa fa-heart"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-exchange"></i>Compare</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i>Email to friend</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="item"><img src="{{\Illuminate\Support\Facades\URL::to('/').$book->image}}"
                                               class="img-responsive"
                                               alt="" style="height: 474.11px;"></div>
                    </div>

                </div>
            </article>


        @if($book->getEvaluationCount() > 0)
            <!-- comments - START -->
            @includeIf("Books.web.partials.comments")
            <!-- comments - END -->
            @endif

            <div class="releated-products">
                <h2>@lang('lang.web.related_books')</h2>
                <div class="row grid" id="products">
                    @foreach($book->getRelatedBooks() as $relatedBook)
                        {!! $relatedBook !!}
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
    	PRODUCTS - END
    =========================== -->

    <!-- ==========================
    	ADD REVIEW - START
    =========================== -->
    <div class="modal fade modal-add-review" id="add-review" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                                class="fa fa-times"></i></button>
                    <h4 class="modal-title">Add a review</h4>
                </div>
                <div class="modal-body">
                    <form class="comment-form">
                        <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span>
                            Required fields are marked<span class="required">*</span></p>
                        <div class="row">
                            <div class="form-group comment-form-author col-sm-6">
                                <label for="author">Name<span class="required">*</span></label>
                                <input class="form-control" id="author" name="author" type="text" required value=""
                                       placeholder="Enter your name">
                            </div>
                            <div class="form-group comment-form-email col-sm-6">
                                <label for="email">Email<span class="required">*</span></label>
                                <input class="form-control" id="email" name="email" type="email" required value=""
                                       placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="form-group comment-form-comment">
                            <label for="comment">Comment<span class="required">*</span></label>
                            <textarea class="form-control" id="comment" name="comment" required
                                      placeholder="Enter your message"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================
    	ADD REVIEW - END
    =========================== -->

    <!-- ==========================
    	PRODUCT QUICKVIEW - START
    =========================== -->
    @includeIf('Books.web.modals.details')
    <!-- ==========================
    	PRODUCT QUICKVIEW - END
    =========================== -->

    <!-- ==========================
    	NEWSLETTER - START
    =========================== -->
@endsection
@section('script')
    @includeIf('Books.web.scripts.index')
@endsection