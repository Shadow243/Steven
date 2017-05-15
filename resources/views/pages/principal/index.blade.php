<div class="container">
    <div class="row">
        <div class="col-md-10 no-paddin-xs">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="cover-photo" style="background-image:url(img/Cover/corb.jpg)"> <img src="img/Profile/profile.jpg" class="profile-photo img-thumbnail show-in-modal">
                    <h2 class="cover-name">Marthin McKlowin</h2> </div>
            </div>
            @include('tabes.blade')

        </div>
    </div>
    <div class="row">
        <div class="col-md-10 no-paddin-xs">
            <div class="col-md-5 user-detail no-paddin-xs">
                @include('pages.partials.AboutYou')

                @include('pages.partials.Freinds')

                @include('pages.partials.Galleries')

                @include('pages.partials.likes')

                @include('pages.partials.Groups')

            </div>
            <div class="col-md-7 no-paddin-xs">
                <div class="panel profile-info">
                    <form>
                        <textarea class="form-control input-lg p-text-area" rows="2" placeholder="Whats in your mind today?"></textarea>
                    </form>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-info pull-right">Post</button>
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class=" fa fa-film"></i></a></li>
                            <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                        </ul>
                    </div>
                </div>

                @include('pages.partials.posts', $publications)

                <div class="panel panel-white post-load-more panel-shadow text-center">
                    <button class="btn btn-default"><i class="fa fa-refresh"></i>Load More...</button>
                </div>
            </div>
            <div class="col-md-10 no-paddin-xs col-md-22 hidden">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="cover-photo" style="background-image:url(img/Cover/corb.jpg)"> <img src="img/Profile/profile.jpg" class="profile-photo img-thumbnail show-in-modal">
                        <h2 class="cover-name">Marthin McKlowin</h2> </div>
                </div>
            </div>
        </div>
    </div>
</div>