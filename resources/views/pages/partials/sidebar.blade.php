<!-- Online users sidebar content-->
<div class="chat-sidebar focus" style="">
    <div class="list-group text-left">
        <p class="text-center visible-xs"><a href="#" class="hide-chat btn btn-success btn-sm">Hide</a></p>
        <p class="text-center chat-title">CONTACTS</p>
        <div class="online-users">
        @foreach($onlineFriends as $online_user)
           <a href="javascript:register_popup('{{ $online_user->id }}', '{{ $online_user->name }}');"  class=" list-group-item" title="Ecrire a {{ $online_user->name }}">
                <i class="fa fa-check-circle connected-status"></i>
                <img src="{{ $online_user->GetPhoto() }}" class="img-chat img-thumbnail">
                <span class="chat-user-name">{{ $online_user->name.' '.$online_user->prename }}</span><br />
               {{--<small class="text-muted">{{ $online_user->created_at->diffForHumans() }}</small>--}}
            </a>
        @endforeach
        </div>
    </div>
</div><!-- Online users sidebar content-->