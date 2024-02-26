<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $hariini = date('Y-m-d');
        $employee_id = Auth::guard('employee')->user()->id;

        $employee = Employee::with('position')->with('departement')->where('id', $employee_id)->first();

        $posisi = $employee->position->name;
        $departement_id = $employee->departement_id;

        return view('frontend.profile.edit', compact('employee'));
    }

    function change(Request $request)
    {
        if ($request->upload_option === 'file') {

            if ($request->hasFile('file_input')) {

                $request->validate(['file_input' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

                $photo_file = $request->file('file_input');
                $foto_ekstensi = $photo_file->extension();
                $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
                $photo_file->move(public_path('picture/accounts'), $nama_foto);
                $photo = $nama_foto;
            } else {
                $photo = $request->backup_photo;
            }

            $inputdate = $request->birth_date;
            $formatdate = 'Y-m-d';
            $birthDate = Carbon::parse($inputdate)->format($formatdate);

            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);

            // Match The Old Password
            if (!Hash::check($request->old_password, Auth::guard('employee')->user()->password)) {
                Session::flash('warning', 'Kata Sandi Tidak Sesuai, Cek Kembali Kata Sandi Lama Anda!!');
                return Redirect::back();
            }

            $passNew = Hash::make($request->passBaru);


            $karyawan = Employee::find($request->id);

            $karyawan->nip = $request->nip;
            $karyawan->fullname = $request->fullname;
            $karyawan->photo = $photo;
            $karyawan->gender = $request->gender;
            $karyawan->address = $request->address;
            $karyawan->password = $passNew;
            $karyawan->birth_date = $birthDate;
            $karyawan->birth_place = $request->birth_place;
            $karyawan->save();

            Session::flash('success', 'Berhasil Mengubah Profil');

            return redirect('/dashboard');
        } else {
            // Proses capture webcam
            $imageData = $request->image_data;

            $formatName = date('ymdhis');
            $image_part = explode(';base64', $imageData);
            $image_base64 = base64_decode($image_part[1]);
            $fileName = $formatName . ".png";

            $imageData->move(public_path('picture/accounts'), $fileName, $image_base64);


            $inputdate = $request->birth_date;
            $formatdate = 'Y-m-d';
            $birthDate = Carbon::parse($inputdate)->format($formatdate);
            // Validation Password
            // $request->validate([
            //     'passConfirm' => 'required| min:6',
            //     'passBaru' => 'required| min:6| max:12 |same:password',
            // ]);

            // Match The Old Password
            if (!Hash::check($request->passLama, Auth::guard('employee')->user()->password)) {
                Session::flash('warning', 'Kata Sandi Tidak Sesuai, Cek Kembali Kata Sandi Lama Anda!!');
                return back();
            }

            $passNew = Hash::make($request->passBaru);


            $karyawan = Employee::find($request->id);

            $karyawan->nip = $request->nip;
            $karyawan->fullname = $request->fullname;
            $karyawan->photo = $fileName;
            $karyawan->gender = $request->gender;
            $karyawan->address = $request->address;
            $karyawan->password = $passNew;
            $karyawan->birth_date = $birthDate;
            $karyawan->birth_place = $request->birth_place;
            $karyawan->save();

            Session::flash('success', 'Berhasil Mengubah Profil');

            return redirect('/dashboard');
        }
    }
}
