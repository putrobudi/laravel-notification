<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConversationBestReplyController extends Controller
{
    public function store(Reply $reply) {
      // authorize that the current user has permission to set the best reply
      // for the conversation

      // You'd use this if you to specialize the response. Whether custom redirect or just reponse.
      // this is the same as $this->authorize.
      // if (Gate::denies('update-conversation', $reply->conversation)) {
      //   die('handle it this way'); 
      // }
      
      $this->authorize(/* 'update-conversation' */ 'update', $reply->conversation); // we're authorizing conversation not the reply. Because best reply is stored in conversation table.
      
      // then set it
      // below, $reply-conversation is cached so you don't always perform new db query everytime.
      // But if you want to manually sort of similar to caching it then you can do it like this.
      // Extract the $reply->conversation into a varible or make model method like this:
      $reply->conversation->setBestReply($reply);
      /* $reply->conversation->best_reply_id = $reply->id;
      $reply->conversation->save(); */

      // redirect back to the conversation page.
      return back();
    }
}
