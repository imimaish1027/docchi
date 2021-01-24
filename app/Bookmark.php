<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }
}
