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
        // $report= DB::table("reports")->latest()->take(5)->get()->sum("fees");
        $total=0;
        $student = 0;
        $year = 0;
        // $student = Student::get()->count();
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
        ->select('students.*', 'records.class_name', 'reports.fees','reports.date')->latest()->take(5)->get();
    
    
    
    
        $fees = Student_fee::get();
          $fees = Student_fee::where('years_id', '=', $y_id)->get();
        $sum=0;
        foreach($users as $u){
            $sum +=$u->fees;
        }

        $total = $sum;

        // var_dump( $sum);
        
        return view('admin.dashboard.index', compact("student", "year", "total","users","classes","fees"));
    }

    public function DateFilter(Request $request)
    {
        $total=0;
        $newfrom =  date("Y-m-d", strtotime($request->start));
        $newto  =date("Y-m-d", strtotime($request->end));
         $from =  date("d/m/Y", strtotime($request->start));
        $to  = date("d/m/Y", strtotime($request->end));
         $from11 =  date("m/d/Y", strtotime($request->start));
        $to11  = date("m/d/Y", strtotime($request->end));
        //   $from =  $request->start;
        //   $to = $request->end;

        $classes = Student_classe::get();
        $fees = Student_fee::get();
        $users = DB::table('students')
        ->join('records', 'students.id', '=', 'records.students_id')
        ->join('reports', 'records.id', '=', 'reports.records_id')
        ->select('students.*', 'records.class_name', 'reports.fees')
        // ->whereBetween('date',[$from, $to])->orWhereBetween('date' , [$newfrom , $newto])->orWhereBetween('date' , [$from11 , $to11])
        // ->whereBetween('reports.created_at', [$newfrom." 00:00:00", $newto." 23:59:59"])->get();
        ->whereBetween('reports.updated_at', [$newfrom." 00:00:00", $newto." 23:59:59"])->get();
            // ->whereBetween('reports.date', [$from, $to])->get();
        
        foreach($users as $u){
            $total += $u->fees;
        }
       
    
       
        $table ='';
        $m=1;
        foreach($users as $u) {
            foreach($classes as $c){
                if($c->id==$u->class_name){
                    $class=$c->class_name;
                }
                foreach($fees as  $f){
                    if($f->student_classes_id==$u->class_name)
                        $fee =$f->amount - $u->fees;
                        
                    }
            }
            $table .= '<tr>
                    <td>' . $m++. '</td>
                    <td>' . $u->name . '</td>
                    <td><span>'. $u->father_name . '</span><span>' . $u->mother_name . '</span></td>
                    <td>'.$class.'</td>
                    <td style="width:130px"><span class="deposit-box">' . $u->fees . '</span></td>
                    <td><span class="remain-box">'.$fee.'</span></td>
                </tr>';
            
        }
         return response()->json(["total"=>$total,"table"=>$table]);
        // return response()->json(  $from);
        
    }
}
