<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PositionController extends Controller
{
    function index()
    {
        $data = Position::all();
        return view('backend.positions.list_positions', ['data' => $data]);
    }
    function addNew()
    {
        return view('backend.positions.add_positions');
    }
    function update($id)
    {
        $data = Position::find($id);

        return view('backend.positions.update_positions', ['data' => $data]);
    }
    function destroy(Request $request)
    {
        Position::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/position');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama Posisi Wajib Di isi',
        ]);

        Position::create([
            'name' => $request->name,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/manage/position')->with('success', 'Berhasil Menambahkan Data');
    }
    function change(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama Posisi Wajib Di isi',
        ]);

        $office = Position::find($request->id);

        $office->name = $request->name;
        $office->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/position');
    }
}
