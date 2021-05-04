<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
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
	    if($validator->fails()){
	    	return redirect('login')->with('error', $validator->errors()->first());
	    }
	    else{

		    if(Auth::guard('admin')->attempt($request->only('email', 'password'))){
		    	return redirect('employees')->with('success', 'Admin logged successfully');
		    }
		    else
		    	return redirect('login')->with('error', 'Invalid credentials');
	    }
    }

    public function logout(){
    	Auth::logout();
    	return redirect('login')->with('success', 'Admin loggedout successfully');
    }
}
