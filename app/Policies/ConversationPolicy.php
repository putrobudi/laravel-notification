<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    // this will fire before the actual authorization ability is tested. In this case the update function below.
    public function before(User $user)
    {
        // if user->isAdmin, maybe user->roles(), or just checking id. You might have administrator column on User table.
        // However for checking authorization for administrator, it's a pain to do this for every single policy.
        // So we make a global policy in AuthServiceProvider.
        //   if ($user->id === 6 /* for now just make yourself the admin haha. */) {
        //       return true;
        //   }
        // make sure your run your conditional like above using if. Don't do return $user->id === 6. Because the returned type
        // consists not only boolean. But can be something else. And if it returns non null response, then it will be treated
        // as a result of the policy so the method below, which is update, never gets called.

        // You could also use after method. So it will be executed after the update method below.
    }

    public function view(User $user, Conversation $conversation)
    {
        return $conversation->user->is($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Conversation  $conversation
     * @return mixed
     */
    public function update(User $user, Conversation $conversation)
    {
        //ddd('hello');
        return $conversation->user->is($user);
    }
}
