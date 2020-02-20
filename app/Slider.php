<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //one to many polymorphic relationships to image
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
