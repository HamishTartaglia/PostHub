<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['photoable_id','photoable_type','filename'];

    public function photoable()
    {
        return $this->morphTo();
    }
}
