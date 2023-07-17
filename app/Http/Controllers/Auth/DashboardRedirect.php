<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                $markers =DB::table('applications')->select('address_address','address_latitude','address_longitude')->get();
                $markers = $markers ->map(function ($item, $key){
                    return [$item->address_address, $item->address_latitude, $item->address_longitude];
                });
                return view('admin_dashboard',['markers'=>$markers]);
            }
        }
    }
}
