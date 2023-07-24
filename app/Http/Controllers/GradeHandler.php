<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradeHandler extends Controller
{
    public function createAssessment(Request $request)
    {
        $ExamName = $request->input('name');
        $date = $request->input('date');
        $MaxScore = $request->input('MaxScore');
        $Weight = $request->input('Weight');
        $Supervisor_id = Auth::user()->id;
        $data = array('name' => $ExamName, 'date' => $date, 'maximum' => $MaxScore,'supervisor_id' => $Supervisor_id, 'weight' => $Weight);
        DB::table('assessments')->insert($data);
        return redirect()->back();
    }

    public function fetchAssessmentDetails(Request $request)
    {
        $AssessmentID = $request->input('assessment_id');
        session(['assessment_id' => $AssessmentID]);
        $data = DB::table('assessments')->get();
        $data2 = DB::table('assessments')->where('assessment_id', '=', $AssessmentID)->get();
        $check = DB::table('student_results')->where('assessment_id', '=', session('assessment_id'))->get();
        
            $data4 = DB::table('users')
        ->join('supervisor_allocations', 'supervisor_allocations.student_id', '=', 'users.id')
        ->select('users.id', 'users.name')->get();
            return view('supervisor_update_results')->with('data', $data)->with('data2', $data2)->with('data4', $data4);
        
    }

    public function updateStudentResults(Request $request)
    {
        $check = DB::table('student_results')->where('assessment_id', '=', session('assessment_id'))->get();

        if (!$check->isEmpty()) {
            for ($i = 1; $i <= count($request->student_id); $i++) {
                $id = $request->student_id[$i];
                $assessment_id = $request->assessment_id[$i];
                DB::table('student_results')
                    ->where('student_id', '=', $id)
                    ->where('assessment_id', '=', $assessment_id)
                    ->update([
                        'student_id' => $request->student_id[$i],
                        'assessment_id' => $request->assessment_id[$i],
                        'value' => $request->value[$i]
                    ]);
            }
            return redirect('view_results');
        } else {
            for ($i = 1; $i <= count($request->student_id); $i++) {
                $answers[] = [
                    'student_id' => $request->student_id[$i],
                    'assessment_id' => $request->assessment_id[$i],
                    'value' => $request->value[$i]
                ];
            }

            DB::table('student_results')->insert($answers);
            return redirect('view_results');
        }
    }

    public function editStudentResults(Request $request)
    {
        $student_id = $request->input('student_id');
        $data5 = DB::table('student_results')
            ->join('assessments', 'student_results.assessment_id', '=', 'assessments.assessment_id')
            ->where('student_id', '=', $student_id)
            ->select('student_results.value', 'assessments.maximum', 'assessments.weight', 'assessments.name', 'student_results.result_id')->get();
        $data6 = DB::table('users')
            ->where('id', '=', $student_id)->get();
        return view('supervisor_edit_results')->with('data5', $data5)->with('data6', $data6);
    }

    public function editStudentResults2(Request $request)
    {
        for ($i = 1; $i <= count($request->result_id); $i++) {
            $id = $request->result_id[$i];
            DB::table('student_results')
                ->where('result_id', '=', $id)
                ->update([
                    'value' => $request->value[$i]
                ]);
        }
        return redirect('view_results');
    }
}
