@extends('layouts.adminlayout')
@section('content')
<div class="page-inner ad-inr">
    <div style="display: none;" class="error"></div>
    <section class="main-wrapper">
        <div class="page-color">
            <div class="page-header">
                <div class="page-title">
                    <div class="head-left">
                        <h4>All Students</h4>
                    </div>
                    <div class="head-right">
                        <div class="current-session">
                            <svg class="icon-sessions" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                    <option data-value="{{$yy->id}}" @if($yy->status == 1) selected @endif value="{{url('remove',$yy->id)}}">{{$yy->years}}</option>
                                    @endforeach
                                </select>
                            </span>
                        </div>
                        <div class="page-btn">
                            <a href="javascript:void(0)" class="btn custom-btn addStudent">Add Student</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="tabel-head">
                    <div class="form-group choose-classes">
                        <label for="table-filter">Classes</label>
                        <select class="form-control" id="table-filter">
                            <option value="">All</option>
                            <option>Nursery</option>
                            <option>LKG</option>
                            <option>UKG</option>
                            <option>First</option>
                            <option>Second</option>
                            <option>Third</option>
                            <option>Fourth</option>
                            <option>Fifth</option>
                            <option>Sixth</option>
                            <option>Seventh</option>
                            <option>Eigth</option>
                            <option>Ninth</option>
                            <option>Tenth</option>
                        </select>

                    </div>
                    <div class="tabel-head-right">
                        <form action="{{ route('import') }}" method="Post" enctype="multipart/form-data" class="export-form">
                            @csrf
                            <input type="file" name="file" id="file" class="my-profile-choose-file" style="display:none;">
                            <input type="submit" id="submit" style="display: none;">
                            <div class="btn-group">
                                <div class="btn-single">
                                    <a data-toggle="tooltip" data-placement="top" data-original-title="Import CSV" href="javascript:void(0)" class="btn import btn-data" role='button'>

                                        <svg class="fill" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill" d="M12 14L11.2929 14.7071L12 15.4142L12.7071 14.7071L12 14ZM13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44771 11 5L13 5ZM6.29289 9.70711L11.2929 14.7071L12.7071 13.2929L7.70711 8.29289L6.29289 9.70711ZM12.7071 14.7071L17.7071 9.70711L16.2929 8.29289L11.2929 13.2929L12.7071 14.7071ZM13 14L13 5L11 5L11 14L13 14Z" fill="#8F99B3" />
                                            <path class="nofill" d="M5 16L5 17C5 18.1046 5.89543 19 7 19L17 19C18.1046 19 19 18.1046 19 17V16" stroke="#8F99B3" stroke-width="2" />
                                        </svg>

                                        <span>Import</span>
                                    </a>
                                </div>
                                <div data-toggle="tooltip" data-placement="top" data-original-title="Download CSV" class="btn-single"> <a href="javascript:void(0)" id="export" class="btn  btn-data" role='button'>

                                        <svg class="fill" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill" d="M12 5L11.2929 4.29289L12 3.58579L12.7071 4.29289L12 5ZM13 14C13 14.5523 12.5523 15 12 15C11.4477 15 11 14.5523 11 14L13 14ZM6.29289 9.29289L11.2929 4.29289L12.7071 5.70711L7.70711 10.7071L6.29289 9.29289ZM12.7071 4.29289L17.7071 9.29289L16.2929 10.7071L11.2929 5.70711L12.7071 4.29289ZM13 5L13 14L11 14L11 5L13 5Z" fill="#8F99B3" />
                                            <path class="nofill" d="M5 16L5 17C5 18.1046 5.89543 19 7 19L17 19C18.1046 19 19 18.1046 19 17V16" stroke="#8F99B3" stroke-width="2" />
                                        </svg>

                                        <span>Export</span>
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <form id="frm-example" action="javascript:void(0)" method="get">
                    <div class="page-table" id="dvData">
                        <table id="" class="studenttable tabel-res display nowrap" style="width:100%;" data-plugin-options='{"searchPlaceholder": "Suchen"}'>
                            <thead>
                                <tr>
                                    <th class="width-30"></th>
                                    <th class="width-30"></th>
                                    <th class="width-160">Name</th>
                                    <th>Parents</th>

                                    <th class="width-50">Student Id</th>
                                    <!-- <th>Scholar No.</th> -->
                                    <th>Address</th>
                                    <th>Aadhar Number</th>
                                    <th>Mob No.</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                            </tbody>
                        </table>
                    </div>
                    @if(Auth::check() && Auth::user()->user_type == "Admin")
                    <div class="promote-student">
                        <button type="submit" class="btn custom-btn add-btn" data-toggle="modal" data-target="#promoteModal">Promote Student</button>
                    </div>
                    @endif
                    <div class="container">
                </form>
                <!-- The Modal -->
                <div class="modal" id="promoteModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">Student Promote</h4>
                                <button type="button" class="close" data-dismiss="modal"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{ url('promote') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="students_id" id="promote" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label>Select Session</label>
                                                <select class="form-control" name="year" id="year">
                                                    @foreach($year as $y)
                                                    @if($y->status!=1)
                                                    <option value="{{$y->id}}">{{$y->years}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label>Select Class</label>
                                                <select class="form-control" name="class" id="class">
                                                    @foreach($tests as $c)
                                                    <option value="{{$c->id}}">{{$c->class_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <div class="text-center">
                                    <button type="submit" class="btn custom-btn add-btn align-center">Promote</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- student delete modal -->
                <div id="studentDeleteModal" class="modal modal-danger fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered" style="width:55%;">
                        <div class="modal-content">
                            <form action="{{url('studentdelete')}}" method="POST" class="remove-record-model">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title text-center width-100" id="custom-width-modalLabel">Delete
                                        Student</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6 6L18 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <span class="alert alert-danger w-100 alert-delete"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="9" stroke="#721c24" stroke-width="2" />
                                            <path d="M12.5 7.5C12.5 7.77614 12.2761 8 12 8C11.7239 8 11.5 7.77614 11.5 7.5C11.5 7.22386 11.7239 7 12 7C12.2761 7 12.5 7.22386 12.5 7.5Z" fill="#721c24" stroke="#721c24" />
                                            <path d="M12 17V10" stroke="#721c24" stroke-width="2" />
                                        </svg> You want you sure delete
                                        <span id="studentnamelbl"></span>?
                                    </span>

                                    <input type="hidden" name="sid" id="s_id">
                                    <input type="hidden" name="rid" id="r_id">
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-12 text-center">
                                        <div class="btn-box">

                                            <button type="submit" class="btn custom-btn btn-danger delete-data-btn waves-effect remove-data-from-delete-form add-btn">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- student edit modal -->
                <div class="modal right fade" id="mystudentModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content student-modal-content">
                            <div class="modal-header">
                                <h4>Edit Student</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                            <form method="Post" action="{{url('editstudent')}}" enctype="multipart/form-data" id="edit-student">
                                <input type="hidden" name="sId" id="sIds" value="">
                                @csrf
                                <div class="modal-body after-design">
                                    <div class="tab-panes">
                                        <div class="min-height">
                                            <div class="row mt-1">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="student_ids">Student ID</label>
                                                        <input class="form-control" type="text" name="student_id" id="student_ids" value="" placeholder="Student Id">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="scholar_nos">Student No.</label>
                                                        <input class="form-control" type="text" name="scholar_no" id="scholar_nos" value="" placeholder="Scholar No.">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="names">Student Name</label>
                                                        <input class="form-control" type="text" name="name" id="names" value="" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">Father Name</label>
                                                        <input class="form-control" type="text" name="father_name" id="fname" value="" placeholder="Father name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mname">Mother Name</label>
                                                        <input class="form-control" type="text" name="mother_name" id="mname" value="" placeholder="Mother name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="addres">Address</label>
                                                        <input class="form-control" type="text" name="address" id="addres" value="" placeholder="Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aadhar">Aadhar No.</label>
                                                        <input class="form-control" type="number" name="aadhar_no" id="aadhar" value="" placeholder="Aadhar No.">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="samargid">Samagra Id</label>
                                                        <input class="form-control" type="number" name="samarg_id" id="samargid" value="" placeholder="Samagra Id">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group birth-date">
                                                        <label for="sdob">Date of Birth</label>
                                                        <input class="form-control" type="text" name="dob" id="sdob" value="" placeholder="DOB">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="classes">Class</label>
                                                        <select class="form-control" name="class_name" id="classes">
                                                            <option>Class</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="m1">Mobile No.</label>
                                                        <input class="form-control" type="number" name="mobile_no" id="m1" value="" placeholder="Mobile No.">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="m2">Telephone No.</label>
                                                        <input class="form-control" type="number" name="mobile_no2" id="m2" value="" placeholder="Telephone No.">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 last-input-margin">
                                                    <div class="form-group">
                                                        <label for="sessions">Year</label>
                                                        <select class="form-control" name="session" id="sessions">
                                                            <option>Current Session</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 last-input-margin">
                                                    <div class="form-group">
                                                        <label for="acc">Bank Account No.</label>
                                                        <input class="form-control" type="number" name="account_no" id="acc" value="" placeholder="Bank Account No.">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-12 text-center">
                                        <button type="submit" name="save" class="add-btn btn custom-btn" id="save">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- student edit modal -->
            <div class="modal right fade" id="studentFeeModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content student-modal-content">
                        <div class="modal-header">
                            <h4>Student Fees Details</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body after-design">
                            <div class="tab-panes">
                                <div class="min-height">
                                    <div class="detail-head">
                                        <div class="detail-head-inr">
                                            <div class="detail-head-left">
                                                <div class="student-wrapper">
                                                    <div class="student-img">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.7956 20.7059C17.4537 19.6427 16.7004 18.7033 15.6526 18.0332C14.6047 17.3632 13.3208 17 12 17C10.6792 17 9.3953 17.3632 8.34743 18.0332C7.29957 18.7033 6.5463 19.6427 6.20445 20.7059" stroke="#CCD2E3" stroke-width="2" />
                                                            <circle cx="12" cy="10" r="3" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" />
                                                            <rect x="3" y="3" width="18" height="18" rx="3" stroke="#CCD2E3" stroke-width="2" />
                                                        </svg>
                                                    </div>
                                                    <div class="student-name">
                                                        <div class="student-full-name">
                                                            <h5 class="s_name">{{ Str::title('')}}</h5>
                                                            <div class="stu-id">
                                                                <label class="badge badge-primary">
                                                                    Student ID: <span class="student_ids"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="stu-detail">
                                                            <div class="user-dtls">
                                                                <span class="f_name"></span>
                                                                <span class="m_name"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fee-sec detail-head mt-3">
                                        <div class="fee-left">
                                            <h6>Total Fees ₹ <span class="total-fee amounts badge badge-success"></span>
                                            </h6>
                                            <h6>Old Dues: ₹ <span class="due-fee badge badge-warning" id="old_dues">0</span></h6>
                                        </div>
                                        <div class="fee-right">

                                            <div class="alert alert-danger" role="alert">
                                                <label>Remaining Fees: ₹ <span class="due-fee remaining"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fee-list-head">
                                        <h6>Fees Summery</h6>
                                        <a href="javascript:void(0)" class="btn custom-btn add-btn deposit-modal">Deposit
                                            Fee</a>
                                    </div>
                                    <div class="fee-list-table">
                                        <table class="inner-table">
                                            <thead>
                                                <tr>
                                                    <th>Rec No.</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>By</th>
                                                    @if(Auth::check() && Auth::user()->user_type == "Admin")
                                                    <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody class="student-fees">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // add student model  -->
            <div class="modal right fade" id="myaddModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content student-modal-content">
                        <div class="modal-header">
                            <h4>Add Student</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                        <form action="{{route('students.store')}}" id="studentAdd" method="Post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body after-design">
                                <div class="min-height">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student_id">Student ID</label>
                                                <input class="form-control" type="text" name="student_id" id="student_id" placeholder="Student Id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="scholar_no">Student No.</label>
                                                <input class="form-control" type="text" name="scholar_no" id="scholar_no" placeholder="Scholar No.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Student Name</label>
                                                <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_name">Father Name</label>
                                                <input class="form-control" type="text" name="father_name" id="father_name" placeholder="Father name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="other_name">Mother Name</label>
                                                <input class="form-control" type="text" name="mother_name" id="mother_name" placeholder="Mother name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input class="form-control" type="text" name="address" id="address" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aadhar_no">Aadhar No.</label>
                                                <input class="form-control" type="number" name="aadhar_no" id="aadhar_no" placeholder="Aadhar No.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="samarg_id">Samagra Id</label>
                                                <input class="form-control" type="number" name="samarg_id" id="samarg_id" placeholder="Samagra Id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group birth-date">
                                                <label for="dob">Date of Birth</label>
                                                <input class="form-control valid" type="text" name="dob" id="dob" value="" placeholder="DOB">
                                                <span class="input-group-btn" for="dob">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="class_name">Class</label>
                                                <select class="form-control" name="class_name" id="class_name">
                                                    <option value="" selected>Select Class</option>
                                                    @foreach($tests as $test)
                                                    <option value="{{$test->id}}">{{$test->class_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile_no">Mobile No.</label>
                                                <input class="form-control" type="number" name="mobile_no" id="mobile_no" placeholder="Mobile No.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile_no2">Telephone No.</label>
                                                <input class="form-control" type="number" name="mobile_no2" id="mobile_no2" placeholder="Telephone No.">
                                            </div>
                                        </div>
                                        <div class="col-md-6 last-input-margin" style="display: none;">
                                            <div class="form-group">
                                                <label for="session">Year</label>
                                                <select class="form-control" name="session" id="session">
                                                    <option value="">Current Session</option>
                                                    <option value="{{$y_id}}" selected>{{$y_name }}
                                                    </option>
                                                </select>
                                                <input type="hidden" name="session" value="{{$y_id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 last-input-margin">
                                            <div class="form-group">
                                                <label for="account_no">Bank Account No.</label>
                                                <input class="form-control" type="number" name="account_no" id="account_no" placeholder="Bank Account No.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12 text-center">
                                    <input type="submit" name="save" class="add-btn btn custom-btn" id="butsave" value="Add Student">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fees Deposit modal -->
            <div class="modal right fade" id="feeDepositModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content student-modal-content">
                        <div class="modal-header">
                            <h4>Add Fee</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body after-design">
                            <div class="min-height">
                                <div class="fee-sec detail-head">
                                    <div class="fee-left">
                                        <h6>Total Fees ₹ <span class="total-fee amounts badge badge-success"></span>
                                        </h6>
                                        <h6>Remaining Fees ₹ <span class="due-fee remaining badge badge-danger"></span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="deposit-form">
                                    <p class="msg"></p>
                                    <form action="JavaScript:void(0)" id="add-fees" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="record_id" value="">
                                        <input type="hidden" name="sid" id="student-id" value="">
                                        <input type="hidden" name="cid" id="c_id" value="">
                                        <input type="hidden" name="year" id="" value="{{$y_id}}">

                                        <input type="hidden" name="amount" id="total_amount" value="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="rno">Receipt No.</label>
                                                    <input class="form-control" type="text" id="rno" name="receipt_no" placeholder="Receipt No.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fe">Amount</label>
                                                    <input class="form-control" type="text" id="fe" name="fees" placeholder="Amount">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group birth-date">
                                                    <label for="dat">Date</label>
                                                    <input class="form-control" type="text" name="date" value="" id="dat" placeholder="Date">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="des">Received From</label>
                                                    <input class="form-control" type="text" name="description" id="des" placeholder="Received From">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="save" class="btn custom-btn add-btn align-center" id="but-save">Add Free</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit fees modal -->
            @if(Auth::check() && Auth::user()->user_type == "Admin")
            <div class="modal right fade" id="feeEditModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content student-modal-content">
                        <div class="modal-header">
                            <h4>Edit Fee</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body after-design">
                            <div class="min-height">
                                <div class="fee-sec detail-head">
                                    <div class="fee-left pt-0 pb-0">
                                        <h6>Total Fees ₹ <span class="total-fee amounts badge badge-success"></span>
                                        </h6>
                                        <h6>Remaining Fees ₹ <span class="due-fee remaining badge badge-danger"></span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="deposit-form">
                                    <p class="msg"></p>
                                    <form action="JavaScript:void(0)" id="edit-fees" method="post">
                                        @csrf
                                        <input type="hidden" name="main_id" id="main_id" value="">
                                        <input type="hidden" name="id" id="idkl" value="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="receipt">Receipt No.</label>
                                                    <input class="form-control" type="text" name="receipt_no" id="receipt" placeholder="Receipt No.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fee">Amount</label>
                                                    <input class="form-control" type="text" name="fees" id="fee" placeholder="Amount">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group birth-date">
                                                    <label for="dates">Date</label>
                                                    <input class="form-control" type="text" name="date" id="dates" value="" placeholder="Date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="descriptions">Received From</label>
                                                    <input class="form-control" type="text" name="description" id="descriptions" placeholder="Received From">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="save" class="btn custom-btn add-btn align-center" id="but-edit">Add Fee</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <!-- //fees delete -->
            @if(Auth::check() && Auth::user()->user_type == "Admin")
            <div id="reportDeleteModal" class="modal modal-danger fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" style="width:55%;">
                    <div class="modal-content">
                        <form action="{{url('reportdelete')}}" method="POST" class="remove-record-model">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title text-center width-100" id="custom-width-modalLabel">Delete
                                    Receipt</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M6 6L18 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span class="alert alert-danger w-100 alert-delete"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="9" stroke="#721c24" stroke-width="2" />
                                        <path d="M12.5 7.5C12.5 7.77614 12.2761 8 12 8C11.7239 8 11.5 7.77614 11.5 7.5C11.5 7.22386 11.7239 7 12 7C12.2761 7 12.5 7.22386 12.5 7.5Z" fill="#721c24" stroke="#721c24" />
                                        <path d="M12 17V10" stroke="#721c24" stroke-width="2" />
                                    </svg> You want you sure delete this
                                    record?</span>
                                <input type="hidden" name="sid" id="report_id">
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 text-center">
                                    <div class="btn-box">
                                        <button type="submit" class="btn custom-btn btn-danger  add-btn delete-data-btn waves-effect remove-data-from-delete-form">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
@section('additionalscripts')
@endsection