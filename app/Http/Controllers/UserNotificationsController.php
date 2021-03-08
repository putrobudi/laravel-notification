<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    public function show() {
      // class reference: User Notifiable, DatabaseNotification.php
      // artisan tinker = App\Models\User::find(id)->notifications
      // Let's assume that if a user access /notification, that means, they've read the notifications
      /* use tap function to combine with markAsRead method */
      // $notifications = auth()->user()->unreadNotifications; // When you fetch the collection here
      // you'll get a custom collection. The customisation is in DatabaseNotificationCollection.php
      /* foreach ($notifications as $notification) {
        $notification->markAsRead();
      } Not recommended because that's a lot of database query and so end up with N+1 */
      // So, instead of using foreach like above, do

      // So the first visit, we'll fetch unreadnotifications. But immediately after it, we'll mark them as read.
      // So the next time we load the page, it will not show us the read notifications until we have a new notification.
      /* Use tap function */
      // $notifications->markAsRead();

      $notifications = auth()->user()->unreadNotifications;
      
      return view('notifications.show', [
        // 'notifications' => $notifications
        //'notification' => auth()->user()->unreadNotifications   /* this will return null and creates error if chained with markAsRead on iteration */
        // tap function -> a higher order tap
        // 'notification' => tap(auth()->user()->unreadNotifications)->markAsRead()
        'notifications' => tap($notifications)->markAsRead()
      ]);
    }
}
