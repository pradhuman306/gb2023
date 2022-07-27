<?php

namespace App\Http\Controllers;
use App\Models\Student_fee;
use App\Models\Year;
use App\Models\Student_classe;
use App\Models\Student;
use App\Models\Record;
use Illuminate\Http\Request;

use Session;
class ClassController extends Controller
{
    public function index(){
        $years=Year::where("status","=",1)->get();
        if($years->isEmpty()){
            Session::flash('message', 'First add session and make it current to database!');
            return redirect('years');
        }
        $year = Year::where("status","=",1)->get();
        foreach($year as $y){
            $id=$y->id;
        }
        $tests = Student_fee::where("years_id",$id)->get();
      
        $class = Student_classe::get();
        return view('admin.class.index',compact("tests","year","class"));
    }
    public function create(){
        $tests = Student_classe::all();
        $year = Year::all();
        return view('admin.class.create',compact("tests","year"));
    }
    public function store(Request $request){

        $request->validate([
           
            
        ]);

        $tests= new Student_fee;
        $tests->years_id=$request->years_id;
        $tests->student_classes_id=$request->student_classes_id;
        $tests->amount=$request->amount;
      
        
        $tests->save();
        Session::flash('message', 'Fees added successfully!');
       
        return redirect('add_class');

    }
    public function show($id)
    {
    
       //
    
    }
    public function edit($test){
        $year = Year::all();
        $class = Student_classe::all();
        $tests = Student_fee::where("id", "=", $test)->first();
    
        return view('admin.class.edit',compact("tests","year","class"));        
    }

    public function update(Request $request ,$id){
       
        $request->validate([
            
        ]);
        $tests =Student_fee::where("id", "=", $id)->first();
       
        $tests->years_id=$request->years_id;
        $tests->student_classes_id=$request->student_classes_id;
        $tests->amount=$request->amount;
       
        $tests->update(); 
      
        Session::flash('message', 'Data updated successfully!');
        return redirect('add_class');

    }
    public function destroy(request $request){
        $id = $request->all();
        Student_fee::destroy($id);
        // Session::flash('message', ' data delete successfuly!');
       

    }
    public function FeesData($id){

       $tests = Student_fee::where("years_id", "=", $id)->get();
       $year = Year::get();
       $class = Student_classe::get();

     return view('admin.class.view',compact("tests","year","class"));

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
       
        $record = new Record;
        $record->students_id= $stu_id;
        $record->class_name= $class;
        $record->session=$year;
        $record->save();
       
       } 
       Session::flash('message', 'Student promoted to next class.');
       return redirect('students');
      
      
 }
}
