<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index () 
    {
        // dd(Auth::getDefaultDriver());
        $total_karyawan = Employee::count();
        $total_departement = Departement::count();

        return view('backend.dashboard.home', compact('total_karyawan', 'total_departement'));
    }

    
}
