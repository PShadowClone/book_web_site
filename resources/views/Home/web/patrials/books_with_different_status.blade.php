<style>
    .clearfix {
        text-align: right;
    }

    h2.small-title {
        text-align: center;
    }

    .clearfix > a > img {
        width: 60px;
        height: 80.13px;
    }
</style>
<section class="content small-products border-bottom" style="background-color: #FFFFFF">
    <div class="container">
        <div class="row">

            <!-- COLUMN - START -->
            <div class="col-sm-4">
                <h2 class="small-title">@lang('book.web.top_liked')</h2>
                <ul class="list-unstyled small-product">

                @foreach(top_liked_books() as $book)
                    {{--{{dd($book)}}--}}
                    <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <div class="col-sm-8">
                                <h3>{{$book->name}}</h3>

                                <span class="price">
                                <ins><span class="amount">{{$book->price.' '.CURRENCY_NAME}}</span></ins>
                                    <div class="">

                                        {!! $book->likes()->count() !!}
                                        <i class="fa fa-heart"></i>
                                    </div>
                            </span>
                            </div>
                            <a href="{{route('web.book.show',['id' => $book->id])}}" class="col-sm-4">
                                <img src="{{\Illuminate\Support\Facades\URL::to('/').$book->image}}"
                                     class="img-responsive" alt="">
                            </a>
                        </li>
                        <!-- PRODUCT - END -->
                    @endforeach
                </ul>
            </div>
            <!-- COLUMN - END -->

            <!-- COLUMN - START -->
            <div class="col-sm-4">
                <h2 class="small-title">@lang('book.web.top_requested')</h2>
                <ul class="list-unstyled small-product">

                @foreach(top_requested_books() as $book)
                    <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <div class="col-sm-8">
                                <h3>{{$book->name}}</h3>

                                <span class="price">
                                <ins><span class="amount">{{$book->price.' '.CURRENCY_NAME}}</span></ins>
                                    <div class="">
                                        {!! $book->requests()->count() !!}
                                        <i class="fa fa-shopping-cart"></i>
                                </div>
                            </span>
                            </div>
                            <a href="{{route('web.book.show',['id' => $book->id])}}" class="col-sm-4">
                                <img src="{{\Illuminate\Support\Facades\URL::to('/').$book->image}}"
                                     class="img-responsive" alt="">
                            </a>
                        </li>
                        <!-- PRODUCT - END -->
                    @endforeach
                </ul>
            </div>
            <!-- COLUMN - END -->

            <!-- COLUMN - START -->
            <div class="col-sm-4">
                <h2 class="small-title">@lang('book.web.top_rated')</h2>
                <ul class="list-unstyled small-product">
                @foreach(top_rated_books() as $book)
                    <!-- PRODUCT - START -->
                        <li class="clearfix">
                            <div class="col-sm-8">
                                <h3>{{$book->name}}</h3>

                                <span class="price">
                                <ins><span class="amount">{{$book->price.' '.CURRENCY_NAME}}</span></ins>
                                    <div class="product-rating">
                                    {!! show_book_rating($book) !!}
                                </div>
                            </span>
                            </div>
                            <a href="{{route('web.book.show',['id' => $book->id])}}" class="col-sm-4">
                                <img src="{{\Illuminate\Support\Facades\URL::to('/').$book->image}}"
                                     class="img-responsive" alt="">
                            </a>
                        </li>
                        <!-- PRODUCT - END -->
                    @endforeach
                </ul>
            </div>
            <!-- COLUMN - END -->

        </div>
    </div>
</section>