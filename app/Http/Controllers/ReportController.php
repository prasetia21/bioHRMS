<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\Location as ModelsLocation;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    function index()
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::where('id', $employee_id)->first();

        $posisi = $employee->position_id;
        $departement_id = $employee->departement_id;

        $deptCoordinate = Departement::where('id', $departement_id)->first();

        $location = $deptCoordinate->coordinate;
        $lokasiDept = explode(",", $location);
        $latitudeDept = $lokasiDept[0];
        $longitudeDept = $lokasiDept[1];

        

        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        $info = Location::get($ip);

        // posisi
        if ($posisi == 1) {
            return view('frontend.reports.promotor', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 2) {
            return view('frontend.reports.sales_retail', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 3) {
            return view('frontend.reports.sales_industri', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 4) {
            return view('frontend.reports.technician', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 5) {
            return view('frontend.reports.admin', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 6) {
            return view('frontend.reports.online', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 7) {
            return view('frontend.reports.manager', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 8) {
            return view('frontend.reports.hr', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 9) {
            return view('frontend.reports.production', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        } else {
            return view('frontend.reports.user', compact('location', 'info', 'latitudeDept', 'longitudeDept'));
        }

       
    }
}
