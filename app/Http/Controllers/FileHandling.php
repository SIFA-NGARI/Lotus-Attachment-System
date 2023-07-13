<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FileHandling extends Controller

{
  
    public function submissionDetails()
    {
        $student_id = Auth::user()->id;
        $data = DB::table('reports')->where('student_id', '=', $student_id)->get();
        return view('report_submission')->with('data', $data);
    }

    public function submitAssignment(Request $request)
    {
        $student_id = Auth::user()->id;
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('files', $filename);
        $date=now();
        $data = array('student_id' => $student_id, 'file' => $filename,'date'=>$date);
        DB::table('reports')->insert($data);
        return redirect()->back();
    }

    public function deleteAssignment(Request $request)
    {
        $id = $request->input('id');
        DB::table('reports')->where('report_id', '=', $id)->delete();
        return redirect()->back();
    }

    public function editAssignment(Request $request)
    {
        $id = $request->input('id');
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('files', $filename);
        DB::table('reports')->where('report_id', '=', $id)->update(['file' => $filename]);
        return redirect()->back();
    }

    public function viewAssignmentSubmission($material_id)
    {
        $data = DB::table('reports')->where('report_id', "=", $material_id)->get();
        return view('view_files')->with('data', $data);
    }

    public function LecViewSubmissions()
    {
        $data = DB::table('reports')
        ->join('users', 'reports.student_id', '=', 'users.id')
            ->select('reports.report_id', 'users.id', 'users.name', 'reports.date')->get();     
        return view('supervisor_view_reports')->with('data', $data);
    }
}
