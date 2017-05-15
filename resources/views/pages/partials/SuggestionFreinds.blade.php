
        {{--@foreach($freinds as $list_user)--}}
        {{--<div class="notification-row">--}}
            {{--<div class="notification-padding">--}}
                {{--<div class="sidebar-fa-image img-may-know">--}}
                    {{--<img class="notifications" src="{{ $list_user->GetPhoto() }}">--}}
                {{--</div>--}}
                {{--<div class="sidebar-fa-text">--}}
                    {{--<b><a href="#">{{ $list_user->name.' '.$list_user->prename }}</a></b><br>--}}

                    {{--<a href="#" data-url="{{ route('friend::add') }}" data-user="{{ $list_user->id }}" data-token="{{ csrf_token() }}" class="add-friend btn btn-info" title="Envoyer une demande">--}}
                        {{--<i class="fa fa-user-plus">Add Friend</i>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}


    @foreach($freinds as $list_user)
        @if(!$authUser->hasSentFriendRequestTo($list_user))
            @if(!$authUser->hasFriendRequestFrom($list_user))
                @if(!$authUser->isFriendWith($list_user))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">People You May Know</h3>
                        </div>
                        <div class="panel-body">
                        <div class="notification-row suggested-{{ $list_user->id }}">
                            <div class="notification-padding">
                                <div class="sidebar-fa-image img-may-know">
                                    <img class="notifications" src="{{ $list_user->GetPhoto() }}">
                                </div>
                                <div class="sidebar-fa-text">
                                    <b><a href="#">{{ $list_user->name.' '.$list_user->prename }}</a></b><br>

                                    <a href="#" data-url="{{ route('Freind::add') }}" data-user="{{ $list_user->id }}" data-token="{{ csrf_token() }}" class="add-friend_sugestion btn btn-info" title="Envoyer une demande">
                                        <i class="fa fa-user-plus">Add Friend</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endif
            @endif
        @endif
    @endforeach


