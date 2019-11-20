@extends('layouts.app')

@section('content')

<body>
<div class="app">
    <!-- @if(Session::has('message'))
     <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif-->

    @include('flash::message')

    <div class="authentication">
        <div class="sign-in">
            <div class="row no-mrg-horizon">
                <div class="col-md-4 no-pdd-horizon">
                    <div class="full-height bg-white height-100">
                        <div class="vertical-align full-height pdd-horizon-70">
                            <div class="table-cell">
                                <div class="pdd-horizon-15">
                                    <h2>Beacon Link Admin</h2>
                                    <p class="mrg-btm-15 font-size-13">Please enter your user name and password to login</p>
                                    <form method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            
                                            <input id="password" type="password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                            <!-- <div class="font-size-12">
                                                <input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="agreement">Keep Me Signed In</label>
                                            </div> --> 
                                        <button class="btn btn-info">Login</button>
                                    </form>
                                     <p class="mrg-btm-15 font-size-13">
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="padding-left: 0 !important;">
                                            Forgot Your Password?
                                        </a>
                                    </p> 
                                </div>
                            </div>
                        </div>
                        <div class="login-footer">
                            
                            <img class="img-responsive inline-block" src="./images/logo/logo.png" width="100" alt="">
                            <!-- <span class="font-size-13 pull-right pdd-top-10">Don't have an account? <a href="#">Click Here</a></span> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-8 no-pdd-horizon hidden-xs">
                    <div class="full-height bg" style="background-image: url('./images/login-bg-1.jpg')">
                        <div class="img-caption">
                            <h1 class="caption-title">Beacon Link</h1>
                            <p class="caption-text">INDUSTRY LEADING LANGUAGE TRANSLATION IN MORE THAN 120+ LANGUAGES.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
