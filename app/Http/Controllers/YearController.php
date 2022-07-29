<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Session;
use DB;

class YearController extends Controller
{
    public function index()
    {
        $years=Year::get();
        return view('admin.year.create',compact("years"));
    }
    public function create()
    {

        //
    }
    public function store(Request $request)
    {
        $request->validate([
            'years'=> ['required','unique:years'],
        ]);

        $years = new Year;
        $years->years = $request->years;
        if (isset($request->session) && $request->session[0] == '1') {

            
            if(Year::where("status", "=", 1)->exists()){
                $tests=Year::where("status", "=", 1)->get();
            
                foreach ($tests as $t) {
                    $id = $t->id;
                    $year= $t->years;
                   
                }
                DB::table('years')->where('id', $id)->update([
                    'status' => 0,
                    'years'=>$year,
                ]);
            }
            
         
            $years->status = '1';
        } else {
            $years->status = '0';
        }
        $years->save();
        Session::flash('success', 'Session added successfully!');

        return redirect()->back();

    }
    public function show($id)
    {

        //

    }
    public function edit($test)
    {

        // $tests = Year::where("id", "=", $test)->first();

        // return view('admin.year.edit');        
    }

    public function update(Request $request, $id)
    {

        // $request->validate([

        // ]);
        // $tests =Year::where("id", "=", $id)->first();

        // $tests->years=$request->years;

        // $tests->update(); 

        // Session::flash('success', ' data updated successfuly!');
        // return redirect('years');

    }
    public function destroy()
    {
    }

    public function MakeCurrent(Request $request, $id)
    {
       
        
    }


    public function RemoveCurrent(Request $request, $id)
    {
        if(Year::where("status", "=", 1)->exists()){
            $tests = Year::where("status", "=", 1)->get();
            foreach($tests as $t){
                $active=$t->id;
                $year=$t->years;
               
            }
            DB::table('years')->where('id', $active)->update([
                'status' => 0,
                'years'=>$year,
            ]);
    
            $years = Year::where("id", "=", $id)->first();
                $test=$years->years;
    
                $toactive=$years->id;
    
            DB::table('years')->where('id', $toactive)->update([
                'status' => 1,
                'years'=>$test,
            ]);
            Session::flash('success', 'Session changed successfully!');
    
            return redirect()->back();
        }
       else{
        Session::flash('error', 'First add session with selecting checkbox!');
        return redirect()->back();
       }

        
    }
}
