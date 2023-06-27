<?php

use App\Http\Controllers\Auth\AdminRegSupervisor;
use App\Http\Controllers\Auth\DashboardRedirect;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ImportController;
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


require __DIR__ . '/auth.php';

