<!-- Modal -->
<div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('offer.addBook')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="books">@lang('library.libraries')</label>
                        <select id="libraries" name="libraries" class="form-control bs-select" data-live-search="true">
                            <option value="-1">@lang('library.library')</option>
                            @foreach(libraries() as $library)
                                <option value="{{$library->id}}">{{$library->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <label for="books">@lang('book.books')</label>
                        <select id="offered_books" name="books" class="form-control bs-select" data-live-search="true">
                            <option value="-1" selected>@lang('offer.all')</option>
                        {{--@foreach(books() as $book)--}}
                                {{--<option value="{{$book->id}}">{{$book->name}}</option>--}}
                            {{--@endforeach--}}
                        </select>
                        <span id="books_error" class="error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveBookOffer">@lang('lang.add')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
            </div>
        </div>
    </div>
</div>