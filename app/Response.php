<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'parent_id', 'topic_id', 'member_id', 'response', 'published', 'changed'
        ];

    public function topics()
    {
        return $this->belongsTo('App\Topic');
    }

    public function members()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }
}
