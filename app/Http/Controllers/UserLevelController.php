<?php

namespace App\Http\Controllers;

use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserLevelController extends Controller
{
    function index()
    {
        $data = UserLevel::all();
        return view('user-levels.index', ['data' => $data]);
    }
    function addNew()
    {
        return view('user-levels.add');
    }
    function update($id)
    {
        $data = UserLevel::find($id);

        return view('user-levels.update', ['data' => $data]);
    }
    function destroy(Request $request)
    {
        UserLevel::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/user-levels');
    }
  
    function create(Request $request)
    {
        $request->validate([
            'role' => 'required|min:3',
        ], [
            'role.required' => 'Nama Level Akses Wajib Di isi',
            'role.min' => 'Kolom Nama Level Akses minimal harus 3 karakter.',
        ]);

        UserLevel::create([
            'role' => $request->role,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/user-levels')->with('success', 'Berhasil Menambahkan Data');
    }
    function change(Request $request)
    {
        $request->validate([
            'role' => 'required|min:3',
        ], [
            'role.required' => 'Nama Level Akses Wajib Di isi',
            'role.min' => 'Kolom Nama Level Akses minimal harus 3 karakter.',
        ]);

        $office = UserLevel::find($request->id);

        $office->role = $request->role;
        $office->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/user-levels');
    }
}
