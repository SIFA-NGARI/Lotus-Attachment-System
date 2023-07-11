<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttachmentInitialisation extends Controller
{
    public function createApplication(Request $request)
    {
        $name = $request->input('name');
        $branch = $request->input('branch');
        $address = $request->input('address');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
        $description = $request->input('description');
        $date_range = $request->input('date_range');
        $hours = $request->input('hours'); 
        $activities = $request->input('activities');
        $skills = $request->input('skills'); 
        $type = $request->input('type'); 
        $status = 0;
        $student_id = Auth::user()->id;
        $data = array('org_name' => $name,'student_id' => $student_id,'branch' => $branch,'address' => $address,'description' => $description,'date' => $date_range,'country' => $country,'state' => $state,'city' => $city,'hours' => $hours,'activities' => $activities,'skills' => $skills,'type' => $type,  'status' => $status);
        DB::table('applications')->insert($data);
        return redirect('student_view_attachments');
    }

    public function viewApplications() {
        $data = DB::table('applications')->where('status', "=", 0)
        ->join('users', 'applications.student_id', '=', 'users.id')
        ->select('users.id','users.name','applications.id as app_id')
        ->get();
        return view('attachment_initialisation/admin_view_applications')->with('data', $data);
    }
    public function acceptedApplications() {
        $data = DB::table('applications')->where('status', "=", 1)
        ->join('users', 'applications.student_id', '=', 'users.id')
        ->select('users.id','users.name','applications.id as app_id')
        ->get();
        return view('attachment_initialisation/accepted_applications')->with('data', $data);
    }
    public function rejectedApplications() {
        $data = DB::table('applications')->where('status', "=", 2)
        ->join('users', 'applications.student_id', '=', 'users.id')
        ->select('users.id','users.name','applications.id as app_id')
        ->get();
        return view('attachment_initialisation/rejected_applications')->with('data', $data);
    }
     

    public function viewOrganizationDetails($student_id){
        $data = DB::table('applications')->where('student_id', "=", $student_id)
        ->join('countries','applications.country','=','countries.id')
        ->join('cities','applications.city','=','cities.id')
        ->join('states','applications.state','=','states.id')
        ->select('org_name','branch','address','description','countries.name as country','cities.name as city','states.name as state')
        ->get();
        return view('attachment_initialisation/view_organization_details')->with('data', $data);

    }
    public function viewAttachmentDetails($student_id){
        $data = DB::table('applications')->where('student_id', "=", $student_id)->get();
        return view('attachment_initialisation/view_attachment_details')->with('data', $data);

    }
    public function viewRejectComments($application_id){
        $data = DB::table('reject_comments')->where('application_id', "=", $application_id)->get();
        return view('attachment_initialisation/view_reject_comments')->with('data', $data);

    }
    public function acceptAttachment($application_id){
        DB::table('applications')
        ->where('id', '=', $application_id)
        ->update([
            'status' => 1,
        ]); 
        DB::table('reject_comments')
        ->where('application_id', '=', $application_id)->delete(); 
        return redirect('view_applications');

    }
    public function rejectComments($application_id){
        return view('attachment_initialisation/reject_comments')->with('application_id', $application_id);

    }

    public function rejectAttachment(Request $request){
        $id = $request->input('application_id');
        $comments = $request->input('comments');
        DB::table('applications')
        ->where('id', '=', $id)
        ->update([
            'status' => 2,
        ]);
        $data = array('application_id' => $id,'comments' => $comments);
        DB::table('reject_comments')->insert($data);  
        return redirect('view_applications');
    }

    public function studentViewAttachments(){
        $student_id = Auth::user()->id;
        $data2 = DB::table('applications')->where('student_id', "=", $student_id)
        ->select('status')->get();
        $data = DB::table('applications')->where('student_id', "=", $student_id)->get();
        return view('attachment_initialisation/student_view_applications')->with('data', $data)->with('data2', $data2);
    }

    public function studentViewOrganizationDetails($application_id){
        $data = DB::table('applications')->where('applications.id', "=", $application_id)
        ->join('countries','applications.country','=','countries.id')
        ->join('cities','applications.city','=','cities.id')
        ->join('states','applications.state','=','states.id')
        ->select('org_name','branch','address','description','countries.name as country','cities.name as city','states.name as state')
        ->get();
        return view('attachment_initialisation/view_organization_details2')->with('data', $data);

    }
    public function studentViewAttachmentDetails($application_id){
        $data = DB::table('applications')->where('student_id', "=", $application_id)->get();
        return view('attachment_initialisation/view_attachment_details2')->with('data', $data);

    }
    public function studentViewRejectComments($application_id){
        $data = DB::table('reject_comments')->where('application_id', "=", $application_id)->get();
        return view('attachment_initialisation/view_reject_comments2')->with('data', $data);

    }
    public function editAssignmentPage($student_id){
        $data1=DB::table('users')->where('id','=',$student_id)->get();
        $data2=DB::table('supervisor_allocations')->where('student_id','=',$student_id)->get();
        $data= DB::table('users')->where('role','=','1')->get();
        return view('supervisor_assignment/edit_assignment')->with('data', $data)->with('data1', $data1)->with('data2', $data2);
    }
    public function editAssignment(Request $request){
        $allocation_id = $request->input('allocation_id');
        $supervisor_id= $request->input('supervisor_id');
        DB::table('supervisor_allocations')
        ->where('allocation_id', '=', $allocation_id)
        ->update([
            'supervisor_id' => $supervisor_id,
        ]);
        return redirect('admin_allocation');

    }

    public function nullifyAssignment($student_id){
        DB::table('supervisor_allocations')
        ->where('student_id', '=', $student_id)
        ->delete();
        return redirect('admin_allocation');
    }
}