@extends('layouts.adminlayout')

@section('content')

<section class="main-wrapper">
    <div class="page-color">
        <div class="page-header">
            <div class="page-title">
                Create User &amp; Assign Role</span>
            </div>
            <div class="page-btn">
                <a href="{{ route('assignrole.index') }}" class="add-btn">
                    <span>
                        <img src="{{url('/')}}/assets/image/Icon-arrow-back.svg" class="btn-arrow-show" alt="">
                        <img src="{{url('/')}}/assets/image/Icon-arrow-back-2.svg" class="btn-arrow-hide" alt="">
                    </span>
                    <span>Back</span>
                </a>
            </div>
        </div>
        <div class="profile-box">
            <div class="short-code">
                <form action="{{ route('assignrole.store') }}" method="POST" class="">
                    @csrf
                    <div class="form-group">
                        <label> User Name</label>
                        <input type="text" placeholder="" name="name" id="" class="form-control">
                        @error('name')
                        <label class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> User Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="email" autofocus>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Assign Role</label>
                        <select name="user_type" id="user_type"> 
                            <option value="Accountant">Accountant</option>
                            <option value="Admin">Admin</option>
                            <option value="Manager">Manager</option>
                            <option value="Teacher">Teacher</option>
                        </select>
                    </div>
                    <div class=" text-center">
                        <input type="submit" name="save" class="login-btn" id="save" value="Create User">
                    </div>
                </form>
            </div>
        </div>
</section>
@endsection