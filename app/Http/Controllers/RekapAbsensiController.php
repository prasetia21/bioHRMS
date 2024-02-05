<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\Presence;
use App\Models\WorkPermit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapAbsensiController extends Controller
{
    function izin()
    {
        $today = date('Y-m-d');
        $month = date('m');
        $numbermonth = date('m') * 1;
        $year = date('Y');

        $data = WorkPermit::with('employee.position')
            ->with('employee.departement')
            ->with('present')
            ->whereRaw('MONTH(req_date)="' . $month . '"')
            ->whereRaw('YEAR(req_date)="' . $year . '"')
            ->orderBy('req_date')
            ->get();

        return view('backend.rekap.izin', ['data' => $data]);
    }

    function cuti()
    {
        $today = date('Y-m-d');
        $month = date('m');
        $numbermonth = date('m') * 1;
        $year = date('Y');

        $data = Leave::with('employee.position')
            ->with('employee.departement')
            ->whereRaw('MONTH(req_date)="' . $month . '"')
            ->whereRaw('YEAR(req_date)="' . $year . '"')
            ->orderBy('req_date')
            ->get();

        return view('backend.rekap.cuti', ['data' => $data]);
    }

    function presensi(Request $request)
    {
        $today = date('Y-m-d');
        $month = date('m');
        $year = date('Y');


        // $data = Presence::with('employee.position')
        //     ->with('employee.departement')
        //     ->with('present')
        //     ->whereRaw('MONTH(presence_date)="' . $month . '"')
        //     ->whereRaw('YEAR(presence_date)="' . $year . '"')
        //     ->orderBy('presence_date')
        //     ->get();


        $data = Employee::with('position')
            ->with('departement')
            ->orderBy('departement_id', 'ASC')
            ->get();

        if (request()->month_filter == null) {
            $numbermonth = date('m') * 1;
            $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return view('backend.rekap.presensi', ['data' => $data], compact('numbermonth', 'namemonth', 'month', 'year'));
        } else {
            $monthFilter = request()->month_filter;

            

            switch ($monthFilter) {
                case '01':
                    $monthFilter = Carbon::now()->month(1)->format('m');
                    break;
                case '02':
                    $monthFilter = Carbon::now()->month(2)->format('m');
                    break;
                case '03':
                    $monthFilter = Carbon::now()->month(3)->format('m');
                    break;
                case '04':
                    $monthFilter = Carbon::now()->month(4)->format('m');
                    break;
                case '05':
                    $monthFilter = Carbon::now()->month(5)->format('m');
                    break;
                case '06':
                    $monthFilter = Carbon::now()->month(6)->format('m');
                    break;
                case '07':
                    $monthFilter = Carbon::now()->month(7)->format('m');
                    break;
                case '08':
                    $monthFilter = Carbon::now()->month(8)->format('m');
                    break;
                case '09':
                    $monthFilter = Carbon::now()->month(9)->format('m');
                    break;
                case '10':
                    $monthFilter = Carbon::now()->month(10)->format('m');
                    break;
                case '11':
                    $monthFilter = Carbon::now()->month(11)->format('m');
                    break;
                case '12':
                    $monthFilter = Carbon::now()->month(12)->format('m');
                    break;
            }
            $numbermonth = $monthFilter * 1;
            $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            
            return view('backend.rekap.presensi-filter', ['data' => $data], compact('numbermonth', 'namemonth', 'monthFilter', 'year'));
        }
    }
}
