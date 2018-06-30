@foreach($books as $book)
    <div class="col-sm-3 col-xs-6 product-panel">
        <article class="product-item">
            <div class="row">
                <div class="col-sm-4">
                    <img src="{{($book->image ? \Illuminate\Support\Facades\URL::to('/').$book->image  : asset('assets/no_image.jpeg'))}}"
                         class="img-responsive" alt="" style="height: 350px;width: 100%;">
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
