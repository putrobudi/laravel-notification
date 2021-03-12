@foreach ($conversation->replies as $reply)
    <div>
        <header style="display: flex; justify-content: space-between;">
            <p class="m-0"><strong>{{ $reply->user->name }} said ...</strong></p>

            {{-- You might want to store this if logic in the Reply model if you're going to use it multiple times in lots of places. --}}
            @if (/* $conversation->best_reply_id === $reply->id */ $reply->isBest())
                <span style="color: green;">Best Reply!!</span>
            @endif
        </header>
        {{ $reply->body }}
        {{-- define @can in AuthServiceProvider --}}
        {{-- then authorize the post request --}}
        @can(/* 'update-conversation' */ 'update', $conversation)
            <form method="POST" action="/best-replies/{{ $reply->id }}">
              @csrf
                <button type="submit" class="btn p-0 text-muted">
                    Best Reply?
                </button>
            </form>
        @endcan
    </div>

    @continue($loop->last)

    <hr>
@endforeach
