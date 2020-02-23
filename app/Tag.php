<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    // Polymorphic many to many relationship between tags table and articles table
    public function articles()
    {
        return $this->morphedByMany('App\Article', 'taggable');
    }


    // Polymorphic many to many relationship between tags table and products table
    public function products()
    {
        return $this->morphedByMany('App\Product', 'taggable');
    }




}
