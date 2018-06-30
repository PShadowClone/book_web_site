<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookFavourite extends Model
{

    protected $table = 'book_likes';
    protected $id = 'id';
    protected $fillable = ['client_id', 'book_id', 'created_at', 'updated_at'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

}
