<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel-options">
        <div class="navbar navbar-default navbar-cover">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profile-opts-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="profile-opts-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#"><i class="fa fa-tasks"></i>Timeline</a></li>
                        <li><a href="{{ route('About::index') }}"><i class="fa fa-info-circle"></i>About</a></li>
                        <li><a href="{{ route('Freind::index') }}"><i class="fa fa-users"></i>Friends <em style="color: #1975A3;">{{ Auth::user()->getFriendsCount() }}</em> </a></li>
                        <li><a href="#"><i class="fa fa-file-image-o"></i>Photos</a></li>
                        <li><a href="{{ route('Message::index') }}"><i class="fa fa-comment"></i>Messages</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>