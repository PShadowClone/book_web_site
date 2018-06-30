<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'username', 'phone', 'name', 'email', 'password', 'status', 'type', 'single_company', 'instRate', 'total_profits', 'company_id', 'remember_token', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'token', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected $guard = 'client';


//    public function getUserNameAttribute(){
//        dd( $this->attributes['username']);
//    }
    public function getPasswordAttribute()
    {

//        return $this->attributes['password'];
//        dd($this->attributes['password']);
        return $this->attributes['password'];
//        $this->attributes['password'] = Hash::make($pass);

    }

    /**
     *
     *  check if types is supported or not
     * @param $type
     * @return mixed
     * @throws \Exception
     */

    public function setType($type)
    {
        if ($type != '1' && $type != '2')
            throw new \Exception(UNSUPPORTED_TYPE);
        return $type;
    }


    /**
     * check if $status is supported or not
     * @param $status
     * @return mixed
     * @throws \Exception
     */
    public function setStatus($status)
    {
        if ($status != '1' && $status != '2')
            throw new \Exception(UNSUPPORTED_TYPE);
        return $status;
    }


    /**
     * get user company
     * @if $type == 2
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }


    public function driverAreas()
    {
        return $this->hasMany(DriverArea::class, 'user_id', 'id');
    }

    public function client_requests()
    {
        return $this->hasMany(Request::class, 'client_id', 'id');

    }

    public function driver_requests()
    {
        return $this->hasMany(Request::class, 'driver_id', 'id');
    }

}
