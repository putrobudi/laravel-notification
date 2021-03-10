<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Event class should represents an action that has taken place in your system along with any data that 
// goes along with it. In real life (in the constructor) that data would be a (Product) Model. 

class ProductPurchased
{
    use Dispatchable, SerializesModels;

    public $name; // You'd want all your event's properties to be public.

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(/* Product */ $name)
    {
        $this->name = $name;
    }
}
