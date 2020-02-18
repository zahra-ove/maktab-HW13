<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function commentable()
    {
        return $this->morphTo();
    }


//each comment belongs to only one user  ---> one to many relationship between user and comment
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
