<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
