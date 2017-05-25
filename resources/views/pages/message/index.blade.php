@extends('layouts.Default')
@section('title') Messages @stop

@section('content')
<!-- Timeline content -->
<div class="container" style="margin-top:80px;">
    {{--<div class="col-md-10 col-md-offset-1 no-paddin-xs">--}}
    <div class="col-md-10 no-paddin-xs">
        <div class="col-md-12">
            <!--  chat content -->
            <div class="row">
                <div class="col-md-4 bg-white ">
                    <!-- member list -->
                    <div class=" row border-bottom padding-sm" style="height: 40px;">

                    </div>
                    <ul class="friend-list">
                        @foreach($threads as $conversation)
                        <li class="conversation" data-conversation-id="{{ $conversation->id }}">
                            <a href="#" class="clearfix">
                                <img src="{{ $conversation->user->GetPhoto() }}" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>{{ $conversation->user->name }}</strong>
                                </div>
                                <div class="last-message text-muted">{{ $conversation->lastMessage->body }}</div>
                                <small class="time text-muted">{{ $conversation->lastMessage->created_at->diffForHumans() }}</small>
                                <small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                            </a>
                        </li>
                            @endforeach
                    </ul><!-- end member list -->
                </div>

                <!-- selected chat content -->
                <div class="col-md-8 bg-white ">
                    <div class="chat-message" id="chat-message" style="height: 500px;">
                            @forelse($lastconversations as $latconnversationuser)
                            <ul class="chat">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                      <img src="{{ $latconnversationuser->user->GetPhoto() }}" alt="User Avatar">
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">{{ $latconnversationuser->user->name }}</strong>
                                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> {{ $latconnversationuser->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p>
                                            {{ $latconnversationuser->lastMessage->body }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            @empty
                            <ul class="chat">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                      <img src="{{ Auth::user()->GetPhoto() }}" alt="User Avatar">
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
{{--                                            <strong class="primary-font">{{ $latconnversationuser->user()->name }}</strong>--}}
                                            {{--<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> {{ $latconnversationuser->created_at->diffForHumans() }}</small>--}}
                                        </div>
                                        <p>
                                            {{ 'Veuillez ecrire un message pour creer une conversation ' }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            @endforelse
                    </div>
                    <div class="panel profile-info">
                        <form method="post" action="{{ route('Message::messages.update', ['id' => $latconnversationuser->id]) }}">
                            {{ method_field('put') }}
                            {{ csrf_field() }}
                            <textarea class="form-control input-lg p-text-area txt-reply" name="body" rows="3" placeholder="Write a message..."></textarea>
                            {{--<button type="button" class="btn btn-reply btn-info pull-right" style="background-color: #1975A3">Send</button>--}}

                        <div class="panel-footer">
                            <button type="button" class="btn btn-reply btn-info pull-right">Send</button>
                        </div>
                        </form>
                    </div><!-- end add post form-->
                </div><!-- selected chat content -->
            </div><!-- end chat content -->
        </div>
    </div>
</div>
@endsection