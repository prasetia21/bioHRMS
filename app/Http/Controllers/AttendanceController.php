<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function inAttendance()
    {
        $hariini = date('Y-m-d');
        $employee_id = Auth::guard('employee')->user()->id;
        $cek = Presence::where('presence_date', $hariini)->where('id', $employee_id)->count();
        return view('frontend.attendance.in', compact('cek'));
    }

    public function inStore(Request $request)
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::find($employee_id);

        $departement = $employee->departement_id;

        $presence_date = date('Y-m-d');
        $day = date('D');
        $time = date('H:i:s');

        $latYog = -7.824743884482511;
        $longYog = 110.3851776668307;

        $latJep = -6.652100557453785;
        $longJep = 110.70972057237938;

        $latCir = -6.709089464556359;
        $longCir = 108.4885450319081;

        $latSby = -7.446453578935748;
        $longSby = 112.56573042028272;

        $location = $request->lokasi;
        $lokasiuser = explode(",", $location);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        if ($day == "Sun") {
            echo "error|Selamat Berakhir Pekan, Anda Tidak Perlu Presensi Hari ini|sunday";
        } else {
            if ($departement == 1) {
                $distancelocation = $this->distance($latYog, $longYog, $latitudeuser, $longitudeuser);
                $radius = round($distancelocation["meters"]);
            } elseif ($departement == 2) {
                $distancelocation = $this->distance($latJep, $longJep, $latitudeuser, $longitudeuser);
                $radius = round($distancelocation["meters"]);
            } elseif ($departement == 3) {
                $distancelocation = $this->distance($latCir, $longCir, $latitudeuser, $longitudeuser);
                $radius = round($distancelocation["meters"]);
            } elseif ($departement == 4) {
                $distancelocation = $this->distance($latSby, $longSby, $latitudeuser, $longitudeuser);
                $radius = round($distancelocation["meters"]);
            } else {
                $radius = null;
            }
    
            $image = $request->image;
            //dd($location);
    
            $cek = Presence::where('presence_date', $presence_date)->where('id', $employee_id)->count();
    
            if ($cek > 0) {
                $ket = "out";
            } else {
                $ket = "in";
            }

            if (isset($image)) {
                $folderPath = 'public/uploads/absensi';
                $formatName = $employee->nip . "-" . $presence_date . "-" . $ket;
                $image_part = explode(';base64', $image);
                $image_base64 = base64_decode($image_part[1]);
                $fileName = $formatName . ".png";
                $photo = $folderPath . $fileName;
            } else {
                echo "error|Foto Selfie Gagal, Harap Reload Ulang Halaman / Hubungi IT Departemen|image";
            }
    
           
            if ($radius > 10) {
                echo "error|Maaf Anda berada diluar Radius, Jarak Anda masih " . $radius . " Meter dari Kantor|radius";
            } elseif ($radius == null) {
                echo "error|Maaf Koordinat Departemen Bagian Anda tidak ditemukan, Hubungi IT Departemen|departement";
            } else {
                if ($cek > 0) {
                    $absen_pulang = [
                        'time_out' => $time,
                        'location_out' => $location,
                        'photo_out' => $fileName,
                    ];
                    $presensi_pulang = Presence::where('presence_date', $presence_date)->where('employee_id', $employee_id)->update($absen_pulang);
                    if ($presensi_pulang) {
                        echo "success|Terimakasih, Hati-hati dijalan|out";
                        Storage::put($photo, $image_base64);
                    } else {
                        echo "error|Gagal Absen, Harap Mencoba Kembali|out";
                    }
                } else {
                    $absen_masuk = [
                        'employee_id' => $employee_id,
                        'presence_date' => $presence_date,
                        'time_in' => $time,
                        'location_in' => $location,
                        'photo_in' => $fileName,
                    ];
                    $presensi_masuk = Presence::insert($absen_masuk);
                    if ($presensi_masuk) {
                        echo "success|Terimakasih, Selamat Bekerja, Jangan Lupa Berdoa|in";
                        Storage::put($photo, $image_base64);
                    } else {
                        echo "error|Gagal Absen, Harap Mencoba Kembali|in";
                    }
                }
            }
        }

        
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}
