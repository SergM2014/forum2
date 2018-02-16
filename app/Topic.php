<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $fillable = [
      'category_id', 'member_id', 'title', 'eng_title'
    ];

    public function comments()
    {
        return $this->hasMany('App\Response');
    }
}
