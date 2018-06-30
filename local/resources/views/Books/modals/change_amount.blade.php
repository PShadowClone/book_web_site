<!-- Modal -->
<div class="modal fade" id="amountModel" tabindex="-1" role="dialog" aria-labelledby="amountModelHeader"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="amountModelHeader">@lang('book.change_amount')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"> الكمية المتوفرة حالياً : <span id="current_amount"></span></div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <input class="form-control" id="new_amount" name="new_amount" placeholder="@lang('book.new_amount')">
                        <span class="error" id="new_amount_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_new_amount">@lang('lang.edit')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
            </div>
        </div>
    </div>
</div>