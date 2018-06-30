@foreach(categories() as $category)
    <li>
        <a href="{{route('web.book.search.show')}}?category_id={{$category->id}}">{{$category->name}}</a>
    </li>
@endforeach