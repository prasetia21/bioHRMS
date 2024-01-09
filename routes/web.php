<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLevelController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('layouts.index');
// });



Route::middleware(['guest:employee'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/signin', [AuthController::class, 'prosesLogin']);
});

Route::middleware(['auth:employee'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/absensi/masuk', [AttendanceController::class, 'inAttendance']);
    Route::post('/absensi/store', [AttendanceController::class, 'inStore']);

    Route::get('/laporan/promotor', [ReportController::class, 'index']);

    Route::get('/signout', [AuthController::class, 'prosesLogout']);
});

Route::get('/manage', [HomeController::class, 'index'])->name('dashboard-manage');


Route::get('/manage/departement', [DepartementController::class, 'index'])->name('departemen');
Route::get('/manage/departement/add', [DepartementController::class, 'addNew'])->name('tambah.departemen');
Route::post('/manage/departement/store', [DepartementController::class, 'store'])->name('store.departemen');
Route::get('/manage/departement/update/{id}', [DepartementController::class, 'update'])->name('update.departemen');
Route::post('/manage/departement/change', [DepartementController::class, 'change'])->name('change.departemen');
Route::post('/manage/departement/remove/{id}', [DepartementController::class, 'destroy'])->name('destroy.departemen');


Route::get('/manage/position', [PositionController::class, 'index'])->name('position');
Route::get('/manage/position/add', [PositionController::class, 'addNew'])->name('tambah.position');
Route::post('/manage/position/store', [PositionController::class, 'store'])->name('store.position');
Route::get('/manage/position/update/{id}', [PositionController::class, 'update'])->name('update.position');
Route::post('/manage/position/change', [PositionController::class, 'change'])->name('change.position');
Route::post('/manage/position/remove/{id}', [PositionController::class, 'destroy'])->name('destroy.position');


Route::get('/manage/employee', [EmployeeController::class, 'index'])->name('employee');
Route::get('/manage/employee/add', [EmployeeController::class, 'addNew'])->name('tambah.employee');
Route::post('/manage/employee/store', [EmployeeController::class, 'store'])->name('store.employee');
Route::get('/manage/employee/update/{id}', [EmployeeController::class, 'update'])->name('update.employee');
Route::post('/manage/employee/change', [EmployeeController::class, 'change'])->name('change.employee');
Route::post('/manage/employee/remove/{id}', [EmployeeController::class, 'destroy'])->name('destroy.employee');

Route::get('/manage/user', [UserController::class, 'index'])->name('user');
Route::get('/manage/user/add', [UserController::class, 'addNew'])->name('tambah.user');
Route::post('/manage/user/store', [UserController::class, 'store'])->name('store.user');
Route::post('/manage/user/remove/{id}', [UserController::class, 'destroy'])->name('destroy.user');
Route::get('/manage/user/update/{id}', [UserController::class, 'update'])->name('update.user');
Route::post('/manage/user/change', [UserController::class, 'change'])->name('change.user');
Route::get('/manage/user/password-update/{id}', [UserController::class, 'updatePassword'])->name('update.password.user');
Route::post('/manage/user/password-change', [UserController::class, 'changePassword'])->name('change.password.user');

Route::get('/manage/user-level', [UserController::class, 'roleList'])->name('userlevel');
Route::get('/manage/user-level/add', [UserController::class, 'addNewRole'])->name('tambah.userlevel');
Route::post('/manage/user-level/store', [UserController::class, 'storeRole'])->name('store.userlevel');
Route::post('/manage/user-level/remove/{id}', [UserController::class, 'destroyRole'])->name('destroy.userlevel');