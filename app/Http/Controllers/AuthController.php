<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function prosesLogin (Request $request){
        if (Auth::guard('karyawan')->attempt(['no_hp' => $request->no_hp, 'password' => $request->password ])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'No Telepon / Password Salah']);
        }
    }

    public function prosesLogout () {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }
}
