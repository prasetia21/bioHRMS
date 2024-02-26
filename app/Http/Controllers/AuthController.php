<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function prosesLogin (Request $request){
        if (Auth::guard('employee')->attempt(['phone' => $request->phone, 'password' => $request->password ])) {
            
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'No Telepon / Password Salah']);
        }
    }

    public function prosesLogout () {
        if (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
            return redirect('/');
        }
    }

    

    public function dashboardLogin (Request $request){
        if (Auth::guard('user')->attempt(['phone' => $request->phone, 'password' => $request->password ])) {
            
            return redirect('/manage');
        } else {
            return redirect('/')->with(['warning' => 'No Telepon / Password Salah']);
        }
    }

    public function dashboardLogout () {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/welcome');
        }
    }
}
