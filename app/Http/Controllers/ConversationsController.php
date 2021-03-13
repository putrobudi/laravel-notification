<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function index() {
      return view('conversations.index' ,[
          'conversations' => Conversation::all()
      ]);
    }

    public function show(Conversation $conversation) {
      // Behind the scene about Route Model Binding
      // Conversation::where('id', $conversation->id)->first();

      // Authorizing 
      // You define view in ConversationPolicy. If you don't define, by default it will return unauthorized
      // We can also do this as a middleware.
      // $this->authorize('view' /* Or you can remove it because of the abilityGuess */, $conversation);

      return view('conversations.show', [
          'conversation' => $conversation
      ]);
    }
}
