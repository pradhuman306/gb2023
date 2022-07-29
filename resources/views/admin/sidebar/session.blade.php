@extends('layouts.adminlayout')
@section('content')
<div class="page-inner ad-inr">
   
    <section class="main-wrapper">
        <div class="page-color">
            <div class="page-header">
                <div class="page-title">
                    <h3><span>{{$class_name}}</span></h3>
                    <div class="user-drop-sec">
                    <span class="c_session"><b><img src="{{url('/')}}/assets/image/sess.svg" alt=""></b> {{$y_name}} </span>
                        <ul>
                            <li>
                                <a href="javascript:void(0)"><i>
                                        <img src="{{url('/')}}/assets/image/username.svg" class="menu-show" alt="">
                                    </i><span>Hemendra</span>
                                    <span class="drop-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.831" height="6.197" viewBox="0 0 10.831 6.197">
                                            <path id="Icon_ionic-ios-arrow-back" data-name="Icon ionic-ios-arrow-back" d="M13.113,11.6,17.2,7.51a.773.773,0,1,0-1.094-1.091l-4.632,4.629a.771.771,0,0,0-.023,1.065L16.1,16.774a.774.774,0,1,0,1.1-1.09Z" transform="translate(-6.172 17.445) rotate(-90)" fill="#000" />
                                        </svg>
                                    </span></a>
                                <ul>
                                    <li>
                                        <a href="{{ url('/logout') }}">
                                            <i>
                                                <img src="{{url('/')}}/assets/image/logout-01.svg" class="menu-show" alt="">
                                            </i><span>Log Out</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-inr">
                <div class="tabel-head">
                    <div class="form-group">
                        <select name="change" id="changes">
                            @php
                            $posts= App\Models\Student_classe::get();
                            $current_year=$y_id;
                            @endphp
                            @foreach($posts as $post)
                            <option @if(request()->segment(2) == $post->id) selected @endif value="{{ $post->id }}" session="{{$current_year}}">{{$post->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tabel-head-right">
                        <form action="{{ route('import') }}" method="Post" enctype="multipart/form-data" class="export-form">
                            @csrf
                            <input type="file" name="file" id="file" class="my-profile-choose-file">
                            <input type="submit" id="submit" style="display: none;">
                            <a href="#" class="import btn-data" role='button'>
                                <img src="{{url('/')}}/assets/image/import.svg" alt="">
                            </a>
                            <a href="#" id="export" class="btn-data" role='button'>
                                <img src="{{url('/')}}/assets/image/export.svg" alt="">
                            </a>
                        </form>
                        <div class="page-btn">
                            <a href="javascript:void(0)" class="add-btn addStudent">Add Student</a>
                        </div>
                    </div>
                </div>
                <form id="frm-example" action="javascript:void(0)" method="get">
                    <div class="page-table" id="dvData">
                        <table id="class-table" class="tabel-res checkbox-table  " style="width:100%;">
                            <thead>
                                <tr>
                                    <!-- <th class="width-30"></th> -->
                                    <th class="width-30">#</th>
                                    <th class="width-160">Name</th>
                                    <th class="width-50">Id</th>
                                    <th>Scholar No.</th>
                                    <th>Address</th>
                                    <th>Aadhar Number</th>
                                    <th>Mob No.</th>
                                    <th>Actions</th>
                                    <!-- <th>Bank Acc/No.</th> -->
                                    <!-- <th>Class</th> -->
                                    <!-- <th>D.O.B</th> -->
                                    <!-- <th style="display: none;">Profile</th> -->
                                    <!-- <th>Samagar Id</th> -->
                                </tr>
                            </thead>
                            <tbody id="result">
                                @php $i = 0; @endphp
                                @foreach($tests as $t)
                                @foreach($b as $student)
                                @if($t->students_id==$student->id)
                                <tr>
                                    <td class="width-30">{{$student->id}}</td>
                                    <!-- <td class="width-30">@php echo ++$i @endphp</td> -->
                                    <td class="width-160"><b>{{$student->name}}</b><br>
                                        <div class="user-dtls">
                                            <span><img src="{{url('/')}}/assets/image/men.svg" alt="">{{ strtolower($student->father_name)}}</span>
                                            <span><img src="{{url('/')}}/assets/image/women.svg" alt="">{{ strtolower($student->mother_name)}}</span>
                                        </div>
                                    </td>
                                    <td class="width-50">{{$student->student_id}}</td>
                                    <td>{{$student->scholar_no}}</td>
                                    <td>{{$student->address}}</td>
                                    <td>{{$student->aadhar_no}}</td>
                                    <td>{{$student->mobile_no}} <br>
                                        {{$student->mobile_no2}}
                                    </td>
                                    <td>
                                    <ul class="d-flex">
                                        <li class="tool tool-view">
                                            <a class="studentpopup" data-id="{{$student->id}}" data-href="{{route('students.edit',$student->id)}}" fees-href="{{url('show',['student'=>$student->id,'session'=>$t->session])}}">  <img src="{{url('/')}}/assets/image/feather-eye.svg" width="16px" alt=""> </a>
                                            <span class="tooltips">Preview</span>
                                        </li>

                                        <li class="tool tool-delete">
                                            @if(Auth::check() && Auth::user()->user_type == "Admin")
                                            <a href="javascript:void(0)" type="submit" class="delete-btn deletestudent" data-id="{{$student->id}}" data-name="{{$t->id}}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 15L10 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M14 15L14 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
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
                    
                    <p><button type="submit" data-toggle="modal" data-target="#promoteModal">Promote</button></p>
                    <div class="container">
                      
                </form>
                  <!-- The Modal -->
                  <div class="modal" id="promoteModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center width-100">Student Promote</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="#8F99B3" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6 6L18 18" stroke="#8F99B3" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('promote') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="students_id" id="promote" value="">
                                            <div class="form-group">
                                            <select name="year" id="year">
                                                <option value="">Session</option>
                                                @foreach($year as $y)
                                                @if($y->status!=1)
                                                <option value="{{$y->id}}">{{$y->years}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="form-group">
                                            <select name="class" id="class">
                                                <option value="">Class</option>
                                                @foreach($allclass as $c)
                                                <option value="{{$c->id}}">{{$c->class_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="form-group">
                                            <input type="submit" value="Add" class="add-btn align-center">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
            </section>
</div>

@endsection
@section('additionalscripts')>
@endsection