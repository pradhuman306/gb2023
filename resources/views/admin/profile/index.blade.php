@extends('layouts.adminlayout')

@section('content')
<div class="page-inner ad-inr">
    <section class="main-wrapper">
        
        <div class="page-color">
            <div class="page-header">
                <div class="page-title">
                    <div class="head-left">
                        <h4>User Profile</h4>
                    </div>
                    <div class="head-right">
                    <div class="current-session">
                        <svg class="icon-sessions" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="6" width="18" height="15" rx="2" stroke="#8F99B3" stroke-width="2">
                            </rect>
                            <path d="M4 11H20" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                            <path d="M9 16H15" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                            <path d="M8 3L8 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                            <path d="M16 3L16 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                        <span>
                        @php
                    $years= App\Models\Year::get();
                    @endphp
                    <select class="cus-menu" name="select_session" id="select_session">
                        @foreach($years as $yy)
                        <option @if($yy->status == 1) selected @endif value="{{url('remove',$yy->id)}}">{{$yy->years}}</option>
                        @endforeach
                    </select>
                        </span>
                    </div>

                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="inr-page-sec">
                    <div id="main-wrapper">

                    <div class="short-code w-border">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel-heading clearfix">
                                    <h5 class="panel-title">Basic Information</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" id="profile-details" action="{{route('updateprofile')}}" novalidate>
                                    @csrf
                                   
                                        <input type="hidden" name="id" value="{{ $user->id }}" />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First
                                                        Name</label><label class="error">*</label>
                                                    <input type="text" name="name" id="name" required
                                                        class="form-control" value='{{$user->name}}'>

                                                    @error('name')
                                                    <label class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="lname" class="form-control"
                                                        placeholder="Last Name" value="{{$user->lname}}">
                                                    @error('lname')
                                                    <label class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email Address</label><label class="error">*</label>
                                                    <input type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        required class="form-control" value='{{$user->email}}'>
                                                    @error('email')
                                                    <label class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn custom-btn btn-primary">Update
                                                    Profile</button>
                                            </div>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-md-3">
                        <div class="panel-heading clearfix">
                                        <h5 class="panel-title">Change Password</h5>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                 <form method="post" id="profile-password" action="{{route('updatepassword')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}" />

                                       
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Current Password</label><label class="error">*</label>
                                                        <input type="password" name='oldpassword' required
                                                            placeholder="Current Password"
                                                            class="form-control @error('password') is not current password @enderror">
                                                        @error('oldpassword')
                                                        <label class="error" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>New Password</label><label class="error">*</label>
                                                        <input type="password" required name="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="New Password">
                                                        @error('password')
                                                        <label class="error" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Confirm New Password</label><label class="error">*</label>
                                                        <input type="password" required name="cpassword"
                                                            class="form-control" placeholder="Confirm New Password">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-12">
                                                <button type="submit" class="btn custom-btn btn-primary">Update
                                                    Password</button>
                                                </div>
                                            
                                        </div>
                                       
                                    </form>
                                    </div>    
                            </div>
                        </div>
                    </div>
    </section>
</div><!-- /Page Content -->
@endsection

@section('additionalscripts')
<script>
$("#profile-details").validate();
// $("#profile-picture").validate();
$("#profile-password").validate();
</script>
@endsection