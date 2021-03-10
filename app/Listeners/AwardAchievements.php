<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AwardAchievements
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductPurchased  $event
     * @return void
     */

     // Listen to the event and handle it. 
    public function handle(ProductPurchased $event)
    {
        // You read of the $event object itself
        // So maybe if you need to read the product itself,
        // your Event class might have a product property, $event-product,
        // maybe a user, $event-user
        var_dump('check for new achievements');
    }
}
