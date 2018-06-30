<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    public $primaryKey = 'id';
    public $fillable = ['id', 'name', 'arrange', 'image', 'created_at', 'updated_at'];
    public $dates = ['created_at', 'updated_at'];


    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
