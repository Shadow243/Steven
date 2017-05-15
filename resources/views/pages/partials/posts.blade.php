@foreach($publications as $posts)
    <div class="panel panel-white post panel-shadow">
        <div class="post-heading">
            <div class="pull-left image"> <img src="{{ $posts->user->GetPhoto() }}" class="avatar" alt="user profile image"> </div>
            <div class="pull-left meta">
                <div class="title h5"> <a href="#" class="post-user-name">{{ $posts->user->name }}</a> a publier une photo. </div>
                <h6 class="text-muted time">{{ $posts->created_at->diffForHumans() }}</h6> </div>
        </div>
        <div class="post-image"> <img src="{{ $posts->photo }}" class="image show-in-modal" alt="image post"> </div>
        <div class="post-description">
            <p>{{ $posts->content }}</p>
            <div class="stats">
                <a href="{{ route('post::like', ['post_id' =>  $posts->id]) }}" data-token="{{ csrf_token() }}" title="@if(Auth::user()->hasLikePost($posts)) Je n'aime plus @else J'aime @endif" class="likelink stat-item">
                    <i class="fa @if(Auth::user()->hasLikePost($posts)) fa-thumbs-o-down @else fa-thumbs-o-up @endif"></i>
                @if($posts->likes->count() > 0)
                    <em class="number_likes">{{$posts->likes->count() }}</em>
                 @endif
                </a>
                <a href="#" class="stat-item"> <i class="fa fa-comments-o icon"></i>
                 
                @if($posts->comments->count() > 0)
                    {{ $posts->comments->count() }} <small>{{ str_plural('commentaire',  $posts->comments->count()) }} </small>
                 @endif
                 </a>
                <a href="#" class="stat-item"> <i class="fa fa-retweet icon"></i> 128 </a>
            </div>
        </div>
        <div class="post-footer">
            <div class="alert alert-info" style="display: none;"></div>

            <ul class="comments-list">
                @foreach($posts->lastComments() as $comment)
                    <li class="comment">
                        <a class="pull-left" href="#"> <img class="avatar" src="{{ $comment->user->GetPhoto() }}" alt="avatar"> </a>
                        @can('delete', $comment)
                            <form method="post" action="{{ route('post::comment::destroy', [$comment]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="pull-right delete-comment" style="border: none;background: #eee;"> <i class="fa fa-times-circle absent-status"></i></button>
                            </form>
                        @endcan

                        <div class="comment-body">
                            <div class="comment-heading">
                                <h4 class="comment-user-name"><a href="#">{{ $comment->user->name }}</a></h4>
                                <h5 class="time">{{ $comment->created_at->diffForHumans() }}</h5> </div>
                            <p>{{ $comment->content }}</p>

                        </div>

                    </li>
                    @endforeach
            </ul>

            <form action="{{ route('post::comment::store') }}" class="comment-form" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id_post" value="{{ $posts->id }}" />
                <div class="form-group">
                    <small class="help-block" style="display: none;"></small>
                    <input name="content" class="form-control add-comment-input" placeholder="Add a comment..." type="text" >
                </div>
            </form>
        </div>
    </div>
@endforeach
