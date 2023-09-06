<?php

namespace App\Observers;

use App\Models\BlogPosts;
use Illuminate\Support\Facades\Cache;


class BlogPostObserver
{


    public function deleting(BlogPosts $blogpost) //some of valid events
    {

        $blogpost->comments()->delete();
        Cache::tags(['blog-post'])->forget("blog-post-{$blogpost->id}");
    }

    public function updating(BlogPosts $blogpost)
    {
        Cache::tags(['blog-post'])->forget("blog-post-{ $blogpost->id}");
    }

    public function restoring(BlogPosts $blogpost)
    {

        $blogpost->comments()->restore();
    }





}
