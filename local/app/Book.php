<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function library()
    {
        return $this->belongsTo(Library::class, 'library_id', 'id');
    }
}
