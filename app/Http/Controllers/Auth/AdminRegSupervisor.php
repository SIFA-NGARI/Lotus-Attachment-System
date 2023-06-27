<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRegSupervisor extends Controller
{
    public function index()
    {
        $supervisors = User::select('name','email','phone_number')->where('role', '=', 1)->paginate();

        return view('admin_reg_sup.index')->with('supervisors', $supervisors);
    }
}
