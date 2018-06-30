<!-- Modal -->
<div class="modal fade" id="profitsForm" tabindex="-1" role="dialog" aria-labelledby="profitsFormTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profitsFormTitle">@lang("library.addLibraryProfit")</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input name="profitMoney" id="profitMoney" type="text" placeholder="@lang("library.profitMoney")"
                               class="form-control">
                        <span class="error profitMuch_error"></span>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px">
                        <select name="profitType" id="profitType" class="bs-select form-control">
                            <option value="1">@lang('library.cache')</option>
                            <option value="2">@lang('library.bank_transaction')</option>
                        </select>
                        <span class="error profitType_error"></span>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="profitSave">@lang('lang.submit')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
            </div>
        </div>
    </div>
</div>