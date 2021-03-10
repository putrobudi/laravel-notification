<?php

namespace App\Http\Controllers;

use App\Events\ProductPurchased;
use App\Notifications\PaymentReceived;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    public function create() {
      return view('payments.create');
    }

    /* Database notification and send SMS notifications. */
    // public function store() {
    //   request()->user()->notify(new PaymentReceived(/* In real life this would be an object, or something 
    //   from database, or a response from a webhook from stripe */ 900)); 
    //   // You can also write like this instead of Notification::send. 
    //   //Easier to read but only if you're notifying one user. 
    //   //For a collection of users, use Nofitication::send. 
    //   //Also if you already have user instance you can do $user->notify because User uses Notifiable.
    //   //Notification::send(request()->user(), new PaymentReceived());
    // }

    /* Eventing */
    public function store() {
      /* core process */
      // process the payment (through billing provider like stripe)
      // unlock the purchase (Generating license code or something like that)

      // Announcing the system by dispatching events.
      ProductPurchased::dispatch('toy' /* again in real life this'd be (Product) Model */);
      // event(new ProductPurchased('toy')); Identical to the above.

      /* Side effects that occur after core process. */
      // Notify the user about the payment
      // award achievements
      // send shareable coupon (scheduled email.)

      // Several ways to do the above process.
      // Procedural, Service class, use case class (e.g PurchasingProduct.php), Eventing.
      
    }
}
