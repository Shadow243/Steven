@extends('layouts.Default')
@section('title') {{ Auth::user()->name }} @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 no-paddin-xs">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="cover-photo" style="background-image:url({{ Auth::user()->MurPhoto }})">

                        <label class="" style="">
                            <form action="{{ route('profile::avatar::update') }}" id="photo_profil_form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <img src="{{ auth::user()->GetPhoto() }}" class="profile-photo img-thumbnail show-in-modal">
                                <input type="file" multiple="multiple" id="photo_profil_user_home" name="photo_profil_user_home" style="display: none;">
                            </form>
                        </label>
                        <div class="text-right" style="">
                            <div class="desc-content">
                                <h1 class="fg-white text-shadow">{{ 'Avenu' }},{{ $authUser->city }}, {{ $authUser->Nationality }}</h1>
                                <h4 class="fg-white text-shadow">- Aug 20th, 2014</h4>
                                <div style="margin-top:50px;"></div>
                            </div>
                        </div>
                        <h2 class="cover-name">{{ auth::user()->name.' '.auth::user()->post.' '.auth::user()->prename }}</h2>
                    </div>
                </div>
                @include('pages.partials.tabe')

            </div>
        </div>
        <div class="row">
            <div class="col-md-10 no-paddin-xs">
                <div class="col-md-5 user-detail no-paddin-xs">
                    <!--A bout You-->
                    @include('pages.partials.AboutYou')

                    <!-- Freids Code Part-->
                    @include('pages.partials.Freinds')

                    <!--Photo codes-->
                    @include('pages.partials.Galleries')

                    <!--Likes Codes-->
                    @include('pages.partials.likes')

                    <!--Groups Code -->
                    @include('pages.partials.Groups')

                </div>
                <div class="col-md-7 no-paddin-xs">

                    <!--post Form -->
                    @include('pages.partials.Forms.PostForm')


                    @include('pages.partials.posts', $publications)

                    <div class="panel panel-white post-load-more panel-shadow text-center">
                        <button class="btn btn-default"><i class="fa fa-refresh"></i>Load More...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
