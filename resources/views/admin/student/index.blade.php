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
                                    <option @if($yy->status == 1) selected @endif value="{{url('remove',$yy->id)}}">{{$yy->years}}</option>
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
                                    <th class="hide">Class</th>
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
                                @php $i = 0; @endphp
                                @foreach($records as $r)
                                @php
                                $students= App\Models\Student::Where('id', $r->students_id)->get();
                                @endphp
                                @foreach($students as $student)
                                @if($r->session == $y_id)
                                <tr>
                                    <td class="width-30">{{$student->id}}</td>
                                    <td class="width-30"></td>
                                    <td class="width-160">
                                        <div class="students-name">{{ Str::title($student->name)}}</div>
                                    </td>
                                    @foreach($tests as $class)
                                    @if($r->class_name==$class->id)
                                    <td class="hide">{{$class->class_name}}
                                    </td>
                                    @elseif($r->class_name==NULL)
                                    <!-- <td class="hide">
                                    </td> -->
                                    @endif
                                    @endforeach
                                    <td>
                                        <div class="user-dtls">
                                            <span>{{ strtolower($student->father_name)}}</span>
                                            <span>{{ strtolower($student->mother_name)}}</span>
                                        </div>
                                    </td>


                                    <td class="width-50"><span class="custom-badge badge badge-primary">{{$student->student_id}}</span>
                                    </td>
                                    <!-- <td>{{$student->scholar_no}}</td> -->
                                    <td>{{$student->address}}</td>
                                    <td>{{$student->aadhar_no}}</td>
                                    <td>{{$student->mobile_no}} <br>
                                        {{$student->mobile_no2}}
                                    </td>
                                    <td>
                                        <ul class="d-flex">
                                            <li class="tool tool-view">
                                                <a data-toggle="tooltip" data-placement="top" data-original-title="Fees" class="fees-popup btn-sml" data-id="{{$student->id}}" data-href="{{route('students.edit',$student->id)}}" fees-href="{{url('show',['student'=>$student->id,'session'=>$r->session])}}">

                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 8.5C3 7.10218 3 6.40326 3.22836 5.85195C3.53284 5.11687 4.11687 4.53284 4.85195 4.22836C5.40326 4 6.10218 4 7.5 4H16.5C17.8978 4 18.5967 4 19.1481 4.22836C19.8831 4.53284 20.4672 5.11687 20.7716 5.85195C21 6.40326 21 7.10218 21 8.5V9.25C21 9.66421 20.6642 10 20.25 10H20C18.8954 10 18 10.8954 18 12V12C18 13.1046 18.8954 14 20 14H20.25C20.6642 14 21 14.3358 21 14.75V15.5C21 16.8978 21 17.5967 20.7716 18.1481C20.4672 18.8831 19.8831 19.4672 19.1481 19.7716C18.5967 20 17.8978 20 16.5 20H7.5C6.10218 20 5.40326 20 4.85195 19.7716C4.11687 19.4672 3.53284 18.8831 3.22836 18.1481C3 17.5967 3 16.8978 3 15.5V14.75C3 14.3358 3.33579 14 3.75 14H4C5.10457 14 6 13.1046 6 12V12C6 10.8954 5.10457 10 4 10H3.75C3.33579 10 3 9.66421 3 9.25V8.5Z" stroke="#8F99B3" stroke-width="2" />
                                                        <path d="M11.5568 10.6885C11.7249 10.2536 11.809 10.0361 11.9455 10.0059C11.9814 9.99802 12.0186 9.99802 12.0545 10.0059C12.191 10.0361 12.2751 10.2536 12.4432 10.6885C12.5389 10.9359 12.5867 11.0596 12.6761 11.1437C12.7012 11.1673 12.7284 11.1883 12.7574 11.2065C12.8608 11.2711 12.9899 11.2831 13.248 11.3071C13.685 11.3477 13.9035 11.368 13.9702 11.4973C13.984 11.5241 13.9934 11.5531 13.998 11.5831C14.0201 11.7279 13.8595 11.8796 13.5383 12.1829L13.449 12.2671C13.2989 12.4089 13.2238 12.4798 13.1803 12.5683C13.1543 12.6213 13.1368 12.6785 13.1286 12.7375C13.115 12.8358 13.137 12.9386 13.1809 13.1443L13.1967 13.2178C13.2755 13.5867 13.315 13.7712 13.2657 13.8618C13.2215 13.9433 13.1401 13.9954 13.0501 13.9999C12.9499 14.0048 12.8088 13.8855 12.5265 13.6468C12.3406 13.4895 12.2476 13.4109 12.1443 13.3802C12.05 13.3521 11.95 13.3521 11.8557 13.3802C11.7524 13.4109 11.6594 13.4895 11.4735 13.6468C11.1912 13.8855 11.0501 14.0048 10.9499 13.9999C10.8599 13.9954 10.7785 13.9433 10.7343 13.8618C10.685 13.7712 10.7245 13.5867 10.8033 13.2178L10.8191 13.1443C10.863 12.9386 10.885 12.8358 10.8714 12.7375C10.8632 12.6785 10.8457 12.6213 10.8197 12.5683C10.7762 12.4798 10.7011 12.4089 10.551 12.2671L10.4617 12.1829C10.1405 11.8796 9.97989 11.7279 10.002 11.5831C10.0066 11.5531 10.016 11.5241 10.0298 11.4973C10.0965 11.368 10.315 11.3477 10.752 11.3071C11.0101 11.2831 11.1392 11.2711 11.2426 11.2065C11.2716 11.1883 11.2988 11.1673 11.3239 11.1437C11.4133 11.0596 11.4611 10.9359 11.5568 10.6885Z" fill="#8F99B3" stroke="#8F99B3" />
                                                    </svg>


                                                </a>

                                            </li>
                                            <li class="tool tool-view">
                                                <a data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="studentpopup btn-sml" data-id="{{$student->id}}" data-href="{{route('students.edit',$student->id)}}" fees-href="{{url('show',['student'=>$student->id,'session'=>$r->session])}}">
                                                    <svg class="nofill" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <mask id="path-1-outside-1_1154_12363" maskUnits="userSpaceOnUse" x="3" y="4" width="17" height="17" fill="black">
                                                            <rect fill="white" x="3" y="4" width="17" height="17" />
                                                            <path d="M13.5858 7.41421L6.39171 14.6083C6.19706 14.8029 6.09974 14.9003 6.03276 15.0186C5.96579 15.1368 5.93241 15.2704 5.86564 15.5374L5.20211 18.1915C5.11186 18.5526 5.06673 18.7331 5.16682 18.8332C5.2669 18.9333 5.44742 18.8881 5.80844 18.7979L5.80845 18.7979L8.46257 18.1344C8.72963 18.0676 8.86316 18.0342 8.98145 17.9672C9.09974 17.9003 9.19706 17.8029 9.39171 17.6083L16.5858 10.4142L16.5858 10.4142C17.2525 9.74755 17.5858 9.41421 17.5858 9C17.5858 8.58579 17.2525 8.25245 16.5858 7.58579L16.4142 7.41421C15.7475 6.74755 15.4142 6.41421 15 6.41421C14.5858 6.41421 14.2525 6.74755 13.5858 7.41421Z" />
                                                        </mask>
                                                        <path d="M6.39171 14.6083L7.80593 16.0225L7.80593 16.0225L6.39171 14.6083ZM13.5858 7.41421L12.1716 6L12.1716 6L13.5858 7.41421ZM16.4142 7.41421L15 8.82843L15 8.82843L16.4142 7.41421ZM16.5858 7.58579L18 6.17157L18 6.17157L16.5858 7.58579ZM16.5858 10.4142L18 11.8284L16.5858 10.4142ZM9.39171 17.6083L7.9775 16.1941L7.9775 16.1941L9.39171 17.6083ZM5.86564 15.5374L7.80593 16.0225L7.80593 16.0225L5.86564 15.5374ZM5.20211 18.1915L3.26183 17.7065H3.26183L5.20211 18.1915ZM5.80845 18.7979L5.32338 16.8576L5.23624 16.8794L5.15141 16.9089L5.80845 18.7979ZM8.46257 18.1344L7.97751 16.1941L7.9775 16.1941L8.46257 18.1344ZM5.16682 18.8332L6.58103 17.419L6.58103 17.419L5.16682 18.8332ZM5.80844 18.7979L6.29351 20.7382L6.38065 20.7164L6.46549 20.6869L5.80844 18.7979ZM8.98145 17.9672L7.99605 16.2268L7.99605 16.2268L8.98145 17.9672ZM16.5858 10.4142L18 11.8284L18 11.8284L16.5858 10.4142ZM6.03276 15.0186L4.29236 14.0332L4.29236 14.0332L6.03276 15.0186ZM7.80593 16.0225L15 8.82843L12.1716 6L4.9775 13.1941L7.80593 16.0225ZM15 8.82843L15.1716 9L18 6.17157L17.8284 6L15 8.82843ZM15.1716 9L7.9775 16.1941L10.8059 19.0225L18 11.8284L15.1716 9ZM3.92536 15.0524L3.26183 17.7065L7.1424 18.6766L7.80593 16.0225L3.92536 15.0524ZM6.29352 20.7382L8.94764 20.0746L7.9775 16.1941L5.32338 16.8576L6.29352 20.7382ZM3.26183 17.7065C3.233 17.8218 3.15055 18.1296 3.12259 18.4155C3.0922 18.7261 3.06509 19.5599 3.7526 20.2474L6.58103 17.419C6.84671 17.6847 6.99914 18.0005 7.06644 18.2928C7.12513 18.5478 7.10965 18.7429 7.10358 18.8049C7.09699 18.8724 7.08792 18.904 7.097 18.8631C7.10537 18.8253 7.11788 18.7747 7.1424 18.6766L3.26183 17.7065ZM5.15141 16.9089L5.1514 16.9089L6.46549 20.6869L6.46549 20.6869L5.15141 16.9089ZM5.32338 16.8576C5.22531 16.8821 5.17467 16.8946 5.13694 16.903C5.09595 16.9121 5.12762 16.903 5.19506 16.8964C5.25712 16.8903 5.45223 16.8749 5.70717 16.9336C5.99955 17.0009 6.31535 17.1533 6.58103 17.419L3.7526 20.2474C4.44011 20.9349 5.27387 20.9078 5.58449 20.8774C5.87039 20.8494 6.17822 20.767 6.29351 20.7382L5.32338 16.8576ZM7.9775 16.1941C7.95279 16.2188 7.9317 16.2399 7.91214 16.2593C7.89271 16.2787 7.87671 16.2945 7.86293 16.308C7.84916 16.3215 7.83911 16.3312 7.83172 16.3382C7.82812 16.3416 7.82545 16.3441 7.8236 16.3458C7.82176 16.3475 7.8209 16.3483 7.82092 16.3482C7.82094 16.3482 7.82198 16.3473 7.82395 16.3456C7.82592 16.3439 7.82893 16.3413 7.83291 16.338C7.84086 16.3314 7.85292 16.3216 7.86866 16.3098C7.88455 16.2979 7.90362 16.2843 7.92564 16.2699C7.94776 16.2553 7.97131 16.2408 7.99605 16.2268L9.96684 19.7076C10.376 19.476 10.6864 19.1421 10.8059 19.0225L7.9775 16.1941ZM8.94764 20.0746C9.11169 20.0336 9.55771 19.9393 9.96685 19.7076L7.99605 16.2268C8.02079 16.2128 8.0453 16.2001 8.06917 16.1886C8.09292 16.1772 8.11438 16.1678 8.13277 16.1603C8.15098 16.1529 8.16553 16.1475 8.17529 16.1441C8.18017 16.1424 8.18394 16.1412 8.18642 16.1404C8.1889 16.1395 8.19024 16.1391 8.19026 16.1391C8.19028 16.1391 8.18918 16.1395 8.18677 16.1402C8.18435 16.1409 8.18084 16.1419 8.17606 16.1432C8.16625 16.1459 8.15278 16.1496 8.13414 16.1544C8.11548 16.1593 8.09368 16.1649 8.0671 16.1716C8.04034 16.1784 8.0114 16.1856 7.97751 16.1941L8.94764 20.0746ZM15.1716 9C15.3435 9.17192 15.4698 9.29842 15.5738 9.40785C15.6786 9.518 15.7263 9.57518 15.7457 9.60073C15.7644 9.62524 15.7226 9.57638 15.6774 9.46782C15.6254 9.34332 15.5858 9.18102 15.5858 9H19.5858C19.5858 8.17978 19.2282 7.57075 18.9258 7.1744C18.6586 6.82421 18.2934 6.46493 18 6.17157L15.1716 9ZM18 11.8284L18 11.8284L15.1716 8.99999L15.1716 9L18 11.8284ZM18 11.8284C18.2934 11.5351 18.6586 11.1758 18.9258 10.8256C19.2282 10.4292 19.5858 9.82022 19.5858 9H15.5858C15.5858 8.81898 15.6254 8.65668 15.6774 8.53218C15.7226 8.42362 15.7644 8.37476 15.7457 8.39927C15.7263 8.42482 15.6786 8.482 15.5738 8.59215C15.4698 8.70157 15.3435 8.82807 15.1716 9L18 11.8284ZM15 8.82843C15.1719 8.6565 15.2984 8.53019 15.4078 8.42615C15.518 8.32142 15.5752 8.27375 15.6007 8.25426C15.6252 8.23555 15.5764 8.27736 15.4678 8.32264C15.3433 8.37455 15.181 8.41421 15 8.41421V4.41421C14.1798 4.41421 13.5707 4.77177 13.1744 5.07417C12.8242 5.34136 12.4649 5.70664 12.1716 6L15 8.82843ZM17.8284 6C17.5351 5.70665 17.1758 5.34136 16.8256 5.07417C16.4293 4.77177 15.8202 4.41421 15 4.41421V8.41421C14.819 8.41421 14.6567 8.37455 14.5322 8.32264C14.4236 8.27736 14.3748 8.23555 14.3993 8.25426C14.4248 8.27375 14.482 8.32142 14.5922 8.42615C14.7016 8.53019 14.8281 8.6565 15 8.82843L17.8284 6ZM4.9775 13.1941C4.85793 13.3136 4.52401 13.624 4.29236 14.0332L7.77316 16.0039C7.75915 16.0287 7.7447 16.0522 7.73014 16.0744C7.71565 16.0964 7.70207 16.1155 7.69016 16.1313C7.67837 16.1471 7.66863 16.1591 7.66202 16.1671C7.65871 16.1711 7.65613 16.1741 7.65442 16.1761C7.65271 16.178 7.65178 16.1791 7.65176 16.1791C7.65174 16.1791 7.65252 16.1782 7.65422 16.1764C7.65593 16.1745 7.65842 16.1719 7.66184 16.1683C7.66884 16.1609 7.67852 16.1508 7.692 16.1371C7.7055 16.1233 7.72132 16.1073 7.74066 16.0879C7.76013 16.0683 7.78122 16.0472 7.80593 16.0225L4.9775 13.1941ZM7.80593 16.0225C7.8144 15.9886 7.82164 15.9597 7.82839 15.9329C7.8351 15.9063 7.84068 15.8845 7.84556 15.8659C7.85043 15.8472 7.85407 15.8337 7.8568 15.8239C7.85813 15.8192 7.85914 15.8157 7.85984 15.8132C7.86054 15.8108 7.86088 15.8097 7.86088 15.8097C7.86087 15.8098 7.86046 15.8111 7.85965 15.8136C7.85884 15.8161 7.85758 15.8198 7.85588 15.8247C7.85246 15.8345 7.84713 15.849 7.8397 15.8672C7.8322 15.8856 7.82284 15.9071 7.81141 15.9308C7.79993 15.9547 7.78717 15.9792 7.77316 16.0039L4.29236 14.0332C4.06071 14.4423 3.96637 14.8883 3.92536 15.0524L7.80593 16.0225Z" fill="#8F99B3" mask="url(#path-1-outside-1_1154_12363)" />
                                                        <path d="M12.5 7.5L15.5 5.5L18.5 8.5L16.5 11.5L12.5 7.5Z" fill="#8F99B3" />
                                                    </svg>
                                                </a>

                                            </li>
                                            <!-- <li class="tool tool-view" style="display:none;">
                                                <a class=""
                                                    href="{{url('showResult',['student'=>$student->id,'class'=>$r->class_name])}}">
                                                    <img src="{{url('/')}}/assets/image/result.png" width="16px" alt="">
                                                </a>
                                            </li> -->
                                            <li class="tool tool-delete">
                                                @if(Auth::check() && Auth::user()->user_type == "Admin")
                                                <a data-toggle="tooltip" data-placement="top" data-original-title="Delete" href="javascript:void(0)" type="submit" class="btn-sml deletestudent btn-sml" data-id="{{$student->id}}" data-stdname="{{ Str::title($student->name)}}" data-name="{{$r->id}}">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 15L10 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                                        <path d="M14 15L14 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                                        <path d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                                        <path d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                                    </svg>
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @endforeach
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

                                    <input type="hidden" , name="sid" id="s_id">
                                    <input type="hidden" , name="rid" id="r_id">
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
                            <h4>Add  Student</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body after-design">
                            <form action="{{route('students.store')}}" id="studentAdd" method="Post" enctype="multipart/form-data">
                                @csrf
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <div class="col-12 text-center">
                                <input type="submit" name="save" class="add-btn btn custom-btn" id="butsave" value="Add Student">
                            </div>
                        </div>
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