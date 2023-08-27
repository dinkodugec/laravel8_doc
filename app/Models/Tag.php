<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function blogPosts()
    {
        /* return $this->belongsToMany(BlogPosts::class)->withTimestamps()->as('tagged'); */
        return $this->morphedByMany('App\BlogPost', 'taggable')->withTimestamps()->as('tagged');
    }
}