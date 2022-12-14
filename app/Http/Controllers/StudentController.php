<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Student_classe;
use App\Models\Student;
use App\Models\Record;
use App\Models\Report;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\Student_fee;
use Illuminate\Http\Request;
use Auth;
use Session;
use PDF;

class StudentController extends Controller
{
    public function index()
    {
        
        $class_name=1;
        $students=0;  $y_name=0;
        $tests=0;   $y_id=0; $records=0;
        $tests = Student_classe::all();
        // $records = Record::get();
        $year = Year::get();
        foreach($year as $y){
            if($y->status==1){
                $y_id=$y->id;
                $y_name=$y->years;
            }
        }
        // $records = Record::get();
        $records = Record::where("session","=", $y_id)->get();
      $students=Student::get();
     
        return view('admin.student.index', compact("students", "tests", "records","y_id","y_name","year"));
    }

    public function getserverside(Request $request)
    {
        $limit = $request->length;
        $offset = $request->start;
        $search = $request->search;
        $search = $search['value'];
        $responsedata = array();
        $year = Year::get();
        $selected_session = $request->selected_session;
        if(isset($selected_session)){
            $y_id = $selected_session;
        }else{
            foreach($year as $y){
                if($y->status==1){
                    $y_id=$y->id;
                }
            }
        }
       

        if($search == null || $search == '' || $search == ' '){
            $TotalstudentsWithRecord = DB::table('students')->join('records', 'students.id', '=', 'records.students_id')->join('student_classes', 'records.class_name', '=', 'student_classes.id')->select('students.*', 'student_classes.class_name', 'records.session','records.id as record_id')->where("records.session","=", $y_id)->get();
            $totalrecord = count($TotalstudentsWithRecord);
            if($limit == -1 || $limit == '-1'){
                $studentsWithRecord = DB::table('students')
                ->join('records', 'students.id', '=', 'records.students_id')
                ->join('student_classes', 'records.class_name', '=', 'student_classes.id')
                ->select('students.*', 'student_classes.class_name', 'records.session','records.id as record_id')
                ->where("records.session","=", $y_id)
                ->orderBy('students.id', 'DESC')
                ->get();
            }else{
        $studentsWithRecord = DB::table('students')
            ->join('records', 'students.id', '=', 'records.students_id')
            ->join('student_classes', 'records.class_name', '=', 'student_classes.id')
            ->select('students.*', 'student_classes.class_name', 'records.session','records.id as record_id')
            ->where("records.session","=", $y_id)
            ->orderBy('students.id', 'DESC')
            ->offset($offset)->limit($limit)
            ->get();
        }
        }else{
            $TotalstudentsWithRecord = DB::table('students')->join('records', 'students.id', '=', 'records.students_id')->join('student_classes', 'records.class_name', '=', 'student_classes.id')->select('students.*', 'student_classes.class_name', 'records.session','records.id as record_id')
            ->where("records.session","=", $y_id)
            ->where(function($query) use ($search){
                $query->where('student_classes.class_name', 'LIKE', '%'.$search.'%');
                $query->orWhere('students.name', 'LIKE', '%'.$search.'%');
                $query->orWhere('students.father_name', 'LIKE', '%'.$search.'%');
                $query->orWhere('students.mother_name', 'LIKE', '%'.$search.'%');
                $query->orWhere('students.address', 'LIKE', '%'.$search.'%');
                $query->orWhere('students.aadhar_no', 'LIKE', '%'.$search.'%');
                $query->orWhere('students.mobile_no', 'LIKE', '%'.$search.'%');
                $query->orWhere('students.dob', 'LIKE', '%'.$search.'%');
            })
            ->get();
            $totalrecord = count($TotalstudentsWithRecord);

            if($limit == -1 || $limit == '-1'){
                $studentsWithRecord = DB::table('students')
                ->join('records', 'students.id', '=', 'records.students_id')
                ->join('student_classes', 'records.class_name', '=', 'student_classes.id')
                ->select('students.*', 'student_classes.class_name', 'records.session','records.id as record_id')
                ->where("records.session","=", $y_id)
                ->where(function($query) use ($search){
                    $query->where('student_classes.class_name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.father_name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.mother_name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.address', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.aadhar_no', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.mobile_no', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.dob', 'LIKE', '%'.$search.'%');
                })
                ->orderBy('students.id', 'DESC')
                ->get();
            }else{
                $studentsWithRecord = DB::table('students')
                ->join('records', 'students.id', '=', 'records.students_id')
                ->join('student_classes', 'records.class_name', '=', 'student_classes.id')
                ->select('students.*', 'student_classes.class_name', 'records.session','records.id as record_id')
                ->where("records.session","=", $y_id)
                ->where(function($query) use ($search){
                    $query->where('student_classes.class_name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.father_name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.mother_name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.address', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.aadhar_no', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.mobile_no', 'LIKE', '%'.$search.'%');
                    $query->orWhere('students.dob', 'LIKE', '%'.$search.'%');
                })
                ->orderBy('students.id', 'DESC')
                ->offset($offset)->limit($limit)
                ->get();
            }
        }
          
        foreach ($studentsWithRecord as $key => $stdRecord) {

            $datahref= route("students.edit",["student"=>$stdRecord->id,"session"=>$stdRecord->session]);
            $feeshref= url("show",["student"=>$stdRecord->id,"session"=>$stdRecord->session]);
              $li_one = '<li class="tool tool-view">
                   <a data-toggle="tooltip" data-placement="top" data-original-title="Fees" class="fees-popup btn-sml" data-id="'.$stdRecord->id.'" data-href="'.$datahref.'" fees-href="'.$feeshref.'">
                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M3 8.5C3 7.10218 3 6.40326 3.22836 5.85195C3.53284 5.11687 4.11687 4.53284 4.85195 4.22836C5.40326 4 6.10218 4 7.5 4H16.5C17.8978 4 18.5967 4 19.1481 4.22836C19.8831 4.53284 20.4672 5.11687 20.7716 5.85195C21 6.40326 21 7.10218 21 8.5V9.25C21 9.66421 20.6642 10 20.25 10H20C18.8954 10 18 10.8954 18 12V12C18 13.1046 18.8954 14 20 14H20.25C20.6642 14 21 14.3358 21 14.75V15.5C21 16.8978 21 17.5967 20.7716 18.1481C20.4672 18.8831 19.8831 19.4672 19.1481 19.7716C18.5967 20 17.8978 20 16.5 20H7.5C6.10218 20 5.40326 20 4.85195 19.7716C4.11687 19.4672 3.53284 18.8831 3.22836 18.1481C3 17.5967 3 16.8978 3 15.5V14.75C3 14.3358 3.33579 14 3.75 14H4C5.10457 14 6 13.1046 6 12V12C6 10.8954 5.10457 10 4 10H3.75C3.33579 10 3 9.66421 3 9.25V8.5Z" stroke="#8F99B3" stroke-width="2" />
                           <path d="M11.5568 10.6885C11.7249 10.2536 11.809 10.0361 11.9455 10.0059C11.9814 9.99802 12.0186 9.99802 12.0545 10.0059C12.191 10.0361 12.2751 10.2536 12.4432 10.6885C12.5389 10.9359 12.5867 11.0596 12.6761 11.1437C12.7012 11.1673 12.7284 11.1883 12.7574 11.2065C12.8608 11.2711 12.9899 11.2831 13.248 11.3071C13.685 11.3477 13.9035 11.368 13.9702 11.4973C13.984 11.5241 13.9934 11.5531 13.998 11.5831C14.0201 11.7279 13.8595 11.8796 13.5383 12.1829L13.449 12.2671C13.2989 12.4089 13.2238 12.4798 13.1803 12.5683C13.1543 12.6213 13.1368 12.6785 13.1286 12.7375C13.115 12.8358 13.137 12.9386 13.1809 13.1443L13.1967 13.2178C13.2755 13.5867 13.315 13.7712 13.2657 13.8618C13.2215 13.9433 13.1401 13.9954 13.0501 13.9999C12.9499 14.0048 12.8088 13.8855 12.5265 13.6468C12.3406 13.4895 12.2476 13.4109 12.1443 13.3802C12.05 13.3521 11.95 13.3521 11.8557 13.3802C11.7524 13.4109 11.6594 13.4895 11.4735 13.6468C11.1912 13.8855 11.0501 14.0048 10.9499 13.9999C10.8599 13.9954 10.7785 13.9433 10.7343 13.8618C10.685 13.7712 10.7245 13.5867 10.8033 13.2178L10.8191 13.1443C10.863 12.9386 10.885 12.8358 10.8714 12.7375C10.8632 12.6785 10.8457 12.6213 10.8197 12.5683C10.7762 12.4798 10.7011 12.4089 10.551 12.2671L10.4617 12.1829C10.1405 11.8796 9.97989 11.7279 10.002 11.5831C10.0066 11.5531 10.016 11.5241 10.0298 11.4973C10.0965 11.368 10.315 11.3477 10.752 11.3071C11.0101 11.2831 11.1392 11.2711 11.2426 11.2065C11.2716 11.1883 11.2988 11.1673 11.3239 11.1437C11.4133 11.0596 11.4611 10.9359 11.5568 10.6885Z" fill="#8F99B3" stroke="#8F99B3" />
                       </svg>
                   </a>
               </li>';
               

               $li_two = '<li class="tool tool-view">
                   <a data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="studentpopup btn-sml" data-id="'.$stdRecord->id.'" data-href="'.$datahref.'" fees-href="'.$feeshref.'">
                       <svg class="nofill" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <mask id="path-1-outside-1_1154_12363" maskUnits="userSpaceOnUse" x="3" y="4" width="17" height="17" fill="black">
                               <rect fill="white" x="3" y="4" width="17" height="17" />
                               <path d="M13.5858 7.41421L6.39171 14.6083C6.19706 14.8029 6.09974 14.9003 6.03276 15.0186C5.96579 15.1368 5.93241 15.2704 5.86564 15.5374L5.20211 18.1915C5.11186 18.5526 5.06673 18.7331 5.16682 18.8332C5.2669 18.9333 5.44742 18.8881 5.80844 18.7979L5.80845 18.7979L8.46257 18.1344C8.72963 18.0676 8.86316 18.0342 8.98145 17.9672C9.09974 17.9003 9.19706 17.8029 9.39171 17.6083L16.5858 10.4142L16.5858 10.4142C17.2525 9.74755 17.5858 9.41421 17.5858 9C17.5858 8.58579 17.2525 8.25245 16.5858 7.58579L16.4142 7.41421C15.7475 6.74755 15.4142 6.41421 15 6.41421C14.5858 6.41421 14.2525 6.74755 13.5858 7.41421Z" />
                           </mask>
                           <path d="M6.39171 14.6083L7.80593 16.0225L7.80593 16.0225L6.39171 14.6083ZM13.5858 7.41421L12.1716 6L12.1716 6L13.5858 7.41421ZM16.4142 7.41421L15 8.82843L15 8.82843L16.4142 7.41421ZM16.5858 7.58579L18 6.17157L18 6.17157L16.5858 7.58579ZM16.5858 10.4142L18 11.8284L16.5858 10.4142ZM9.39171 17.6083L7.9775 16.1941L7.9775 16.1941L9.39171 17.6083ZM5.86564 15.5374L7.80593 16.0225L7.80593 16.0225L5.86564 15.5374ZM5.20211 18.1915L3.26183 17.7065H3.26183L5.20211 18.1915ZM5.80845 18.7979L5.32338 16.8576L5.23624 16.8794L5.15141 16.9089L5.80845 18.7979ZM8.46257 18.1344L7.97751 16.1941L7.9775 16.1941L8.46257 18.1344ZM5.16682 18.8332L6.58103 17.419L6.58103 17.419L5.16682 18.8332ZM5.80844 18.7979L6.29351 20.7382L6.38065 20.7164L6.46549 20.6869L5.80844 18.7979ZM8.98145 17.9672L7.99605 16.2268L7.99605 16.2268L8.98145 17.9672ZM16.5858 10.4142L18 11.8284L18 11.8284L16.5858 10.4142ZM6.03276 15.0186L4.29236 14.0332L4.29236 14.0332L6.03276 15.0186ZM7.80593 16.0225L15 8.82843L12.1716 6L4.9775 13.1941L7.80593 16.0225ZM15 8.82843L15.1716 9L18 6.17157L17.8284 6L15 8.82843ZM15.1716 9L7.9775 16.1941L10.8059 19.0225L18 11.8284L15.1716 9ZM3.92536 15.0524L3.26183 17.7065L7.1424 18.6766L7.80593 16.0225L3.92536 15.0524ZM6.29352 20.7382L8.94764 20.0746L7.9775 16.1941L5.32338 16.8576L6.29352 20.7382ZM3.26183 17.7065C3.233 17.8218 3.15055 18.1296 3.12259 18.4155C3.0922 18.7261 3.06509 19.5599 3.7526 20.2474L6.58103 17.419C6.84671 17.6847 6.99914 18.0005 7.06644 18.2928C7.12513 18.5478 7.10965 18.7429 7.10358 18.8049C7.09699 18.8724 7.08792 18.904 7.097 18.8631C7.10537 18.8253 7.11788 18.7747 7.1424 18.6766L3.26183 17.7065ZM5.15141 16.9089L5.1514 16.9089L6.46549 20.6869L6.46549 20.6869L5.15141 16.9089ZM5.32338 16.8576C5.22531 16.8821 5.17467 16.8946 5.13694 16.903C5.09595 16.9121 5.12762 16.903 5.19506 16.8964C5.25712 16.8903 5.45223 16.8749 5.70717 16.9336C5.99955 17.0009 6.31535 17.1533 6.58103 17.419L3.7526 20.2474C4.44011 20.9349 5.27387 20.9078 5.58449 20.8774C5.87039 20.8494 6.17822 20.767 6.29351 20.7382L5.32338 16.8576ZM7.9775 16.1941C7.95279 16.2188 7.9317 16.2399 7.91214 16.2593C7.89271 16.2787 7.87671 16.2945 7.86293 16.308C7.84916 16.3215 7.83911 16.3312 7.83172 16.3382C7.82812 16.3416 7.82545 16.3441 7.8236 16.3458C7.82176 16.3475 7.8209 16.3483 7.82092 16.3482C7.82094 16.3482 7.82198 16.3473 7.82395 16.3456C7.82592 16.3439 7.82893 16.3413 7.83291 16.338C7.84086 16.3314 7.85292 16.3216 7.86866 16.3098C7.88455 16.2979 7.90362 16.2843 7.92564 16.2699C7.94776 16.2553 7.97131 16.2408 7.99605 16.2268L9.96684 19.7076C10.376 19.476 10.6864 19.1421 10.8059 19.0225L7.9775 16.1941ZM8.94764 20.0746C9.11169 20.0336 9.55771 19.9393 9.96685 19.7076L7.99605 16.2268C8.02079 16.2128 8.0453 16.2001 8.06917 16.1886C8.09292 16.1772 8.11438 16.1678 8.13277 16.1603C8.15098 16.1529 8.16553 16.1475 8.17529 16.1441C8.18017 16.1424 8.18394 16.1412 8.18642 16.1404C8.1889 16.1395 8.19024 16.1391 8.19026 16.1391C8.19028 16.1391 8.18918 16.1395 8.18677 16.1402C8.18435 16.1409 8.18084 16.1419 8.17606 16.1432C8.16625 16.1459 8.15278 16.1496 8.13414 16.1544C8.11548 16.1593 8.09368 16.1649 8.0671 16.1716C8.04034 16.1784 8.0114 16.1856 7.97751 16.1941L8.94764 20.0746ZM15.1716 9C15.3435 9.17192 15.4698 9.29842 15.5738 9.40785C15.6786 9.518 15.7263 9.57518 15.7457 9.60073C15.7644 9.62524 15.7226 9.57638 15.6774 9.46782C15.6254 9.34332 15.5858 9.18102 15.5858 9H19.5858C19.5858 8.17978 19.2282 7.57075 18.9258 7.1744C18.6586 6.82421 18.2934 6.46493 18 6.17157L15.1716 9ZM18 11.8284L18 11.8284L15.1716 8.99999L15.1716 9L18 11.8284ZM18 11.8284C18.2934 11.5351 18.6586 11.1758 18.9258 10.8256C19.2282 10.4292 19.5858 9.82022 19.5858 9H15.5858C15.5858 8.81898 15.6254 8.65668 15.6774 8.53218C15.7226 8.42362 15.7644 8.37476 15.7457 8.39927C15.7263 8.42482 15.6786 8.482 15.5738 8.59215C15.4698 8.70157 15.3435 8.82807 15.1716 9L18 11.8284ZM15 8.82843C15.1719 8.6565 15.2984 8.53019 15.4078 8.42615C15.518 8.32142 15.5752 8.27375 15.6007 8.25426C15.6252 8.23555 15.5764 8.27736 15.4678 8.32264C15.3433 8.37455 15.181 8.41421 15 8.41421V4.41421C14.1798 4.41421 13.5707 4.77177 13.1744 5.07417C12.8242 5.34136 12.4649 5.70664 12.1716 6L15 8.82843ZM17.8284 6C17.5351 5.70665 17.1758 5.34136 16.8256 5.07417C16.4293 4.77177 15.8202 4.41421 15 4.41421V8.41421C14.819 8.41421 14.6567 8.37455 14.5322 8.32264C14.4236 8.27736 14.3748 8.23555 14.3993 8.25426C14.4248 8.27375 14.482 8.32142 14.5922 8.42615C14.7016 8.53019 14.8281 8.6565 15 8.82843L17.8284 6ZM4.9775 13.1941C4.85793 13.3136 4.52401 13.624 4.29236 14.0332L7.77316 16.0039C7.75915 16.0287 7.7447 16.0522 7.73014 16.0744C7.71565 16.0964 7.70207 16.1155 7.69016 16.1313C7.67837 16.1471 7.66863 16.1591 7.66202 16.1671C7.65871 16.1711 7.65613 16.1741 7.65442 16.1761C7.65271 16.178 7.65178 16.1791 7.65176 16.1791C7.65174 16.1791 7.65252 16.1782 7.65422 16.1764C7.65593 16.1745 7.65842 16.1719 7.66184 16.1683C7.66884 16.1609 7.67852 16.1508 7.692 16.1371C7.7055 16.1233 7.72132 16.1073 7.74066 16.0879C7.76013 16.0683 7.78122 16.0472 7.80593 16.0225L4.9775 13.1941ZM7.80593 16.0225C7.8144 15.9886 7.82164 15.9597 7.82839 15.9329C7.8351 15.9063 7.84068 15.8845 7.84556 15.8659C7.85043 15.8472 7.85407 15.8337 7.8568 15.8239C7.85813 15.8192 7.85914 15.8157 7.85984 15.8132C7.86054 15.8108 7.86088 15.8097 7.86088 15.8097C7.86087 15.8098 7.86046 15.8111 7.85965 15.8136C7.85884 15.8161 7.85758 15.8198 7.85588 15.8247C7.85246 15.8345 7.84713 15.849 7.8397 15.8672C7.8322 15.8856 7.82284 15.9071 7.81141 15.9308C7.79993 15.9547 7.78717 15.9792 7.77316 16.0039L4.29236 14.0332C4.06071 14.4423 3.96637 14.8883 3.92536 15.0524L7.80593 16.0225Z" fill="#8F99B3" mask="url(#path-1-outside-1_1154_12363)" />
                           <path d="M12.5 7.5L15.5 5.5L18.5 8.5L16.5 11.5L12.5 7.5Z" fill="#8F99B3" />
                       </svg>
                   </a>
               </li>';

               if(Auth::check() && Auth::user()->user_type == "Admin"){
                $li_three = '<li class="tool tool-delete">
                <a data-toggle="tooltip" data-placement="top" data-original-title="Delete" href="javascript:void(0)" type="submit" class="btn-sml deletestudent btn-sml" data-id="'.$stdRecord->id.'" data-stdname="'.$stdRecord->name.'" data-name="'.$stdRecord->record_id.'">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 15L10 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                        <path d="M14 15L14 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                        <path d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                        <path d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059" stroke="#8F99B3" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </a>
                </li>';
               }else{
                $li_three = '';
               }

               $action = '<ul class="d-flex">'.$li_one.$li_two.$li_three.'</ul>';

            $nestedData['one'] = $stdRecord->id;
            $nestedData['two'] = '';
            $nestedData['name'] = '<div class="students-name">'.$stdRecord->name.'
            <span>'.$stdRecord->class_name.'</span></div>';

            $nestedData['parents'] = '<div class="user-dtls">
                                            <span>'.($stdRecord->father_name).'</span>
                                            <span>'.($stdRecord->mother_name).'</span>
                                      </div>';
            $nestedData['std_id'] = '<span class="custom-badge badge badge-primary">'.$stdRecord->student_id.'</span>'; 
            $nestedData['address'] = $stdRecord->address;
            $nestedData['aadhar'] = $stdRecord->aadhar_no;
            $nestedData['mob'] = $stdRecord->mobile_no.'<br>'.$stdRecord->mobile_no2;
            $nestedData['actions'] = $action;
            $responsedata[] = $nestedData;

        }


        $json_data = array(
            "draw"            => intval($request->draw),
            "recordsTotal"    => intval($totalrecord),
            "recordsFiltered" => intval($totalrecord),
            "data"            => !empty($responsedata) ? $responsedata : [],
            'px' => $search
        );

        echo json_encode($json_data);
    }

 
    public function create()
    {
        $tests = Student_classe::all();
        $year = Year::all();

        return view('admin.student.create', compact("tests", "year"));
    }

    public function store(Request $request)
    {
      
        $request->validate([]);

        $students = new Student;
        $students->student_id = $request->student_id;
        $students->scholar_no = $request->scholar_no;
        $students->name = $request->name;
        $students->father_name = $request->father_name;
        $students->mother_name = $request->mother_name;
        $students->address = $request->address;
        $students->aadhar_no = $request->aadhar_no;
        $students->samarg_id = $request->samarg_id;
        $students->dob = $request->dob;

        $students->mobile_no = $request->mobile_no;
        $students->mobile_no2 = $request->mobile_no2;

        $students->account_no = $request->account_no;


        if ($request->hasFile('profile_picture')) {

            $profile = $request->file('profile_picture');
            $file_name = time() . '.' . $profile->getClientOriginalExtension();
            $path = public_path('../image/profile_picture');
            $profile->move($path, $file_name);
            $students->profile_picture = $file_name;
        } else {
            $students->profile_picture = "";
        }
        $students->save();
        $records = new Record;
        $records->students_id = $students->id;
        $records->class_name = $request->class_name;
        $records->session = $request->session;
        $records->save();
        Session::flash('success', 'Student added successfully!');

        return redirect()->back();

    }
    public function show()
    {
       
    }
    public function edit($student, Request $request)
    {
       $year = Year::get();
        foreach($year as $y){
            if($y->status==1){
                $y_id=$y->id;
                $y_name=$y->years;
            }
        }

        if(isset($request->session)){
            $y_id = $request->session;
        }                   
       
        $records = Record::where("students_id", "=", $student)->where("session","=", $y_id)->first();
        $students = Student::where("id", "=", $student)->first();
        $cid=$records->class_name;
        $yid=$records->session;
        $class = Student_classe::all();
           $old_dues = Payment::where("student_id", "=", $students->id)->where("session","=", $y_id)->sum('price');
            $output = '';
            foreach($class as $c){
                $output .= '<option value="'.$c->id. ',' .$records->id.'" '.(($cid == $c->id) ? 'selected="selected"':"").'>'.$c->class_name.'</option>';  
            }

            $year = Year::all();
        $year_output ='';
        foreach($year as $y){
            $year_output .= '<option value="'.$y->id.'" '.(($yid == $y->id) ? 'selected="selected"':"").'>'.$y->years.'</option>';  
        }
            

        $arr = array('id'=>$students->id,'student_ids'=>$students->student_id,'scholar_nos'=>$students->scholar_no,'names'=>$students->name,'fname'=> $students->father_name,'mname'=>$students->mother_name,'addres'=> $students->address,
    'aadhar'=> $students->aadhar_no,'samargid'=>$students->samarg_id,'sdob'=>$students->dob,'m1'=>$students->mobile_no ,'m2'=>$students->mobile_no2,'acc'=> $students->account_no,'output'=>$output,'y_output'=>$year_output,'old_dues'=>$old_dues);
        echo json_encode($arr); 
       
        // return  $cid;
    }

    public function update(Request $request)
    {
        $id = $request->sId;
        $students = Student::where("id", "=", $id)->first();

        $students->student_id = $request->student_id;
        $students->scholar_no = $request->scholar_no;
        $students->name = $request->name;
        $students->father_name = $request->father_name;
        $students->mother_name = $request->mother_name;
        $students->address = $request->address;
        $students->aadhar_no = $request->aadhar_no;
        $students->samarg_id = $request->samarg_id;
        $students->dob = $request->dob;

        $students->mobile_no = $request->mobile_no;
        $students->mobile_no2 = $request->mobile_no2;

        $students->account_no = $request->account_no;
        if ($request->hasFile('profile_picture')) {

            $profile = $request->file('profile_picture');
            $file_name = time() . '.' . $profile->getClientOriginalExtension();
            $path = public_path('../image/profile_picture');
            $profile->move($path, $file_name);
            $students->profile_picture = $file_name;
        } else {

            $profile =  $students->profile_picture;
            $students->profile_picture = $profile;
        }

        $students->update();

        $record_id = explode(',', $request->class_name)[1];
        $class = explode(',', $request->class_name)[0];

        $records = Record::where("id", "=", $record_id)->first();
        $records->students_id = $students->id;
        $records->session = $request->session;
        $records->class_name = $class;
        $records->update();
        Session::flash('success', 'Data updated successfully!');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $id = $request->input('sid');
        $rid = $request->input('rid');
       $year = Year::get();
        foreach($year as $y){
            if($y->status==1){
                $y_id=$y->id;
            }
        }
        // Student::destroy($id);
        // Record::destroy($rid);
        Record::where('session', $y_id)->where('id', $rid)->delete();

        Session::flash('success', 'Data deleted successfully!');
        return redirect()->back();
    }
     public function delete(Request $request)
    {
        // 
    }
    public function ShowResult($student,$class){
        $tests = Student_classe::where('id','=',$class)->get();
        
      
        foreach($tests as $class){
            if($class->id){
               $class_name= $class->class_name;
  
            }
        }
        $students = Student::where("id", "=", $student)->first();
        return view('admin.student.result',compact("students","class_name"));
    }
    public function PrintResult(Request $request){
        
        $students = Student::where("id", "=", $request->student_id)->first();
        $data = $request->all();
        $pdf = PDF::loadView('admin.student.Presult',array('students' => $students,'data'=>$data))->setPaper('a4', 'landscape');
        return $pdf->download('test_pdf.pdf');
        // return $pdf->stream('test_pdf.pdf');
        
        
    }
    public function StudentShow($student,$session){
        
     
        $records = Record::where("students_id", "=", $student)->where("session", "=", $session)->first();
       
        $year = Year::where("id", "=",$session)->first();
        $sessions = $year->years;
        $session_id = $year->id;
        $classes = Student_classe::where("id", "=", $records->class_name)->first();
        $class = $classes->class_name;
        $c_id = $classes->id;


        if(Student_fee::where("student_classes_id", "=", $records->class_name)->where("years_id", "=",$session)->exists()) {
            $tests = Student_fee::where("student_classes_id", "=", $records->class_name)->where("years_id", "=",$session)->first();


            $amount = $tests->amount;

            $sum = Report::where("records_id", "=", $records->id)->sum('fees');

            $r = $amount - $sum;

            $students = Student::where("id", "=", $student)->first();
            $record_id = $records->id;

            $url=url("image/profile_picture").'/'.$students->profile_picture;
            $durl=url("image/profile_picture/download.png");

            $reports= Report::where("records_id","=",$record_id)->get();
            $l = count($reports);
            $table = '';
          if(Auth::user()->user_type == "Admin"){
                for ($i = 0; $i < $l; $i++) {
          
                $table .= '<tr>
                        <td>' . $reports[$i]->receipt_no . '</td>
                        <td>' . $reports[$i]->fees . '</td>
                        <td>'.$reports[$i]->date.'</td>
                        <td>'.$reports[$i]->description.'</td>
                        <td><ul class="d-flex">
                        <li class="tool tool-edit">
                        <a class="btn-sml passingID" href="javascript:void(0)"  r="'.$reports[$i]->receipt_no.'" dat="'.$reports[$i]->date.'" fee="'.$reports[$i]->fees.'" data-id="'.$reports[$i]->id.'" record-id="'.$reports[$i]->records_id.'" d="'.$reports[$i]->description.'">
                        <svg class="nofill" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <mask id="path-1-outside-1_1154_12363" maskUnits="userSpaceOnUse" x="3" y="4" width="17" height="17" fill="black">
                                                            <rect fill="white" x="3" y="4" width="17" height="17"></rect>
                                                            <path d="M13.5858 7.41421L6.39171 14.6083C6.19706 14.8029 6.09974 14.9003 6.03276 15.0186C5.96579 15.1368 5.93241 15.2704 5.86564 15.5374L5.20211 18.1915C5.11186 18.5526 5.06673 18.7331 5.16682 18.8332C5.2669 18.9333 5.44742 18.8881 5.80844 18.7979L5.80845 18.7979L8.46257 18.1344C8.72963 18.0676 8.86316 18.0342 8.98145 17.9672C9.09974 17.9003 9.19706 17.8029 9.39171 17.6083L16.5858 10.4142L16.5858 10.4142C17.2525 9.74755 17.5858 9.41421 17.5858 9C17.5858 8.58579 17.2525 8.25245 16.5858 7.58579L16.4142 7.41421C15.7475 6.74755 15.4142 6.41421 15 6.41421C14.5858 6.41421 14.2525 6.74755 13.5858 7.41421Z"></path>
                                                        </mask>
                                                        <path d="M6.39171 14.6083L7.80593 16.0225L7.80593 16.0225L6.39171 14.6083ZM13.5858 7.41421L12.1716 6L12.1716 6L13.5858 7.41421ZM16.4142 7.41421L15 8.82843L15 8.82843L16.4142 7.41421ZM16.5858 7.58579L18 6.17157L18 6.17157L16.5858 7.58579ZM16.5858 10.4142L18 11.8284L16.5858 10.4142ZM9.39171 17.6083L7.9775 16.1941L7.9775 16.1941L9.39171 17.6083ZM5.86564 15.5374L7.80593 16.0225L7.80593 16.0225L5.86564 15.5374ZM5.20211 18.1915L3.26183 17.7065H3.26183L5.20211 18.1915ZM5.80845 18.7979L5.32338 16.8576L5.23624 16.8794L5.15141 16.9089L5.80845 18.7979ZM8.46257 18.1344L7.97751 16.1941L7.9775 16.1941L8.46257 18.1344ZM5.16682 18.8332L6.58103 17.419L6.58103 17.419L5.16682 18.8332ZM5.80844 18.7979L6.29351 20.7382L6.38065 20.7164L6.46549 20.6869L5.80844 18.7979ZM8.98145 17.9672L7.99605 16.2268L7.99605 16.2268L8.98145 17.9672ZM16.5858 10.4142L18 11.8284L18 11.8284L16.5858 10.4142ZM6.03276 15.0186L4.29236 14.0332L4.29236 14.0332L6.03276 15.0186ZM7.80593 16.0225L15 8.82843L12.1716 6L4.9775 13.1941L7.80593 16.0225ZM15 8.82843L15.1716 9L18 6.17157L17.8284 6L15 8.82843ZM15.1716 9L7.9775 16.1941L10.8059 19.0225L18 11.8284L15.1716 9ZM3.92536 15.0524L3.26183 17.7065L7.1424 18.6766L7.80593 16.0225L3.92536 15.0524ZM6.29352 20.7382L8.94764 20.0746L7.9775 16.1941L5.32338 16.8576L6.29352 20.7382ZM3.26183 17.7065C3.233 17.8218 3.15055 18.1296 3.12259 18.4155C3.0922 18.7261 3.06509 19.5599 3.7526 20.2474L6.58103 17.419C6.84671 17.6847 6.99914 18.0005 7.06644 18.2928C7.12513 18.5478 7.10965 18.7429 7.10358 18.8049C7.09699 18.8724 7.08792 18.904 7.097 18.8631C7.10537 18.8253 7.11788 18.7747 7.1424 18.6766L3.26183 17.7065ZM5.15141 16.9089L5.1514 16.9089L6.46549 20.6869L6.46549 20.6869L5.15141 16.9089ZM5.32338 16.8576C5.22531 16.8821 5.17467 16.8946 5.13694 16.903C5.09595 16.9121 5.12762 16.903 5.19506 16.8964C5.25712 16.8903 5.45223 16.8749 5.70717 16.9336C5.99955 17.0009 6.31535 17.1533 6.58103 17.419L3.7526 20.2474C4.44011 20.9349 5.27387 20.9078 5.58449 20.8774C5.87039 20.8494 6.17822 20.767 6.29351 20.7382L5.32338 16.8576ZM7.9775 16.1941C7.95279 16.2188 7.9317 16.2399 7.91214 16.2593C7.89271 16.2787 7.87671 16.2945 7.86293 16.308C7.84916 16.3215 7.83911 16.3312 7.83172 16.3382C7.82812 16.3416 7.82545 16.3441 7.8236 16.3458C7.82176 16.3475 7.8209 16.3483 7.82092 16.3482C7.82094 16.3482 7.82198 16.3473 7.82395 16.3456C7.82592 16.3439 7.82893 16.3413 7.83291 16.338C7.84086 16.3314 7.85292 16.3216 7.86866 16.3098C7.88455 16.2979 7.90362 16.2843 7.92564 16.2699C7.94776 16.2553 7.97131 16.2408 7.99605 16.2268L9.96684 19.7076C10.376 19.476 10.6864 19.1421 10.8059 19.0225L7.9775 16.1941ZM8.94764 20.0746C9.11169 20.0336 9.55771 19.9393 9.96685 19.7076L7.99605 16.2268C8.02079 16.2128 8.0453 16.2001 8.06917 16.1886C8.09292 16.1772 8.11438 16.1678 8.13277 16.1603C8.15098 16.1529 8.16553 16.1475 8.17529 16.1441C8.18017 16.1424 8.18394 16.1412 8.18642 16.1404C8.1889 16.1395 8.19024 16.1391 8.19026 16.1391C8.19028 16.1391 8.18918 16.1395 8.18677 16.1402C8.18435 16.1409 8.18084 16.1419 8.17606 16.1432C8.16625 16.1459 8.15278 16.1496 8.13414 16.1544C8.11548 16.1593 8.09368 16.1649 8.0671 16.1716C8.04034 16.1784 8.0114 16.1856 7.97751 16.1941L8.94764 20.0746ZM15.1716 9C15.3435 9.17192 15.4698 9.29842 15.5738 9.40785C15.6786 9.518 15.7263 9.57518 15.7457 9.60073C15.7644 9.62524 15.7226 9.57638 15.6774 9.46782C15.6254 9.34332 15.5858 9.18102 15.5858 9H19.5858C19.5858 8.17978 19.2282 7.57075 18.9258 7.1744C18.6586 6.82421 18.2934 6.46493 18 6.17157L15.1716 9ZM18 11.8284L18 11.8284L15.1716 8.99999L15.1716 9L18 11.8284ZM18 11.8284C18.2934 11.5351 18.6586 11.1758 18.9258 10.8256C19.2282 10.4292 19.5858 9.82022 19.5858 9H15.5858C15.5858 8.81898 15.6254 8.65668 15.6774 8.53218C15.7226 8.42362 15.7644 8.37476 15.7457 8.39927C15.7263 8.42482 15.6786 8.482 15.5738 8.59215C15.4698 8.70157 15.3435 8.82807 15.1716 9L18 11.8284ZM15 8.82843C15.1719 8.6565 15.2984 8.53019 15.4078 8.42615C15.518 8.32142 15.5752 8.27375 15.6007 8.25426C15.6252 8.23555 15.5764 8.27736 15.4678 8.32264C15.3433 8.37455 15.181 8.41421 15 8.41421V4.41421C14.1798 4.41421 13.5707 4.77177 13.1744 5.07417C12.8242 5.34136 12.4649 5.70664 12.1716 6L15 8.82843ZM17.8284 6C17.5351 5.70665 17.1758 5.34136 16.8256 5.07417C16.4293 4.77177 15.8202 4.41421 15 4.41421V8.41421C14.819 8.41421 14.6567 8.37455 14.5322 8.32264C14.4236 8.27736 14.3748 8.23555 14.3993 8.25426C14.4248 8.27375 14.482 8.32142 14.5922 8.42615C14.7016 8.53019 14.8281 8.6565 15 8.82843L17.8284 6ZM4.9775 13.1941C4.85793 13.3136 4.52401 13.624 4.29236 14.0332L7.77316 16.0039C7.75915 16.0287 7.7447 16.0522 7.73014 16.0744C7.71565 16.0964 7.70207 16.1155 7.69016 16.1313C7.67837 16.1471 7.66863 16.1591 7.66202 16.1671C7.65871 16.1711 7.65613 16.1741 7.65442 16.1761C7.65271 16.178 7.65178 16.1791 7.65176 16.1791C7.65174 16.1791 7.65252 16.1782 7.65422 16.1764C7.65593 16.1745 7.65842 16.1719 7.66184 16.1683C7.66884 16.1609 7.67852 16.1508 7.692 16.1371C7.7055 16.1233 7.72132 16.1073 7.74066 16.0879C7.76013 16.0683 7.78122 16.0472 7.80593 16.0225L4.9775 13.1941ZM7.80593 16.0225C7.8144 15.9886 7.82164 15.9597 7.82839 15.9329C7.8351 15.9063 7.84068 15.8845 7.84556 15.8659C7.85043 15.8472 7.85407 15.8337 7.8568 15.8239C7.85813 15.8192 7.85914 15.8157 7.85984 15.8132C7.86054 15.8108 7.86088 15.8097 7.86088 15.8097C7.86087 15.8098 7.86046 15.8111 7.85965 15.8136C7.85884 15.8161 7.85758 15.8198 7.85588 15.8247C7.85246 15.8345 7.84713 15.849 7.8397 15.8672C7.8322 15.8856 7.82284 15.9071 7.81141 15.9308C7.79993 15.9547 7.78717 15.9792 7.77316 16.0039L4.29236 14.0332C4.06071 14.4423 3.96637 14.8883 3.92536 15.0524L7.80593 16.0225Z" fill="#8F99B3" mask="url(#path-1-outside-1_1154_12363)"></path>
                                                        <path d="M12.5 7.5L15.5 5.5L18.5 8.5L16.5 11.5L12.5 7.5Z" fill="#8F99B3"></path>
                                                    </svg>
                        </a>
                        </li>
                        <li class="tool tool-delete">
                        <a href="javascript:void(0)" type="submit" class="btn-sml delete-btn deletereport" data-id="'.$reports[$i]->id.'"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 15L10 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M14 15L14 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                    </svg></a>
                        </li>
                        </ul></td></tr>';
            }
            
          }else{
               for ($i = 0; $i < $l; $i++) {
          
                $table .= '<tr>
                        <td>' . $reports[$i]->receipt_no . '</td>
                        <td>' . $reports[$i]->fees . '</td>
                        <td>'.$reports[$i]->date.'</td>
                        <td>'.$reports[$i]->description.'</td>
                        </tr>';
            }
          }
        //  . $ad ? 
        //   : '' .
           

            $profile= '<div class="stuedent-img">'.((($students->profile_picture==NULL)==true) ?'<img class="student-img" src="'.$durl.'" />':
            '<img class="student-img" src="'.$url.'"/>').'</div>';
            $arr = array('students'=>$students,'students_id'=>$student,'amount'=>$amount,'class'=>$class,'sessions'=>$sessions,'record_id'=>$record_id,'session_id'=>$session_id,'r'=>$r,'table'=>$table,'profile'=>$profile,'cid'=>$c_id);
            echo json_encode($arr); 
           
        } 
        else {
            $arr=["message"=>"First fill fees details of class $class ($year->years) !" ,"success"=>0];
            echo json_encode($arr); 
            
        }
    
    }
}
