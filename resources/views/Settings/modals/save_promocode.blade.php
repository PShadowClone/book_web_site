<div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('setting.addPromoCode')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" id="discount_rate" placeholder="@lang('setting.discount_rate')"/>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <input class="form-control" id="promo_code" placeholder="@lang('setting.promo_code')"/>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px">
                        <div class="alert alert-danger promo-alert" style="display: none">
                            <span>@lang('lang.error') !</span> <span id="addPromoValidation"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="savePromoCode">@lang('lang.add')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
            </div>
        </div>
    </div>
</div>