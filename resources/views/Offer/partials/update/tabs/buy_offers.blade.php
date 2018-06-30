<div class="row" style="padding-top: 15px">
    <div class="col-md-12">
        <div class="col-md-3 radio-list">
            <div class="col-md-12" style="margin-bottom: 10px">

                <input type="radio" name="buy_offer_type" class="radio-inline" value="1" style="margin-left: 5px"
                       {{old('buy_offer_type') == '1'  ? 'checked' : $offer->buy_offer_type == "1" ?'checked':''}}/>
                <label>@lang('offer.buy_from_one_library')</label>
            </div>
            <div class="col-md-12">

                <input type="radio" name="buy_offer_type" class="radio-inline" value="2" style="margin-left: 5px" {{old('buy_offer_type') == '2' ? 'checked' :  $offer->buy_offer_type == "2" ? 'checked': ''}}/>
                <label> @lang('offer.all_sales')</label>
            </div>
        </div>
        <div class="col-md-9">
            <div class="col-md-12">
                <div class="col-md-6" style="margin-top: 10px;">
                    <div class="input-icon right">
                        <i class="fa fa-percent"></i>
                        <input type="text" class="form-control" id="buy_discount_rate" name="buy_discount_rate"
                               placeholder="@lang('offer.buy_discount_rate')" value="{{old('buy_discount_rate') ? old('buy_discount_rate') : $offer->buy_discount_rate}}">
                        <span class="error">{{$errors->first('buy_discount_rate')}}</span>
                    </div>
                </div>
                <div class="col-md-6 input-icon right" style="margin-top: 10px;" >
                    <i style="margin: 5px 4px 9px 24px;">ريال</i>
                    <input type="text" class="form-control" id="more_than" name="more_than"
                           placeholder="@lang('offer.more_than')" value="{{old('more_than') ? old('more_than')  :  $offer->more_than}}">
                   <span class="error">{{$errors->first('more_than')}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
