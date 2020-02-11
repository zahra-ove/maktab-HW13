<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    // many to many relationship between User model and Role model
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
