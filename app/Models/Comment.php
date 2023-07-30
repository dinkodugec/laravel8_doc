<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{

    use SoftDeletes;

    use HasFactory;

    protected $fillable = ['user_id', 'content'];

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

       public function user()
       {
           return $this->belongsTo('App\User');
       }



       public static function boot()
       {

           parent::boot();

          /*  static::addGlobalScope(new LatestScope); */
          static::creating(function (Comment $comment) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
            Cache::tags(['blog-post'])->forget('mostCommented');
        });


       }
}