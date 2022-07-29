@extends('layouts.adminlayout')
@section('content')
<div class="page-inner ad-inr">
    <section class="main-wrapper">
        <div class="page-color">

            <div class="page-header">
                <div class="page-title">
                    <div class="head-left">
                        <h4>Fees Structure</h4>
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
                        <div class="page-btn">
                            <a href="javascript:void(0)" class="btn custom-btn addFees">Add Fees Structure</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myfeesModal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title">Add Fess</h4>
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
                        <form id="class-form" method="Post" action="{{route('feesstructure.store')}}">
                            <div class="modal-body">

                                @csrf
                                <div class="row">
                                    <div class="col-md-6 last-input-margin">
                                        <div class="form-group">
                                            <label>Select Session</label><label class="error">*</label>
                                            <select name="years_id" id="years_id" class="form-control">
                                                <option value="" selected>Select Session</option>
                                                @foreach($years as $y)
                                                <option value="{{$y->id}}">{{$y->years}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Class</label><label class="error">*</label>
                                            <select name="student_classes_id" id="student_classes_id"
                                                class="form-control">
                                                <option value="" selected>Select Class</option>
                                                @foreach($classes as $test)
                                                <option value="{{$test->id}}">{{$test->class_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Yearly Fees</label><label class="error">*</label>
                                            <input class="form-control" type="text" placeholder="₹ Fees" name="amount"
                                                id="amount">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 text-center">
                                    <div class="btn-box">
                                        <button type="submit" class="btn  custom-btn add-btn">Add Fees</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="fees-container">
                    <div class="page-table">
                        <table class="custom-table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width:30px">S.No.</th>
                                    <th>Class Name</th>
                                    <th>Fees</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($tests as $test)
                                <tr>
                                    <td>@php echo ++$i @endphp</td>

                                    @foreach($class as $c)
                                    @if($test->student_classes_id == $c->id)
                                    <td class="students-name">{{$c->class_name}}</td>
                                    @endif
                                    @endforeach
                                    <td><label class="custom-badge badge badge-success">{{$test->amount}}</label></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="tool">
                                                <a class="btn-sml edit-btn editfees" data-toggle="tooltip"
                                                    data-placement="top" data-original-title="Edit"
                                                    data-href="{{ route('feesstructure.edit',$test->id) }}"
                                                    data-id="{{$test->id}}" y-id="{{$y->id}}"
                                                    fee-amount="{{$test->amount}}">
                                                    <svg class="nofill" width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <mask id="path-1-outside-1_1154_12363"
                                                            maskUnits="userSpaceOnUse" x="3" y="4" width="17"
                                                            height="17" fill="black">
                                                            <rect fill="white" x="3" y="4" width="17" height="17">
                                                            </rect>
                                                            <path
                                                                d="M13.5858 7.41421L6.39171 14.6083C6.19706 14.8029 6.09974 14.9003 6.03276 15.0186C5.96579 15.1368 5.93241 15.2704 5.86564 15.5374L5.20211 18.1915C5.11186 18.5526 5.06673 18.7331 5.16682 18.8332C5.2669 18.9333 5.44742 18.8881 5.80844 18.7979L5.80845 18.7979L8.46257 18.1344C8.72963 18.0676 8.86316 18.0342 8.98145 17.9672C9.09974 17.9003 9.19706 17.8029 9.39171 17.6083L16.5858 10.4142L16.5858 10.4142C17.2525 9.74755 17.5858 9.41421 17.5858 9C17.5858 8.58579 17.2525 8.25245 16.5858 7.58579L16.4142 7.41421C15.7475 6.74755 15.4142 6.41421 15 6.41421C14.5858 6.41421 14.2525 6.74755 13.5858 7.41421Z">
                                                            </path>
                                                        </mask>
                                                        <path
                                                            d="M6.39171 14.6083L7.80593 16.0225L7.80593 16.0225L6.39171 14.6083ZM13.5858 7.41421L12.1716 6L12.1716 6L13.5858 7.41421ZM16.4142 7.41421L15 8.82843L15 8.82843L16.4142 7.41421ZM16.5858 7.58579L18 6.17157L18 6.17157L16.5858 7.58579ZM16.5858 10.4142L18 11.8284L16.5858 10.4142ZM9.39171 17.6083L7.9775 16.1941L7.9775 16.1941L9.39171 17.6083ZM5.86564 15.5374L7.80593 16.0225L7.80593 16.0225L5.86564 15.5374ZM5.20211 18.1915L3.26183 17.7065H3.26183L5.20211 18.1915ZM5.80845 18.7979L5.32338 16.8576L5.23624 16.8794L5.15141 16.9089L5.80845 18.7979ZM8.46257 18.1344L7.97751 16.1941L7.9775 16.1941L8.46257 18.1344ZM5.16682 18.8332L6.58103 17.419L6.58103 17.419L5.16682 18.8332ZM5.80844 18.7979L6.29351 20.7382L6.38065 20.7164L6.46549 20.6869L5.80844 18.7979ZM8.98145 17.9672L7.99605 16.2268L7.99605 16.2268L8.98145 17.9672ZM16.5858 10.4142L18 11.8284L18 11.8284L16.5858 10.4142ZM6.03276 15.0186L4.29236 14.0332L4.29236 14.0332L6.03276 15.0186ZM7.80593 16.0225L15 8.82843L12.1716 6L4.9775 13.1941L7.80593 16.0225ZM15 8.82843L15.1716 9L18 6.17157L17.8284 6L15 8.82843ZM15.1716 9L7.9775 16.1941L10.8059 19.0225L18 11.8284L15.1716 9ZM3.92536 15.0524L3.26183 17.7065L7.1424 18.6766L7.80593 16.0225L3.92536 15.0524ZM6.29352 20.7382L8.94764 20.0746L7.9775 16.1941L5.32338 16.8576L6.29352 20.7382ZM3.26183 17.7065C3.233 17.8218 3.15055 18.1296 3.12259 18.4155C3.0922 18.7261 3.06509 19.5599 3.7526 20.2474L6.58103 17.419C6.84671 17.6847 6.99914 18.0005 7.06644 18.2928C7.12513 18.5478 7.10965 18.7429 7.10358 18.8049C7.09699 18.8724 7.08792 18.904 7.097 18.8631C7.10537 18.8253 7.11788 18.7747 7.1424 18.6766L3.26183 17.7065ZM5.15141 16.9089L5.1514 16.9089L6.46549 20.6869L6.46549 20.6869L5.15141 16.9089ZM5.32338 16.8576C5.22531 16.8821 5.17467 16.8946 5.13694 16.903C5.09595 16.9121 5.12762 16.903 5.19506 16.8964C5.25712 16.8903 5.45223 16.8749 5.70717 16.9336C5.99955 17.0009 6.31535 17.1533 6.58103 17.419L3.7526 20.2474C4.44011 20.9349 5.27387 20.9078 5.58449 20.8774C5.87039 20.8494 6.17822 20.767 6.29351 20.7382L5.32338 16.8576ZM7.9775 16.1941C7.95279 16.2188 7.9317 16.2399 7.91214 16.2593C7.89271 16.2787 7.87671 16.2945 7.86293 16.308C7.84916 16.3215 7.83911 16.3312 7.83172 16.3382C7.82812 16.3416 7.82545 16.3441 7.8236 16.3458C7.82176 16.3475 7.8209 16.3483 7.82092 16.3482C7.82094 16.3482 7.82198 16.3473 7.82395 16.3456C7.82592 16.3439 7.82893 16.3413 7.83291 16.338C7.84086 16.3314 7.85292 16.3216 7.86866 16.3098C7.88455 16.2979 7.90362 16.2843 7.92564 16.2699C7.94776 16.2553 7.97131 16.2408 7.99605 16.2268L9.96684 19.7076C10.376 19.476 10.6864 19.1421 10.8059 19.0225L7.9775 16.1941ZM8.94764 20.0746C9.11169 20.0336 9.55771 19.9393 9.96685 19.7076L7.99605 16.2268C8.02079 16.2128 8.0453 16.2001 8.06917 16.1886C8.09292 16.1772 8.11438 16.1678 8.13277 16.1603C8.15098 16.1529 8.16553 16.1475 8.17529 16.1441C8.18017 16.1424 8.18394 16.1412 8.18642 16.1404C8.1889 16.1395 8.19024 16.1391 8.19026 16.1391C8.19028 16.1391 8.18918 16.1395 8.18677 16.1402C8.18435 16.1409 8.18084 16.1419 8.17606 16.1432C8.16625 16.1459 8.15278 16.1496 8.13414 16.1544C8.11548 16.1593 8.09368 16.1649 8.0671 16.1716C8.04034 16.1784 8.0114 16.1856 7.97751 16.1941L8.94764 20.0746ZM15.1716 9C15.3435 9.17192 15.4698 9.29842 15.5738 9.40785C15.6786 9.518 15.7263 9.57518 15.7457 9.60073C15.7644 9.62524 15.7226 9.57638 15.6774 9.46782C15.6254 9.34332 15.5858 9.18102 15.5858 9H19.5858C19.5858 8.17978 19.2282 7.57075 18.9258 7.1744C18.6586 6.82421 18.2934 6.46493 18 6.17157L15.1716 9ZM18 11.8284L18 11.8284L15.1716 8.99999L15.1716 9L18 11.8284ZM18 11.8284C18.2934 11.5351 18.6586 11.1758 18.9258 10.8256C19.2282 10.4292 19.5858 9.82022 19.5858 9H15.5858C15.5858 8.81898 15.6254 8.65668 15.6774 8.53218C15.7226 8.42362 15.7644 8.37476 15.7457 8.39927C15.7263 8.42482 15.6786 8.482 15.5738 8.59215C15.4698 8.70157 15.3435 8.82807 15.1716 9L18 11.8284ZM15 8.82843C15.1719 8.6565 15.2984 8.53019 15.4078 8.42615C15.518 8.32142 15.5752 8.27375 15.6007 8.25426C15.6252 8.23555 15.5764 8.27736 15.4678 8.32264C15.3433 8.37455 15.181 8.41421 15 8.41421V4.41421C14.1798 4.41421 13.5707 4.77177 13.1744 5.07417C12.8242 5.34136 12.4649 5.70664 12.1716 6L15 8.82843ZM17.8284 6C17.5351 5.70665 17.1758 5.34136 16.8256 5.07417C16.4293 4.77177 15.8202 4.41421 15 4.41421V8.41421C14.819 8.41421 14.6567 8.37455 14.5322 8.32264C14.4236 8.27736 14.3748 8.23555 14.3993 8.25426C14.4248 8.27375 14.482 8.32142 14.5922 8.42615C14.7016 8.53019 14.8281 8.6565 15 8.82843L17.8284 6ZM4.9775 13.1941C4.85793 13.3136 4.52401 13.624 4.29236 14.0332L7.77316 16.0039C7.75915 16.0287 7.7447 16.0522 7.73014 16.0744C7.71565 16.0964 7.70207 16.1155 7.69016 16.1313C7.67837 16.1471 7.66863 16.1591 7.66202 16.1671C7.65871 16.1711 7.65613 16.1741 7.65442 16.1761C7.65271 16.178 7.65178 16.1791 7.65176 16.1791C7.65174 16.1791 7.65252 16.1782 7.65422 16.1764C7.65593 16.1745 7.65842 16.1719 7.66184 16.1683C7.66884 16.1609 7.67852 16.1508 7.692 16.1371C7.7055 16.1233 7.72132 16.1073 7.74066 16.0879C7.76013 16.0683 7.78122 16.0472 7.80593 16.0225L4.9775 13.1941ZM7.80593 16.0225C7.8144 15.9886 7.82164 15.9597 7.82839 15.9329C7.8351 15.9063 7.84068 15.8845 7.84556 15.8659C7.85043 15.8472 7.85407 15.8337 7.8568 15.8239C7.85813 15.8192 7.85914 15.8157 7.85984 15.8132C7.86054 15.8108 7.86088 15.8097 7.86088 15.8097C7.86087 15.8098 7.86046 15.8111 7.85965 15.8136C7.85884 15.8161 7.85758 15.8198 7.85588 15.8247C7.85246 15.8345 7.84713 15.849 7.8397 15.8672C7.8322 15.8856 7.82284 15.9071 7.81141 15.9308C7.79993 15.9547 7.78717 15.9792 7.77316 16.0039L4.29236 14.0332C4.06071 14.4423 3.96637 14.8883 3.92536 15.0524L7.80593 16.0225Z"
                                                            fill="#8F99B3" mask="url(#path-1-outside-1_1154_12363)">
                                                        </path>
                                                        <path d="M12.5 7.5L15.5 5.5L18.5 8.5L16.5 11.5L12.5 7.5Z"
                                                            fill="#8F99B3"></path>
                                                    </svg>
                                                </a>
                                            </span>

                                            @foreach($class as $c)
                                    @if($test->student_classes_id == $c->id)
                                    @php $clas = $c->class_name; @endphp
                                    @endif
                                    @endforeach

                                            <span class="tool">
                                                @if(Auth::check() && Auth::user()->user_type == "Admin")
                                                <a data-toggle="tooltip" data-placement="top"
                                                    data-original-title="Delete" href="javascript:void(0)" type="submit"
                                                    class="btn-sml delete-btn deleteUser" 
                                                    data-name="{{$clas}}" 
                                                    data-id="{{$test->id}}">
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
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($tests->count() == '0')
                                <tr>
                                    <td colspan="4" style="text-align:center">No data available in table</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- fees delete modal -->
            <div id="feesDeleteModal" class="modal modal-danger fade" tabindex="-1" role="dialog"
                aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-dialog-centered">
                        <form action="{{url('feesdelete')}}" method="POST" class="remove-record-model">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <div class="modal-header">
                                <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Applicant Record
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="#8F99B3" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6 6L18 18" stroke="#8F99B3" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                </button>

                            </div>
                            <div class="modal-body">
                                <span class="alert alert-danger w-100 alert-delete">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="9" stroke="#721c24" stroke-width="2" />
                                        <path
                                            d="M12.5 7.5C12.5 7.77614 12.2761 8 12 8C11.7239 8 11.5 7.77614 11.5 7.5C11.5 7.22386 11.7239 7 12 7C12.2761 7 12.5 7.22386 12.5 7.5Z"
                                            fill="#721c24" stroke="#721c24" />
                                        <path d="M12 17V10" stroke="#721c24" stroke-width="2" />
                                    </svg>
                                    You want you sure delete <span id="deletefeeclass"></span>?</span>
                                <input type="hidden" name="fees_id" id="app_id">
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 text-center">
                                    <div class="btn-box">
                                        <button type="submit"
                                            class="btn custom-btn btn-danger remove-data-from-delete-form">Delete</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- fees edit modal -->
            <div class="modal fade" id="myEfeesModal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Fees</h4>
                            <button type="button" class="close" data-dismiss="modal"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M6 6L18 18" stroke="#CCD2E3" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg></button>
                        </div>
                        <form method="Post" action="{{url('editfees')}}" id="editfeestructure">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="main_id" id="main_id" value="">
                                <input type="hidden" name="class_id" id="class_id" value="">
                                <input type="hidden" name="year_id" id="year_id" value="">
                                <div class="row">
                                    <div class="col-md-6 last-input-margin" style="display: none;">
                                        <div class="form-group">
                                            <label>Current Session</label>
                                            <select class="form-control" name="years_id" id="year_ids">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Class</label><label class="error">*</label>
                                            <select class="form-control" name="student_classes_id"
                                                id="student_classes_ids">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fees</label><label class="error">*</label>
                                            <input class="form-control" type="text" name="amount" id="amounts" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 text-center">
                                    <div class="btn-box">

                                        <button type="submit" class="btn custom-btn add-btn">Update Fees</button>
                                    </div>
                                </div>
                            </div>

                        </form>
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