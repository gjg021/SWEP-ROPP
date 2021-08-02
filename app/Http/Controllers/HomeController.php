<?php

namespace App\Http\Controllers;


class HomeController extends Controller{


    public function index(){
    	return "to home";
        return view('dashboard.home.index');
    }
    

}
