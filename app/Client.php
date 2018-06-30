<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{
    public $table = 'clients';
    protected $fillable = ['id', 'username', 'phone', 'name', 'email', 'password', 'status', 'type', 'single_company', 'instRate', 'total_profits', 'company_id', 'remember_token', 'token'
    ];
    public $guard = 'client';


    public function getAuthPassword()
    {
        return $this->pass;
    }
}
