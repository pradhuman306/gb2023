@extends('layouts.adminlayout')
@section('content')
<div class="page-inner ad-inr">
   
    <section class="main-wrapper">
        <div class="page-color">
            <div class="page-header">
                <div class="page-title">
                    <h3>Edit <span> Student</span></h3>
                    <a href="{{url('/students')}}" class="add-btn">
                        <span>
                            <img src="{{url('/')}}/assets/image/Icon-arrow-back.svg" class="btn-arrow-show" alt="">
                            <img src="{{url('/')}}/assets/image/Icon-arrow-back-2.svg" class="btn-arrow-hide" alt="">
                        </span>
                        <span>Back</span>
                    </a>
                </div>
            </div>
            <div class="page-table">
                <div class="profile-box container-fluid">
                    <form class="add-student-form" method="Post" action="{{route('students.update',$students->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$students->id}}" />
                                    <label>Student Id</label>
                                    <input type="text" name="student_id" id="student_id" value="{{$students->student_id}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Scholar No.</label>
                                    <input type="text" name="scholar_no" id="scholar_no" value="{{$students->scholar_no}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" value="{{$students->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Father name</label>
                                    <input type="text" name="father_name" id="" value="{{$students->father_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mother name</label>
                                    <input type="text" name="mother_name" id="" value="{{$students->mother_name}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" id="" value="{{$students->address}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Aadhar No.</label>
                                    <input type="number" name="aadhar_no" id="" value="{{$students->aadhar_no}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Samagra Id</label>
                                    <input type="number" name="samarg_id" id="" value="{{$students->samarg_id}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" id="" value="{{$students->dob}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select name="class_name" id="class_name">
                                        <option value="" selected>Select Class</option>
                                        @foreach($tests as $test)
                                        <option value="<?php echo $test->id . ',' . $records->id; ?>" <?php
                                                                                                        if ($records->class_name == $test->id) {
                                                                                                            echo 'selected="selected"';
                                                                                                        } ?>>{{$test->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Mobile No. 1</label>
                                    <input type="number" name="mobile_no" id="" value="{{$students->mobile_no}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Mobile No. 2</label>
                                    <input type="number" name="mobile_no2" id="" value="{{$students->mobile_no2}}">
                                </div>
                            </div>
                            <div class="col-md-6 last-input-margin">
                                <div class="form-group">
                                    <label>Current Session</label>
                                    <select name="session" id="session" disabled>
                                        @foreach($year as $y)
                                        @if($y->status==1)
                                        @php $val = $y->id; @endphp
                                        <option value="{{$y->id}}" selected>{{$y->years }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="session" value="{{$val}}">
                                </div>
                            </div>
                            <div class="col-6 last-input-margin">
                                <div class="form-group">
                                    <label>Bank Account No.</label>
                                    <input type="number" name="account_no" id="account_no" value="{{$students->account_no}}">
                                </div>
                            </div>
                            <div class="col-6 last-input-margin">
                                <div class="form-group">
                                    <label> Picture </label>
                                    <input type="file" value="{{$students->profile_picture}}" name="profile_picture" id="profile_picture">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="submit" name="save" class="login-btn" id="save" value="Update Student Information">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('additionalscripts')
@endsection