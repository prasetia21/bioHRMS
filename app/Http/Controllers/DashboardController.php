<?php

namespace App\Http\Controllers;

use App\Models\AdminReport;
use App\Models\Employee;
use App\Models\GetLeave;
use App\Models\LeaveRequest;
use App\Models\Presence;
use App\Models\PresenceRule;
use App\Models\Present;
use App\Models\PromotorReport;
use App\Models\ReqWorkPermit;
use App\Models\SalesIndustriReport;
use App\Models\SalesRetailReport;
use App\Models\SuratPeringatan;
use App\Models\TechnicianReport;
use App\Models\Teguran;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $sixMonthsLater = date('Y-m-d', strtotime($today . ' + 6 months'));

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

        $getJatahCuti = GetLeave::with('employee.position')
            ->with('employee.departement')->where('employee_id', $employee_id)->first();

        $jmlTeguran = Teguran::where('employee_id', $employee_id)->count();
        $jmlSP = SuratPeringatan::where('employee_id', $employee_id)->count();
        $ketSP = SuratPeringatan::where('employee_id', $employee_id)->get();

        if ($telat->jmlTelat === 4) {

            if ($jmlTeguran === 0) {
                $teguran = [
                    'employee_id' => $employee_id,
                    'tgl_terbit' => $today,
                    'status' => "Teguran 1",
                ];
                $create_teguran = Teguran::create($teguran);
                if (!empty($create_teguran)) {
                    Session::flash('danger', 'Anda Mendapatkan Surat Teguran, Segera Cek dan Evaluasi Tindakan Anda');
                }
            }
        }

        if ($jmlTeguran === 1 && $telat->jmlTelat >= 5) {
            if ($jmlSP === 0) {

                $peringatan = [
                    'employee_id' => $employee_id,
                    'tgl_terbit' => $today,
                    'status' => "Surat Peringatan 1",
                    'level' => 1,
                    'masa_berlaku' => $sixMonthsLater,
                ];
                $create_peringatan = SuratPeringatan::create($peringatan);
                if (!empty($create_peringatan)) {
                    Session::flash('danger', 'Anda Mendapatkan Surat Peringatan 1, Segera Cek dan Evaluasi Tindakan Anda');
                }
            }
        }



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

            return view('frontend.dashboard.promotor', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
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

            return view('frontend.dashboard.sales_retail', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
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

            return view('frontend.dashboard.sales_industri', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
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

            return view('frontend.dashboard.technician', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
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

            return view('frontend.dashboard.user', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
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

            return view('frontend.dashboard.online', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
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
                ->orderBy('status_1', 'DESC')
                ->get();

            $cuti = LeaveRequest::with('employee.position')
                ->with('present')
                ->with('leave')
                ->where('req_date', $hariini)
                ->orderBy('status_1', 'DESC')
                ->get();

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

            return view('frontend.dashboard.hr', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'ijin', 'cuti', 'allAbsensi', 'allTelat', 'day', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti'));
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

            return view('frontend.dashboard.production', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
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

            return view('frontend.dashboard.user', compact('todayattendance', 'employee', 'history',  'numbermonth', 'namemonth', 'month', 'year', 'hadir', 'telat', 'izin', 'sakit', 'report', 'cekReqIjin', 'cekAccIjin', 'cekReqCuti', 'cekAccCuti', 'getJatahCuti', 'hariini', 'ketSP'));
        }
    }

    public function teguran($employee_id)
    {
        $teguran = Teguran::with('employee.position', 'employee.departement')->where('employee_id', $employee_id)->first();
        $year = date('Y');

        $pdf = Pdf::loadView('frontend.surat.teguran', compact('teguran', 'year'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('surat_teguran.pdf');
    } // End Method 

    public function peringatan($employee_id)
    {
        $peringatan = SuratPeringatan::with('employee.position', 'employee.departement')->where('employee_id', $employee_id)->first();
        $year = date('Y');

        $pdf = Pdf::loadView('frontend.surat.peringatan', compact('peringatan', 'year'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('surat_peringatan.pdf');
    } // End Method 
}
