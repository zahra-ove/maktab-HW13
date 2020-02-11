<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'username', 'email', 'age', 'gender_id', 'password'];

    public function gender(){
        return $this->belongsTo('App\Gender');
    }

// many to many relationship between User model and Role model
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
