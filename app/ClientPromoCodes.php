<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPromoCodes extends Model
{
    protected $table = 'client_promocodes';
    public $primary_key = 'id';
    public $fillable = ['client_id', 'promo_id', 'created_at', 'updated_at'];

    public function promo_code()
    {
        return $this->hasOne(PromoCodes::class, 'id', 'promo_id');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
