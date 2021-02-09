<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Theme extends Model
{
    public $sortable = ['created_at'];
    protected $fillable = ['title', 'answer_a', 'pic_a', 'answer_b', 'pic_b'];
    protected $dates = ['created_at'];

    public function user(): BelongsTo
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

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'bookmarks')->withTimestamps();
    }

    public function isBookmarkedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->bookmarks->where('id', $user->id)->count()
            : false;
    }

    public function getCountBookmarksAttribute(): int
    {
        return $this->bookmarks->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
