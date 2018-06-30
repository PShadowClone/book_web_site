<section class="content brands pattern border-top border-bottom">
    <div class="container">
        <h2 class="section-title">@lang('book.web.newest_books')</h2>
        <div id="brands-carousel">
            @for($counter = 0; $counter < SLIDED_BOOK_SECTION_LIMIT ; $counter++)
                @if(isset(books()[$counter]) && books()[$counter]->image)
                    <div class="item newest_item">
                        <a href="{{route('web.book.show',['id' => books()[$counter]->id])}}">
                            <img src="{{\Illuminate\Support\Facades\URL::to('/').books()[$counter]->image}}"
                                 class="img-responsive newest_books" alt="{{books()[$counter]->name}}"
                                 style="height: 190px; width: 190px">
                        </a>
                    </div>
                @endif
            @endfor
        </div>
    </div>
</section>