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


    //polymorphic many to many relationship between products table and tags table
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
