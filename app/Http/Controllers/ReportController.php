<?php

namespace App\Http\Controllers;
use App\Models\Report;
use App\Models\Student;
use App\Models\Student_fee;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    public function index(){
        
    }
    public function create()
    {
      //
    }
    public function store(Request $request){
        
        $reports = new Report;
        $reports->records_id = $request->id;
        $reports->receipt_no = $request->receipt_no;
        $reports->fees = $request->fees;
        $reports->date = $request->date;
        $reports->description = $request->description;
        $reports->save();
        $y_id = $request->year;
        $c_id = $request->cid;

        $r = Student_fee::where("student_classes_id", "=", $c_id )->where("years_id", "=", $y_id)->first();
        $amounts = $r->amount;
        $q = Report::where("records_id", "=", $request->id)->sum('fees');
        $remaining = $amounts-$q;
        $s_id = $request->sid;
       
        $records = Record::where("students_id", "=", $s_id)->where("session", "=", $y_id)->first();
        $record_id = $records->id;
        $reports= Report::where("records_id","=",$record_id)->get();
        $l = count($reports);
        $table = '';
       
        for ($i = 0; $i < $l; $i++) {
      
            $table .= '<tr>
                    <td>' . $reports[$i]->receipt_no . '</td>
                    <td>' . $reports[$i]->fees . '</td>
                    <td>'.$reports[$i]->date.'</td>
                    <td>'.$reports[$i]->description.'</td>
                    <td><ul class="d-flex">
                    <li class="tool tool-edit">
                        <a class="edit-btn passingID" href="javascript:void(0)"  r="'.$reports[$i]->receipt_no.'" dat="'.$reports[$i]->date.'" fee="'.$reports[$i]->fees.'" data-id="'.$reports[$i]->id.'" record-id="'.$reports[$i]->records_id.'" d="'.$reports[$i]->description.'">
                            <img src="http://localhost/GB-convent/assets/image/feather-edit.svg" width="16px" alt=""></a>
                        <span class="tooltips">Edit</span>
                    </li>
                    <li class="tool tool-delete">
                        <a href="javascript:void(0)" type="submit" class="delete-btn deletereport" data-id="'.$reports[$i]->id.'">
                            <img src="http://localhost/GB-convent/assets/image/feather-trash.svg" width="16px" alt="">
                        </a>
                    </li>
                </ul></td>
                </tr>';
            
        }
       
        $arr=["msg"=>"fees deposite","status"=>"success","table"=>$table,"re"=>$remaining];
         
        echo json_encode($arr); 
      
        
    }
    public function show()
    {
       
    
    }
    public function edit($post){
        
    }

    public function update(Request $request){

        $id = $request->main_id;
        $reports =Report::where("id", "=", $id)->first();
        $reports->records_id = $request->id;
        $reports->receipt_no = $request->receipt_no;
        $reports->fees = $request->fees;
        $reports->date = $request->date;
        $reports->description = $request->description;
        $reports->update(); 
        $arr=["msg"=>"fees updated","status"=>"success"];
        echo json_encode($arr); 
    }
    public function destroy(Request $request){
       
        $id = $request->input('sid');
        Report::destroy($id);
        Session::flash('message', 'Fees delete successfully!');
        return redirect()->back();

    }
}
