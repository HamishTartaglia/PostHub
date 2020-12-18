<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['username', 'description',];
    protected $attributes = ['score'=>0];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
