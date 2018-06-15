<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['response_id', 'member_id', 'like', 'dislike'];

    public $timestamps = false;

    public function members()
    {
        return $this->belongsTo('App\Member');
    }

    public function responses()
    {
        return $this->belongsTo('App\Response');
    }
}
