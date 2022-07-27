<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Session; 

class ProfileController extends Controller
{
    public function index(){
        if (Auth::User()){
            $user = User::find(Auth::User()->id);
            return view('admin.profile.index', compact("user"));
        }
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'email' => 'required',
            
        ]);
     
        $profile = User::find($request->id);
        $profile->name = $request->name;
        $profile->lname = $request->lname;
        $profile->email = $request->email;
        $profile->save();
        Session::flash('message', 'Profile updated successfully!');
        return redirect()->back();
       
    }
    public function updatePassword(Request $request) {
        $request->validate([
            'oldpassword' =>'required',
           
            'password' => 'min:6|required_with:cpassword|same:cpassword',
            'cpassword' => 'min:6'
        ]);

        $profile = User::find($request->id);
        $oldpassword= $profile->password;
        $profile->password = Hash::make($request->password);

        $currentpassword =$request->oldpassword;
    
        if (Hash::check($currentpassword,$oldpassword)) {
            $profile->save();
            Session::flash('message-password', 'Password changed successfully!');
            return redirect()->back();
        }else{
            return redirect()->back()->withInput()->withErrors(['oldpassword' => 'Password does not match!']);;
        }
        
    }
}
