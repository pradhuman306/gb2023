@extends('layouts.adminlayout')
@section('content')
<div class="page-inner ad-inr">
   
    <section class="main-wrapper">
        <div class="page-color">
            @if(Auth::check() && Auth::user()->user_type == "Admin")
            <div class="page-header">
                <div class="page-title">
                    <div class="head-left">
                        <h4>Add Session</h4>
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
            @endif
            <div class="page-body">
                <div class="session-container">
                    @if(Auth::check() && Auth::user()->user_type == "Admin")
                    <div class="profile-box">
                        <div class="short-code">
                            <form id="add-session-form" method="Post" action="{{route('years.store')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5 class="panel-title">Session</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Add New Session</label><label class="error">*</label>
                                            <input type="text" name="years"
                                                class="form-control @error('years') is-invalid @enderror"
                                                placeholder="E.g. 2018-2019">
                                            @error('years')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="session[]"
                                                value="1" id="current">
                                            <label class="custom-control-label" for="current"><span>Make this session as
                                                    current</span></label>
                                        </div>
                                        </div>
                                        <div class="btn-box">
                                            <button type="submit" class="btn custom-btn add-btn margin-top-15">Add
                                                Session</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if(App\Models\Year::exists())
                    <div class="page-table" id="dvData">
                        <table id="student-table" class="tabel-res custom-table added-session " style="width:100%;">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Session</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                @php $i = 0; @endphp
                                @foreach($years as $r)
                                <tr>
                                    <td>@php echo ++$i @endphp</td>
                                    <td class="students-name">{{$r->years}}</td>
                                    <td>
                                        @if($r->status==1)
                                        <label class="switch">
                                            <input type="checkbox" checked onclick="mySessionfun('session{{($r->id)}}')">
                                            <span class="slider round"></span>
                                        </label>
                                        <a class="active" id="session{{($r->id)}}" href="{{url('remove',$r->id)}}">Deactivate</a>

                                        @else
                                        <label class="switch">
                                            <input type="checkbox" onclick="mySessionfun('session{{($r->id)}}')">
                                            <span class="slider round"></span>
                                        </label>
                                        <a id="session{{($r->id)}}" href="{{url('remove',$r->id)}}">Active</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @if($years->count() == '0')
                                <tr>
                                    <td colspan="3" style="text-align:center">No data available in table</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('additionalscripts')
@endsection