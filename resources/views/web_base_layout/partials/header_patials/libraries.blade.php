@foreach(libraries() as $library)
    <li>
        <a href="{{route('web.book.search.show')}}?library_id={{$library->id}}">{{$library->name}}</a>
    </li>
@endforeach