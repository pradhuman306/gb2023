<?php

namespace App\Http\Controllers;
use App\Models\Student_fee;
use App\Models\Year;
use App\Models\Student_classe;
use App\Models\Student;
use App\Models\Record;
use Illuminate\Http\Request;
use Session;
class FeesController extends Controller
{
    public function index(){
        $years=Year::where("status","=",1)->get();
        if($years->isEmpty()){
            Session::flash('error', 'First add session and make it current to database!');
            return redirect('years');
        }
        $year = Year::where("status","=",1)->get();
        foreach($year as $y){
            $id=$y->id;
        }
        $tests = Student_fee::where("years_id",$id)->get();
      
        $class = Student_classe::get();
        $classes = Student_classe::all();
        $years = Year::all();
        return view('admin.fees.index',compact("tests","year","class","classes","years"));
        
    }
    public function create(){
        //
    }
    public function store(Request $request){

        $request->validate([
            'years_id' => 'required',
            'student_classes_id' => 'required',
            'amount' => 'required',
        ]);

        $tests= new Student_fee;
        $tests->years_id=$request->years_id;
        $tests->student_classes_id=$request->student_classes_id;
        $tests->amount=$request->amount;
        $tests->save();
        Session::flash('success', 'Fees added successfully!');
        return redirect('feesstructure');

    }
    public function show($id)
    {
    
       //
    
    }
    public function edit($test){
        
        
        $tests = Student_fee::where("id", "=", $test)->first();
        $cid=$tests->student_classes_id;
        $yid=$tests->years_id;
       
            $class = Student_classe::all();
            
            $output = '';
            foreach($class as $c){
                $output .= '<option value="'.$c->id.'" '.(($cid == $c->id) ? 'selected="selected"':"").'>'.$c->class_name.'</option>';  
            }
            
        $year = Year::all();
        $year_output ='';
        foreach($year as $y){
            $year_output .= '<option value="'.$y->id.'" '.(($yid == $y->id) ? 'selected="selected"':"").'>'.$y->years.'</option>';  
        }


       
        $arr = array('id'=>$tests->id,'amount'=>$tests->amount,'output'=>$output,'y_output'=>$year_output);
        echo json_encode($arr); 
            //  return $year_output;
    }

    public function update(Request $request){
       
        $id = $request->main_id;
        $tests =Student_fee::where("id", "=", $id)->first();
       
        $tests->years_id=$request->years_id;
        $tests->student_classes_id=$request->student_classes_id;
        $tests->amount=$request->amount;
       
        $tests->update(); 
      
        Session::flash('success', 'Data updated successfully!');
        return redirect('feesstructure');

    }
    public function destroy(request $request){
        $id = $request->input('fees_id');
      
        Student_fee::destroy($id);
        Session::flash('success', 'Data delete successfully!');
        return redirect('feesstructure');

    }
    public function FeesData($id){

       $tests = Student_fee::where("years_id", "=", $id)->get();
       $year = Year::get();
       $class = Student_classe::get();
       $year_id = $id;
     return view('admin.fees.view',compact("tests","year","class","year_id"));

    }
    public function PromoteData(Request $request){

        $years = Year::where("status","=",1)->get();
        foreach($years as $y){
            $id=$y->id;
        }
        $year= $request->year;
        $class= $request->class;

        $data= $request->students_id;
        $a=json_decode($data);
        $l=count($a);
       
     

       for($i=0;$i<$l;$i++){

       
        $records = Record::where("students_id", "=",$a[$i])->where("session","=",$id)->first();

        $stu_id=$records->students_id;
    //   dd($class);
        $record = new Record;
        $record->students_id= $stu_id;
        $record->class_name= $class;
        $record->session=$year;
        $record->save();
       
       } 
       Session::flash('success', 'Student promoted to next class.');
       return redirect('students');
      
      
 }
    
}
