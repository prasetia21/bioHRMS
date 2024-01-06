<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index () 
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::where('id', $employee_id)->first();

        $posisi = $employee->position_id;

        // posisi
        if ($posisi == 1) {
            return view('frontend.dashboard.promotor');
        } elseif ($posisi == 2) {
            return view('frontend.dashboard.sales_retail');
        } elseif ($posisi == 3) {
            return view('frontend.dashboard.sales_industri');
        } elseif ($posisi == 4) {
            return view('frontend.dashboard.technician');
        } elseif ($posisi == 5) {
            return view('frontend.dashboard.admin');
        } elseif ($posisi == 6) {
            return view('frontend.dashboard.online');
        } elseif ($posisi == 7) {
            return view('frontend.dashboard.manager');
        } elseif ($posisi == 8) {
            return view('frontend.dashboard.hr');
        } elseif ($posisi == 9) {
            return view('frontend.dashboard.production');
        } else {
            return view('frontend.dashboard.user');
        }
    }
}
