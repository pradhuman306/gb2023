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

        <div class="dashboard-wrapper">
            <div class="dash-wrap-left">
                <div class="dash-wrap-left-inr">
                    <div class="dash-box-wraper">
                        <div class="dash-box dash-box-first">
                            <p>Total Students</p>
                            <h2>{{$student}}</h2>
                        </div>
                        <!-- <div class="dash-box dash-box-second">
                            <p>Current Session</p>
                            <h2>{{$year}}</h2>
                        </div> -->
                        <div class="dash-box dash-box-third">
                            <p>Weekly Collection</p>
                            <h2 id="total">{{$total}}</h2>
                        </div>
                    </div>
                    <div class="recent-fees-sec">
                        <div class="recent-head">
                            <div class="date-select">
                                <div class="input-daterange input-group" id="datepicker">
                                    <form action="javascript:void(0)" id="date-form">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" id="starts" class="input-sm" name="start"
                                                placeholder="From" autocomplete="off" />
                                            <span class="input-group-btn" for="start">
                                               
                                            </span>
                                        </div>
                                        <div class="input-group sec-inp-group">
                                            <!-- <span class="input-group-addon">to</span> -->
                                            <input type="text" class="input-sm" name="end" id="ends" placeholder="To" />
                                            <span class="input-group-btn" for="start">
                                                
                                            </span>
                                        </div>
                                        <button class="filter-btn earning" type="submit">Filter</button>
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
                                        <td style="width:130px"><span
                                                class="deposit-box badge custom-badge badge-success">₹{{$student->fees}}</span></td>
                                                <td style="width:130px">
                                                @foreach($fees as $f)
                                        @if($f->student_classes_id==$student->class_name && $f->years_id == $student->session)
                                        <span
                                                class="remain-box badge custom-badge badge-danger">₹{{$f->amount - $student->fees}}</span>
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