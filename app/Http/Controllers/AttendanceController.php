<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\Presence;
use App\Models\PresenceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function inAttendance()
    {
        $hariini = date('Y-m-d');
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::with('departement')->find($employee_id);

        $cek = Presence::where('presence_date', $hariini)->where('employee_id', $employee_id)->count();

        return view('frontend.attendance.in', compact('cek', 'employee'));
    }

    public function inStore(Request $request)
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::with('departement')->find($employee_id);

        $departement = $employee->departement->branch;

        $presence_date = date('Y-m-d');
        $day = date('D');
        $time = date('H:i:s');

        $location = $request->lokasi;
        $lokasiuser = explode(",", $location);
        $lat2 = $lokasiuser[0];
        $lon2 = $lokasiuser[1];

        $Dept = Departement::where('branch', $departement)->first();

        if ($day == "Sun") {
            echo "error|Selamat Berakhir Pekan, Anda Tidak Perlu Presensi Hari ini|sunday";
        } else {
            if ($departement == 'Yogyakarta') {
                $lat1 = $Dept->latitude;
                $lon1 = $Dept->longitude;
                $distancelocation = $this->distance($lat1, $lon1, $lat2, $lon2);
                $radius = round($distancelocation["meters"]);
            } elseif ($departement == 'Jepara') {
                $lat1 = $Dept->latitude;
                $lon1 = $Dept->longitude;
                $distancelocation = $this->distance($lat1, $lon1, $lat2, $lon2);
                $radius = round($distancelocation["meters"]);
            } elseif ($departement == 'Cirebon') {
                $lat1 = $Dept->latitude;
                $lon1 = $Dept->longitude;
                $distancelocation = $this->distance($lat1, $lon1, $lat2, $lon2);
                $radius = round($distancelocation["meters"]);
            } elseif ($departement == 'Surabaya') {
                $lat1 = $Dept->latitude;
                $lon1 = $Dept->longitude;
                $distancelocation = $this->distance($lat1, $lon1, $lat2, $lon2);
                $radius = round($distancelocation["meters"]);
            } elseif ($departement == 'Yogyakarta-2') {
                $lat1 = $Dept->latitude;
                $lon1 = $Dept->longitude;
                $distancelocation = $this->distance($lat1, $lon1, $lat2, $lon2);
                $radius = round($distancelocation["meters"]);
            } else {
                $radius = null;
            }

            $image = $request->image;


            $cek = Presence::where('presence_date', $presence_date)->where('employee_id', $employee_id)->count();

            if ($cek > 0) {
                $ket = "out";
            } else {
                $ket = "in";
            }

            if (isset($image)) {

                $folderPath = 'public/uploads/absensi/';
                $formatName = $employee->nip . "-" . $presence_date . "-" . $ket;
                $image_part = explode(';base64', $image);
                $image_base64 = base64_decode($image_part[1]);
                $fileName = $formatName . ".png";
                $photo = $folderPath . $fileName;
            } else {
                echo "error|Foto Selfie Gagal, Harap Reload Ulang Halaman / Hubungi Departemen IT|image";
            }


            if ($radius > 10) {
                echo "error|Maaf Anda berada diluar Radius, Jarak Anda masih " . $radius . " Meter dari Kantor|radius";
            } elseif ($radius == null) {
                echo "error|Maaf Koordinat Unit Kerja Anda tidak ditemukan, Hubungi Departemen IT|departement";
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
                    $ruleDatang = strtotime(PresenceRule::get('arrived_time'));
                    $timeIn = strtotime($time);

                    // dd($ruleDatang);
                    if ($timeIn <= $ruleDatang) {
                        $absen_masuk = [
                            'employee_id' => $employee_id,
                            'presence_date' => $presence_date,
                            'time_in' => $time,
                            'present_id' => 1,
                            'location_in' => $location,
                            'photo_in' => $fileName,
                        ];
                    } else {
                        $absen_masuk = [
                            'employee_id' => $employee_id,
                            'presence_date' => $presence_date,
                            'time_in' => $time,
                            'present_id' => 3,
                            'location_in' => $location,
                            'photo_in' => $fileName,
                        ];
                    }

                    $presensi_masuk = Presence::create($absen_masuk);
                    if ($presensi_masuk) {
                        echo "success|Terimakasih, Selamat Bekerja dan Jangan Lupa Berdoa|in";
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
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $meters = $miles * 1.609344;

        return compact('meters');
    }
}
