@extends('layouts.Default')
@section('title') Home @stop

@section('content')
<div class="container container-timeline" style="margin-top:100px;">
    <div class="col-md-10 no-paddin-xs">
        <div class="col-md-5 no-paddin-xs">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Bienvennu</h3>
                </div>
                <div class="panel-body">
                    <img src="{{ auth::user()->GetPhoto() }}" class="home-avatar img-thumbnail" alt="user profile image">
                    <a href="profile.html">{{ auth::user()->name.' '.auth::user()->post.' '.auth::user()->prename }}</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Friends activity</h3>
                </div>
                <div class="panel-body">
                    <div class="notification-row">
                        <div class="notification-padding">
                            <div class="sidebar-fa-image">
                                <img class="notifications" src="img/Friends/guy-2.jpg">
                            </div>
                            <div class="sidebar-fa-text"><b>
                                    <a href="#">Carlos marthur</a></b>
                                reviewed a <b>
                                    <a href="#">publication</a>
                                </b>.
                                <span class="timeago">5 days ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-row">
                        <div class="notification-padding">
                            <div class="sidebar-fa-image">
                                <img class="notifications" src="img/Friends/woman-2.jpg">
                            </div>
                            <div class="sidebar-fa-text"><b>
                                    <a href="#">Hillary Markston</a></b>
                                shared a <b>
                                    <a href="#">publication</a></b>.
                                <span class="timeago">5 min ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-row">
                        <div class="notification-padding">
                            <div class="sidebar-fa-image">
                                <img class="notifications" src="img/Friends/woman-3.jpg">
                            </div>
                            <div class="sidebar-fa-text"><b>
                                    <a href="#">Leidy marshel</a></b> shared a <b>
                                    <a href="#">publication</a></b>.
                                <span class="timeago">5 min ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-row">
                        <div class="notification-padding">
                            <div class="sidebar-fa-image">
                                <img class="notifications" src="img/Friends/woman-4.jpg">
                            </div>
                            <div class="sidebar-fa-text"><b>
                                    <a href="#">Presilla bo</a></b> shared a <b>
                                    <a href="#">publication</a></b>.
                                <span class="timeago">5 min ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-row">
                        <div class="notification-padding">
                            <div class="sidebar-fa-image">
                                <img class="notifications" src="img/Friends/woman-4.jpg">
                            </div>
                            <div class="sidebar-fa-text"><b>
                                    <a href="#">Martha markguy</a></b>
                                shared a <b>
                                    <a href="#">publication</a></b>.
                                <span class="timeago">5 min ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-row">
                        <div class="notification-padding">
                            <div class="sidebar-fa-image">
                                <img class="notifications" src="img/Friends/guy-5.jpg">
                            </div>
                            <div class="sidebar-fa-text"><b>
                                    <a href="#">Carlos marthur</a></b>
                                reviewed a <b>
                                    <a href="#">publication</a></b>.
                                <span class="timeago">5 days ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-groups">
                <div class="panel-heading">
                    <h3 class="panel-title">Suggested Groups</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="col-xs-3 col-sm-6 col-md-3">
                                <img src="img/Likes/likes-5.png" alt="Group" class="img-responsive img-circle">
                            </div>
                            <div class="col-xs-9 col-sm-6">
                                <span class="name">Bootdey competitors</span>
                            </div>
                            <div class="clearfix">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-xs-3 col-sm-6 col-md-3">
                                <img src="img/Likes/likes-1.png" alt="Group" class="img-responsive img-circle">
                            </div>
                            <div class="col-xs-9 col-sm-6">
                                <span class="name">Git in action</span>
                            </div>
                            <div class="clearfix">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-xs-3 col-sm-6 col-md-3">
                                <img src="img/Likes/likes-6.png" alt="Group" class="img-responsive img-circle">
                            </div>
                            <div class="col-xs-9 col-sm-6">
                                <span class="name">Bootdey Snippets</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li class="list-group-item">
                            <div class="col-xs-3 col-sm-6 col-md-3">
                                <img src="img/Likes/likes-2.png" alt="Group" class="img-responsive img-circle">
                            </div>
                            <div class="col-xs-9 col-sm-6">
                                <span class="name">Html 5 live</span>
                            </div>
                            <div class="clearfix">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            @include('pages.partials.SuggestionFreinds')

        </div>
        <div class="col-md-7 no-paddin-xs">
            <!--post Form -->
            @include('pages.partials.Forms.PostForm')

            @foreach($freinds as $frienRequest)
                @if($authUser->hasFriendRequestFrom($frienRequest))
                    <div class="panel panel-white post panel-shadow">
                        <div class="post-heading">
                            <div class="pull-left image">
                                <img src="{{ $frienRequest->sender->GetPhoto() }}" class="avatar" alt="user profile image">
                            </div>
                            <div class="pull-left meta">
                                <div class="title h5">
                                    <a href="#" class="post-user-name">{{ $frienRequest->sender->name }}</a>
                                    Vous a envoyer une demande
                                </div>
                                <h6 class="text-muted time">{{ $frienRequest->sender->created_at->DiffForHumans() }}</h6>

                            </div>

                            <a class="pull-right" type="file" name="" style="border-radius: 20px;  background: #1975A3; border-color:#fff;">
                                <a href="#" data-url="{{ route('friend::Accept::request') }}" data-user="{{ $frienRequest->sender->id }}" data-token="{{ csrf_token() }}" class="add-friend btn btn-success btn-xs" title="Envoyer une demande">
                                    {{--<i class="fa fa-plus"></i>--}}
                                    Accepter
                                </a>
                            </a>
                        </div>
                    </div>
                @endif
@endforeach
            @include('pages.partials.posts', $publications)

            <div class="panel panel-white post-load-more panel-shadow text-center">
                <button class="btn btn-default"><i class="fa fa-refresh"></i>Load More...</button>
            </div>
        </div>
    </div>
@endsection