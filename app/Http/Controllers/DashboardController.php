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
        $employee = Employee::with('position')->with('departement')->where('id', $employee_id)->first();

        $posisi = $employee->position->name;

        $today =date('Y-m-d');
        $todayattendance = Presence::where('employee_id', $employee_id)->where('presence_date', $today)->first();

        // posisi
        if ($posisi == 'Promotor') {
            return view('frontend.dashboard.promotor', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'Sales Retail') {
            return view('frontend.dashboard.sales_retail', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'Sales Industri') {
            return view('frontend.dashboard.sales_industri', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'Teknisi') {
            return view('frontend.dashboard.technician', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'Admin') {
            return view('frontend.dashboard.admin', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'Online') {
            return view('frontend.dashboard.online', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'Manager') {
            return view('frontend.dashboard.manager', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'HR') {
            return view('frontend.dashboard.hr', compact('todayattendance', 'employee'));
        } elseif ($posisi == 'Produksi') {
            return view('frontend.dashboard.production', compact('todayattendance', 'employee'));
        } else {
            return view('frontend.dashboard.user', compact('todayattendance', 'employee'));
        }
    }
}
