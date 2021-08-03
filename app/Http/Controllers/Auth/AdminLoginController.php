<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:admin');
	}

    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request){
   
    	//return $request;
    	//validate form data
    	// $this->validate($request,[
    	// 	'username' => 'reqired',
    	// 	'password' => 'reqired|min:6'
    	// ]);

    	//attemt login
    	//if success
    	if(\Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])){
    		return redirect()->intended(route('admin.home'));
    	}
    	return redirect()->back()->withInput($request->only('email'));
    }
}
