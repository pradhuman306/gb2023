@extends('layouts.adminlayout')
@section('content')
<section class="main-wrapper">
    <div class="page-color">
        <div class="page-header">
            <div class="roles">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="">Edit User &amp; Role</h2>
                    </div>
                    <div class="page-btn">
                        <a href="{{ route('assignrole.index') }}" class="">
                            <span>
                                <img src="{{url('/')}}/assets/image/Icon-arrow-back.svg" class="btn-arrow-show" alt="">
                                <img src="{{url('/')}}/assets/image/Icon-arrow-back-2.svg" class="btn-arrow-hide" alt="">
                            </span>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="profile-box">
                <div class="short-code">
                    <form action="{{ route('assignrole.update',$user->id) }}" method="POST" class="">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label> User Name</label>
                            <input type="text" placeholder="" name="name" id="" class="form-control" value="{{ $user->name }}">
                            @error('name')
                            <label class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label> Assign Role</label>
                                <select name="user_type" id="user_type">
                                    <option value="Admin">Admin</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Manager">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn btn-box">
                            <input type="submit" class="login-btn" value="Update User">
                        </div>
                    </form>
</section>
@endsection