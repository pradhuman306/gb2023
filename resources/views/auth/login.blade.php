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
                        <h3 class="login-heading">Login</h3>
                        <p>Welcome to GB Convent</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>User Name <span>*</span></label>
                            <div class="user-name">
                                <input placeholder="Enter your username" id="name" type="text"
                                    class="form-control user-name @error('name') is-invalid @enderror" name="name"
                                    value="<?php if(isset($_COOKIE['USERNAME'])){ echo $_COOKIE['USERNAME']; } ?>" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password <span>*</span></label>
                            <div class="pass-word">
                                <input placeholder="Enter your password" id="password" type="password"
                                    class="form-control  @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" value="<?php if(isset($_COOKIE['PASSWORD'])){ echo $_COOKIE['PASSWORD']; } ?>">
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" value="Yes" class="custom-control-input" id="customControlInline" <?php if(isset($_COOKIE['USERNAME'])){ echo 'checked'; } ?>>
                                <label class="custom-control-label" for="customControlInline"><span>Remember me</span></label>
                            </div>

                            @if (Route::has('password.request'))
                            <div class="fgot-pass">
                                <a href="{{ route('password.request') }}"> Forget Password?</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn custom-btn login-btn">Login</button>
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
    </div>
</section>
@endsection