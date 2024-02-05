<?php

namespace App\Http\Controllers;

use App\Models\AdminReport;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Presence;
use App\Models\PresenceRule;
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
        $departement = $employee->departement->branch;

      

        $today = date('Y-m-d');
        $month = date('m');
        $numbermonth = date('m') * 1;
        $year = date('Y');
        $todayattendance = Presence::where('employee_id', $employee_id)->where('presence_date', $today)->first();
        
        $history = Presence::where('employee_id', $employee_id)
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
            ->where('present_id', 3)
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->first();
        
        $izin = Presence::selectRaw('COUNT(id) as jmlIzin')
            ->where('employee_id', $employee_id)
            ->where('present_id', 4)
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->first();
        
        $sakit = Presence::selectRaw('COUNT(id) as jmlSakit')
            ->where('employee_id', $employee_id)
            ->where('present_id', 2)
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->first();
    

        $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];


        // posisi
        if ($posisi == 'Promotor') {
            
            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            $report = PromotorReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.promotor', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        } elseif ($posisi == 'Sales Retail') {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            $report = SalesRetailReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.sales_retail', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        } elseif ($posisi == 'Sales Industri') {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            $report = SalesIndustriReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.sales_industri', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        } elseif ($posisi == 'Teknisi') {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            $report = TechnicianReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.technician', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        } elseif ($posisi == 'Admin') {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            $report = AdminReport::selectRaw('COUNT(id) as jmlLaporan')
                ->where('employee_id', $employee_id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->first();

            return view('frontend.dashboard.user', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        } elseif ($posisi == 'Online') {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            return view('frontend.dashboard.online', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        } elseif ($posisi == 'Manager') {

            $dept = $employee->departement->branch;

            //dd($dept);

            $hariini = date('Y-m-d');

            $day = date('d');

            $allAbsensi = Presence::with('employee.position')
            ->whereRelation('employee.departement', 'branch', '=', $dept)
            ->with('present')
            ->where('presence_date', $hariini)
            ->whereIn('present_id', ['2', '3', '4', '5', '6'])
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->orderBy('present_id', 'ASC')
            ->get();


            $ijin = ReqWorkPermit::with('employee.departement')
                ->with('employee.position')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('approval_2', '0')
                ->where('departement', $dept)
                ->orderBy('status_2', 'DESC')
                ->get();

            $cuti = LeaveRequest::with('employee.position')
                ->with('present')
                ->with('leave')
                ->where('req_date', $hariini)
                ->where('approval_2', '0')
                ->orderBy('status_2', 'DESC')
                ->get();


            return view('frontend.dashboard.manager', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'ijin', 'cuti', 'allAbsensi', 'day'));
        } elseif ($posisi == 'HR') {
            $hariini = date('Y-m-d');
            $day = date('d');

            $allAbsensi = Presence::with('employee.position')->with('employee.departement')->with('present')
            ->where('presence_date', $hariini)
            ->whereIn('present_id', ['2', '3', '4', '5', '6'])
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->orderBy('present_id', 'ASC')
            ->get();

            $allTelat = Presence::with('employee.position')->with('employee.departement')->with('present')
            ->where('presence_date', $hariini)
            ->whereIn('present_id', ['3'])
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->orderBy('present_id', 'ASC')
            ->get();

            $ijin = ReqWorkPermit::with('employee.position')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('approval_1', '0')
                ->orderBy('status_1', 'DESC')
                ->get();

            $cuti = LeaveRequest::with('employee.position')
                ->with('present')
                ->with('leave')
                ->where('req_date', $hariini)
                ->where('approval_1', '0')
                ->orderBy('status_1', 'DESC')
                ->get();

            return view('frontend.dashboard.hr', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'ijin', 'cuti', 'allAbsensi', 'allTelat', 'day'));
        } elseif ($posisi == 'Produksi') {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            return view('frontend.dashboard.production', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        } else {

            $hariini = date('Y-m-d');

            $cekReqIjin = ReqWorkPermit::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccIjin = ReqWorkPermit::where('req_date', $hariini)->onlyTrashed()->first();

            $cekReqCuti = LeaveRequest::where('req_date', $hariini)
                ->with('present')
                ->where('employee_id', $employee_id)
                ->first();

            $cekAccCuti = LeaveRequest::where('req_date', $hariini)->onlyTrashed()->first();

            return view('frontend.dashboard.user', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'hariini'));
        }
    }
}
