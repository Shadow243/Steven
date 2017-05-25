<li class="clearfix @if($message->user->id == Auth::user()->id) left @else right @endif  animated slideInUp">
      <span class="chat-img @if($message->user->id == Auth::user()->id) pull-left @else pull-right @endif">
          <img src="{{ $message->user->GetPhoto() }}" alt="User Avatar">
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