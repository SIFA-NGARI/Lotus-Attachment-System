<?php

namespace App\Http\Controllers;

use App\Models\Organisations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class AttachmentInitialisation extends Controller
{
    public function createApplication(Request $request)
    {
        Organisations::create($request->all());
        return redirect()->route('student_view_attachments');
    }

    public function viewApplications()
    {
        $data = DB::table('applications')->where('status', "=", 0)
            ->join('users', 'applications.student_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'applications.id as app_id', 'org_name', 'address_longitude', 'address_latitude')
            ->get();
        return view('attachment_initialisation/admin_view_applications')->with('data', $data);
    }
    public function lecViewAttachments()
    {
        $data = DB::table('supervisor_allocations')->where('supervisor_id', "=", Auth::user()->id)->get();
                  
        return view('attachment_initialisation/lec_view_applications')->with('data', $data);
    }
    public function studentViewAcceptedAttachments()
    {
        $data = DB::table('applications')->where('student_id', "=", Auth::user()->id)->where('status', "=", 1)->get();     
        $data2=DB::table('users')->join('supervisor_allocations','supervisor_id','=','id')->where("supervisor_allocations.student_id",'=',Auth::user()->id)->get();
        return view('attachment_initialisation/student_view_attachments')->with('data', $data)->with('data2', $data2);
    }
    public function acceptedApplications()
    {
        $data = DB::table('applications')->where('status', "=", 1)
            ->join('users', 'applications.student_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'applications.id as app_id', 'org_name', 'address_longitude', 'address_latitude')
            ->get();
        return view('attachment_initialisation/accepted_applications')->with('data', $data);
    }
    public function rejectedApplications()
    {
        $data = DB::table('applications')->where('status', "=", 2)
            ->join('users', 'applications.student_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'applications.id as app_id', 'org_name', 'address_longitude', 'address_latitude')
            ->get();
        return view('attachment_initialisation/rejected_applications')->with('data', $data);
    }


    public function viewAttachmentDetails($application_id)
    {
        $data = DB::table('applications')->where('id', "=", $application_id)->get();
        return view('attachment_initialisation/view_attachment_details')->with('data', $data);
    }
    public function viewAttachmentDetails2($application_id)
    {
        $data = DB::table('applications')->where('id', "=", $application_id)->get();
        return view('attachment_initialisation/view_attachment_details3')->with('data', $data);
    }
    public function viewAttachmentDetails3($application_id)
    {
        $data = DB::table('applications')->where('id', "=", $application_id)->get();
        return view('attachment_initialisation/view_attachment_details4')->with('data', $data);
    }
    public function viewRejectComments($application_id)
    {
        $data = DB::table('reject_comments')->where('application_id', "=", $application_id)->get();
        return view('attachment_initialisation/view_reject_comments')->with('data', $data);
    }
    public function acceptAttachment($application_id)
    {
        DB::table('applications')
            ->where('id', '=', $application_id)
            ->update([
                'status' => 1,
            ]);
        DB::table('reject_comments')
            ->where('application_id', '=', $application_id)->delete();
        return redirect('view_applications');
    }
    public function rejectComments($application_id)
    {
        return view('attachment_initialisation/reject_comments')->with('application_id', $application_id);
    }

    public function rejectAttachment(Request $request)
    {
        $id = $request->input('application_id');
        $comments = $request->input('comments');
        DB::table('applications')
            ->where('id', '=', $id)
            ->update([
                'status' => 2,
            ]);
        $data = array('application_id' => $id, 'comments' => $comments);
        DB::table('reject_comments')->insert($data);
        return redirect('view_applications');
    }

    public function studentViewAttachments()
    {
        $student_id = Auth::user()->id;
        $data2 = DB::table('applications')->where('student_id', "=", $student_id)
            ->select('status')->get();
        $data = DB::table('applications')->where('student_id', "=", $student_id)->get();
        return view('attachment_initialisation/student_view_applications')->with('data', $data)->with('data2', $data2);
    }

    public function studentViewAttachmentDetails($application_id)
    {
        $data = DB::table('applications')->where('student_id', "=", $application_id)->get();
        return view('attachment_initialisation/view_attachment_details2')->with('data', $data);
    }
    public function studentViewRejectComments($application_id)
    {
        $data = DB::table('reject_comments')->where('application_id', "=", $application_id)->get();
        return view('attachment_initialisation/view_reject_comments2')->with('data', $data);
    }
    public function editAssignmentPage($student_id)
    {
        $data1 = DB::table('users')->where('id', '=', $student_id)->get();
        $data2 = DB::table('supervisor_allocations')->where('student_id', '=', $student_id)->get();
        $data = DB::table('users')->where('role', '=', '1')->get();
        return view('supervisor_assignment/edit_assignment')->with('data', $data)->with('data1', $data1)->with('data2', $data2);
    }
    public function editAssignment(Request $request)
    {
        $allocation_id = $request->input('allocation_id');
        $supervisor_id = $request->input('supervisor_id');
        DB::table('supervisor_allocations')
            ->where('allocation_id', '=', $allocation_id)
            ->update([
                'supervisor_id' => $supervisor_id,
            ]);
        return redirect('admin_allocation');
    }

    public function nullifyAssignment($student_id)
    {
        DB::table('supervisor_allocations')
            ->where('student_id', '=', $student_id)
            ->delete();
        return redirect('admin_allocation');
    }
}
