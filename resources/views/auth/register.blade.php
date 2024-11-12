@extends('layouts.client')
@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Register</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="kenne-login-register_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-8 col-xs-12 mx-auto">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Register</h4>
                            <div class="row">
                                <div class="col-md-6 col-12 mb--20">
                                    <label>Name</label>
                                    <input type="text" placeholder="Name" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}"  autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-12">
                                    <label>Email Address*</label>
                                    <input type="email" placeholder="Email Address" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="password" placeholder="Password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                     autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" id="password-confirm"
                                    name="password_confirmation"  autocomplete="new-password">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="kenne-register_btn">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
