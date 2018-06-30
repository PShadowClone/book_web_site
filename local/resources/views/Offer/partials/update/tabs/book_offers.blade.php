<div class="row" style="padding-top: 15px">
    <div class="col-md-12">
        <div class="col-md-3 radio-list">
            <div class="col-md-12" style="margin-bottom: 10px">
                {{--{{dd(old('book_offer_type'))}}--}}
                <input type="radio" name="book_offer_type" class="radio-inline" value="1"
                       style="margin-left: 5px;" {{old('book_offer_type') ==  "1" ? 'checked' : ($offer->book_offer_type == '1' || !old('book_offer_type')? 'checked':  '')}}/>
                <label>@lang('offer.free_delivering')</label>
            </div>
            <div class="col-md-12">

                <input type="radio" name="book_offer_type" class="radio-inline" value="2"
                       style="margin-left: 5px;" {{old('book_offer_type')  == "2" ? 'checked' :$offer->book_offer_type == '2' ? 'checked':  ''}}/>
                <label> @lang('offer.price_discount')</label>
            </div>
        </div>
        <div class="col-md-9">
            <div class="col-md-12">
                <div class="col-md-6">
                    <input name="from_book" id="from_book" class="form-control"
                           placeholder="@lang('offer.from_book')"
                           value="{{old('from_book') ? old('from_book') : $offer->from_book}}"/>
                    <span class="error">{{$errors->first('from_book')}}</span>
                </div>
                <div class="col-md-6 input-icon right" id="book_more_than"
                >
                    <i style="margin: 5px 4px 9px 24px;">ريال</i>
                    <input name="book_more_than" class="form-control"
                           placeholder="@lang('offer.book_purchase_more_than')"
                           value="{{old('book_more_than') ? old('book_more_than')  : $offer->book_more_than}}"/>
                    <span class="error">{{$errors->first('book_more_than')}}</span>
                </div>
                <div class="col-md-12"
                     style="margin-top: 10px;{{old('book_offer_type') == '2'? 'display:block': ($offer->book_offer_type == '1' ? 'display: none' : '')}}"
                     id="book_discount_rate_container">
                    <div class="input-icon right">
                        <i class="fa fa-percent"></i>
                        <input type="text" class="form-control" id="book_discount_rate" name="book_discount_rate"
                               placeholder="@lang('offer.book_discount_rate')"
                               value="{{old('book_discount_rate') ? old('book_discount_rate') : $offer->book_discount_rate}}">
                        <span class="error">{{$errors->first('book_discount_rate')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-left: 60px !important;padding-right: 45px;margin-top: 18px;">
        <a class="btn btn-primary" data-toggle="modal" data-target="#addBook">@lang('offer.addBook')</a>
        <table class="table table-striped table-bordered table-hover dt-responsive" id="offeredBooks"
               width="">
            <thead>
            <tr>
                <th>المكتبة</th>
                <th>اسم الكتاب</th>
                <th>كل الكتب</th>
                <th>العملية</th>
            </tr>
            </thead>
        </table>
    </div>
</div>