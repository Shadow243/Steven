@extends('layouts.Default')
@section('title') Messages @stop

@section('content')
<!-- Timeline content -->
<div class="container" style="margin-top:80px;">
    {{--<div class="col-md-10 col-md-offset-1 no-paddin-xs">--}}
    <div class="col-md-10 no-paddin-xs">
        <div class="col-md-12">
            <!--  chat content -->
            <div class="row">
                <div class="col-md-4 bg-white ">
                    <!-- member list -->
                    <div class=" row border-bottom padding-sm" style="height: 40px;">

                    </div>
                    <ul class="friend-list">
                        <li class="active bounceInDown">
                            <a href="#" class="clearfix">
                                <img src="img/Friends/guy-2.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>John Doe</strong>
                                </div>
                                <div class="last-message text-muted">Hello, Are you there?</div>
                                <small class="time text-muted">Just now</small>
                                <small class="chat-alert label label-danger">1</small>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <img src="img/Friends/woman-10.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>Jane Doe</strong>
                                </div>
                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                <small class="time text-muted">5 mins ago</small>
                                <small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <img src="img/Friends/woman-3.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>Kate Doe</strong>
                                </div>
                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                <small class="time text-muted">Yesterday</small>
                                <small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <img src="img/Friends/woman-4.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>Martha Doe</strong>
                                </div>
                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                <small class="time text-muted">Yesterday</small>
                                <small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <img src="img/Friends/woman-5.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>Katherin Doe</strong>
                                </div>
                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                <small class="time text-muted">Yesterday</small>
                                <small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <img src="img/Friends/woman-6.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>Camila crut</strong>
                                </div>
                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                <small class="time text-muted">Yesterday</small>
                                <small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <img src="img/Friends/woman-7.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>Marian Grey</strong>
                                </div>
                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                <small class="time text-muted">Yesterday</small>
                                <small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <img src="img/Friends/woman-8.jpg" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>Jane Doe</strong>
                                </div>
                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                <small class="time text-muted">5 mins ago</small>
                                <small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                            </a>
                        </li>
                    </ul><!-- end member list -->
                </div>

                <!-- selected chat content -->
                <div class="col-md-8 bg-white ">
                    <div class="chat-message">
                        <ul class="chat">
                            <li class="left clearfix">
                          <span class="chat-img pull-left">
                          <img src="img/Friends/guy-2.jpg" alt="User Avatar">
                        </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">John Doe</strong>
                                        <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                </div>
                            </li>
                            {{--@foreach($message as $mes)--}}
                            <li class="right clearfix">
                          <span class="chat-img pull-right">
                          <img src="img/Friends/guy-3.jpg" alt="User Avatar">
                        </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Sarah</strong>
                                        <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                                    </p>
                                </div>
                            </li>
                            {{--@endforeach--}}
                            <li class="right clearfix">
                          <span class="chat-img pull-right">
                          <img src="img/Friends/guy-3.jpg" alt="User Avatar">
                        </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Sarah</strong>
                                        <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel profile-info">
                        <form method="post" action="#" enctype="multipart/form-data">
                            <textarea class="form-control input-lg p-text-area" rows="3" placeholder="Write a message..."></textarea>
                            {{--<input class="form-control border no-shadow no-rounded input-lg p-text-area" placeholder="Type your message here">--}}

                            {{--<div class="chat-box_ bg-white">--}}
                                {{--<div class="input-group">--}}
                                    {{--<input class="form-control border no-shadow no-rounded" placeholder="Type your message here">--}}
                                    {{--<span class="input-group-btn">--}}
                {{--<button class="btn btn-success no-rounded" type="button">Send</button>--}}
              {{--</span>--}}
                                {{--</div><!-- /input-group -->--}}
                            {{--</div>--}}
                        <div class="panel-footer">
                            <button type="button" class="btn btn-info pull-right" style="background-color: #1975A3">Send</button>
                            <ul class="nav nav-pills">
                                <label class="btn btn-default btn-info btn-file" style="padding: 5px 15px;border-radius: 20px;background: #f9f9f9; color: black; border-color:#fff;">
                                    <i class="fa fa-camera"></i> <input type="file" multiple="multiple" name="photo" style="display: none;">
                                </label>
                                {{--<li><a href="#"><i class="fa fa-map-marker"></i></a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-camera"></i></a></li>--}}
                                {{--<li><a href="#"><i class=" fa fa-film"></i></a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-microphone"></i></a></li>--}}
                            </ul>
                            {{--<ul class="nav nav-pills">--}}
                                {{--<li><input type="file" style="text-align-last: end; opacity: 2" class="fa fa-camera" /><i class="fa fa-camera"></i></li>--}}
                                {{--<li><a href="#"><i class=" fa fa-film"></i></a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-microphone"></i></a></li>--}}
                            {{--</ul>--}}
                        </div>
                        </form>
                    </div><!-- end add post form-->
                </div><!-- selected chat content -->
            </div><!-- end chat content -->
        </div>
    </div>
</div>
@endsection