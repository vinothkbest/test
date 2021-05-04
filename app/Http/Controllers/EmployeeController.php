<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Exports\UserReport;
use Validator;
use Hash;
use Excel;
class EmployeeController extends Controller
{
    public function registerForm(){
    	return view('employee-create');
    }
    public function register(Request $req){
		$validator = Validator::make($req->all(),[
                    'name' => 'required',
                    'dob' => 'required',
                    'email' => 'required|email|unique:employees,email',
                    'mobile' => 'required|phone|unique:employees,mobile', //phone has extended validation
                    'salary' => 'required',
                    'address' => 'required',
                    'is_admin' => 'required|boolean',
              ],[
                  'mobile.phone' =>'Provide 10 digits mobile number.'
              ]);

		if($validator->fails()){
			return response()->json(['message' => $validator->errors()->first(), 'status' => 'error'], 400);
		}

    	if($req->is_admin){
    		$validator = Validator::make($req->all(),[
                    'password' => 'required|min:5',
              ]);

            if($validator->fails()){
                return response()->json(['message' => $validator->errors()->first(), 'status' => 'error'], 400);
            }
	    	$data = ['name' =>ucfirst($req->name), 'dob' => $req->dob, 'email' => $req->email,
	    			 'mobile' => $req->mobile, 'salary' => $req->salary, 'address' => $req->address, 'password' => Hash::make($req->password), 'is_admin' => 1];
    	}
    	else{
    		$data = ['name' =>ucfirst($req->name), 'dob' => $req->dob, 'email' => $req->email,
	    			 'mobile' => $req->mobile, 'salary' => $req->salary, 'address' => $req->address, 'is_admin' => 0];
    	}
    	Employee::create($data);

    	return response()->json(['status'=> 'success', 'message' => "New Employee has been registered successfully"], 201);
    }

    public function employees(){
    	return view('employees');
    }

    public function dataTable(){
    	$employees = Employee::orderByDesc('created_at')->get();
    	return response()->json([
	          'data' => $employees, 
        ]);
    }
    public function report(){
        return Excel::download(new UserReport, 'employees.xlsx');
    }
}
