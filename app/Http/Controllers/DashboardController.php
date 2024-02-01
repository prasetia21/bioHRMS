<?php

namespace App\Http\Controllers;

use App\Models\AdminReport;
use App\Models\Employee;
use App\Models\Presence;
use App\Models\Present;
use App\Models\PromotorReport;
use App\Models\ReqWorkPermit;
use App\Models\SalesIndustriReport;
use App\Models\SalesRetailReport;
use App\Models\TechnicianReport;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::with('position')->with('departement')->where('id', $employee_id)->first();

        $posisi = $employee->position->name;

        $today = date('Y-m-d');
        $month = date('m');
        $numbermonth = date('m') * 1;
        $year = date('Y');
        $todayattendance = Presence::where('employee_id', $employee_id)->where('presence_date', $today)->first();

        $history = Presence::where('id', $employee_id)
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->orderBy('presence_date')
            ->get();

        $hadir = Presence::selectRaw('COUNT(id) as jmlHadir')
            ->where('employee_id', $employee_id)
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->first();

        $telat = Presence::selectRaw('COUNT(id) as jmlTelat')
            ->where('employee_id', $employee_id)
            ->where('present_id', 4)
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->first();

        $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];


        // posisi
        if ($posisi == 'Promotor') {
            

            $report = PromotorReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.promotor', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report'));
        } elseif ($posisi == 'Sales Retail') {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::onlyTrashed()->first();

            
               
            $report = SalesRetailReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.sales_retail', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report', 'cekReqIjin', 'cekAccIjin'));
        } elseif ($posisi == 'Sales Industri') {

            $report = SalesIndustriReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.sales_industri', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report'));
        } elseif ($posisi == 'Teknisi') {

            $report = TechnicianReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.technician', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report'));
        } elseif ($posisi == 'Admin') {

            $report = AdminReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.user', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report'));
        } elseif ($posisi == 'Online') {
            return view('frontend.dashboard.online', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report'));
        } elseif ($posisi == 'Manager') {

            $dept = $employee->departement->branch;

            $hariini = date('Y-m-d');

            $ijin = ReqWorkPermit::with('employee.departement')
                ->with('employee.position')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('approval_2', '0')
                ->where('departement', $dept)
                ->get();

            return view('frontend.dashboard.manager', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'ijin'));
        } elseif ($posisi == 'HR') {
            $hariini = date('Y-m-d');

            $ijin = ReqWorkPermit::with('employee.position')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('approval_1', '0')
                ->get();

            return view('frontend.dashboard.hr', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'ijin'));
        } elseif ($posisi == 'Produksi') {
            return view('frontend.dashboard.production', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report'));
        } else {
            return view('frontend.dashboard.user', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'year', 'hadir', 'telat', 'report'));
        }
    }
}
