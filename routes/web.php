<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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
    return view('welcome');
});

// Route::get('/admin/dashboard', function () {
//     return view('admin/dashboard');
// });

// Route::get('/staff/dashboard', function () {
//     return view('staff/dashboard');
// });


Route::get('/staff/dashboard', function () {
    if(session('loguser')){
    return view('staff/dashboard');
    }
    return redirect('staff/login');
});



Route::get('staff/login', function () {
    if (session('loguser')) {
        return redirect('staff/dashboard');
    }
    return view('staff/login');
});

Route::get('logout', function(){
    Session::flush();
    return Redirect::to('/staff/login');
 });

//  Ending Staff


Route::get('/admin/dashboard', function () {
    if(session('logadmin')){
    return view('admin/dashboard');
    }
    return redirect('admin/login');
});



Route::get('admin/login', function () {
    if (session('logadmin')) {
        return redirect('admin/dashboard');
    }
    return view('admin/login');
});

Route::get('logout', function(){
    Session::flush();
    return Redirect::to('/admin/login');
 });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/staff/register', [App\Http\Controllers\StaffController::class, 'showRegistrationForm'])->name('staff.register');
Route::post('/staff/register', [App\Http\Controllers\StaffController::class, 'register']);

// Route::get('staff/login', [App\Http\Controllers\StaffController::class, 'login'])->name('staff.login');
Route::post('/staff/login', [App\Http\Controllers\StaffController::class, 'logins']);

Route::get('/admin/register', [App\Http\Controllers\AdminController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [App\Http\Controllers\AdminController::class, 'register']);


// Route::get('admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'adminlogin']);