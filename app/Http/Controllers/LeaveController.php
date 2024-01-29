<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $hariini = date('Y-m-d');
        $employee_id = Auth::guard('employee')->user()->id;

        $employee = Employee::with('position')
            ->with('departement')
            ->with('leave')
            ->where('id', $employee_id)
            ->first();

        $employees = Employee::with('position')
            ->with('departement')
            ->with('leave')
            ->get();



        $posisi = $employee->position->name;
        $departement_id = $employee->departement_id;


        return view('frontend.leave.request', compact('employee', 'employees'));
    }
}
