<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
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

    Route::get('/kirim-laporan/', [ReportController::class, 'index'])->name('kirim-laporan');
    Route::post('/distance-apply', [ReportController::class, 'DistanceApply']);

    Route::post('/create-promotor', [ReportController::class, 'storePromotor']);
    Route::post('/create-sales-industri', [ReportController::class, 'storeSalesIndustri']);
    Route::post('/create-sales-retail', [ReportController::class, 'storeSalesRetail']);
    Route::post('/create-teknisi', [ReportController::class, 'storeTechnician']);
    Route::post('/create-admin', [ReportController::class, 'storeAdmin']);

    Route::get('/laporan-terkirim', [ReportController::class, 'send'])->name('laporan-terkirim');

    Route::get('/laporan-promotor', [ReportController::class, 'promotorReport'])->name('laporan-promotor');
    Route::get('/laporan-sales-retail', [ReportController::class, 'salesRetailReport'])->name('laporan-sales-retail');
    Route::get('/laporan-sales-industri', [ReportController::class, 'salesIndustriReport'])->name('laporan-sales-industri');
    Route::get('/laporan-teknisi', [ReportController::class, 'teknisiReport'])->name('laporan-teknisi');
    Route::get('/laporan-admin', [ReportController::class, 'adminReport'])->name('laporan-admin');


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
Route::post('/manage/user-level/store', [UserController::class, 'storeRole'])->name('store.userlevel');
Route::post('/manage/user-level/remove/{id}', [UserController::class, 'destroyRole'])->name('destroy.userlevel');

Route::get('/manage/rule-attendance', [SettingController::class, 'ruleListAttendance'])->name('ruleattendance');
Route::post('/manage/rule-attendance/store', [SettingController::class, 'storeRuleAttendance'])->name('store.ruleattendance');
Route::get('/manage/rule-attendance/update/{id}', [SettingController::class, 'updateRuleAttendance'])->name('update.ruleattendance');
Route::post('/manage/rule-attendance/change', [SettingController::class, 'changeRuleAttendance'])->name('change.ruleattendance');
Route::post('/manage/rule-attendance/remove/{id}', [SettingController::class, 'destroyRuleAttendance'])->name('destroy.ruleattendance');

Route::get('/manage/rule-leave', [SettingController::class, 'ruleListLeave'])->name('ruleleave');
Route::post('/manage/rule-leave/store', [SettingController::class, 'storeRuleLeave'])->name('store.ruleleave');
Route::get('/manage/rule-leave/update/{id}', [SettingController::class, 'updateRuleLeave'])->name('update.ruleleave');
Route::post('/manage/rule-leave/change', [SettingController::class, 'changeRuleLeave'])->name('change.ruleleave');
Route::post('/manage/rule-leave/remove/{id}', [SettingController::class, 'destroyRuleLeave'])->name('destroy.ruleleave');


Route::get('/manage/news', [NewsController::class, 'index'])->name('news');
Route::get('/manage/news/add', [NewsController::class, 'addNew'])->name('tambah.news');
Route::post('/manage/news/store', [NewsController::class, 'store'])->name('store.news');
Route::get('/manage/news/update/{id}', [NewsController::class, 'update'])->name('update.news');
Route::post('/manage/news/change', [NewsController::class, 'change'])->name('change.news');
Route::post('/manage/news/remove/{id}', [NewsController::class, 'destroy'])->name('destroy.news');
Route::get('/news/{param}', [NewsController::class, 'detail'])->name('detail.news');
Route::post('/manage/news/approve/{id}', [NewsController::class, 'approve'])->name('approve.news');

