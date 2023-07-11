<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminRegSupervisor extends Controller
{
    public function index()
    {
        $supervisors = User::select('name','email','phone_number')->where('role', '=', 1)->paginate();

        return view('admin_reg_sup.index')->with('supervisors', $supervisors);
    }
    public function adminAllocations()
    {
        $data = DB::table('supervisor_allocations')->select('student_id','supervisor_id')->paginate();

        return view('supervisor_assignment.index')->with('data', $data);
    }
}
