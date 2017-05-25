
<h1>{{ $thread->subject }}</h1>
<ul class="chat">
@foreach($thread->messages as $message)
    {{--<div class="media">--}}
        {{--<a class="pull-left" href="#">--}}
            {{--<img src="{{ $message->user->GetPhoto() }}" style="width: 60px;" alt="{{ $message->user->name }}" class="img-circle">--}}
        {{--</a>--}}
        {{--<div class="media-body">--}}
            {{--<h5 class="media-heading">{{ $message->user->name }}</h5>--}}
            {{--<p>{{ $message->body }}</p>--}}
            {{--<div class="text-muted"><small>Posted {{ $message->created_at->diffForHumans() }}</small></div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <li class="clearfix @if($message->user->id == Auth::user()->id) left @else right @endif">
      <span class="chat-img @if($message->user->id == Auth::user()->id) pull-left @else pull-right @endif">
          <img src="{{ $message->user->GetPhoto() }}" alt="{{ $message->user->name }}">
      </span>
        <div class="chat-body clearfix">
            <div class="header">
                <strong class="primary-font">{{ $message->user->name }}</strong>
                <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}</small>
            </div>
            <p>
                {{ $message->body }}
            </p>
        </div>
    </li>
@endforeach
</ul>
<div class="panel profile-info">
    <form method="post" action="{{ route('Message::messages.update', ['id' => $thread->id]) }}" class="reply-form" enctype="multipart/form-data">
        {{ method_field('put') }}
        {{ csrf_field() }}
        <textarea class="form-control input-lg p-text-area txt-reply" rows="3" name="body" placeholder="Write a message..."></textarea>
        <div class="panel-footer">
            <button type="button" class="btn btn-reply btn-info pull-right" style="background-color: #1975A3">Send</button>
            <ul class="nav nav-pills">
                <label class="btn btn-default btn-info btn-file" style="padding: 5px 15px;border-radius: 20px;background: #f9f9f9; color: black; border-color:#fff;">
                    <i class="fa fa-camera"></i> <input type="file" multiple="multiple" name="photo" style="display: none;">
                </label>

            </ul>
        </div>
    </form>
</div>


