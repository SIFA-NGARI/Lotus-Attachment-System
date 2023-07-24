<?php

use App\Http\Controllers\AttachmentInitialisation;
use App\Http\Controllers\Auth\AdminRegSupervisor;
use App\Http\Controllers\Auth\DashboardRedirect;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ImportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FileHandling;
use App\Http\Controllers\GradeHandler;
use App\Http\Controllers\SupervisorReg;
use App\Http\Controllers\SiteAuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DropDownController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/register');
});
Route::get('dash', function () {
    return view('dash');
})->name('dash');
Route::get('dash2', function () {
    return view('dash2');
})->name('dash2');
Route::resource('booking',BookingController::class);

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/dashboard', [DashboardRedirect::class, 'dashboards'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/import_parse', [ImportController::class, 'parseImport'])->name('import_parse');
Route::post('/import_process', [ImportController::class, 'processImport'])->name('import_process');

Route::get('site-register', [SiteAuthController::class, 'siteRegister']);
Route::post('site-register', [SiteAuthController::class, 'siteRegisterPost']);

Route::get('/viewAssignmentSubmission/{material_id}', [FileHandling::class, 'viewAssignmentSubmission'])->name('viewAssignmentSubmission');
Route::get('/viewAssignmentDraft/{material_id}', [FileHandling::class, 'viewAssignmentDraft'])->name('viewAssignmentDraft');

Route::post('/import_parse2', [ImportController::class, 'parseImport2'])->name('import_parse2');
Route::post('/import_process2', [ImportController::class, 'processImport2'])->name('import_process2');




//student module
Route::get('submissionDetails', [FileHandling::class, 'submissionDetails'])->name('submissionDetails')->middleware('role:2');
Route::post('submit_assignment', [FileHandling::class, 'submitAssignment'])->name('submit_assignment')->middleware('role:2');
Route::post('make_logbook', [FileHandling::class, 'makeLogbook'])->name('make_logbook')->middleware('role:2');

Route::post('submit_assignment2', [FileHandling::class, 'submitAssignment2'])->name('submit_assignment2')->middleware('role:2');
Route::post('save_as_draft2', [FileHandling::class, 'saveAsDraft2'])->name('save_as_draft2')->middleware('role:2');
Route::post('save_as_draft', [FileHandling::class, 'saveAsDraft'])->name('save_as_draft')->middleware('role:2');
Route::post('delete_assignment', [FileHandling::class, 'deleteAssignment'])->name('delete_assignment')->middleware('role:2');
Route::post('edit_assignment3', [FileHandling::class, 'editAssignment'])->name('edit_assignment3')->middleware('role:2');
Route::get('attachment_application_form', [DropDownController::class, 'index'])->name('attachment_application_form')->middleware('role:2');
Route::post('api/fetch-state', [DropDownController::class, 'fatchState'])->middleware('role:2');
Route::post('api/fetch-cities', [DropDownController::class, 'fatchCity'])->middleware('role:2');
Route::post('/student_application', [AttachmentInitialisation::class, 'createApplication'])->name('student_application')->middleware('role:2');
Route::get('student_view_accepted_attachments', [AttachmentInitialisation::class, 'studentViewAcceptedAttachments'])->name('student_view_accepted_attachments')->middleware('role:2');
Route::get('student_view_attachment_details2/{application_id}', [AttachmentInitialisation::class, 'viewAttachmentDetails2'])->name('student_view_attachment_details2')->middleware('role:2');
Route::get('student_view_attachments', [AttachmentInitialisation::class, 'studentViewAttachments'])->name('student_view_attachments')->middleware('role:2');
Route::get('student_view_attachment_details/{application_id}', [AttachmentInitialisation::class, 'studentViewAttachmentDetails'])->name('student_view_attachment_details')->middleware('role:2');
Route::get('student_view_reject_comments/{application_id}', [AttachmentInitialisation::class, 'studentViewRejectComments'])->name('student_view_reject_comments')->middleware('role:2');
Route::get('attachment_dashboard/{attachment_id}/{supervisor_id}/{type}', [FileHandling::class, 'attachmentDashboard'])->name('attachment_dashboard');
Route::get('dashboard3', function(){
    return view('student_dashboard3');
})->name('dashboard3');
Route::get('google-map', [FileHandling::class, 'maps'])->name('google_map');
Route::get('student_logbook', function(){
    return view('student_logbook');
})->name('student_logbook');
Route::get('lecturer_logbook', function(){
    $data=DB::table('logbook')->join('applications','applications.id','=','logbook.attachment_id')->select('applications.student_id','logbook.id as id','logbook.date')->get();
    return view('lecturer_logbook')->with('data',$data);
})->name('lecturer_logbook');
Route::get('student_logbook_view', function(){
    $data=DB::table('logbook')->where('attachment_id','=',session('attachment_id'))->get();
    return view('student_logbook_view')->with('data',$data);
})->name('student_logbook_view');
Route::post('comment', function(Request $request)
{
    $id = $request->input('id');
    $comments = $request->input('comments');
    DB::table('logbook')->where('id','=',$id)->update(['comments'=>$comments,'seen'=>1]);
    return redirect()->route('lecturer_logbook');
})->name('comment');


Route::get('view_logbook_lec/{id}/{sname}',function($id,$sname){
    $data=DB::table('logbook')->where('id','=',$id)->get();
    return view('view_logbook_lec')->with('data',$data)->with('sname',$sname);
})->name('view_logbook_lec');
Route::get('view_logbook_student/{id}',function($id){
    $data=DB::table('logbook')->where('id','=',$id)->get();
    return view('view_logbook_student')->with('data',$data);
})->name('view_logbook_student');
Route::get('comment_logbook/{id}/{sname}',function($id,$sname){
    $data=DB::table('logbook')->where('id','=',$id)->get();
    return view('comment_logbook')->with('data',$data)->with('sname',$sname);
})->name('comment_logbook');

//supervisor module
Route::get('/Lec_view_submissions', [FileHandling::class, 'LecViewSubmissions'])->name('Lec_view_submissions')->middleware('role:1');

Route::get('/gradeSubmission/{report_id}', [FileHandling::class, 'gradeSubmissions'])->name('gradeSubmission')->middleware('role:1');

Route::post('create_assessment', [GradeHandler::class, 'createAssessment'])->name('create_assessment')->middleware('role:1');
Route::post('fetch_assessment_details', [GradeHandler::class, 'fetchAssessmentDetails'])->name('fetch_assessment_details')->middleware('role:1');
Route::post('update_student_results', [GradeHandler::class, 'updateStudentResults'])->name('update_student_results')->middleware('role:1');
Route::post('edit_student_results', [GradeHandler::class, 'editStudentResults'])->name('edit_student_results')->middleware('role:1');
Route::post('edit_student_results2', [GradeHandler::class, 'editStudentResults2'])->name('edit_student_results2')->middleware('role:1');
Route::get('student_chooser', function () {
    $data = DB::table('applications')->where('student_id', "=", Auth::user()->id)->where('status', "=", 1)->get();
    $data2 = DB::table('supervisor_allocations')->where('student_id', "=", Auth::user()->id)->get();
    return view('student_dashboard2')->with('data', $data)->with('data2', $data2);
})->name('student_chooser');

Route::get('/Stud_View_Results', function () {
    $data5 = DB::table('student_results')
        ->join('assessments', 'student_results.exam_id', '=', 'assessments.exam_id')
        ->where('student_id', '=', session('student_id'))
        ->where('assessments.unit_code', '=', session('unit_id'))
        ->select('student_results.value', 'assessments.maximum', 'assessments.weight', 'assessments.exam_name')->get();
    return view('Lecturer_Student_Module.Student.view_result')->with('data5', $data5);
})->name('Stud_View_Results');

Route::get('update_results', function () {
    $data = DB::table('assessments')->get();
    $data4 = DB::table('users')
        ->join('supervisor_allocations', 'supervisor_allocations.student_id', '=', 'users.id')
        ->select('users.id', 'users.name')->get();
    return view('supervisor_update_results')->with('data', $data)->with('data4', $data4);
})->name('update_results')->middleware('role:1');
Route::get('/view_results', function () {
    $data4 = DB::table('users')
        ->join('supervisor_allocations', 'supervisor_allocations.student_id', '=', 'users.id')
        ->select('users.id', 'users.name')->get();
    $data6 = DB::table('assessments')->where('assessments.supervisor_id', '=', Auth::user()->id)->select('name')->get();
    return view('supervisor_view_results')->with('data4', $data4)->with('data6', $data6);
})->name('view_results')->middleware('role:1');

Route::get('lec_view_attachments', [AttachmentInitialisation::class, 'lecViewAttachments'])->name('lec_view_attachments')->middleware('role:1');
Route::get('view_attachment_details_lec/{application_id}', [AttachmentInitialisation::class, 'viewAttachmentDetails3'])->name('view_attachment_details_lec')->middleware('role:1');


//admin module
Route::get('/admin_reg_supp', [AdminRegSupervisor::class, 'index'])->name('SupervisorRegistration')->middleware('role:0');
Route::get('/admin_allocation', [AdminRegSupervisor::class, 'adminAllocations'])->name('AdminAllocations')->middleware('role:0');
Route::get('/fetch_form', function () {
    return view('reg_sup');
})->name('fetch_form')->middleware('role:0');
Route::post('/sup_reg', [SupervisorReg::class, 'store'])->name('sup_reg')->middleware('role:0');
Route::get('edit_assignment_page/{student_id}', [AttachmentInitialisation::class, 'editAssignmentPage'])->name('edit_assignment_page')->middleware('role:0');
Route::post('edit_assignment', [AttachmentInitialisation::class, 'editAssignment'])->name('edit_assignment')->middleware('role:0');
Route::get('nullify_assignment/{student_id}', [AttachmentInitialisation::class, 'nullifyAssignment'])->name('nullify_assignment')->middleware('role:0');
Route::get('view_applications', [AttachmentInitialisation::class, 'viewApplications'])->name('view_applications')->middleware('role:0');
Route::get('view_attachment_details/{application_id}', [AttachmentInitialisation::class, 'viewAttachmentDetails'])->name('view_attachment_details')->middleware('role:0');
Route::get('accept_attachment/{application_id}', [AttachmentInitialisation::class, 'acceptAttachment'])->name('accept_attachment')->middleware('role:0');
Route::post('reject_attachment', [AttachmentInitialisation::class, 'rejectAttachment'])->name('reject_attachment')->middleware('role:0');
Route::get('reject_comments/{application_id}', [AttachmentInitialisation::class, 'rejectComments'])->name('reject_comments')->middleware('role:0');

Route::get('accepted_applications', [AttachmentInitialisation::class, 'acceptedApplications'])->name('accepted_applications')->middleware('role:0');
Route::get('rejected_applications', [AttachmentInitialisation::class, 'rejectedApplications'])->name('rejected_applications')->middleware('role:0');
Route::get('view_reject_comments/{application_id}', [AttachmentInitialisation::class, 'viewRejectComments'])->name('view_reject_comments')->middleware('role:0');
Route::get('rep', function () {
    return view('report_status)');
});



require __DIR__ . '/auth.php';
require __DIR__ . '/crud.php';
