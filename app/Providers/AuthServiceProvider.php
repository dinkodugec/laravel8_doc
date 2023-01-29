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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       Gate::define('update-post', function($user, $post){
           return $user->id == $post->user_id;
       });

       Gate::define('delete-post', function ($user, $post) {
        return $user->id == $post->user_id;
    });

    Gate::before(function ($user, $ability) { //it is called before Gates upthere...by default $user is authenticeted user
        if ($user->is_admin && in_array($ability, ['update-post'])) {  //ability to admin user can update a post
            return true;
        }
    });

      // Gate::after(function ($user, $ability, $result) {
        //     if ($user->is_admin) {
        //         return true;
        //     }
        // });
    }
}
