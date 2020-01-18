<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'nickname', 'nickname');
    }

    /**
     * Returns auth user.
     *
     */
    public static function AuthUser()
    {
        return auth()->user();
    }

    public static function GetUserByNickname($nickname)
    {
        return User::where('nickname', 'like', $nickname)->first();
    }
   
}
