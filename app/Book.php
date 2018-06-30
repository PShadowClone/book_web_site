<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Request as BookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Mockery\Exception;

class Book extends Model
{
    public $table = 'books';
    public $primaryKey = 'id';
    public $fillable = ['id', 'name', 'arrange', 'image', 'amount', 'writer', 'publisher', 'publish_date', 'inquisitor', 'description', 'price', 'category_id', 'library_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function evaluations()
    {
        return $this->hasMany(UserEvaluations::class, 'book_id', 'id');
    }

    public function book_evaluations()
    {
        return $this->hasMany(BookEvaluation::class, 'book_id', 'id');
    }

    public function library()
    {
        return $this->belongsTo(Library::class, 'library_id', 'id');
    }

    public function getEvaluationRating()
    {
        $bookQuery = BookEvaluation::where(['book_id' => $this->id]);
        return $bookQuery->sum('evaluate') / ($bookQuery->count() == 0 ? 1 : $bookQuery->count());
    }

    public function getEvaluationCount()
    {
        return BookEvaluation::where(['book_id' => $this->id])->count();
    }

    public function likes()
    {
        return $this->hasMany(BookFavourite::class, 'book_id', 'id');
    }

    public function requests()
    {
        return $this->hasMany(BookRequest::class, 'book_id', 'id');
    }


    /**
     * returns library's name
     *
     * @return string
     */
    public function getLibraryName()
    {
        $library = $this->library;
        if ($library)
            return $library->name;
        return UNKNOWN;
    }

    /**
     * returns category's name
     *
     * @return string
     */
    public function getCategoryName()
    {
        $category = $this->category;
        if ($category)
            return $category->name;
        return UNKNOWN;
    }

    /**
     *
     * get the offered price for book if there is any available offers
     *
     * @return int|string
     */
    public function getOfferedPrice()
    {
        try {
            $offer = available_offers();
            if (!$offer)
                return 0;
            if ($offer->type == FREE_DELIVERING) {
                return 0;
            }
            if ($offer->book_offer_type == ALL_LIBRARY_BOOKS) {
                if ($this->library_id == $offer->library_id) {
                    $offeredPrice = calculate_book_discount($this->price, $offer->book_discount_rate);
                    return number_format($offeredPrice, 2, '.', '');
                } else {
                    return 0;
                }
            }
            $result = $offer->offeredBooks()->where(['book_id' => $this->id])->first();
            if (!$result)
                return 0;
            $offeredPrice = calculate_book_discount($this->price, $offer->book_discount_rate);
            return number_format($offeredPrice, 2, '.', '');
        } catch (\Exception $exception) {
            return 0;
        }
    }

    /**
     *
     * returns RELATED_BOOKS_NUMBERS of related books
     *
     * @return mixed
     */
    public function getRelatedBooks()
    {
        return $this->category->books()->where('books.id', '<>', $this->id)->limit(RELATED_BOOKS_NUMBERS)->get()->map(function ($item) {
            return view('Books.web.partials.related_book', compact('item'))->render();
        });
    }

    /**
     *
     * get the top rated books
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public static function top_rated($limit = BOOK_NUMBER_HOME)
    {
        $books = collect();
        BookEvaluation::orderBy('evaluate', 'desc')->limit($limit)->groupBy('book_id')->get()->map(function ($item) use ($books) {
            if ($book = $item->book) {
                $books->push($book);
            }
            return $item;
        });
        return $books;
    }

    /**
     *
     * get the most requested books
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function top_requested($limit = BOOK_NUMBER_HOME)
    {
        $books = BookRequest::join('books', 'books.id', '=', 'requests.book_id')
            ->select('books.*', DB::raw('COUNT(requests.book_id) as book_count'))
            ->groupBy('books.id')
            ->orderBy('book_count', 'desc')->limit(BOOK_NUMBER_HOME)->get()->toArray();
        return Book::hydrate($books);
    }


    /**
     *
     * get the most liked books
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function top_liked($limit = BOOK_NUMBER_HOME)
    {
        $books = BookFavourite::join('books', 'books.id', '=', 'book_likes.book_id')
            ->select('books.*', DB::raw('COUNT(book_likes.book_id) as book_count'))
            ->groupBy('books.id')
            ->orderBy('book_count', 'desc')->limit(BOOK_NUMBER_HOME)->get()->toArray();
        return Book::hydrate($books);
    }

    /**
     *
     * humans readable date
     *
     * @return string
     */
    public function getPublishDate()
    {
        Carbon::setLocale(app()->getLocale());
        return Carbon::parse($this->publish_date)->diffForHumans();
    }

    /**
     *
     * returns the liked books
     *
     * @return $this
     */
    public static function likedBooks($id = null)
    {
        $books = Book::join('book_likes', 'book_likes.book_id', '=', 'books.id')
            ->where(['book_likes.client_id' => Auth::id()]);
        if ($id)
            $books = $books->where(['books.id' => $id]);
        return $books->select(['books.*']);
    }


    /**
     *
     * check if book been requested before or not (to freeze up add_to_cart button)
     *
     * @return bool
     */
    public function checkRequestedBook()
    {
        $bookCheck = BookRequest::where(['book_id' => $this->id])->whereIn('status', [FOR_CONFIRMING, CONFIRMED, PAYED, UNDER_PREPARING, PREPARED, DELIVERING])->first();
        return $bookCheck ? TRUE : FALSE;
    }


    /**
     *
     * returns all requested book in cart
     *
     * @param bool $pagination_flag
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function requestedBooks($pagination_flag = false)
    {
        $books = Book::join('requests', 'requests.book_id', '=', 'books.id')
            ->join('cart', 'cart.request_id', '=', 'requests.id')
            ->where('cart.client_id', '=', Auth::id())
            ->where('requests.client_id', '=', Auth::id())
            ->select(['books.*', 'requests.book_amount', 'requests.status', 'requests.id as request_id', 'cart.id as cart_id']);
        if ($pagination_flag)
            return $books->paginate(CART_PAGINATION);
        return $books->get();
    }


    /**
     *
     * calculates the total price of requested book
     *
     * @return float|int|mixed
     */
    public function totalPrice()
    {
        if (!$this->book_amount)
            return $this->price;
        try {
            return $this->book_amount * $this->price;
        } catch (\Exception $exception) {
            return $this->price;
        }
    }


    public function getImage()
    {
        if ($this->image)
            return URL::to('/') . $this->image;
        return asset('assets/' . NO_IMAGE);
    }

}
