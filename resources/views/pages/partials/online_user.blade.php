@forelse($onlineFriends as $online_user)
    <a href="#" data-user-id="{{ $online_user->id }}" data-user-name="{{ $online_user->name }}"  class="user list-group-item" title="Ecrire a {{ $online_user->name }}">
        <i class="fa fa-check-circle connected-status"></i>
        <img src="{{ $online_user->GetPhoto() }}" class="img-chat img-thumbnail">
        <span class="chat-user-name">{{ $online_user->name.' '.$online_user->prename }}</span><br />
        {{--<small class="text-muted">{{ $online_user->created_at->diffForHumans() }}</small>--}}
    </a>
    @empty
    <div>Aucun ami actuellement en ligne</div>
@endforelse