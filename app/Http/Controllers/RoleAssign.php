<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Session;
class RoleAssign extends Controller
{

    public function index()
    {
        $users = User::get();
      
        return view('backend.assignrole.index', compact('users'));
    }

    public function create()
    {
    
        return view('backend.assignrole.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'password'  => 'required|string|min:8',
            'user_type' =>'required',
        ]);
        $user= new User();
        $user->name = $request->name;
        $user->user_type=$request->user_type;
        $user->password= Hash::make($request->password);
        $user->save();
       

        Session::flash('message', 'Role assigned successfully!');

        return redirect()->route('assignrole.index');
    }

    public function edit($id)
    {
        $user = User::where("id", "=", $id)->first();
        $arr = array('id'=>$user->id,'name'=>$user->name,'user_type'=>$user->user_type);
        echo json_encode($arr); 
    }

    public function update(Request $request)
    {
        $id = $request->u_id;
        
        $user = User::where("id", "=", $id)->first();
        
        $user->name = $request->name;
        $user->user_type=$request->user_type;
        // $user->password= Hash::make($request->password);
        $user->update();
        
        Session::flash('message', 'Data updated successfully!');
        return redirect('assignrole');
       
    }

    public function destroy(request $request){
        $id = $request->input('role_id');
       
        User::destroy($id);
        Session::flash('message', 'Data delete successfully!');
       
        return redirect('assignrole');
       

    }
}