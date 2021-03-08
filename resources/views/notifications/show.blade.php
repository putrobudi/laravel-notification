@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
@endsection

@section('content')
    <div class="container">
      <ul>
        @forelse ($notifications as $notification)
            <li class="list-unstyled">
              @if ($notification->type === 'App\Notifications\PaymentReceived')
                We have received a payment of ${{ $notification->data['amount'] / 100 /* look DatabaseNotification.php $cast */ }} from you.
              @endif
            </li>
        @empty
            <li>You have no unread notifications at this time.</li>
        @endforelse
      </ul>
    </div>
@endsection
