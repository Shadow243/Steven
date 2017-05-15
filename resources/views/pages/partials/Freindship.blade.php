<!-- cover content -->
<div class="row">
    <div class="col-md-10 no-paddin-xs">
        <div class="col-md-12">
            <!-- panel friends -->
            <div class="panel panel-default panel-list-friends">
                <div class="panel-heading">
                    <h3 class="panel-title">Friends</h3>
                </div>
                <div class="panel-body">
                    @foreach($freinds as $list_user)
                        @if(!$authUser->isFriendWith($list_user))
                            <div class="col-md-4 suggested-{{ $list_user->id }}">
                                <div class="g-hover-card">
                                    <img src="{{ $list_user->MurPhoto }}" alt="">
                                    <div class="user-avatar">
                                        <img src="{{ $list_user->GetPhoto() }}" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="title">
                                            <a href="#">{{ $list_user->name }}</a>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <a href="#" data-url="@if($authUser->hasSentFriendRequestTo($list_user)) {{ route('Freind::Deny::freindRequest') }} @elseif($authUser->hasFriendRequestFrom($list_user)) {{ route('Freind::Accept::request') }} @else {{  route('Freind::add')  }} @endif" data-user="{{ $list_user->id }}" data-token="{{ csrf_token() }}" class="add-friend btn @if($authUser->hasSentFriendRequestTo($list_user)) btn-warning @elseif($authUser->hasFriendRequestFrom($list_user)) btn-success @else btn-info @endif btn-xs" title="@if($authUser->hasSentFriendRequestTo($list_user)) Annuler la demande @elseif($authUser->hasFriendRequestFrom($list_user)) Accepter la demande @else Envoyer la demande @endif">
                                            <i class="fa @if($authUser->hasSentFriendRequestTo($list_user)) fa-close @elseif($authUser->hasFriendRequestFrom($list_user)) fa-heart @else fa-plus @endif"></i>
                                        </a>
                                        <a href="javascript:register_popup('{{ $list_user->id }}', '{{ $list_user->name }}');" class="btn btn-primary btn-xs" title="Ecrire un message">
                                            <i class="fa fa-envelope"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="col-md-12 panel-white post-load-more panel-shadow text-center">
                        <button class="btn btn-default">
                            <i class="fa fa-refresh"></i>Afficher plus...
                        </button>
                    </div>
                </div>
            </div><!-- end panel friends -->
        </div>
    </div>
</div>