<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id', 'avatar', 'name', 'email', 'password', 'remember_token'
    ];
}
