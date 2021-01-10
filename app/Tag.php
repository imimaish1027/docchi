<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function themes()
    {
        return $this->belongsToMany('App\Theme')->withTimestamps();
    }
}
