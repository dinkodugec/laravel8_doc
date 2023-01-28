<?php

namespace App\Models;

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
}
