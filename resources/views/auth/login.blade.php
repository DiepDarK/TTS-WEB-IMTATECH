@extends('layouts.client')
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="kenne-login-register_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-9 mx-auto">
                    <!-- Login Form s-->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Login</h4>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <label>Email Address*</label>
                                    <input id="email" type="email" placeholder="Email Address"
                                        @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb--20">
                                    <label>Password*</label>
                                    <input id="password" type="password" @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box">
                                        <input type="checkbox" id="remember_me" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (Route::has('password.request'))
                                        <div class="forgotton-password_info">
                                            <a href="{{ route('password.request') }}"> Forget pasword?</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <button class="kenne-login_btn">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                            <form action="#">
                                <div class="login-form">
                                    <h4 class="login-title">Register</h4>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb--20">
                                            <label>First Name</label>
                                            <input type="text" placeholder="First Name">
                                        </div>
                                        <div class="col-md-6 col-12 mb--20">
                                            <label>Last Name</label>
                                            <input type="text" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Email Address*</label>
                                            <input type="email" placeholder="Email Address">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Confirm Password</label>
                                            <input type="password" placeholder="Confirm Password">
                                        </div>
                                        <div class="col-12">
                                            <button class="kenne-register_btn">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
            </div>
        </div>
    </div>
@endsection
