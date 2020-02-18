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

// each user has many comments ---> one to many relationship between user and comments
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


//one to many polymorphic relationships to image
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    

//if user has determined role return true, otherwise return false
    public function hasRole($roleName)
    {
        $roles = $this->roles()->get();

        foreach($roles as $role)
        {
            if($role->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }
}
