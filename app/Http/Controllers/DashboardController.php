<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index () 
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::where('id', $employee_id)->first();

        $posisi = $employee->position_id;

        $today =date('Y-m-d');
        $todayattendance = Presence::where('employee_id', $employee_id)->where('presence_date', $today)->first();


        // posisi
        if ($posisi == 1) {
            return view('frontend.dashboard.promotor', compact('todayattendance'));
        } elseif ($posisi == 2) {
            return view('frontend.dashboard.sales_retail', compact('todayattendance'));
        } elseif ($posisi == 3) {
            return view('frontend.dashboard.sales_industri', compact('todayattendance'));
        } elseif ($posisi == 4) {
            return view('frontend.dashboard.technician', compact('todayattendance'));
        } elseif ($posisi == 5) {
            return view('frontend.dashboard.admin', compact('todayattendance'));
        } elseif ($posisi == 6) {
            return view('frontend.dashboard.online', compact('todayattendance'));
        } elseif ($posisi == 7) {
            return view('frontend.dashboard.manager', compact('todayattendance'));
        } elseif ($posisi == 8) {
            return view('frontend.dashboard.hr', compact('todayattendance'));
        } elseif ($posisi == 9) {
            return view('frontend.dashboard.production', compact('todayattendance'));
        } else {
            return view('frontend.dashboard.user', compact('todayattendance'));
        }
    }
}
