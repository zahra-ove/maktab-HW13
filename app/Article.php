<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    //morphToMany relationships to comments table
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    //one to many polymorphic relationships to image
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
