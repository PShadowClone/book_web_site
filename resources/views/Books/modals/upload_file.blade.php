<!-- Modal -->
<div class="modal fade" id="books_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <form method="POST" enctype="multipart/form-data" action="{{route('book.upload.files')}}">
        {{csrf_field()}}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('book.book_record')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group input-large">
                                    <div class="form-control uneditable-input input-fixed input-medium"
                                         data-trigger="fileinput">
                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                        <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new"> @lang('book.choose_file') </span>
                                                                    <span class="fileinput-exists"> @lang('book.change_file') </span>
                                                                    <input type="hidden" value=""
                                                                           name=""><input
                                                type="file" name="book_file"> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists"
                                       data-dismiss="fileinput"> @lang('book.remove') </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
                    <input type="submit" class="btn btn-primary" value="@lang('lang.add')"/>
                </div>
            </div>
        </div>
    </form>
</div>