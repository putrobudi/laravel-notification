<?php

namespace App\Providers;

use App\Models\Conversation;
use App\Models\User;
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

        // move this to ConversationPolicy (you create via artisan) in update method. And reference the new key name of update method on ConversationBestReplyController.
        // Gate::define('update-conversation', function (/* ? */User $user /* current authenticated user */, Conversation $conversation) {
        //     // return true;
        //     return $conversation->user->is($user);
        // });

        // Global policy for administrator
        // From Conversation Policy
         /* Gate::before(function (User $user) {
             if ($user->id === 6) {
                 return true;
             }
         }); */

        // From Roles and Abilities
        // the $ability argument is from @can blade directive. The $user defaults to current authenticated user.
        Gate::before(function($user, $ability) {
            if ($user->abilities()->contains($ability)) {
                return true;
            }
        }); // the secret sauce recipe: We created the abilities, and then we hook them into Laravel Gate functionality using 
        // global before hook or filter. So you can extract this to your own package if you want or there is no shortage of 
        // authorization packages on Laravel Community. So you might review those as well.

    }
}
