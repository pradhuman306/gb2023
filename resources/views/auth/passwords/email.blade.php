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
                        <h3 class="login-heading">Reset Password</h3>
                        <p>Enter your email address to reset your password</p>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label>E-Mail Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn custom-btn login-btn">Send Reset Link</button>
                        </div>
                    </form>

                    <!-- <div class="fgot-pass register-here">

                        <p>No registered yet? <a href="{{ route('register') }}"> Register Here </a></p>
                    </div> -->

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
</section>
@endsection