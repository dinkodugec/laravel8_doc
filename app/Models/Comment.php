<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

    use HasFactory;

       // blog_post_id - by default laravel will try find a forign key blog_post_id in Comment table
       public function blogPost()
       {
           // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
           return $this->belongsTo(BlogPosts::class);

       }

       public function scopeLatest(Builder $query)
       {
           return $query->orderBy(static::CREATED_AT, 'desc');
       }



       public static function boot()
       {

           parent::boot();

          /*  static::addGlobalScope(new LatestScope); */


       }
}