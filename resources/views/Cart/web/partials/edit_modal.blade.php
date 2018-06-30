<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">@lang('request.web.edit_request')</h3>

            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="edit_request_form">
                        <input type="hidden" id="request_id">
                        <input type="hidden" id="book_id">
                        <div class="col-md-12" style="margin-top: 10px">
                            <label for="book_name">@lang('request.web.request_identifier')</label>
                            <input type="text" class="form-control" name="request_identifier" id="request_identifier"
                                   readonly>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <label for="book_name">@lang('request.web.book_name')</label>
                            <input type="text" class="form-control" name="book_name" id="book_name" readonly>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <label for="book_name">@lang('request.web.book_price')</label>
                            <input type="text" class="form-control" name="book_price" id="book_price" readonly>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <label for="book_name">@lang('request.web.requested_amount')</label>
                            <input type="text" class="form-control" name="book_requested_amount"
                                   id="book_requested_amount">
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.web.close')</button>
                <button type="button" class="btn btn-primary " id="edit_request">@lang('lang.web.save')</button>
            </div>
        </div>
    </div>
</div>