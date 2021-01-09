<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['title', 'answer_a', 'pic_a', 'answer_b', 'pic_b'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\BookMark');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
