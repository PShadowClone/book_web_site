@foreach(liked_books() as $book)
    <li>
        <a href="{{route('web.book.show',['id' => $book->id])}}">{{$book->name}}</a>
    </li>
@endforeach