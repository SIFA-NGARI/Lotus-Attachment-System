<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class FileHandling extends Controller

{

    public function submissionDetails()
    {
        $student_id = Auth::user()->id;
        $data = DB::table('reports')->where('student_id', '=', $student_id)->get();
        return view('report_submission')->with('data', $data);
    }
    private function read_pdf($filename)
    {
        $parser = new \Smalot\PdfParser\Parser();
        $pdf    = $parser->parseFile($filename);
        $bullet = '•';

        $text = $pdf->getText();
        $text = str_replace($bullet, " ", $text);
        return $text;
    }

    public function submitAssignment(Request $request)
    {
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('files', $filename);
        $pdf = file_get_contents('files/' . $filename);
        $counter = 'files/' . $filename;
        $number = preg_match_all("/\/Page\W/", $pdf, $dummy);
        $date = now();
        $result = str_word_count($this->read_pdf($counter));
        if ($number >= 15 && $result >= 4125) {

            $data = array('attachment_id' => session('attachment_id'), 'file' => $filename, 'date' => $date);
            DB::table('reports')->insert($data);
            DB::table('report_drafts')->where('attachment_id', '=', session('attachment_id'))->delete();

            return redirect()->back();
        } else {
            return Redirect::back()->withErrors(["The submitted document contains " . $number . " pages and " . $result . " words. It does not meet the report requirements of at least 15 pages and 4125 words."]);
        }
    }
    public function editAssignment(Request $request)
    {
        $id = $request->input('id');
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('files', $filename);
        $pdf = file_get_contents('files/' . $filename);
        $counter = 'files/' . $filename;
        $number = preg_match_all("/\/Page\W/", $pdf, $dummy);
        $date = now();
        $result = str_word_count($this->read_pdf($counter));
        if ($number >= 15 && $result >= 4125) {
            DB::table('reports')->where('report_id', '=', $id)->update(['file' => $filename, 'date' => $date]);
            return redirect()->back();
        } else {
            return Redirect::back()->withErrors(["The submitted document contains " . $number . " pages and " . $result . " words. It does not meet the report requirements of at least 15 pages and 4125 words."]);
        }
    }

    public function submitAssignment2(Request $request)
    {
        $file = $request->file;
        $counter = 'files/' . $file;
        $pdf = file_get_contents('files/' . $file);
        $number = preg_match_all("/\/Page\W/", $pdf, $dummy);
        $date = now();
        $result = str_word_count($this->read_pdf($counter));
        if ($number >= 15 && $result >= 4125) {

            $data = array('attachment_id' => session('attachment_id'), 'file' => $file, 'date' => $date);
            DB::table('reports')->insert($data);
            DB::table('report_drafts')->where('attachment_id', '=', session('attachment_id'))->delete();

            return redirect()->back();
        } else {
            return Redirect::back()->withErrors(["The submitted document contains " . $number . " pages and " . $result . " words. It does not meet the report requirements of at least 15 pages and 4125 words."]);
        }
    }

    public function saveAsDraft(Request $request)
    {
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('files', $filename);
        $date = now();
        $data = array('attachment_id' => session('attachment_id'), 'file' => $filename, 'date' => $date);
        DB::table('report_drafts')->insert($data);
        return redirect()->back();
    }
    public function saveAsDraft2(Request $request)
    {
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('files', $filename);
        $date = now();
        DB::table('report_drafts')->where('attachment_id', '=', session('attachment_id'))
            ->update([
                'date' => $date,
                'file' => $filename
            ]);
        return redirect()->back();
    }

    public function deleteAssignment(Request $request)
    {
        $id = $request->input('id');
        DB::table('reports')->where('report_id', '=', $id)->delete();
        return redirect()->back();
    }


    public function viewAssignmentSubmission($material_id)
    {
        $data = DB::table('reports')->where('report_id', "=", $material_id)->get();
        return view('view_files')->with('data', $data);
    }

    public function viewAssignmentDraft($material_id)
    {
        $data = DB::table('report_drafts')->where('id', "=", $material_id)->get();
        return view('view_files')->with('data', $data);
    }


    public function LecViewSubmissions()
    {
        $data = DB::table('reports')
        ->join('applications','applications.id','=','reports.attachment_id')
        ->select('applications.student_id','reports.date as date' ,'reports.report_id')
        ->get();
        return view('lec_report_dashboard')->with('data', $data);
    }

    public function attachmentDashboard($attachment_id, $supervisor_id, $type)
    {
        session(['attachment_id' => $attachment_id]);
        session(['supervisor_id' => $supervisor_id]);
        session(['type' => $type]);
        return redirect()->route('dashboard3');
    }
    public function reportDashboard()
    {
        $draft = DB::table('report_drafts')->where('attachment_id', '=', session('attachment_id'))->get();
        $deadline_open = DB::table('overall_attachment')->where('supervisor_id', '=', session('supervisor_id'))->where('type', '=', session('type'))->get();
        $report = DB::table('reports')->where('attachment_id', '=', session('attachment_id'))->get();
        return view('report_dashboard')->with('draft', $draft)->with('deadline_open', $deadline_open)->with('report', $report);
    }
    public function maps(){
        $markers =DB::table('applications')->select('address_address','address_latitude','address_longitude')->get();
        $markers = $markers ->map(function ($item, $key){
            return [$item->address_address, $item->address_latitude, $item->address_longitude];
        });
        return view('admin_dashboard',['markers'=>$markers]);
    }
    public function makeLogbook(Request $request)
    {
        $date = $request->input('date');
        $objectives = $request->input('objectives');
        $tasks = $request->input('tasks');
        $lessons = $request->input('lessons');
        $attachment_id = session('attachment_id');
        $seen=0;
        $data = array('objectives' => $objectives, 'date' => $date, 'tasks' => $tasks,'lessons' => $lessons, 'attachment_id' => $attachment_id, 'seen'=>$seen);
        DB::table('logbook')->insert($data);
        return redirect()->back();
    }
}
