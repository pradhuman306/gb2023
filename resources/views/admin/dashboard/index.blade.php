@extends('layouts.adminlayout')
@section('content')
<section class="main-wrapper">
    <div class="page-color">
        <div class="page-header">
            <div class="page-title">
                <div class="head-left">
                    <h4>Dashboard</h4>
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
                                <option @if($yy->status == 1) selected @endif value="{{url('remove',$yy->id)}}">{{$yy->years}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                    <div class="sideToggle">
                        <div id="nav-icon" class=""> <span></span> <span></span> <span></span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">

            <div class="dashboard-wrapper">
                <div class="dash-wrap-left">
                    <div class="dash-wrap-left-inr">
                        <div class="dash-box-wraper">
                            <div class="dash-box dash-box-first">
                                <div class="dash-box-dtl">
                                    <p>Total Students</p>
                                    <h2>{{$student}}</h2>
                                </div>
                                <div class="dash-box-icon">
                                    <svg class="icon-assign-role" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></circle>
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd" d="M13.3267 15.0759C12.8886 15.0255 12.4452 15 12 15C10.0805 15 8.19383 15.4738 6.63113 16.3732C5.06902 17.2721 3.88124 18.5702 3.33091 20.1106C3.1451 20.6307 3.41608 21.203 3.93617 21.3888C4.45626 21.5746 5.02851 21.3036 5.21432 20.7835C5.57558 19.7723 6.39653 18.8157 7.62872 18.1066C8.64272 17.523 9.86375 17.1503 11.158 17.0368C11.4889 16.0601 12.3091 15.3092 13.3267 15.0759Z" fill="#8F99B3"></path>
                                        <path d="M18 14L18 22" stroke="#8F99B3" stroke-width="2.5" stroke-linecap="round"></path>
                                        <path d="M22 18L14 18" stroke="#8F99B3" stroke-width="2.5" stroke-linecap="round"></path>
                                    </svg>
                                </div>
                            </div>
                            <!-- <div class="dash-box dash-box-second">
                            <p>Current Session</p>
                            <h2>{{$year}}</h2>
                        </div> -->
                            <div class="dash-box dash-box-third">
                                <div class="dash-box-dtl">
                                    <p>Weekly Collection</p>
                                    <h2 id="total">{{$total}}</h2>
                                </div>
                                <div class="dash-box-icon">
                                    <svg class="icon-assign-role" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></circle>
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd" d="M13.3267 15.0759C12.8886 15.0255 12.4452 15 12 15C10.0805 15 8.19383 15.4738 6.63113 16.3732C5.06902 17.2721 3.88124 18.5702 3.33091 20.1106C3.1451 20.6307 3.41608 21.203 3.93617 21.3888C4.45626 21.5746 5.02851 21.3036 5.21432 20.7835C5.57558 19.7723 6.39653 18.8157 7.62872 18.1066C8.64272 17.523 9.86375 17.1503 11.158 17.0368C11.4889 16.0601 12.3091 15.3092 13.3267 15.0759Z" fill="#8F99B3"></path>
                                        <path d="M18 14L18 22" stroke="#8F99B3" stroke-width="2.5" stroke-linecap="round"></path>
                                        <path d="M22 18L14 18" stroke="#8F99B3" stroke-width="2.5" stroke-linecap="round"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="recent-fees-sec">
                            <div class="recent-head">
                                <div class="date-select">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <form action="javascript:void(0)" id="date-form">
                                            @csrf
                                            <div class="date-group">
                                                <span class="input-group-btn" for="start">
                                                <input type="text" id="starts" class="form-control input-sm" name="start" placeholder="From" autocomplete="off" />
                                                </span>
                                            </div>
                                            <div class="date-group sec-inp-group">
                                                <!-- <span class="input-group-addon">to</span> -->
                                                <span class="input-group-btn" for="end">
                                                <input type="text" class="form-control input-sm" name="end" id="ends" placeholder="To" />
                                                </span>
                                            </div>
                                            <button class="filter-btn btn custom-btn earning" type="submit">Filter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="page-table">
                                <table id="fees-table" class=" tabel-res custom-table display nowrap" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:30px">#</th>
                                            <th class="width-200">Student Name</th>
                                            <th>Parents</th>
                                            <th>Class</th>
                                            <!-- <th>session</th> -->
                                            <th style="width:130px">Deposit fees</th>
                                            <th>Remaining fees</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fees-tables">
                                        @php $i = 0;
                                        @endphp
                                        @foreach($users as $student)
                                        <tr>
                                            <td class="width-20">@php echo ++$i @endphp</td>
                                            <td class="students-name">{{ Str::title($student->name) }}</td>

                                            <td class="width-200">
                                                <div class="user-dtls">
                                                    <span>{{ Str::title($student->father_name) }}</span>
                                                    <span> {{ Str::title($student->mother_name) }}</span>
                                                </div>
                                            </td>
                                            @foreach($classes as $c)
                                            @if($c->id==$student->class_name)
                                            <td>{{$c->class_name}}</td>
                                            @endif
                                            @endforeach
                                            <!-- <td>{{$student->session}}</td> -->
                                            <td style="width:130px"><span class="deposit-box badge custom-badge badge-success">₹{{$student->fees}}</span></td>
                                            <td style="width:130px">
                                                @foreach($fees as $f)
                                                @if($f->student_classes_id==$student->class_name && $f->years_id == $student->session)
                                                <span class="remain-box badge custom-badge badge-danger">₹{{$f->amount - $student->fees}}</span>
                                                @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>


</script>
@endpush