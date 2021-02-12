<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function themes(): BelongsToMany
    {
        return $this->belongsToMany('App\Theme')->withTimestamps();
    }
}
