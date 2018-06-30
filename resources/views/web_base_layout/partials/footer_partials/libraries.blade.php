@for($counter = 0 ; $counter < FOOTER_LIBRARY_LIMIT ; $counter++)
    @if(isset(libraries()[$counter]))
        <li><a href="{{route('web.book.search.show')}}?library_id={{libraries()[$counter]->id}}">{{libraries()[$counter]->name}}</a></li>

    @endif
@endfor