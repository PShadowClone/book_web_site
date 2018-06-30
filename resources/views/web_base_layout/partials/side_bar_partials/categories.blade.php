@foreach(categories() as $category)
    <li class="panel">
        <a class="collapsed" role="button" data-toggle="collapse"
           data-parent="#categories" href="#parent-{{$category->id}}"
           aria-expanded="false" aria-controls="parent-1">{{$category->name}}
            <span>[{{books_by_category($category->id)->count()}}]</span>
        </a>
        <ul id="parent-{{$category->id}}" class="list-unstyled panel-collapse collapse" role="menu">
            @foreach(books_by_category($category->id) as $book)
                <li><a href="{{route('web.book.show' , ['id' => $book->id])}}">{{$book->name}}</a></li>
            @endforeach
        </ul>
    </li>
@endforeach

