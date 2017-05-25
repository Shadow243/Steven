<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Steven Blaise">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">

    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/chatbox.css') }}" rel="stylesheet">

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

        var authUserId = null;

        @if(Auth::check()) authUserId = {{ Auth::user()->id }} @endif
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top navbar-principal">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> <img src="img/logo-white.png" class="img-logo"> <b>{{ config('app.name') }}</b> </a>
        </div>

            <div id="navbar" class="collapse navbar-collapse">
                <div class="col-md-5 col-sm-4">
                    <div class="col-md-12" style="">
                        <div class="row">
                            <nav class="navbar navbar-default navbar-fixed-top navbar-principal">
                                <div class="container">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                        <a class="navbar-brand" href="{{ url('/home') }}"> <img src="{{ asset('img/logo-white.png') }}" class="img-logo"> <b>{{ config('app.name') }}</b> </a>
                                    </div>
                                    @if(Auth::check())
                                    <div id="navbar" class="collapse navbar-collapse">
                                        <div class="col-md-5 col-sm-4">
                                            <form class="navbar-form">
                                                <div class="form-group" style="display:inline;">
                                                    <div class="input-group" style="display:table;">
                                                        <input class="form-control" name="search" placeholder="Search..." autocomplete="off" type="text"> <span class="input-group-addon" style="width:1%;"> <span class="glyphicon glyphicon-search"></span> </span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <ul class="nav navbar-nav navbar-right">
                                            <li><a href="{{ url('/home') }}" class="home_link">{{ auth::user()->name.' ' }}<img src="{{ Auth::user()->GetPhoto() }}" class="img-nav img-circle"></a></li>
                                            <li><a href="{{ url('/home/collectios') }}"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                                            {{--<li><a href="{{ route('Notifications::index') }}"><i class="fa fa-globe"></i></a></li>--}}
                                            <li class="dropdown">
                                                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-gears"></i>
                                                    {{ auth::user()->name }}
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu" style="background: white;" role="menu">
                                                    <li><a href="{{ route('Message::index')  }}"><i class=""></i>Messages</a></li>
                                                    <li><a href="{{ route('profile::index')  }}"><i class=""></i>Profil</a></li>
                                                    <li><a href="{{ route('Freind::index')  }}"><i class=""></i>Freind</a></li>
                                                    <li><a href="{{ route('About::index')  }}"><i class=""></i>About</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit()";><i class="fa fa-lock"></i> </a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </ul>
                                            </li>
                                            {{--<li><a href="#" class="nav-controller"><i class="fa fa-user"></i>Users</a></li>--}}
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>

    </div>
</nav>

<div class="container">
    @yield('content')

    <div class="monconteneur">
        {{--for my chat box (popups)--}}
    </div>
</div>
@if(Auth::check())
    <!-- Online users sidebar content-->
    @include('pages.partials.sidebar')
    <!-- Online users sidebar content-->
{{--    @include('pages.message.chatbax')--}}
@endif
<!--footer -->
@include('pages.partials.footer')
<!-- Scripts -->

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/jquery.form.min.js') }}"></script>
<script async="" src="assets/js/analytics.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/notify.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

@include('flashy::message')

@if(Auth::check())
    <script>
        //this function can remove a array element.
        Array.remove = function(array, from, to) {
            var rest = array.slice((to || from) + 1 || array.length);
            array.length = from < 0 ? array.length + from : from;
            return array.push.apply(array, rest);
        };

        //this variable represents the total number of popups can be displayed according to the viewport width
        var total_popups = 0;

        //arrays of popups ids
        var popups = [];

        //this is used to close a popup
        function close_popup(id)
        {
            for(var iii = 0; iii < popups.length; iii++)
            {
                if(id == popups[iii])
                {
                    Array.remove(popups, iii);

                    document.getElementById(id).style.display = "none";

                    calculate_popups();

                    return;
                }
            }
        }

        //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
        function display_popups()
        {
            var right = 220;

            var iii = 0;
            for(iii; iii < total_popups; iii++)
            {
                if(popups[iii] != undefined)
                {
                    var element = document.getElementById(popups[iii]);
                    element.style.right = right + "px";
                    right = right + 320;
                    element.style.display = "block";
                }
            }

            for(var jjj = iii; jjj < popups.length; jjj++)
            {
                var element = document.getElementById(popups[jjj]);
                element.style.display = "none";
            }
        }

        //creates markup for a new popup. Adds the id to popups array.
        function register_popup(id, name)
        {

            for(var iii = 0; iii < popups.length; iii++)
            {
                //already registered. Bring it to front.
                if(id == popups[iii])
                {
                    Array.remove(popups, iii);

                    popups.unshift(id);

                    calculate_popups();


                    return;
                }
            }

            var element = '<div class="popup-box chat-popup" id="'+ id +'">';
            element = element + '<div class="popup-head">';
            element = element + '<div class="popup-head-left">'+ name +'</div>';
            element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
            element = element + '<div style="clear: both"></div></div><div class="popup-messages">\
                 <div id="messages" class="messages">\
                <ul>\
                    <li>\
                        <span class="left">Hello</span>\
                        <div class="clear"></div>\
                    </li> \
                    <li>\
                        <span class="right">You Welcome man ggjjgj rffdfd ggggfdgdrrt ghhghghdshj </span>\
                        <div class="clear"></div>\
                    </li> \
                </ul>\
                <div class="clear"></div>\
            </div>\
            <form action="#">\
<input type="text" placeholder="Messege ici" autofocus autocomplete="none" style=" width: 100%; background: white; height: 50px;border-radius: inherit;" value="" required="">\
</form>\
                 </div></div>';

            document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;

            popups.unshift(id);

            calculate_popups();

        }

        //calculate the total number of popups suitable and then populate the toatal_popups variable.
        function calculate_popups()
        {
            var width = window.innerWidth;
            if(width < 540)
            {
                total_popups = 0;
            }
            else
            {
                width = width - 200;
                //320 is width of a single popup box
                total_popups = parseInt(width/320);
            }

            display_popups();

        }

        //recalculate when window is loaded and also when window is resized.
        window.addEventListener("resize", calculate_popups);
        window.addEventListener("load", calculate_popups);

    </script>
@endif
</body>
</html>
