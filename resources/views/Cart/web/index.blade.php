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

        .modal-body {
            text-align: right;
        }

        .modal-header {
            padding: 15px !important;
            text-align: right;
            font-size: 28px !important;
            border-bottom: 1px solid #e5e5e5 !important;
        }

    </style>
@endsection
@section('breadcrumb')
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="{{route('web.cart.show')}}">@lang('cart.web.cart')</a></li>
                        <li><a href="{{route('web.home.show')}}">@lang('lang.web.home')</a></li>
                    </ol>
                </div>
                <div class="col-xs-6 book-name">
                    <h2>@lang('cart.web.cart')</h2>
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
    <section class="content account">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <article class="account-content">

                        <form>
                            <div class="products-order shopping-cart">
                                <div class="table-responsive">
                                    <table class="table table-products">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('cart.web.request_status')</th>
                                            <th>@lang('cart.web.total')</th>
                                            <th>@lang('cart.web.amount')</th>
                                            <th>@lang('cart.web.price')</th>
                                            <th>@lang('cart.web.book')</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(cart_books(PAGINATED) as $book)
                                            <tr>
                                                <td class="col-xs-1 text-center">
                                                    <a class="btn btn-primary delete_request"
                                                       data-value="{{$book->request_id}}">
                                                        <i class="fa fa-times" style="padding-left: 0 !important;"></i>
                                                    </a>
                                                    <a class="btn btn-success edit_request"
                                                       data-value="{{$book->request_id}}">
                                                        <i class="fa fa-edit"
                                                           style="padding-left: 0 !important;"></i></a>
                                                </td>
                                                <td class="col-xs-1 col-md-1 text-center">
                                                    <span><b>{{request_status($book->status)}}</b></span></td>
                                                <td class="col-xs-2 text-center">
                                                    <span><b>{{$book->totalPrice()}}</b></span></td>
                                                <td class="col-xs-2 col-md-1 text-center">
                                                    <div class="form-group">
                                                        <span>{{ $book->book_amount}}</span>
                                                    </div>
                                                </td>
                                                <td class="col-xs-2 col-md-1 text-center">
                                                    <span>{{$book->price .  CURRENCY_NAME}}</span>
                                                </td>
                                                <td class="col-xs-4 col-md-5 text-center">
                                                    <h4>
                                                        <a href="{{route('web.book.show' , ['id' => $book->id])}}">{{$book->name}}</a>

                                                    </h4>
                                                </td>
                                                <td class="col-xs-1 text-center">
                                                    <img src="{{$book->getImage()}}"
                                                         alt=""
                                                         class="img-responsive"
                                                         style="max-width: 70px ; height: 94.3px"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            {{cart_books(PAGINATED)->links()}}
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-primary confirming-requests"
                                               style="float: right">@lang('cart.web.send_confirming_request')</a>
                                            <a  class="btn btn-primary make-deliver"
                                               style="margin-right: 10px; float: right">@lang('cart.web.make_delivery')</a>
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <div class="box">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-2" style="margin-left: 0;direction: rtl">
                                        <ul class="list-unstyled order-total" style="text-align: left">
                                            <li>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="text-align: right">
                                                        <span>{{cart_total()['total_products']}}</span> {{CURRENCY_NAME}}
                                                    </div>
                                                    <div class="col-md-6">  @lang('cart.web.total_product')</div>
                                                </div>

                                            </li>
                                            <li>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="text-align: right">
                                                        {{cart_total()['discount']}} - {{CURRENCY_NAME}}
                                                    </div>
                                                    <div class="col-md-6">@lang('cart.web.discount')</div>
                                                </div>

                                            </li>
                                            <li>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="text-align: right">
                                                        <span class="total">{{cart_total()['final_total']}}</span> {{CURRENCY_NAME}}
                                                    </div>
                                                    <div class="col-md-6">@lang('cart.web.final_total')</div>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6" style="text-align: right;direction: rtl">
                                        <h5>@lang('cart.web.enter_promo_code')</h5>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   placeholder="@lang('cart.web.promo_code')" id="promo_code">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary add-promo-code"
                                                        type="button">@lang('cart.web.enter')</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix" style="display: none">
                                <a href="checkout.html" class="btn btn-primary btn-lg pull-right ">Checkout</a>
                            </div>
                        </form>

                    </article>
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
    @includeIf('Cart.web.partials.edit_modal')
    <!-- ==========================
    	PRODUCT QUICKVIEW - END
    =========================== -->

    <!-- ==========================
    	NEWSLETTER - START
    =========================== -->
@endsection
@section('script')
    @includeIf('Cart.web.scripts.index')
@endsection