<?php

namespace App\Providers;

use App\Models\BlogPosts;
use App\Models\Comment;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use App\Services\Counter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::component('components.badge', 'badge');
        Blade::component('components.tags', 'tags');
        Blade::component('components.errors', 'errors');
        Blade::component('components.comment-form', 'commentForm');
        Blade::component('components.comment-list', 'commentList');

        $this->app->singleton(Counter::class, function ($app) {           //$app will be always pass by laravel
            return new Counter(env('COUNTER_TIMEOUT'));
        });

       BlogPosts::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
