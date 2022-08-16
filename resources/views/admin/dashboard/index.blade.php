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
                                    <h2 id="total">₹{{number_format($total)}}</h2>
                                </div>
                                <div class="dash-box-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 8.5C3 7.10218 3 6.40326 3.22836 5.85195C3.53284 5.11687 4.11687 4.53284 4.85195 4.22836C5.40326 4 6.10218 4 7.5 4H16.5C17.8978 4 18.5967 4 19.1481 4.22836C19.8831 4.53284 20.4672 5.11687 20.7716 5.85195C21 6.40326 21 7.10218 21 8.5V9.25C21 9.66421 20.6642 10 20.25 10H20C18.8954 10 18 10.8954 18 12V12C18 13.1046 18.8954 14 20 14H20.25C20.6642 14 21 14.3358 21 14.75V15.5C21 16.8978 21 17.5967 20.7716 18.1481C20.4672 18.8831 19.8831 19.4672 19.1481 19.7716C18.5967 20 17.8978 20 16.5 20H7.5C6.10218 20 5.40326 20 4.85195 19.7716C4.11687 19.4672 3.53284 18.8831 3.22836 18.1481C3 17.5967 3 16.8978 3 15.5V14.75C3 14.3358 3.33579 14 3.75 14H4C5.10457 14 6 13.1046 6 12V12C6 10.8954 5.10457 10 4 10H3.75C3.33579 10 3 9.66421 3 9.25V8.5Z" stroke="#8F99B3" stroke-width="2"></path>
                                                        <path d="M11.5568 10.6885C11.7249 10.2536 11.809 10.0361 11.9455 10.0059C11.9814 9.99802 12.0186 9.99802 12.0545 10.0059C12.191 10.0361 12.2751 10.2536 12.4432 10.6885C12.5389 10.9359 12.5867 11.0596 12.6761 11.1437C12.7012 11.1673 12.7284 11.1883 12.7574 11.2065C12.8608 11.2711 12.9899 11.2831 13.248 11.3071C13.685 11.3477 13.9035 11.368 13.9702 11.4973C13.984 11.5241 13.9934 11.5531 13.998 11.5831C14.0201 11.7279 13.8595 11.8796 13.5383 12.1829L13.449 12.2671C13.2989 12.4089 13.2238 12.4798 13.1803 12.5683C13.1543 12.6213 13.1368 12.6785 13.1286 12.7375C13.115 12.8358 13.137 12.9386 13.1809 13.1443L13.1967 13.2178C13.2755 13.5867 13.315 13.7712 13.2657 13.8618C13.2215 13.9433 13.1401 13.9954 13.0501 13.9999C12.9499 14.0048 12.8088 13.8855 12.5265 13.6468C12.3406 13.4895 12.2476 13.4109 12.1443 13.3802C12.05 13.3521 11.95 13.3521 11.8557 13.3802C11.7524 13.4109 11.6594 13.4895 11.4735 13.6468C11.1912 13.8855 11.0501 14.0048 10.9499 13.9999C10.8599 13.9954 10.7785 13.9433 10.7343 13.8618C10.685 13.7712 10.7245 13.5867 10.8033 13.2178L10.8191 13.1443C10.863 12.9386 10.885 12.8358 10.8714 12.7375C10.8632 12.6785 10.8457 12.6213 10.8197 12.5683C10.7762 12.4798 10.7011 12.4089 10.551 12.2671L10.4617 12.1829C10.1405 11.8796 9.97989 11.7279 10.002 11.5831C10.0066 11.5531 10.016 11.5241 10.0298 11.4973C10.0965 11.368 10.315 11.3477 10.752 11.3071C11.0101 11.2831 11.1392 11.2711 11.2426 11.2065C11.2716 11.1883 11.2988 11.1673 11.3239 11.1437C11.4133 11.0596 11.4611 10.9359 11.5568 10.6885Z" fill="#8F99B3" stroke="#8F99B3"></path>
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