<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }

    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }
}
