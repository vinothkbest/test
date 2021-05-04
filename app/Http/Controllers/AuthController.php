<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\Employee;
class AuthController extends Controller
{
    public function loginForm(){
    	return view('admin-login');
    }

    public function authentication(Request $request){
    	$validator = Validator::make($request->all(), [
	    	'email' => 'required|email',
	    	'password' => 'required'
	    ]);
	    if($validator->fails())
	    	return redirect('login')->with('error', $validator->errors()->first());
	    
	    
	    $is_admin = Employee::where(['email'=> $request->email, 'is_admin' => 1])->first();
	    if($is_admin){
    		if(Hash::check($request->password, $is_admin->password)){
    			$request->session()->put("secret", Hash::make('logged-token'));
    			$request->session()->put("user", $is_admin->name);
	    		return redirect('employees')->with('success', 'Admin logged successfully');
    		}
    			
	    	else
		    	return redirect('login')->with('error', 'Invalid password');
	    }
	    else
	    	return redirect('login')->with('error', 'Invalid email');
    }

    public function logout(){
    	session()->flush();
    	return redirect('login')->with('success', 'Admin loggedout successfully');
    }
}
