<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\City;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'activate', 'email', 'password', 'city_id', 'role', 'phone', 'referred_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function getPhoneNumber()
    {
        return $this->phone;
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function referrer()
    {
        return $this->belongsTo('App\User', 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany('App\User', 'referred_by');
    }

    public function balance()
    {
        return $this->hasOne('App\Models\Balance', 'user_id');
    }
}
