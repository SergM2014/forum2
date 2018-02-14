<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'parent_id', 'topic_id', 'response', 'published', 'changed'
        ];


}
