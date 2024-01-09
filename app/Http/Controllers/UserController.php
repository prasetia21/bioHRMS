<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function index()
    {
        $data = User::with('level')->get();

        return view('backend.user.list_user', ['data' => $data]);
    }

    function addNew()
    {
        $data = UserLevel::all();

        return view('backend.user.add_user', ['data' => $data]);
    }

    function destroy(Request $request)
    {
        User::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/user');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'user_level_id' => 'required',
            'confirmpassword' => 'required|min:8',
        ], [
            'name.required' => 'Kolom Nama Wajib Di isi',
            'name.min' => 'Kolom Nama minimal harus 4 karakter.',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Invalid',
            'password.required' => 'Password Wajib Di isi',
            'password.min' => 'Password minimal harus 8 karakter.',
            'confirmpassword.required' => 'Konfirmasi Password Wajib Di isi',
            'confirmpassword.min' => 'Password minimal harus 8 karakter.',
            'user_level_id.required' => 'Role Akses User Wajib Di isi',
        ]);

        $cekName = $request->name;
        $sameUser = User::where('name', $cekName)->first();

        if ($sameUser) {
            Session::flash('danger', 'User sudah Terdaftar');
            return Redirect::back(); 
        }

        $cekEmail = $request->email;
        $sameUser = User::where('email', $cekEmail)->first();

        if ($sameUser) {
            Session::flash('danger', 'Email sudah Terdaftar');
            return Redirect::back(); 
        }

        $pass = $request->password;
        $passconf = $request->confirmpassword;

        if ($pass !== $passconf) {
            Session::flash('danger', 'Password dan Konfirmasi Password Tidak Sama');
            return Redirect::back(); 
        }

        User::create([
            'name' => $request->name,
            'user_level_id' => $request->user_level_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/manage/user')->with('success', 'Berhasil Menambahkan Data');
    }

    function update($id)
    {
        $user = User::with('level')->find($id);
        $data = UserLevel::all();

        return view('backend.user.update_user', ['data' => $data], compact('user'));
    }

    function change(Request $request)
    {
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->user_level_id = $request->user_level_id;
        $user->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/user');
    }

    function updatePassword($id)
    {
        $user = User::find($id);

        return view('backend.user.update_password_user', compact('user'));
    }

    function changePassword(Request $request)
    {
        $user = User::find($request->id);

        // Validation 
        $request->validate([
            'passwordOld' => 'required',
            'passwordNew' => 'required', 
        ]);

        // Match The Old Password
        if (!Hash::check($request->passwordOld, $user->password)) {
            Session::flash('error', 'Password Lama tidak Sesuai');
            return Redirect::back();
        }

        $pass = $request->passwordNew;
        $passconf = $request->confirmpasswordNew;

        if ($pass !== $passconf) {
            Session::flash('danger', 'Password Baru dan Konfirmasi Password Tidak Sama');
            return Redirect::back(); 
        }

        User::whereId($request->id)->update([
            'password' => Hash::make($request->passwordNew)

        ]);

        Session::flash('success', 'Berhasil Mengubah Password User');

        return redirect('/manage/user');
    }

    function roleList()
    {
        $data = UserLevel::all();
        return view('backend.user.list_user_levels', ['data' => $data]);
    }
    function addNewRole()
    {
        return view('backend.user.add_user_levels');
    }
    
    function destroyRole(Request $request)
    {
        UserLevel::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/user-level');
    }
  
    function storeRole(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ], [
            'role.required' => 'Nama Level Akses Wajib Di isi',
        ]);

        $cekRole = $request->role;
        if ($cekRole !== 'admin' && $cekRole !== 'manager' && $cekRole !== 'hr' && $cekRole !== 'staff') {
            Session::flash('danger', 'Role Akses Baru Tidak Sesuai dengan Sistem');
            return redirect('/manage/user-level');
        }

        $sameRole = UserLevel::where('role', $cekRole)->first();

        if ($sameRole) {
            Session::flash('danger', 'Role Akses sudah Terdaftar');
            return redirect('/manage/user-level');
        }

        UserLevel::create([
            'role' => $request->role,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/manage/user-level')->with('success', 'Berhasil Menambahkan Data');
    }
}
