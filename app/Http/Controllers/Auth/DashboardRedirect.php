<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRedirect extends Controller
{
    public function dashboards(){
        if (Auth::check()) {
            if (Auth::user()->role == '2') {
                Auth::user()->id  = session('student_id');
                return view('student_dashboard');
            }
            if (Auth::user()->role == '1') {
                Auth::user()->id  = session('supervisor_id');
                return view('supervisor_dashboard');
            }
            if (Auth::user()->role == '0') {
                return view('admin_dashboard');
            }
        }
    }
}
