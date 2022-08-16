@extends('layouts.adminlayout')
@section('content')
<div class="page-inner ad-inr">
    
    <section class="main-wrapper">
        <div class="page-color">
            <div class="page-header">
                <div class="page-title">
                    <div class="head-left">
                        <h4>Extra Pay</h4>
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
                        <option data-value="{{$yy->id}}" @if($yy->status == 1) selected @endif value="{{url('remove',$yy->id)}}">{{$yy->years}}</option>
                        @endforeach
                    </select>
                        </span>
                    </div>
                        <div class="page-btn">
                            <a href="javascript:void(0)" class="btn custom-btn addstudent">Add Dues</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="modal right fade" id="studentModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M6 6L18 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="modal-body">
                                <p class="msg"></p>
                                <form class="add-student-form" id="extrapays" method="Post" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <select class="table-filter form-control" name="class_name"
                                                    id="class_names">
                                                    <option value="" selected>Select Class</option>
                                                    @foreach($class as $test)
                                                    <option value="{{$test->id}}">{{$test->class_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                        $studentslist = App\Models\Student::orderBy('name','asc')->get();
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student</label>
                                                <select class="form-control" name="student_id" id="student_id">
                                                    <option value="" selected>Select Student</option>
                                                    @foreach($studentslist as $student)
                                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input class="form-control" type="number" name="price"
                                                    placeholder="Enter amount">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" style="min-height:100px"
                                                    name="description" rows="4" placeholder="Enter description"
                                                    cols="2"></textarea>
                                            </div>
                                        </div>



                                    </div>

                            </div>
                            <div class="modal-footer text-center justify-content-center">
                                <button type="submit" class="btn custom-btn add-btn addfees"
                                    data-dismiss="modal">Add</button>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="page-table">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th style="width:30px">S.No.</th>
                                <th>Name</th>
                                <th>Parents</th>
                                <th>Description</th>
                                <th>Due Amount</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0;
                            @endphp
                            @foreach($students as $s)
                            <tr>
                                <td>@php echo ++$i @endphp</td>
                                @foreach($studentslist as $student)
                                @if($student->id==$s->student_id)
                                <td>
                                    <div class="students-name">{{$student->name}}</div>
                                </td>
                                @endif
                                @if($student->id==$s->student_id)
                                <td>
                                    <div class="user-dtls">
                                        <span>{{$student->father_name}}</span>
                                        <span>{{$student->mother_name}}</span>
                                    </div>
                                </td>
                                @endif
                                @endforeach
                                <td>{{$s->description}}</td>

                                <td><span class="custom-badge badge badge-warning">₹ {{$s->price}}</span></td>
                                @php
                                $gave = App\Models\Payment::where("id", "=", $s->id)->sum('price');
                                @endphp
                                <td>
                                    <span class="tool">
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="View"
                                            class="btn-sml showdetails" data-id="{{$s->id}}" data-name="{{$s->price}}">

                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="3" stroke="#8F99B3" stroke-width="2" />
                                                <path
                                                    d="M20.188 10.9343C20.5762 11.4056 20.7703 11.6412 20.7703 12C20.7703 12.3588 20.5762 12.5944 20.188 13.0657C18.7679 14.7899 15.6357 18 12 18C8.36427 18 5.23206 14.7899 3.81197 13.0657C3.42381 12.5944 3.22973 12.3588 3.22973 12C3.22973 11.6412 3.42381 11.4056 3.81197 10.9343C5.23206 9.21014 8.36427 6 12 6C15.6357 6 18.7679 9.21014 20.188 10.9343Z"
                                                    stroke="#8F99B3" stroke-width="2" />
                                            </svg>

                                        </a>
                                    </span>
                                    @if(Auth::check() && Auth::user()->user_type == "Admin")
                                    <span class="tool">
                                        <a href="javascript:void(0)" type="submit"
                                            class="btn-sml delete-btn deletepayment" data-id="{{$s->id}}"
                                            data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 15L10 12" stroke="#8F99B3" stroke-width="2"
                                                    stroke-linecap="round"></path>
                                                <path d="M14 15L14 12" stroke="#8F99B3" stroke-width="2"
                                                    stroke-linecap="round"></path>
                                                <path
                                                    d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z"
                                                    stroke="#8F99B3" stroke-width="2" stroke-linecap="round">
                                                </path>
                                                <path
                                                    d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059"
                                                    stroke="#8F99B3" stroke-width="2" stroke-linecap="round">
                                                </path>
                                            </svg>
                                        </a>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            @if($students->count() == '0')
                            <tr>
                                <td colspan="7" style="text-align:center">No data available in table</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div id="paymentDeleteModal" class="modal modal-danger fade" tabindex="-1" role="dialog"
                    aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{url('destroy')}}" method="POST" class="remove-record-model">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Applicant Record</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="#8F99B3" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6 6L18 18" stroke="#8F99B3" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg></button>
                                </div>
                                <div class="modal-body">
                                    <span class="alert alert-danger w-100 alert-delete"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="9" stroke="#721c24" stroke-width="2" />
                                            <path
                                                d="M12.5 7.5C12.5 7.77614 12.2761 8 12 8C11.7239 8 11.5 7.77614 11.5 7.5C11.5 7.22386 11.7239 7 12 7C12.2761 7 12.5 7.22386 12.5 7.5Z"
                                                fill="#721c24" stroke="#721c24" />
                                            <path d="M12 17V10" stroke="#721c24" stroke-width="2" />
                                        </svg> You want you sure delete this
                                        record?</span>
                                    <input type="hidden" name="payment_id" id="payment_id">
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-12 text-center">
                                        <div class="btn-box">

                                            <button type="submit" class="btn custom-btn btn-danger  add-btn"
                                                id="removepayment">Delete</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal right fade" id="showdetail" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Details</h4>

                                <button type="button" class="close" data-dismiss="modal">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>

                                </button>
                            </div>


                            <div class="modal-body">
                                <div class="fee-sec detail-head">
                                    <div class="fee-left">
                                        <h6>Total Extra Pay ₹ <span class="total-fee gave badge badge-success"></span>
                                        </h6>
                                        <h6>Due Amount ₹ <span class="due-fee take badge badge-warning"></span>
                                        </h6>
                                    </div>
                                </div>

                                <input type="hidden" name="old" id="old_pric">
                                <input type="hidden" name="id" id="s_id">

                            </div>
                            <div class="modal-footer">
                                <div class="text-center w-100 justify-content-center">
                                    <a href="javascript:void(0)"
                                        class="btn custom-btn btn-success add-btn addpayment">Gave</a>
                                    <a href="javascript:void(0)" class="btn custom-btn add-btn subpayment">Take</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal right fade" id="gavepayment" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content student-modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Gave Payment</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body after-design">
                                <p class="message"></p>
                                <form class="add-student-form" id="gave" method="Post" önSubmit="return"
                                    action="javascript:void(0)">
                                    @csrf
                                    <input type="hidden" name="old" id="old_price" value="">
                                    <input type="hidden" name="sid" id="id" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input class="form-control" type="number" name="price" id="prices"
                                                    autocomplete="off" placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group birth-date">
                                                <label for="dates"> Date</label>
                                                <input class="form-control" type="text" name="date" id="dates" value=""
                                                    placeholder="When did you get?">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea style="height:100px" class="form-control" type="text"
                                                    name="detail" id="details" placeholder="Enter Details"></textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center w-100 justify-content-center">
                                    <button type="submit" class="btn custom-btn addpay">Gave</button>
                                </div>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
                <div class="modal right fade" id="subpayment" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Take Payment</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="message"></p>
                                <form class="add-student-form" id="takeamount" method="Post" önSubmit="return"
                                    action="javascript:void(0)">
                                    @csrf
                                    <input type="hidden" name="old" id="oldprice" value="">
                                    <input type="hidden" name="sid" id="ids" value="">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input class="form-control" type="number" name="price" id="tprices"
                                                    autocomplete="off" placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group birth-date">
                                                <label>Date</label>
                                                <input class="form-control" type="text" name="date" id="tdates"
                                                    placeholder="When did you get?">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea style="height:100px" class="form-control" type="text"
                                                    name="detail" id="tdetails" placeholder="Enter Details"></textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center w-100 justify-content-center">
                                    <button type="submit" class="btn custom-btn subpay">Take</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
@endsection
@section('additionalscripts')
<script></script>
@endsection