<?php

use App\Http\Controllers\Auth\AdminRegSupervisor;
use App\Http\Controllers\Auth\DashboardRedirect;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ImportController;
use App\Http\Controllers\FileHandling;
use App\Http\Controllers\GradeHandler;
use App\Http\Controllers\SupervisorReg;
use App\Http\Controllers\SiteAuthController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/admin_reg_supp', [AdminRegSupervisor::class, 'index'])->name('SupervisorRegistration');

Route::get('/fetch_form', function () {
    return view('reg_sup');
})->name('fetch_form');

Route::post('/sup_reg', [SupervisorReg::class, 'store'])->name('sup_reg');

Route::get('site-register', [SiteAuthController::class, 'siteRegister']);
Route::post('site-register', [SiteAuthController::class, 'siteRegisterPost']);


Route::get('submissionDetails', [FileHandling::class, 'submissionDetails'])->name('submissionDetails');
Route::post('submit_assignment', [FileHandling::class, 'submitAssignment'])->name('submit_assignment');
Route::post('delete_assignment', [FileHandling::class, 'deleteAssignment'])->name('delete_assignment');
Route::post('edit_assignment', [FileHandling::class, 'editAssignment'])->name('edit_assignment');
Route::get('/viewAssignmentSubmission/{material_id}', [FileHandling::class, 'viewAssignmentSubmission'])->name('viewAssignmentSubmission');
Route::get('/Lec_view_submissions', [FileHandling::class, 'LecViewSubmissions'])->name('Lec_view_submissions');

Route::post('create_assessment', [GradeHandler::class, 'createAssessment'])->name('create_assessment');
Route::post('fetch_assessment_details', [GradeHandler::class, 'fetchAssessmentDetails'])->name('fetch_assessment_details');
Route::post('update_student_results', [GradeHandler::class, 'updateStudentResults'])->name('update_student_results');
Route::post('edit_student_results', [GradeHandler::class, 'editStudentResults'])->name('edit_student_results');
Route::post('edit_student_results2', [GradeHandler::class, 'editStudentResults2'])->name('edit_student_results2');

Route::get('update_results', function () {
    $data = DB::table('assessments')->where('supervisor_id', '=', Auth::user()->id)->get();
    $data4 = DB::table('users')
        ->join('supervisor_allocations', 'supervisor_allocations.student_id', '=', 'users.id')
        ->select('users.id', 'users.name')->get();
    return view('supervisor_update_results')->with('data', $data)->with('data4', $data4);
})->name('update_results');
Route::get('/view_results', function () {
    $data4 = DB::table('users')
        ->join('supervisor_allocations', 'supervisor_allocations.student_id', '=', 'users.id')
        ->select('users.id', 'users.name')->get();
    $data6 = DB::table('assessments')->where('assessments.supervisor_id', '=', Auth::user()->id)->select('name')->get();
    return view('supervisor_view_results')->with('data4', $data4)->with('data6', $data6);
})->name('view_results');

require __DIR__ . '/auth.php';

