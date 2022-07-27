<?php

namespace App\Http\Controllers;
use App\Models\Student_classe;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Repayment;
use Illuminate\Http\Request;

class ExtrapayController extends Controller
{
    public function index(){
        $students =Payment::get();
        $class = Student_classe::get();
        $studentdata = Student::get();
        return view ('admin.extra.index',compact("class","students","studentdata"));
    }


    public function store(Request $request){

        $payments = new Payment;
        $payments->student_id = $request->name;
        $payments->name = $request->name;
        $payments->fname = $request->father_name;
        $payments->mname = $request->mother_name;
        $payments->class = $request->class_name;
        $payments->price = 0;
        $payments->save();
       
            
        $arr=["msg"=>"student added","status"=>"succes"];
         echo json_encode($arr); 
     }
     public function showDetails(Request $request){
        $id=$request->id;
        $old=$request->old;
        // $student =Payment::find($id);
         $studentpay =Payment::find($id);
        $student =Student::find($studentpay->name);

       
        $gave = Repayment::where("payments_id", "=", $id)->sum('gave_amount');
        $take = Repayment::where("payments_id", "=", $id)->sum('take_amount');
        $due=$gave-$take;

        $arr=["student"=>$student,"gave"=>$old,"take"=>$take,"due"=>$due];
        echo json_encode($arr); 
         
    }
    public function addPayment(Request $request){
        $id=$request->id;
        $old_price=$request->old_price;
        $c_price=$request->price;
        $result=$old_price + $c_price;
        $payments =Payment::find($id);
        $payments->price=$result;
        $payments->update();

        $repayments = new Repayment;
        $repayments->payments_id = $id; 
        $repayments->gave_amount = $c_price;
        $repayments->details = $request->detail;
        $repayments->date = $request->date;
        $repayments->take_amount =0;
        $repayments->save();

        
        $gave = Repayment::where("payments_id", "=", $id)->sum('gave_amount');
        $take = Repayment::where("payments_id", "=", $id)->sum('take_amount');
        $due=$gave-$take;

        $arr=["msg"=>"payment success","gave"=>$result,"due"=>$due];
        echo json_encode($arr); 
        // return  response()->json( $payments);
    }

    public function subpayment(Request $request){
        $id=$request->id;
        $old_price=$request->old_price;
        $c_price=$request->price;
        $result=$old_price - $c_price;
        $payments =Payment::find($id);
        $payments->price=$result;
        $payments->update();

        $repayments = new Repayment;
        $repayments->payments_id = $id; 
        $repayments->take_amount = $c_price;
        $repayments->details = $request->detail;
        $repayments->date = $request->date;
        $repayments->gave_amount =0;
        $repayments->save();
        $gave = Repayment::where("payments_id", "=", $id)->sum('gave_amount');
        $take = Repayment::where("payments_id", "=", $id)->sum('take_amount');
        $due=$gave-$take;

        $arr=["msg"=>"payment taken success","gave"=>$result,"due"=>$result];
        echo json_encode($arr); 
        
        
        // return  response()->json( $payments);
    }
}
