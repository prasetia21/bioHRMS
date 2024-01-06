<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\Position;
use App\Models\UserLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    function index()
    {
        $data = Employee::with('departement')->get();
        return view('backend.employees.list_employees', ['data' => $data]);
    }

    function addNew()
    {
        $office = Departement::latest()->get();
        $position = Position::latest()->get();
        $level = UserLevel::latest()->get();

        return view('backend.employees.add_employees', compact('office', 'position', 'level'));
    }

    function store(Request $request)
    {
        $photo = '';
        $inputdate = $request->birth_date;
        $format = 'd-m-Y';
        $date = Carbon::parse($inputdate)->format($format);

        $request->validate([
            'phone' => 'required|min:4',
            'fullname' => 'required|min:4',
            'password' => 'required|min:6',
            'user_level_id' => 'required',
            'position_id' => 'required',
            'departement_id' => 'required',
        ], [
            'phone.required' => 'Nomor HP Wajib Di isi',
            'phone.min' => 'Bidang Nomor HP minimal harus 4 karakter.',
            'fullname.required' => 'Full Name Wajib Di isi',
            'fullname.min' => 'Bidang Full Name minimal harus 4 karakter.',
            'password.required' => 'Password Wajib Di isi',
            'password.min' => 'Password minimal harus 6 karakter.',
            'user_level_id.required' => 'Level Akses User Wajib Di isi',
            'position_id.required' => 'Posisi Wajib Di isi',
            'departement_id.required' => 'Departemen Wajib Di isi',
        ]);


        if ($request->hasFile('photo')) {

            $request->validate(['photo' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

            $photo_file = $request->file('photo');
            $foto_ekstensi = $photo_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $photo_file->move(public_path('picture/accounts'), $nama_foto);
            $photo = $nama_foto;
        } else {
            $photo = "user.jpeg";
        }

        Employee::create([
            'user_level_id' => $request->user_level_id,
            'position_id' => $request->position_id,
            'departement_id' => $request->departement_id,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'password' => $date,
            'fullname' => $request->fullname,
            'photo' => $photo,
            'gender' => $request->gender,
            'address' => $request->address,
            'birth_date' => $date,
            'birth_place' => $request->birth_place,
            'start_work_date' => $request->start_work_date,
            'status' => $request->status,            
        ]);

        Session::flash('success', 'Data berhasil ditambahkan.');

        return redirect('/manage/employees');
    }

    function update($id)
    {
        $data = Employee::find($id);
        $office = Departement::latest()->get();
        $position = Position::latest()->get();
        $level = UserLevel::latest()->get();


        return view('backend.employees.update', ['data' => $data], compact('office', 'position', 'level'));
    }
    function destroy(Request $request)
    {
        Employee::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/employees');
    }
    
    function change(Request $request)
    {
        $photo_file = $request->file('photo');
        $photo_ekstensi = $photo_file->extension();
        $photo = date('ymdhis') . "." . $photo_ekstensi;
        $photo_file->move(public_path('picture/accounts'), $photo);

        $karyawan = Employee::find($request->id);

        $karyawan->nip = $request->nip;
        $karyawan->user_level_id = $request->user_level_id;
        $karyawan->position_id = $request->position_id;
        $karyawan->departement_id = $request->departement_id;
        $karyawan->fullname = $request->fullname;
        $karyawan->photo = $photo;
        $karyawan->gender = $request->gender;
        $karyawan->address = $request->address;
        $karyawan->birth_date = $request->birth_date;
        $karyawan->birth_place = $request->birth_place;
        $karyawan->start_work_date = $request->start_work_date;
        $karyawan->status = $request->status;
        $karyawan->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/employees');
    }

    function register()
    {
        $office = Departement::latest()->get();
        $position = Position::latest()->get();
        $level = UserLevel::latest()->get();

        return view('register.new', compact('office', 'position', 'level'));
    }

    function registerStore(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:4',
            'fullname' => 'required|min:4',
            'password' => 'required|min:6',
            'user_level_id' => 'required',
            'position_id' => 'required',
            'departement_id' => 'required',
        ], [
            'phone.required' => 'Nomor HP Wajib Di isi',
            'phone.min' => 'Bidang Nomor HP minimal harus 4 karakter.',
            'fullname.required' => 'Full Name Wajib Di isi',
            'fullname.min' => 'Bidang Full Name minimal harus 4 karakter.',
            'password.required' => 'Password Wajib Di isi',
            'password.min' => 'Password minimal harus 6 karakter.',
            'user_level_id.required' => 'Level Akses User Wajib Di isi',
            'position_id.required' => 'Posisi Wajib Di isi',
            'departement_id.required' => 'Departemen Wajib Di isi',
        ]);

        Employee::create([
            'user_level_id' => $request->user_level_id,
            'position_id' => $request->position_id,
            'departement_id' => $request->departement_id,
            'phone' => $request->phone,
            'password' => $request->password,
            'fullname' => $request->fullname,    
        ]);

        Session::flash('success', 'User berhasil didaftarkan.');

        return redirect('/');
    }
}
