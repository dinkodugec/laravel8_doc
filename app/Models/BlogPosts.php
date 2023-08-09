<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BlogPosts extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    use HasFactory;

    use SoftDeletes;


    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }





    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        // comments_count
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }



    public static function boot()
    {

        static::addGlobalScope(new LatestScope);

        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();

        //clearing cache
        static::updating(function (BlogPosts $blogPost) {
            Cache::forget("blog-post-{$blogPost->id}");
        });

       static::deleting(function (BlogPosts $blogPosts) {
            $blogPosts->comments()->delete(); //delete blogposts model and related comments from database
        });

        static::restoring(function (BlogPosts $blogPosts) {   //restore
            $blogPosts->comments()->restore();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }



}