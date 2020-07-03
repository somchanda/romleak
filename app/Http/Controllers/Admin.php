<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    function showDashboard(){
        return view('admin.dashboard');
    }
    function test($param){
        return $param;
    }
}
