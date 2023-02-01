<?php

namespace App\Models;

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
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {

        parent::boot();

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
