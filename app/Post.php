<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body',];
    protected $attributes = ['score'=>0];

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
}
