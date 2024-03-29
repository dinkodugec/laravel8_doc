<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Jobs\NotifyyUsersPostWasCommented;
use App\Events\CommentPosted;
use App\Listeners\CacheSubscriber;
use App\Listeners\NotifyUsersAboutComment;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentPosted::class => [
            NotifyUsersAboutComment::class
        ],
        BlogPostPosted::class => [
            NotifyAdminWhenBlogPostCreated::class
        ]
    ];

    protected $subscribe = [
        CacheSubscriber::class
    ];

    /**
     * Register any events for your application.
     *g
     * @return void
     */
    public function boot()
    {
        //
    }
}
