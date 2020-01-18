<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
  
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(User::class, 'nickname', 'nickname');
    }



}
