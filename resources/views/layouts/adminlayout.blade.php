<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G.B.Convent</title>
    <link rel="shortcut icon" href="{{url('/')}}/assets/image/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{url('/')}}/assets/css/global.css">
</head>
<body>
    <div class="overlay"></div>
    <div class="loader-wrap">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- dashboard starts here -->
    <main>
        <!-- sidebar start -->
        <aside class="main-aside">
            <div class="sidebar-wrapper">

                <div class="overlay-close"></div>
                <!-- navigations  -->
                <div class="menu-button">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-head">
                        <a href="javascript:void(0)">
                            <figure><img class="desk-show" src="{{url('/')}}/assets/image/new-white-logo.svg" alt="">
                            </figure>
                            <label>
                                <span>GB Convent</span>
                                @php echo Auth::user()->user_type @endphp
                            </label>
                        </a>
                    </div>
                    <div class="menu-body">
                        <ul class="menu-wrap">
                            <li @if(request()->segment(1) == 'dashboard') class="active" @endif>
                                <a href="{{ url('/dashboard') }}">

                                    <svg class="icon-dashboard" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 12.7596C5 11.4019 5 10.723 5.27446 10.1262C5.54892 9.52949 6.06437 9.08769 7.09525 8.20407L8.09525 7.34693C9.95857 5.7498 10.8902 4.95123 12 4.95123C13.1098 4.95123 14.0414 5.7498 15.9047 7.34693L16.9047 8.20407C17.9356 9.08769 18.4511 9.52949 18.7255 10.1262C19 10.723 19 11.4019 19 12.7596V17C19 18.8856 19 19.8284 18.4142 20.4142C17.8284 21 16.8856 21 15 21H9C7.11438 21 6.17157 21 5.58579 20.4142C5 19.8284 5 18.8856 5 17V12.7596Z" stroke="#8F99B3" stroke-width="2" />
                                        <path d="M14.5 21V16C14.5 15.4477 14.0523 15 13.5 15H10.5C9.94772 15 9.5 15.4477 9.5 16V21" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li @if(request()->segment(1) == 'students') class="active" @endif>
                                <a href="{{ url('/students') }}" class="student">

                                    <svg class="icon-students" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.7274 20.4471C19.2716 19.1713 18.2672 18.0439 16.8701 17.2399C15.4729 16.4358 13.7611 16 12 16C10.2389 16 8.52706 16.4358 7.12991 17.2399C5.73276 18.0439 4.72839 19.1713 4.27259 20.4471" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <circle cx="12" cy="8" r="4" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                    @php
                                    $yearData = App\Models\Year::get();
                                    foreach($yearData as $y){
                                    if($y->status==1){
                                    $y_id=$y->id;
                                    }
                                    }
                                    $records = App\Models\Record::where("session","=",$y_id)->get();
                                    $studentCount = 0
                                    @endphp
                                    @foreach($records as $r)
                                    @php
                                    $studentCount += App\Models\Student::Where('id', $r->students_id)->get()->count();
                                    @endphp
                                    @endforeach
                                    <span>Students <small class="badge badge-primary">{{$studentCount}}</small> </span>
                                </a>
                            </li>

                            @if(Auth::check() && Auth::user()->user_type == "Accountant")
                            <li style="display:none">
                                <a href="javascript:void(0)">

                                    <svg class="icon-sessions" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="6" width="18" height="15" rx="2" stroke="#8F99B3" stroke-width="2" />
                                        <path d="M4 11H20" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M9 16H15" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M8 3L8 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M16 3L16 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                    </svg>

                                    <span>Sessions
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.831" height="6.197" viewBox="0 0 10.831 6.197">
                                            <path class="fill" id="Icon_ionic-ios-arrow-back" data-name="Icon ionic-ios-arrow-back" d="M13.113,11.6,17.2,7.51a.773.773,0,1,0-1.094-1.091l-4.632,4.629a.771.771,0,0,0-.023,1.065L16.1,16.774a.774.774,0,1,0,1.1-1.09Z" transform="translate(-6.172 17.445) rotate(-90)" fill="#000" />
                                        </svg>
                                    </span>

                                </a>
                                @php
                                $posts= App\Models\Year::orderBy('id', 'DESC')->get();
                                @endphp

                                <ul class='sub-menus'>
                                    @foreach($posts as $post)
                                    <li @if(request()->segment(2) == $post->id) class="active" @endif ><a href="{{ url('year',$post->id) }}">{{$post->years}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li style="display:none">
                                <a href="javascript:void(0)">

                                    <svg class="icon-sessions" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="6" width="18" height="15" rx="2" stroke="#8F99B3" stroke-width="2" />
                                        <path d="M4 11H20" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M9 16H15" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M8 3L8 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M16 3L16 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                    </svg>

                                    <span>Sessions
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.831" height="6.197" viewBox="0 0 10.831 6.197">
                                            <path class="fill" id="Icon_ionic-ios-arrow-back" data-name="Icon ionic-ios-arrow-back" d="M13.113,11.6,17.2,7.51a.773.773,0,1,0-1.094-1.091l-4.632,4.629a.771.771,0,0,0-.023,1.065L16.1,16.774a.774.774,0,1,0,1.1-1.09Z" transform="translate(-6.172 17.445) rotate(-90)" fill="#8F99B3" />
                                        </svg>
                                    </span>

                                </a>
                                @php
                                $posts= App\Models\Year::orderBy('id', 'DESC')->get();
                                @endphp

                                <ul class='sub-menus'>
                                    @foreach($posts as $post)
                                    <li @if(request()->segment(2) == $post->id) class="active" @endif ><a href="{{ url('year',$post->id) }}"><span>{{$post->years}}</span></a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <hr>

                            <li @if(request()->segment(1) == 'assignrole') class="active" @endif>

                                <a href="{{ url('/assignrole') }}">

                                    <svg class="icon-assign-role" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd" d="M13.3267 15.0759C12.8886 15.0255 12.4452 15 12 15C10.0805 15 8.19383 15.4738 6.63113 16.3732C5.06902 17.2721 3.88124 18.5702 3.33091 20.1106C3.1451 20.6307 3.41608 21.203 3.93617 21.3888C4.45626 21.5746 5.02851 21.3036 5.21432 20.7835C5.57558 19.7723 6.39653 18.8157 7.62872 18.1066C8.64272 17.523 9.86375 17.1503 11.158 17.0368C11.4889 16.0601 12.3091 15.3092 13.3267 15.0759Z" fill="#8F99B3" />
                                        <path d="M18 14L18 22" stroke="#8F99B3" stroke-width="2.5" stroke-linecap="round" />
                                        <path d="M22 18L14 18" stroke="#8F99B3" stroke-width="2.5" stroke-linecap="round" />
                                    </svg>

                                    <span>Assign Role</span>
                                </a>
                            </li>


                            <li @if(request()->segment(1) == 'feesstructure') class="active" @endif>
                                <a href="{{ url('/feesstructure') }}">

                                    <svg class="icon-fee" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd" d="M5.3067 16.3821C5.64507 16.899 6.04385 17.3775 6.49673 17.8067C7.61893 18.8703 9.02529 19.586 10.5457 19.8671C12.0661 20.1482 13.6354 19.9826 15.0637 19.3905C16.492 18.7984 17.7181 17.8051 18.5937 16.5308C19.4692 15.2564 19.9568 13.7557 19.9973 12.21C20.0378 10.6644 19.6296 9.14014 18.8219 7.82167C18.0143 6.5032 16.8419 5.44701 15.4466 4.78089C14.5023 4.33008 13.4833 4.07101 12.448 4.01294L13.0032 6.08484C13.5483 6.17728 14.0808 6.34509 14.585 6.58577C15.6315 7.08536 16.5108 7.8775 17.1165 8.86635C17.7222 9.8552 18.0284 10.9984 17.998 12.1576C17.9676 13.3168 17.6019 14.4424 16.9453 15.3982C16.2886 16.3539 15.369 17.0989 14.2978 17.543C13.2265 17.9871 12.0496 18.1112 10.9093 17.9004C9.76898 17.6896 8.71421 17.1529 7.87256 16.3551C7.69683 16.1886 7.53195 16.0121 7.3786 15.8269L5.3067 16.3821Z" fill="#8F99B3" />
                                        <path d="M5.91239 4.06647C6.68924 3.47037 7.54796 2.99272 8.46042 2.64739C8.87978 2.48868 9.08946 2.40932 9.28694 2.51053C9.48442 2.61174 9.54649 2.84338 9.67063 3.30667L11.7412 11.0341C11.8632 11.4894 11.9242 11.7171 11.8206 11.8964C11.7171 12.0758 11.4894 12.1368 11.0341 12.2588L3.30667 14.3294C2.84338 14.4535 2.61174 14.5156 2.42535 14.3952C2.23896 14.2747 2.20284 14.0535 2.13061 13.6109C1.97344 12.6481 1.95774 11.6656 2.08555 10.6947C2.25696 9.39275 2.68314 8.13728 3.33975 7C3.99636 5.86272 4.87054 4.8659 5.91239 4.06647Z" stroke="#8F99B3" stroke-width="2" />
                                    </svg>

                                    <span>Fees Structure</span>
                                </a>
                            </li>
                            @endif


                            @if(Auth::check() && Auth::user()->user_type == "Admin")
                            <li @if(request()->segment(1) == 'years') class="active" @endif>
                                <a href="{{ url('/years') }}">

                                    <svg class="icon-add-session" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="6" width="18" height="15" rx="2" stroke="#8F99B3" stroke-width="2" />
                                        <path d="M4 11H20" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M10 16L14 16" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M12 14L12 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M8 3L8 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M16 3L16 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                    </svg>

                                    <span>Add Session</span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::check() && Auth::user()->user_type == "Accountant")
                            <li @if(request()->segment(1) == 'years') class="active" @endif>
                                <a href="{{ url('/years') }}">

                                    <svg class="icon-add-session" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="6" width="18" height="15" rx="2" stroke="#8F99B3" stroke-width="2" />
                                        <path d="M4 11H20" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M10 16L14 16" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M12 14L12 18" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M8 3L8 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M16 3L16 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                    </svg>

                                    <span>Set Session</span>
                                </a>
                            </li>
                            @endif
                            <li @if(request()->segment(1) == 'extrapay') class="active" @endif>
                                <a href="{{ url('/extrapay') }}">

                                    <svg class="icon-due" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="14" r="8" stroke="#8F99B3" stroke-width="2" />
                                        <path d="M12 14L12 11" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M17.5 7.5L19 6" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                        <path d="M10.0681 2.37059C10.1821 2.26427 10.4332 2.17033 10.7825 2.10332C11.1318 2.03632 11.5597 2 12 2C12.4403 2 12.8682 2.03632 13.2175 2.10332C13.5668 2.17033 13.8179 2.26427 13.9319 2.37059" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                                    </svg>

                                    <span>
                                        <!--Extra Pay-->
                                        Old Dues
                                    </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                    <div class="menu-foot">
                        <ul class="menu-foot-wrapper">
                            <hr>
                            <li @if(request()->segment(1) == 'profile') class="active" @endif>
                                <a href="{{ url('/profile') }}">

                                    <svg class="icon-settings" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.08168 13.9445C2.55298 12.9941 2.28862 12.5188 2.28862 12C2.28862 11.4812 2.55298 11.0059 3.08169 10.0555L4.43094 7.63L5.85685 5.24876C6.4156 4.31567 6.69498 3.84912 7.14431 3.5897C7.59364 3.33028 8.13737 3.3216 9.22483 3.30426L12 3.26L14.7752 3.30426C15.8626 3.3216 16.4064 3.33028 16.8557 3.5897C17.305 3.84912 17.5844 4.31567 18.1431 5.24876L19.5691 7.63L20.9183 10.0555C21.447 11.0059 21.7114 11.4812 21.7114 12C21.7114 12.5188 21.447 12.9941 20.9183 13.9445L19.5691 16.37L18.1431 18.7512C17.5844 19.6843 17.305 20.1509 16.8557 20.4103C16.4064 20.6697 15.8626 20.6784 14.7752 20.6957L12 20.74L9.22483 20.6957C8.13737 20.6784 7.59364 20.6697 7.14431 20.4103C6.69498 20.1509 6.4156 19.6843 5.85685 18.7512L4.43094 16.37L3.08168 13.9445Z" stroke="#8F99B3" stroke-width="2" />
                                        <circle cx="12" cy="12" r="3" stroke="#8F99B3" stroke-width="2" />
                                    </svg>

                                    <span>Settings</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}">

                                    <svg class="icon-logout" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="fill" d="M2 12L1.21913 11.3753L0.719375 12L1.21913 12.6247L2 12ZM11 13C11.5523 13 12 12.5523 12 12C12 11.4477 11.5523 11 11 11V13ZM5.21913 6.3753L1.21913 11.3753L2.78087 12.6247L6.78087 7.6247L5.21913 6.3753ZM1.21913 12.6247L5.21913 17.6247L6.78087 16.3753L2.78087 11.3753L1.21913 12.6247ZM2 13H11V11H2V13Z" fill="#8F99B3" />
                                        <path class="fill" d="M13.3424 20.5571L13.5068 19.5707L13.3424 20.5571ZM20.9391 20.7477L21.5855 21.5107L20.9391 20.7477ZM15.0136 3.1644L14.8492 2.178L15.0136 3.1644ZM20.9391 3.25232L21.5855 2.4893L20.9391 3.25232ZM13.5068 4.42933L15.178 4.15079L14.8492 2.178L13.178 2.45654L13.5068 4.42933ZM21 9.08276V14.9172H23V9.08276H21ZM15.178 19.8492L13.5068 19.5707L13.178 21.5435L14.8492 21.822L15.178 19.8492ZM11 8.13193V7.38851H9V8.13193H11ZM11 16.6115V16.066H9V16.6115H11ZM13.5068 19.5707C12.6833 19.4334 12.1573 19.3439 11.7726 19.2294C11.4147 19.1228 11.301 19.0276 11.237 18.9521L9.71094 20.2449C10.1209 20.7288 10.6432 20.9799 11.202 21.1462C11.7339 21.3046 12.4052 21.4147 13.178 21.5435L13.5068 19.5707ZM9 16.6115C9 17.395 8.99818 18.0752 9.06695 18.626C9.13917 19.2044 9.30096 19.7609 9.71094 20.2449L11.237 18.9521C11.173 18.8766 11.0978 18.7487 11.0515 18.3782C11.0018 17.9799 11 17.4463 11 16.6115H9ZM21 14.9172C21 16.5917 20.9976 17.7403 20.8773 18.5879C20.7609 19.4077 20.5567 19.7611 20.2927 19.9847L21.5855 21.5107C22.3825 20.8356 22.7086 19.9176 22.8575 18.8689C23.0024 17.8479 23 16.5306 23 14.9172H21ZM14.8492 21.822C16.4406 22.0872 17.7396 22.3061 18.7705 22.3311C19.8294 22.3566 20.7885 22.1858 21.5855 21.5107L20.2927 19.9847C20.0288 20.2082 19.6467 20.3516 18.8189 20.3316C17.963 20.311 16.8297 20.1245 15.178 19.8492L14.8492 21.822ZM15.178 4.15079C16.8297 3.87551 17.963 3.68904 18.8189 3.66836C19.6467 3.64836 20.0288 3.79177 20.2927 4.01534L21.5855 2.4893C20.7885 1.81418 19.8294 1.64336 18.7705 1.66895C17.7396 1.69385 16.4406 1.91277 14.8492 2.178L15.178 4.15079ZM23 9.08276C23 7.46941 23.0024 6.15211 22.8575 5.13109C22.7086 4.08239 22.3825 3.16442 21.5855 2.4893L20.2927 4.01534C20.5567 4.23891 20.7609 4.59225 20.8773 5.41214C20.9976 6.25971 21 7.40829 21 9.08276H23ZM13.178 2.45654C12.4052 2.58534 11.7339 2.69537 11.202 2.85375C10.6432 3.0201 10.1209 3.27116 9.71094 3.75513L11.237 5.04788C11.301 4.97236 11.4147 4.87716 11.7726 4.77061C12.1573 4.65609 12.6833 4.56658 13.5068 4.42933L13.178 2.45654ZM11 7.38851C11 6.55366 11.0018 6.02008 11.0515 5.62183C11.0978 5.25128 11.173 5.1234 11.237 5.04788L9.71094 3.75513C9.30096 4.2391 9.13917 4.79555 9.06695 5.37405C8.99818 5.92484 9 6.60502 9 7.38851H11Z" fill="#8F99B3" />
                                    </svg>

                                    <span>Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </aside>
        @yield('content')
    </main>
    <!-- dashboard ends here -->

    <!-- data table js -->

    <script type="text/javascript" src="{{url('/')}}/assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/validate.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/custom.js"></script>
    <script type="text/javascript" src="{{url('/')}}/assets/js/sweetalert.min.js"></script>
    <script>
        function swalAlert(type, message) {
            Swal.fire({
                position: 'top-end',
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 1500,
            })
        }


        $(".addSession").click(function() {
            $('#mysessionModal').modal('show');
        });


        //  fees javascript 
        $(".addFees").click(function() {
            $('#myfeesModal').modal('show');
        });
        $(".editfees").click(function() {
            var url = $(this).attr('data-href');
            $.ajax({
                url: url,
                method: "GET",
                success: function(fb) {
                    var resp = $.parseJSON(fb);
                    $('#student_classes_ids').html(resp.output);
                    $('#year_ids').html(resp.y_output);
                    $('#main_id').val(resp.id);
                    $('#amounts').val(resp.amount);
                }
            });
            $('#myEfeesModal').modal('show');
        });
        $(document).on('click', '.deleteUser', function() {
            var userID = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $('#deletefeeclass').html(name);
            $('#app_id').val(userID);
            $('#feesDeleteModal').modal('show');
        });

        // student
        $(".addStudent").click(function() {
            $('#myaddModal').modal('show');
        });

        function yearChange() {
            var Newurl = $("#yearchange").val();
            // console.log(Newurl);
            location.href = Newurl;
        }

        // Fees deposite
        $(".deposit-modal").click(function() {
            $('#feeDepositModal').modal('show');
        });
        $(document).on('click', '.deletestudent', function() {
            var userID = $(this).attr('data-id');
            var recordID = $(this).attr('data-name');
            var studentname = $(this).attr('data-stdname');
            $('#studentnamelbl').html(studentname);
            $('#s_id').val(userID);
            $('#r_id').val(recordID);
            $('#studentDeleteModal').modal('show');
        });
        $(document).on('click', '.deletereport', function() {
            var userID = $(this).attr('data-id');

            $('#report_id').val(userID);
            $('#reportDeleteModal').modal('show');
        });

        $('#class_names').on('change', function() {

            class_name = this.value;

            $.ajax({
                url: 'classfilter',
                method: "Post",
                data: {
                    class_name: class_name,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    // console.log($.parseJSON(data));
                    var resp = $.parseJSON(data);
                    $('#student_id').html(resp.selectoption);
                }
            });
        });

        $(".studentpopup").click(function() {
            var url = $(this).attr('data-href');

            $.ajax({
                url: url,
                method: "GET",
                success: function(fb) {
                    var resp = $.parseJSON(fb);
                    $('#student_ids').val(resp.student_ids);
                    $('#scholar_nos').val(resp.scholar_nos);
                    $('#names').val(resp.names);
                    $('#fname').val(resp.fname);
                    $('#mname').val(resp.mname);
                    $('#addres').val(resp.addres);
                    $('#acc').val(resp.acc);
                    $('#m2').val(resp.m2);
                    $('#m1').val(resp.m1);
                    $('#sdob').val(resp.sdob);
                    $('#samargid').val(resp.samargid);
                    $('#aadhar').val(resp.aadhar);
                    $('#classes').html(resp.output);
                    $('#sessions').html(resp.y_output);
                    $('#sIds').val(resp.id);
                    $('#student-id').val(resp.id);
                    $('#old_dues').html(resp.old_dues);
                }
            });
            $('#mystudentModal').modal('show');
        });


        $(".fees-popup").click(function() {
            var fees = $(this).attr('fees-href');

            $.ajax({
                url: fees,
                method: "GET",
                success: function(data) {
                    var resp = $.parseJSON(data);
                    if (resp.success == 0) {
                        // $('#tabs-2').html(resp.message);
                        swalAlert('error', resp.message);
                    } else {
                        $('.student_ids').html(resp.students.student_id);
                        $('.scholar').html(resp.students.scholar_no);
                        $('.s_name').html(resp.students.name);
                        $('.f_name').html(resp.students.father_name);
                        $('.m_name').html(resp.students.mother_name);
                        $('.address').html(resp.students.address);
                        $('.contact').html(resp.students.mobile_no);
                        $('.amounts').html(resp.amount);
                        $('.remaining').html(resp.r);
                        $('#record_id').val(resp.record_id);
                        $('#total_amount').val(resp.amount);
                        $('.student-fees').html(resp.table);
                        $('#profile_pic').html(resp.profile);
                        $('#c_id').val(resp.cid);
                    }
                }
            });
            $('#studentFeeModal').modal('show');
        });

        //import 
        $('.import').click(function() {
            $("#file").click();
        });
        $('#file').change(function() {
            $('#submit').click();
        });
        $('#select_session').change(function() {
            location.href = this.value;
        });

        //export
        $('#export').click(function() {
            $('.buttons-csv').click();
        });

        //edit fees receipt
        $('body').on('click', '.passingID', function() {
            var ids = $(this).attr('data-id');
            var record_id = $(this).attr('record-id');
            var d = $(this).attr('d');
            var r = $(this).attr('r');
            var fee = $(this).attr('fee');
            var dat = $(this).attr('dat');
            $("#idkl").val(record_id);
            $('#main_id').val(ids);
            $('#descriptions').val(d);
            $('#receipt').val(r);
            $('#fee').val(fee);
            $('#dates').val(dat);
            $('#feeEditModal').modal('show');

        });



        //dashboard
        $(".earning").click(function() {
            var start = $("#starts").val();
            var end = $("#ends").val();
            if(start == '' || end == ''){
                
            }else{
            $('.earning').html('Loading...');
            var startresult = start.split('/');
            start = startresult[1] + '/' + startresult[0] + '/' + startresult[2];

            var endresult = end.split('/');
            end = endresult[1] + '/' + endresult[0] + '/' + endresult[2];
            var table = $('.custom-table').DataTable();

            $.ajax({
                url: 'datefilter',
                method: "Post",
                data: {
                    start: start,
                    end: end,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(fb) {
                    table.destroy();
                    $('#total').html(fb.total);
                    $('.fees-tables').html(fb.table);
                    $('.earning').html('Filter');
                    $("#fees-table").DataTable({
                        language: {
                            search: "",
                            searchPlaceholder: "Search...",
                        },
                        lengthMenu: [
                            [5, 10, 50, -1],
                            [5, 10, 50, "All"],
                        ],
                    });
                }
            });
        }
        });
        //assign role
        $(".addUser").click(function() {
            $('#myAssignModal').modal('show');
        });
        $(".editrole").click(function() {
            var url = $(this).attr('data-href');

            $.ajax({
                url: url,
                method: "GET",
                success: function(fb) {

                    var resp = $.parseJSON(fb);
                    // $('#passwords').val(resp.password);
                    $('#uid').val(resp.id);
                    $('#uname').val(resp.name);
                    $('#uuser_type').val(resp.user_type);
                    console.log(resp);
                }
            });
            $('#myAssignEModal').modal('show');
        });
        $(document).on('click', '.deleterole', function() {
            var userID = $(this).attr('data-id');
            var username = $(this).attr('data-name');
            $('#app_id').val(userID);
            $('#userrolename').html(username);
            $('#RoleDeleteModal').modal('show');
        });
        $(document).on('click', '.deletepayment', function() {
            var userID = $(this).attr('data-id');
            $('#payment_id').val(userID);
            $('#paymentDeleteModal').modal('show');
        });

        // group calendar
        $('.input-daterange').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'dd/mm/yyyy'
        });

        // inline calendar
        $('#inline-cal').datepicker({
            todayHighlight: true,
            daysOfWeekHighlighted: "0",
            format: 'dd/mm/yyyy'
        });

        // inline calendar
        $('.birth-date input').datepicker({
            todayHighlight: true,
            daysOfWeekHighlighted: "0",
            format: 'dd/mm/yyyy'
        });

        $('.datepicker-days table').attr('cellspacing', '7');
    </script>
    <script>
        //fees deposite

        function saveData(formId, action_url, responseDiv) {


            formId = '#' + formId;
            var formData = new FormData(jQuery(formId)[0]);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: action_url,
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(res) {

                    var res = jQuery.parseJSON(res);
                    // console.log(res);
                    if (res.status == 'succes') {
                        location.reload();
                    }
                    if (res.status == 'success') {
                        $(formId).trigger('reset');
                        $('.' + responseDiv).html('<div class="alert alert-success">' + res.msg +
                            '<button type="button" class="closedeposite" data-dismiss="modal">x</button></div>'
                        );
                        $('.student-fees').html(res.table);
                        $('.remaining').html(res.re);
                        $(document).click(function(event) {
                            $(".msg").html('');
                        });


                    } else {
                        $('.' + responseDiv).html('<div class="alert alert-danger">' + res.msg + '</div>');
                        setTimeout(function() {
                            $('.' + responseDiv).html('');
                        }, 4000);
                    }
                },

            });
        }

        $('#but-save').click(function() {


            $("#add-fees").validate({
                rules: {
                    fees: {
                        required: true,

                    },
                    receipt_no: {
                        required: true,

                    },
                    date: {
                        required: true,

                    },
                    action: "required"
                },
                messages: {
                    fees: {
                        required: "fees is required",

                    },
                    receipt_no: {
                        required: "receipt no is required",

                    },
                    date: {
                        required: "Date is required",

                    },
                },
                submitHandler: function() {
                    saveData("add-fees", "{{route('reports.store')}}", "msg");
                }
            });
        });


        $("#class-form").validate({
            rules: {
                years_id: {
                    required: true,
                },
                student_classes_id: {
                    required: true,
                },
                amount: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                years_id: {
                    required: "Year is required",
                },
                student_classes_id: {
                    required: "Class is required",
                },
                amount: {
                    required: "Amount is required",
                },
            },
        });


        $("#profile-password").validate({
            rules: {
                oldpassword: {
                    required: true,
                },
                password: {
                    required: true,
                },
                cpassword: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                oldpassword: {
                    required: "Old password is required",
                },
                password: {
                    required: "Password is required",
                },
                cpassword: {
                    required: "Confirm password is required",
                },
            },
        });


        $("#profile-details").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                name: {
                    required: "Name is required",
                },
                email: {
                    required: "Email is required",
                },
            },
        });

        $("#storeuserrole").validate({
            rules: {
                name: {
                    required: true,
                },
                password: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                name: {
                    required: "Name is required",
                },
                password: {
                    required: "Password is required",
                },
            },
        });

        $('#updateuserrole').validate({
            rules: {
                name: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                name: {
                    required: "Name is required",
                },
            },
        });

        $('#add-session-form').validate({
            rules: {
                years: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                years: {
                    required: "Years is required",
                },
            },
        });

        $('#editfeestructure').validate({
            rules: {
                amount: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                amount: {
                    required: "Amount is required",
                },
            },
        });

        $('#date-form').validate({
            rules: {
                start: {
                    required: true,
                },
                end: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                start: {
                    required: "Start date is required",
                },
                end: {
                    required: "End date is required",
                },
            },
        });

        $('#studentAdd').validate({
            rules: {
                name: {
                    required: true,
                },
                father_name: {
                    required: true,
                },
                mother_name: {
                    required: true,
                },
                address: {
                    required: true,
                },
                class_name: {
                    required: true,
                },
                dob: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                name: {
                    required: "Name is required",
                },
                father_name: {
                    required: "Father name is required",
                },
                mother_name: {
                    required: "Mother name is required",
                },
                address: {
                    required: "Address is required",
                },
                class_name: {
                    required: "Class is required",
                },
                dob: {
                    required: "Date of birth is required",
                },

            },
        });

        $('#edit-student').validate({
            rules: {
                name: {
                    required: true,
                },
                father_name: {
                    required: true,
                },
                mother_name: {
                    required: true,
                },
                address: {
                    required: true,
                },
                class_name: {
                    required: true,
                },
                dob: {
                    required: true,
                },
                action: "required"
            },
            messages: {
                name: {
                    required: "Name is required",
                },
                father_name: {
                    required: "Father name is required",
                },
                mother_name: {
                    required: "Mother name is required",
                },
                address: {
                    required: "Address is required",
                },
                class_name: {
                    required: "Class is required",
                },
                dob: {
                    required: "Date of birth is required",
                },
            },
        });


        $('#but-edit').click(function() {
            saveData("edit-fees", "{{url('report')}}", "msg");
        });

        $('.addstudent').click(function() {
            $('#studentModal').modal('show');
            // $('.addfees').click(function() {
            //     saveData("extrapays", "{{url('extraStore')}}", "msg");

            // });
            $('.addfees').click(function() {
                var classval = $('#class_names').val();
                var studentval = $('#student_id').val();
                if (classval == '' && studentval == '') {
                    $('.msg').html('invalid request');
                } else {
                    saveData("extrapays", "{{url('extraStore')}}", "msg");
                }

            });
        });
        $('.showdetails').click(function() {
            var id = $(this).attr('data-id');
            var old = $(this).attr('data-name');
            $.ajax({

                url: "showdetails",
                method: "post",
                data: {
                    id: id,
                    old: old,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(fb) {
                    var res = jQuery.parseJSON(fb);
                    // console.log(res);
                    $('.gave').html(res.gave);
                    $('.take').html(res.due);
                    $('.s_name').html(res.student.name);
                    $('.f_name').html(res.student.fname);
                    $('.m_name').html(res.student.mname);
                    $('#old_pric').val(old);
                    $('#s_id').val(id);
                    $('#showdetail').modal('show');

                }
            });
        });
        $(".addpayment").click(function() {

            var id = $('#s_id').val();
            var old = $('#old_pric').val();
            $('#id').val(id);
            $('#old_price').val(old);
            $('#gavepayment').modal('show');
            $('.addpay').click(function() {
                $("#gave").validate({
                    rules: {
                        price: {
                            required: true,

                        },
                        action: "required"
                    },
                    messages: {
                        price: {
                            required: "amount is required",
                        },

                    },
                    submitHandler: function() {
                        var price = $("#prices").val();
                        var date = $("#dates").val();
                        var detail = $("#details").val();
                        $.ajax({
                            url: 'addpayment',
                            method: "post",
                            data: {
                                old_price: old,
                                id: id,
                                price: price,
                                date: date,
                                detail: detail,
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(fb) {
                                var res = jQuery.parseJSON(fb);
                                $('#gave').trigger('reset');
                                // $('.message').html(
                                //     '<div class="alert alert-success">' + res
                                //     .msg +
                                //     '<button type="button" class="closedeposite" data-dismiss="modal">x</button></div>'
                                // );
                                swalAlert('success', res.msg);

                                $('.gave').html(res.gave);
                                $('.take').html(res.due);
                                // $(document).click(function(event) {
                                //     $(".message").html('');

                                // });
                                //  location.reload();          
                            }
                        });
                    }
                });


            });
        });

        $(".subpayment").click(function() {
            var id = $('#s_id').val();
            var old = $('#old_pric').val();
            $('#ids').val(id);
            $('#oldprice').val(old);
            $('#subpayment').modal('show');

            $('.subpay').click(function() {
                $("#takeamount").validate({
                    rules: {
                        price: {
                            required: true,

                        },

                        action: "required"
                    },
                    messages: {
                        price: {
                            required: "amount is required",

                        },

                    },
                    submitHandler: function() {
                        var price = $("#tprices").val();
                        var date = $("#tdates").val();
                        var detail = $("#tdetails").val();

                        $.ajax({
                            url: 'subpayment',
                            method: "post",
                            data: {
                                old_price: old,
                                id: id,
                                price: price,
                                date: date,
                                detail: detail,
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(fb) {
                                var res = jQuery.parseJSON(fb);
                                $('#takeamount').trigger('reset');
                                // $('.message').html(
                                //     '<div class="alert alert-success">' + res
                                //     .msg +
                                //     '<button type="button" class="closedeposite" data-dismiss="modal">x</button></div>'
                                // );
                                swalAlert('success', res.msg);

                                $('.gave').html(res.gave);
                                $('.take').html(res.due);
                                // $(document).click(function(event) {
                                //     $(".message").html('');

                                // });
                                //  location.reload();       
                            }
                        });

                    }
                });


            });
        });
        //result
        $(document).ready(function() {

            $('.subject1').keyup(function() {
                var res = 0;
                $(".subject1").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total1').val(res);
            });
            $('.subject2').keyup(function() {
                var res = 0;
                $(".subject2").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total2').val(res);
            });
            $('.subject3').keyup(function() {
                var res = 0;
                $(".subject3").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total3').val(res);
            });
            $('.subject4').keyup(function() {
                var res = 0;
                $(".subject4").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total4').val(res);
            });
            $('.subject5').keyup(function() {
                var res = 0;
                $(".subject5").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total5').val(res);
            });
            $('.subject6').keyup(function() {
                var res = 0;
                $(".subject6").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total6').val(res);
            });
            $('.subm1').keyup(function() {
                var res = 0;
                $(".subm1").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total7').val(res);

            });
            $('.subm2').keyup(function() {
                var res = 0;
                $(".subm2").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total8').val(res);
            });
            $('.subm3').keyup(function() {
                var res = 0;
                $(".subm3").each(function() {
                    if (parseInt($(this).val()))
                        res += parseInt($(this).val());
                });
                $('#total9').val(res);
            });
        });

        function mySessionfun(id) {
            var href = $('#' + id).attr('href');
            location.href = href;
        }
    </script>

    @if(Session::has('success'))
    <script>
        swalAlert('success', "{{ Session::get('success') }}");
    </script>
    @endif
    @if(Session::has('error'))
    <script>
        swalAlert('error', "{{ Session::get('error') }}");
    </script>
    @endif

</body>

</html>