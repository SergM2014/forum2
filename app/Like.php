<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['response_id', 'member_id', 'like', 'dislike'];

    public $timestamps = false;
}
