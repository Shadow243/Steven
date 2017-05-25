{{--@forelse($threads as $conversat)--}}
<div class="msg_box" style="right:290px">
    <div class="msg_head">{{ $user_clicked->name }}
        <div class="close">x</div>
    </div>
    <div class="msg_wrap">
        <div class="msg_body">
            @forelse($threads->messages as $message)
            <div class=" @if($message->user->id == Auth::user()->id) msg_a @else msg_b @endif" data-message-id="{{ $user_clicked->id }}">
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
        {{--<div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>--}}
        <form method="post" action="{{ route('Message::messages.update', ['id' => $message->thread->id]) }}" class="reply-form_pop">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="msg_footer">
                {{--<textarea class="msg_input txt-reply_pop" rows="4" name="body" ></textarea>--}}
                <input name="body" type="text" style="background-color: #fff; box-shadow:none;" class="msg_input txt-reply_pop">
                {{--<textarea class="msg_input txt-reply_pop" rows="4" name="body" ></textarea>--}}
            </div>
        </form>
    </div>
</div>
    {{--@empty--}}

    {{--@endforelse--}}