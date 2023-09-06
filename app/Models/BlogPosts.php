<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BlogPosts extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    use HasFactory;

    use SoftDeletes, Taggable;


    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
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