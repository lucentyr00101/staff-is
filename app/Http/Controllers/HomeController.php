<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()){
            return redirect('/login');
        }else{
            //$user_type = Session::get('user_type');

            // if ($user_type == "employee"){
            //     return "this the employee home";
            // }else if($user_type == "company"){
            //     return "this the company home";
            // }else if ($user_type == "admin"){
            //     return "this the admin home";
            // }

            return redirect('/tasks');
        }
    }
}
