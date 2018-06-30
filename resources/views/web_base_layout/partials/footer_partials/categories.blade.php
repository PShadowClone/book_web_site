@for($counter = 0 ; $counter < FOOTER_CATEGORY_LIMIT ; $counter++)
    @if(isset(categories()[$counter]))
        <li>
            <a href="{{route('web.book.search.show')}}?category_id={{categories()[$counter]->id}}">{{categories()[$counter]->name}}</a>
        </li>
    @endif
@endfor