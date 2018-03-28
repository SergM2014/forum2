<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id', 'avatar', 'name', 'email', 'password', 'remember_token'
    ];

    public function responses()
    {
        return $this->hasMany('App\Response');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

}
