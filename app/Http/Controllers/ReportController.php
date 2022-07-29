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
                            <img src="assets/image/feather-edit.svg" width="16px" alt=""></a>
                        <span class="tooltips">Edit</span>
                    </li>
                    <li class="tool tool-delete">
                        <a href="javascript:void(0)" type="submit" class="delete-btn deletereport" data-id="'.$reports[$i]->id.'">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 15L10 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M14 15L14 12" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                        <path d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
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
        Session::flash('success', 'Fees delete successfully!');
        return redirect()->back();

    }
}
