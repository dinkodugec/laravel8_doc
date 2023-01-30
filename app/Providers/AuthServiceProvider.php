<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\BlogPosts' => 'App\Policies\BlogPostsPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

   /*     Gate::define('update-post', function($user, $post){
           return $user->id == $post->user_id;
       });

       Gate::define('delete-post', function ($user, $post) {
        return $user->id == $post->user_id;
    }); */


        // Gate::define('posts.update', 'App\Policies\BlogPostsPolicy@update');
        // Gate::define('posts.delete', 'App\Policies\BlogPostsPolicy@delete');

       /*  Gate::resource('posts', 'App\Policies\BlogPostsPolicy'); */
        // posts.create, posts.view, posts.update, posts.delete


   /*  Gate::before(function ($user, $ability) { //it is called before Gates upthere...by default $user is authenticeted user
        if ($user->is_admin && in_array($ability, ['posts.update'])) {  //ability to admin user can update a post
            return true;
        }
    }); */

      // Gate::after(function ($user, $ability, $result) {
        //     if ($user->is_admin) {
        //         return true;
        //     }
        // });
    }
}
