@extends('layouts.Default')
@section('title') About You @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 no-paddin-xs">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="cover-photo" style="background-image:url({{ Auth::user()->MurPhoto }})"> <img src="{{ auth::user()->GetPhoto() }}" class="profile-photo img-thumbnail show-in-modal">
                        <h2 class="cover-name">{{ auth::user()->name.' '.auth::user()->post.' '.auth::user()->prename }}</h2> </div>
                </div>
                @include('pages.partials.tabe')

            </div>
        </div>
        <div class="row">
            <div class="col-md-10 no-paddin-xs">
                <!-- tabs user info -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default panel-about">
                        <div class="panel-heading">
                            <h3 class="panel-title">About
                                <a href="edit-profile.html" class="pull-right"><i class="fa fa-edit"></i>Edit</a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12 about-tab-container">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 about-tab-menu">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item active text-center">
                                            <h4 class="fa fa-child"></h4><br>Overview
                                        </a>
                                        <a href="#" class="list-group-item text-center">
                                            <h4 class="fa fa-briefcase"></h4><br>Work
                                        </a>
                                        <a href="#" class="list-group-item text-center">
                                            <h4 class="fa fa-map-marker"></h4><br>Places
                                        </a>
                                        <a href="#" class="list-group-item text-center">
                                            <h4 class="fa fa-newspaper-o"></h4><br>Contact info
                                        </a>
                                        <a href="#" class="list-group-item text-center">
                                            <h4 class="fa fa-calendar"></h4><br>Events
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 about-tab">
                                    <!-- Overview section -->
                                    <div class="about-tab-content active">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <i class="fa fa-briefcase text-primary"></i>&nbsp; Work at software developer
                                            </li>
                                            <li class="list-group-item"><i class="fa fa-mobile text-primary"></i>&nbsp; +57 328 999 444 2</li>
                                            <li class="list-group-item"><i class="fa fa-cubes text-primary"></i>&nbsp;@username (twitter)</li>
                                            <li class="list-group-item"><i class="fa fa-birthday-cake text-primary"></i>&nbsp; August 12, 1990</li>
                                            <li class="list-group-item"><i class="fa fa-envelope text-primary"></i>&nbsp; username@email.com</li>
                                            <li class="list-group-item"><i class="fa fa-tags text-primary"></i>&nbsp;
                                                <label class="label label-info">Html 5</label>
                                                <label class="label label-primary">Css 3</label>
                                                <label class="label label-warning">Boostrap</label>
                                                <label class="label label-success">Jquery</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Work section -->
                                    <div class="about-tab-content">
                                        <ul class="list-group">
                                            <li class="list-group-item"><i class="fa fa-briefcase"></i>&nbsp; Software developer at <a href="#">Deystrap</a></li>
                                            <li class="list-group-item"><i class="fa fa-cubes"></i>&nbsp;Web designer at <a href="#">Dey-Dey</a></li>
                                        </ul>
                                    </div>

                                    <!-- Places search -->
                                    <div class="about-tab-content">
                                        <ul class="photos">
                                            <li>
                                                <a href="#">
                                                    <img src="img/Post/staticmap.png" alt="map 1" class="img-responsive show-in-modal tip">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Contact section -->
                                    <div class="about-tab-content">
                                        <ul class="list-group">
                                            <li class="list-group-item"><i class="fa fa-phone"></i>&nbsp; 533 44 55</li>
                                            <li class="list-group-item"><i class="fa fa-mobile"></i>&nbsp; +57 328 999 444 2</li>
                                            <li class="list-group-item"><i class="fa fa-cubes"></i>&nbsp;@username (twitter) <i class="fa fa-twitter text-twitter"></i></li>
                                            <li class="list-group-item"><i class="fa fa-envelope"></i>&nbsp; username@email.com</li>
                                        </ul>
                                    </div>
                                    <!-- Events section-->
                                    <div class="about-tab-content">
                                        <ul class="list-group">
                                            <li class="list-group-item"><i class="fa fa-calendar text-danger"></i>&nbsp; <a href="#">August 12 welcome to my like</a></li>
                                            <li class="list-group-item"><i class="fa fa-calendar text-danger"></i>&nbsp; <a href="#">August 5 Nach concert at barcelona</a></li>
                                            <li class="list-group-item"><i class="fa fa-calendar text-danger"></i>&nbsp; <a href="#">July 13 El grones concert on medellin</a></li>
                                            <li class="list-group-item"><i class="fa fa-calendar text-danger"></i>&nbsp; <a href="#">June 30 final of ty</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end tabs user info -->

                <!-- family -->
                <div class="col-md-12">
                    <div class="panel panel-default panel-family">
                        <div class="panel-heading">
                            <h3 class="panel-title">Family</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($Users as $personn)
                            <div class="col-md-6 cols-sm-6 col-xs-12">
                                <div class="media block-update-card">
                                    <a class="pull-left" href="{{ route('About::index') }}">
                                        <img class="media-object update-card-MDimentions" src="{{ $personn->GetPhoto() }}" alt="{{ $personn->name }}">
                                    </a>
                                    <div class="media-body update-card-body">
                                        <h4 class="media-heading">{{ $personn->post.' '.$personn->prename }}</h4>
                                        <div class="btn-toolbar card-body-social" role="toolbar">
                                            @if(!Auth::user()->isFriendWith($personn))
                                            <a href="{{  route('Freind::add')  }}" data-user="{{ $personn->id }}" data-token="{{ csrf_token() }}" class="btn btn-default">Add friend</a>
                                            @endif
                                            <a href="{{ route('Message::index') }}" class="btn btn-default">message</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div><!-- end family-->
            </div>
        </div>
    </div>
@endsection