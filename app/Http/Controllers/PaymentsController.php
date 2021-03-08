<?php

namespace App\Http\Controllers;

use App\Notifications\PaymentReceived;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    public function create() {
      return view('payments.create');
    }

    public function store() {
      request()->user()->notify(new PaymentReceived(/* In real life this would be an object, or something 
      from database, or a response from a webhook from stripe */ 900)); 
      // You can also write like this instead of Notification::send. 
      //Easier to read but only if you're notifying one user. 
      //For a collection of users, use Nofitication::send. 
      //Also if you already have user instance you can do $user->notify because User uses Notifiable.
      //Notification::send(request()->user(), new PaymentReceived());
    }
}
