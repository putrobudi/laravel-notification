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
    }
}
