<?php

use App\Http\Controllers\AttachmentInitialisation;
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
use App\Http\Controllers\DropDownController;

Route::get('report_dashboard', [FileHandling::class, 'reportDashboard'])->name('report_dashboard');
Route::get('lecs_atachments', function(){
    $data=DB::table('overall_attachment')->where('supervisor_id','=',Auth::user()->id)->get();
    return view('supervisor_attachment_selector')-> with('data',$data);
})->name('lecs_atachments');
