<?php

namespace App\Http\Controllers;

use App\Models\Student_fee;
use App\Models\Year;
use App\Models\Student_classe;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Record;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total=0;
        $student = 0;
        $year = 0;
         $yearlist = Year::get();
         foreach($yearlist as $y){
            if($y->status==1){
                $y_id=$y->id;
            }
        }
         $student = DB::table('students')
        ->join('records', 'students.id', '=', 'records.students_id')
        ->where('records.session', '=', $y_id)
        ->select('students.*')->get()->count();
        
        $session = Year::where('status', '=', 1)->get();
        foreach ($session as $s) {
            $year = $s->years;
        }
       
        $classes = Student_classe::get();
        $users = DB::table('students')
        ->join('records', 'students.id', '=', 'records.students_id')
        ->join('reports', 'records.id', '=', 'reports.records_id')
        ->where('records.session', '=', $y_id)
        ->select('students.*', 'records.class_name','records.session','reports.fees','reports.date')->latest()->take(5)->get();
    
        $fees = Student_fee::get();
        $sum=0;
        foreach($users as $u){
            $sum +=$u->fees;
        }
        $total = $sum;
        return view('admin.dashboard.index', compact("student", "year", "total","users","classes","fees","yearlist"));
    }

    public function DateFilter(Request $request)
    {
        $total=0;
        $newfrom = date("Y-m-d", strtotime($request->start));
        $newto  = date("Y-m-d", strtotime($request->end));
       
        $yearlist = Year::get();
        foreach($yearlist as $y){
           if($y->status==1){
               $y_id=$y->id;
           }
       }

        $classes = Student_classe::get();
        $fees = Student_fee::get();
        $users = DB::table('students')
        ->join('records', 'students.id', '=', 'records.students_id')
        ->join('reports', 'records.id', '=', 'reports.records_id')
        ->where('records.session', '=', $y_id)
        ->select('students.*', 'records.class_name','records.session', 'reports.fees')
        ->whereBetween('reports.updated_at', [$newfrom." 00:00:00", $newto." 23:59:59"])->get();
        
        foreach($users as $u){
            $total += $u->fees;
        }
       
          $yearlist = Year::get();
         foreach($yearlist as $y){
            if($y->status==1){
                $y_id=$y->id;
            }
        }
       
        $table ='';
        $m=1;
        $fee = 0;
        foreach($users as $u) {
            foreach($classes as $c){
                if($c->id==$u->class_name){
                    $class=$c->class_name;
                }
                foreach($fees as  $f){
                     if($f->student_classes_id==$u->class_name && $f->years_id == $u->session){
                        $fee =$f->amount - $u->fees;
                    }
                    }
            }
            $table .= '<tr>
                    <td class="width-20">' . $m++. '</td>
                    <td class="students-name">' . $u->name . '</td>
                    <td class="width-200">
                    <div class="user-dtls">  
                    <span>'. $u->father_name . '</span><span>' . $u->mother_name . '</span>
                    </div>
                    </td>
                    <td>'.$class.'</td>
                    <td style="width:130px"><span class="deposit-box badge custom-badge badge-success">₹' . $u->fees . '</span></td>
                    <td style="width:130px"><span class="remain-box badge custom-badge badge-danger">₹'.$fee.'</span></td>
                </tr>';
           
        }
         return response()->json(["total"=>$total,"table"=>$table,"y_id"=>$y_id]);
        // return response()->json(  $from);
        
    }
}
