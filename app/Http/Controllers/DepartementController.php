<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartementController extends Controller
{
    function index()
    {
        $data = Departement::all();
        
        $lok1 = 'Yogyakarta';
        $Dept = Departement::where('branch', $lok1)->first();
        dd($Dept->latitude);
        // $latDeptYog1 = 

        return view('backend.departements.list_departements', ['data' => $data]);
    }

    function addNew()
    {
        return view('backend.departements.add_departements');
    }
    function update($id)
    {
        $data = Departement::find($id);

        return view('backend.departements.update_departements', ['data' => $data]);
    }
    function destroy(Request $request)
    {
        Departement::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/departement');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'address' => 'required|min:3',
        ], [
            'name.required' => 'Nama Kantor Wajib Di isi',
            'name.min' => 'Kolom Nama Kantor minimal harus 3 karakter.',
            'address.required' => 'Alamat Kantor Wajib Di isi',
            'address.min' => 'Kolom Alamat Kantor minimal harus 3 karakter.',
        ]);

        Departement::create([
            'name' => $request->name,
            'address' => $request->address,
            'branch' => $request->branch,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'qrcode' => $request->qrcode,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);


        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/manage/departement')->with('success', 'Berhasil Menambahkan Data');
    }
    function change(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'address' => 'required|min:3',
        ], [
            'name.required' => 'Nama Kantor Wajib Di isi',
            'name.min' => 'Kolom Nama Kantor minimal harus 3 karakter.',
            'address.required' => 'Alamat Kantor Wajib Di isi',
            'address.min' => 'Kolom Alamat Kantor minimal harus 3 karakter.',
        ]);

        $dept = Departement::find($request->id);

        $dept->name = $request->name;
        $dept->address = $request->address;
        $dept->branch = $request->branch;
        $dept->latitude = $request->latitude;
        $dept->longitude = $request->longitude;
        $dept->qrcode = $request->qrcode;
        $dept->phone = $request->phone;
        $dept->email = $request->email;
        $dept->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/departement');
    }
}
