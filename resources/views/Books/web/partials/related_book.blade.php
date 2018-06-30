<div class="col-sm-3 col-xs-6">
    <article class="product-item">
        <div class="row">
            <div class="col-sm-3">
                <div class="product-overlay">
                    <div class="product-mask"></div>
                    <a href="single-product.html" class="product-permalink"></a>
                    <img src="{{\Illuminate\Support\Facades\URL::to('/').$item->image}}" class="img-responsive" alt=""
                         style="height: 350.50px">
                    <div class="product-quickview">
                        <a class="btn btn-quickview"

                           href="{{route('web.book.show',['id' => $item->id])}}">@lang('lang.web.details')</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="product-body">
                    <h3>{{$item->name}}</h3>
                    <div class="product-rating">
                        {!! show_book_rating($item) !!}
                    </div>
                    <span class="price">
                       @if($item->offeredPrice)
                            <del><span class="amount">{{$item->price}}</span></del>
                            <ins><span class="amount">{{$item->offeredPrice}}</span></ins>
                        @else
                            <ins><span class="amount">{{$item->price}}</span></ins>
                        @endif
                        <span>{{CURRENCY_NAME}}</span>
                            </span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat mauris
                        eget magna egestas porta. Curabitur sagittis sagittis neque rutrum congue.
                        Donec lobortis dui sagittis, ultrices nunc ornare, ultricies elit. Curabitur
                        tristique felis pulvinar nibh porta. </p>
                    <div class="buttons buttons-simple">
                        {{--<a href=""><i class="fa fa-exchange"></i></a>--}}
                        {{--<a href=""><i class="fa fa-shopping-cart"></i></a>--}}
                        <a href=""><i class="fa fa-heart-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>