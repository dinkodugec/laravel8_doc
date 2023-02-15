<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = ['path', 'blog_post_id'];

    use HasFactory;

    public function blogPost()
    {
        return $this->hasOne(BlogPosts::class);
    }
}