@extends('layouts.Default')

@section('content')
    <div class="row-welcome" style="background-image: url('{{ asset('assets/img/music4.jpg') }}');">
        <div class="row-body">
            <div class="welcome-inner">
                <div class="welcome-message welcome-text-shadow">
                    <div class="welcome-title"> Welcome </div>
                    <div class="welcome-desc"> to our social network {{ config('app.name')}} </div>
                    <div class="welcome-about"> share your memories, connect with others, make new friends. </div>
                </div>
                <div class="welcome-inputs animated fadeInRight">
                    {{--@if (count($errors) > 0)--}}
                        {{--<div class="alert alert-danger">--}}
                            {{--<ul>--}}
                                {{--@foreach ($errors->all() as $error)--}}
                                    {{--<li>{{ $error }}</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    <form action="{{ route('login') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="text" id="short" name="email" value="{{ old('email') }}" placeholder="Username or email">
                        <input type="password" id="short" name="password" placeholder="Password">
                        {{--<input type="checkbox" id="short" name="remember" {{ old('remember') ? 'checked' : '' }}> --}}
                        <div class="form-row">
                            <div class="material-switch pull-left">
                                <input id="someSwitchOptionSuccess" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label for="someSwitchOptionSuccess" class="label-success"></label>
                                <span>Remember Me</span>
                            </div>
                        </div>
                       <button type="submit" style="float: right;" class="btn btn-primary">Login</button><br />
                        <div class="">
                            <span class="forgot-password-link text-shadow pull-left">
                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                            </span>
                        </div>

                    </form> <br>
                    <form action="{{ route('register') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="text" id="short" name="name" value="{{ old('name') }}" placeholder="Username">
                        <input type="text" id="short" name="email" value="{{ old('email') }}" placeholder="Email">
                        <input type="password" id="short" name="password" placeholder="Password">
                        <input type="password" id="short" name="password_confirmation" required placeholder="Confirmation password">
                        <!-- <input type="text" name="captcha" placeholder="Captcha"> -->
                        <button type="submit" class="btn btn-success">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="welcome-full">
        <div class="row-body">
            <div class="welcome-users-inner animated fadeInRight">
                <div class="welcome-user">
                    <a href="profile.html"> <img src="img/Friends/guy-3.jpg" class="img-circle"> </a>
                </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/woman-1.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/guy-2.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/woman-2.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/guy-5.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/woman-3.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/guy-8.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/woman-4.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/guy-9.jpg') }}" class="img-circle"> </a> </div>
                <div class="welcome-user"> <a href="#"> <img src="{{ asset('img/Friends/woman-7.jpg') }}" class="img-circle"> </a> </div>
            </div>
        </div>
    </div>
@endsection

