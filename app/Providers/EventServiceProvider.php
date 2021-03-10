<?php

namespace App\Providers;

use App\Events\ProductPurchased;
use App\Listeners\AwardAchievements;
use App\Listeners\SendShareableCoupon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        // handled by overriding shouldDiscoverEvents() method.
        // ProductPurchased::class => [
        //     AwardAchievements::class,
        //     SendShareableCoupon::class
        // ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    public function shouldDiscoverEvents()
    {
        // when set to true, Laravel will automatically scan your Listener directory
        // and read the classes using PHP reflection API.
        // and then looks for any handle method along with its event
        // So then it automatically builds up the $listen array above.
        return true;
    }

}
