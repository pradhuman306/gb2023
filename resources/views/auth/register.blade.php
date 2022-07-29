@extends('layouts.authlayout')

@section('content')
<section class="login">
    <div class="login-page">
        <div class="login-page-inr">
            <div class="login-right">
                <div class="login-bg">
                    <div class="login-head">
                        <div class="login-icon">
                            <img src="{{url('/')}}/assets/image/new-logo.svg" alt="">
                        </div>
                        <h3 class="login-heading">Register</h3>
                        <p>Welcome to GB Convent</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <div class="form-group">
                            <label>Name</label>
                            <input placeholder="Enter your name" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>E-Mail Address</label>
                            <input placeholder="Enter your email" id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input placeholder="Enter your password" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input placeholder="Confirm your password" id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn custom-btn login-btn">Register</button>
</div>
                    </form>
                    <div class="fgot-pass register-here">

                        <p>Already have an account? <a href="{{ route('login') }}"> Login Here </a></p>
                    </div>
                </div>
               
            </div>
            <div class="login-left">
                <div class="logo-box">
                    <h3>Gyan Bharati Convent</h3>
                </div>
                <div class="copyright-box">
                    <p>@<?php echo date("Y"); ?> <a href="https://www.gbconvent.in" target="_blank">gbconvent.in</a> All
                        right reserved.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('additionalscripts')
<script>
$("#register-form").validate();
</script>
@endsection