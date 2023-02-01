<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPosts extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    use HasFactory;

    use SoftDeletes;


    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }



    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }



    public static function boot()
    {

        parent::boot();

      /*   static::addGlobalScope(new LatestScope); */

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



}
