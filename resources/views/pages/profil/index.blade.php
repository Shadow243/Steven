@extends('layouts.Default')
@section('title') Profil {{ Auth::user()->name }} @stop

@section('content')
<!-- Timeline content -->
<div class="container container-timeline" style="margin-top:100px;">
    <div class="col-md-10 no-paddin-xs">
        <!-- left content-->
        <div class="col-md-10 col-md-offset-2 no-paddin-xs">
                <!-- update cover and profile image-->
                <div class="panel panel-white post panel-shadow">
                    <div class="post-heading">

                        <div class="pull-left image">
                            <img src="{{ Auth::user()->GetPhoto() }}" class="profile-image avatar" alt="user profile image">
                        </div>
                        <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-camera"></i></button>
                    </div>
                    <div class="post-image">
                        <img src="{{ Auth::user()->MurPhoto }}" class="cover-image image show-in-modal" alt="image post">
                    </div>
                    <div class="post-description">
                        <div class="row">
                            <form action="{{ route('profile::cover::update') }}" id="photo_cover_form" class="pull-right photo_cover_form" method="post"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                            <div class="col-md-6 forjoinfil">
                                <label class="btn btn-default btn-info btn-file file_input pull-left" style="padding: 5px 15px;border-radius: 20px;background: #1975A3; border-color:#fff;">
                                    <i class="fa fa-paperclip"></i> Importer<input type="file" id="photo_cover_user" name="photo_cover_user" style="display: none;">
                                </label>
                            </div>
                            <div class="col-md-6 foruploading" style="display: none;">

                                    {{--<label class="btn btn-default btn-info btn-file " style="padding: 5px 15px;border-radius: 20px;background: #1975A3; border-color:#fff;">--}}
                                        {{--<i class="fa fa-upload"></i> <button class="pull-right" name="photo_cover_user_upload" style="display: none;">Upload</button>--}}
                                    {{--</label>--}}
                                <button type="submit" name="photo_cover_user_upload" style="border: none;outline: none !important;overflow: hidden;width: 40px; height: 40px;border-radius: 50%;" class="btn btn-default btn-circle waves-effect waves-pink waves-circle waves-float pull-right">
                                    <i class="fa fa-upload "></i>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div><!-- end update cover and profile image-->
                <!-- update info -->
            <form action="{{ route('profile::store::profil') }}" id="form-profil" class="form-profil" method="post"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-white post panel-shadow">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First name</label>
                            <div class="col-md-8">
                                <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last name</label>
                            <div class="col-md-8">
                                <input class="form-control" name="postname" type="text" value="{{ Auth::user()->post }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Pre name</label>
                            <div class="col-md-8">
                                <input class="form-control" name="prename" type="text" value="{{ Auth::user()->prename }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ville</label>
                            <div class="col-md-8">
                                <input class="form-control" name="city" type="text" value="{{ auth::user()->city }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nationality</label>
                            <div class="col-md-8">
                                <input class="form-control" name="country" type="text" value="{{ auth::user()->Nationality }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sexe</label>
                            <div class="col-md-8">
                                <select name="gender" class="form-control">
                                    <option>M</option>
                                    <option>F</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-8">
                                <input class="form-control" name="email" type="text" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                    </div>
                </div><!-- end update info-->

                <div class="panel panel-white post-load-more panel-shadow text-center">
                    <button class="btn btn-success" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div><!-- end left content-->
    </div>
</div>

<div class="modal fade bs-example-modal-sm" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Modifier la photo de profil</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div id="image-holder"> </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('profile::avatar::update') }}" id="photo_profil_form" class="pull-left photo_profil_form" method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="btn btn-default btn-info btn-file" style="padding: 5px 15px;border-radius: 20px;background: #1975A3; border-color:#fff;">
                                    <i class="fa fa-paperclip"></i> Selectionnez une photo<input type="file" id="photo_profil_user" name="photo_profil_user"  style="display: none;">
                                </label>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" style="    border: none;outline: none !important;overflow: hidden;width: 40px; height: 40px;border-radius: 50%;" class="btn btn-default btn-circle waves-effect waves-pink waves-circle waves-float pull-right">
                                    <i class="fa fa-upload "></i>
                                </button>
                                {{--<button class="btn btn-success" type="submit" style="padding: 5px 15px;border-radius: 20px;border-color:#fff;">--}}
                                    {{--Upload--}}
                                {{--</button>--}}
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('sidebar')
    @include('layouts.partials.sidebar_chat')
@endsection