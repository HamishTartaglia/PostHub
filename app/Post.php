<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body','image'];
    protected $attributes = ['score'=>10];

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function photo()
    {
        return $this->morphOne('App\Photo', 'photoable');
    }
}
