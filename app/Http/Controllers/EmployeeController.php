<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index(){

        if (Auth::user()->roles == 1 ) {
            return view('employee.admin');
        }

        if (Auth::user()->roles == 2 ) {
            return view('employee.manager');
        }
    }
}
