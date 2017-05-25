<div class="msg_body">
    @forelse($threads->messages as $message)
        <div class=" @if($message->user->id == Auth::user()->id) msg_a @else msg_b @endif" data-message-id>
        <img src="{{ $message->user->GetPhoto() }}" class="img-circle" style="width: 25px;"/>
            {{ substr($message->body, 0, 26) }}<br/>
            {{ substr($message->body, 26, 500) }}
        </div>
    @empty
        <div class="msg_b">
            {!! 'Veuillez envoyer un message pour  creer une conversation'  !!}
        </div>
    @endforelse
    {{--<div class="msg_b">This is from B, and its amazingly kool nah... i know it even i liked it :)</div>--}}
    {{--<div class="msg_a">Wow, Thats great to hear from you man </div>--}}
    <div class="msg_push"></div>
</div>