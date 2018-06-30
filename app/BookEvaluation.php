<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookEvaluation extends Model
{
    public $table = 'book_evaluations';
    public $fillable = ['book_id', 'client_id', 'evaluate', 'note', 'created_at', 'updated_at'];


    /**
     *
     * get evaluation book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    /**
     * get userEvaluations' client (who evaluates driver)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

}
