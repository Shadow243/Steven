@extends('layouts.Default')
@section('title') {{ Auth::user()->prename.' Freinds' }} @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 no-paddin-xs">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="cover-photo" style="background-image:url({{ Auth::user()->MurPhoto }})"> <img src="{{ auth::user()->GetPhoto() }}" class="profile-photo img-thumbnail show-in-modal">
                        <h2 class="cover-name">{{ auth::user()->name }}</h2> </div>
                </div>
                @include('pages.partials.tabe')

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 no-paddin-xs">
                <div class="col-md-12 user-detail no-paddin-xs">
                    <!--A bout You-->
               @include('pages.partials.Freindship')

                </div>
            </div>
        </div>
    </div>
@endsection
