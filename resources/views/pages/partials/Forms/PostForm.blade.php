<div class="panel profile-info">
    <div>
        @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
    </div>
    <form method="post" action="{{ route('post::store::post') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <textarea name="content" class="form-control input-lg p-text-area" rows="2" placeholder="Whats in your mind today?"></textarea>
        <div class="panel-footer">
            <button type="submit" class="btn btn-info pull-right" style="background: #1975A3;">Post</button>
            <ul class="nav nav-pills">
                {{--<label class="btn btn-default btn-info btn-file" style="padding: 5px 15px;border-radius: 20px;background: #1975A3; border-color:#fff;">--}}
                    {{--<i class="fa fa-paperclip"></i> Joindre<input type="file" multiple="multiple" name="photo" style="display: none;">--}}
                {{--</label>--}}
                <label class="btn btn-default btn-info btn-file" style="padding: 5px 15px;border-radius: 20px;background: #f9f9f9; color: black; border-color:#fff;">
                    <i class="fa fa-camera"></i> <input type="file" multiple="multiple" name="photo" style="display: none;">
                </label>
                {{--<li><a href="#"><i class="fa fa-map-marker"></i></a></li>--}}
                {{--<li><a href="#"><i class="fa fa-camera"></i></a></li>--}}
                {{--<li><a href="#"><i class=" fa fa-film"></i></a></li>--}}
                {{--<li><a href="#"><i class="fa fa-microphone"></i></a></li>--}}
            </ul>
        </div>
    </form>

</div>