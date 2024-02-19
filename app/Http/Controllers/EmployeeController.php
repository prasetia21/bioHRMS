<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\GetLeave;
use App\Models\Leave;
use App\Models\Position;
use App\Models\UserLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    function index()
    {
        $data = Employee::with('departement')->with('position')->with('level')->with('leave')->get();

        // $date = $data[0]['contact_date'];
        // $arr = explode(' to ', $date);

        // $timestamp1 = $arr['0'];
        // $timestamp2 = $arr['1'];

        // $formatted_dt1 = Carbon::parse($timestamp1);

        // $formatted_dt2 = Carbon::parse($timestamp2);

        // $date_diff = $formatted_dt1->diffInDays($formatted_dt2);

        // $month_diff = $formatted_dt1->diffInMonths($formatted_dt2);

        // $year_diff = $formatted_dt1->diffInYears($formatted_dt2);

        return view('backend.employees.list_employees', ['data' => $data]);
    }

    function addNew()
    {
        $departements = Departement::latest()->get();
        $positions = Position::latest()->get();
        $levels = UserLevel::latest()->get();

        return view('backend.employees.add_employees', compact('departements', 'positions', 'levels'));
    }

    function store(Request $request)
    {
        $photo = '';
        $inputdate = $request->birth_date;
        $inputstartdate = $request->start_work_date;
        $format = 'd-m-Y';
        $formatdate = 'Y-m-d';
        $date = Carbon::parse($inputdate)->format($format);
        $passDate = str_replace('-', '', $date);

        $birthDate = Carbon::parse($inputdate)->format($formatdate);
        $workDate = Carbon::parse($inputstartdate)->format($formatdate);


        


        $start = Carbon::parse($workDate);
        $now = Carbon::now();

        $date_diff = $now->diffInDays($start);

        $month_diff = $now->diffInMonths($start);

        $year_diff = $now->diffInYears($start);
        
        $prevBulan = $start->format('m');

        if ($year_diff >= 2) {
            $jatah = 12;
        } elseif ($year_diff == 1) {
            $jatah = (12 - $prevBulan) + 1;
        } else {
            $jatah = 0;
        }

        // dd($year_diff);

        $request->validate([
            'phone' => 'required|min:4',
            'fullname' => 'required|min:4',
            'user_level_id' => 'required',
            'position_id' => 'required',
            'departement_id' => 'required',
        ], [
            'phone.required' => 'Nomor HP Wajib Di isi / Tidak Sesuai',
            'phone.min' => 'Bidang Nomor HP minimal harus 10 karakter.',
            'fullname.required' => 'Name Wajib Di isi',
            'fullname.min' => 'Bidang Name minimal harus 4 karakter.',
            'user_level_id.required' => 'Level Akses User Wajib Di isi',
            'position_id.required' => 'Posisi Wajib Di isi',
            'departement_id.required' => 'Departemen Wajib Di isi',
        ]);

        $cekPhone = $request->phone;
        $sameUser = Employee::where('phone', $cekPhone)->first();

        if ($sameUser) {
            Session::flash('danger', 'No HP sudah Terdaftar');
            return Redirect::back();
        }


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

        $pegawai = Employee::insertGetId([
            'user_level_id' => $request->user_level_id,
            'position_id' => $request->position_id,
            'departement_id' => $request->departement_id,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'password' => Hash::make($passDate),
            'fullname' => $request->fullname,
            'photo' => $photo,
            'gender' => $request->gender,
            'address' => $request->address,
            'birth_date' => $birthDate,
            'birth_place' => $request->birth_place,
            'start_work_date' => $workDate,
            'contact_date' => $request->contact_date,
            'status' => $request->status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        GetLeave::create([
            'employee_id' => $pegawai,
            'total_days' => $jatah,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan.');

        return redirect('/manage/employee');
    }

    function update($id)
    {
        $data = Employee::with('departement')
            ->with('position')
            ->with('level')
            ->find($id);

        $departements = Departement::latest()->get();
        $positions = Position::latest()->get();
        $levels = UserLevel::latest()->get();

        return view('backend.employees.update_employees', ['data' => $data], compact('departements', 'positions', 'levels'));
    }

    function destroy(Request $request)
    {
        Employee::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/employee');
    }

    function change(Request $request)
    {
        if ($request->hasFile('photo')) {

            $request->validate(['photo' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

            $photo_file = $request->file('photo');
            $foto_ekstensi = $photo_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $photo_file->move(public_path('picture/accounts'), $nama_foto);
            $photo = $nama_foto;
        } else {
            $photo = $request->backup_photo;
        }

        $inputdate = $request->birth_date;
        $inputstartdate = $request->birth_date;
        $formatdate = 'Y-m-d';

        $birthDate = Carbon::parse($inputdate)->format($formatdate);
        $workDate = Carbon::parse($inputstartdate)->format($formatdate);

        $karyawan = Employee::find($request->id);

        $karyawan->nip = $request->nip;
        $karyawan->user_level_id = $request->user_level_id;
        $karyawan->position_id = $request->position_id;
        $karyawan->departement_id = $request->departement_id;
        $karyawan->fullname = $request->fullname;
        $karyawan->photo = $photo;
        $karyawan->gender = $request->gender;
        $karyawan->address = $request->address;
        $karyawan->birth_date = $birthDate;
        $karyawan->birth_place = $request->birth_place;
        $karyawan->start_work_date = $workDate;
        $karyawan->status = $request->status;
        $karyawan->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/employee');
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

        $pegawai = Employee::insertGetId([
            'user_level_id' => $request->user_level_id,
            'position_id' => $request->position_id,
            'departement_id' => $request->departement_id,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        GetLeave::create([
            'employee_id' => $pegawai->id,
            'total_days' => 12,
        ]);

        Session::flash('success', 'User berhasil didaftarkan.');

        return redirect('/');
    }
}
