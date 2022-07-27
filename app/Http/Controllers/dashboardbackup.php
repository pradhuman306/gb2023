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
        $report= DB::table("reports")->latest()->take(2)->get()->sum("fees");
        $total = $report;
        $student = 0;
        $year = 0;
        $student = Student::get()->count();
        $session = Year::where('status', '=', 1)->get();
        foreach ($session as $s) {
            $year = $s->years;
        }
       
        $classes = Student_classe::get();
        $users = DB::table('students')
        ->join('records', 'students.id', '=', 'records.students_id')
        ->join('reports', 'records.id', '=', 'reports.records_id')
        ->select('students.*', 'records.class_name', 'reports.fees')->latest()->take(2)->get();
        
       
        $fees = Student_fee::get();


       

        // var_dump($users);
        
        return view('admin.dashboard.index', compact("student", "year", "total","users","classes","fees"));
    }

    public function DateFilter(Request $request)
    {
        $total=0;
        $from = $request->start;
        $to  = $request->end;

        $reports = Report::whereBetween('date',[$from, $to])->selectRaw('fees')->get();
        $len=count($reports);
        for($j=0;$j<$len;$j++){
            $total+=$reports[$j]->fees;
        }
      
           
        
        $report = Report::whereBetween('date', [$from, $to])->selectRaw('records_id')->selectRaw('fees')->get();
        
        $b = array();
        $m=array();
       
        foreach ($report as $re) {
            $record_id = $re->records_id;
            $record_fees =$re->fees;

            $record = Record::where("id", "=", $record_id)->selectRaw('students_id')->selectRaw('class_name')->get();
            $cid = $record[0]->class_name;
            $classes = Student_classe::where("id", "=", $cid)->get();
            array_push($m, $classes[0]->class_name);
          
            $sid = $record[0]->students_id;

            $students = Student::where("id", "=", $sid)->get();
            array_push($b, $students[0]);
        }
        $l = count($b);
       
        $table ='';
        $c=1;
        for ($i = 0; $i < $l; $i++) {
          
            $table .= '<tr>
                    <td>' . $c++. '</td>
                    <td>'.((($b[$i]->profile_picture==NULL)==true) ?'<img class="student-img" src="image/profile_picture/download.png" />':
                    '<img class="student-img" src="image/profile_picture/' . $b[$i]->profile_picture .'"/>').'</td>
                    
                    <td>' . $b[$i]->name . '</td>
                    <td>' . $b[$i]->father_name . '</td>
                    <td>'.$m[$i].'</td>
                    <td></td>
                    <td></td>
                </tr>';
            
        }
         return response()->json(["total"=>$total,"table"=>$table]);
        // return response()->json($table);
    }
}
// @foreach($tests as $test)
// @if($test->id == $r->class_name)
// <td class="sorting_1">{{$test->class_name}}</td>
// @endif
// @endforeach