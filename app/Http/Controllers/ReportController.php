<?php

namespace App\Http\Controllers;

use App\Models\AdminReport;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\Location as ModelsLocation;
use App\Models\PromotorReport;
use App\Models\SalesIndustriReport;
use App\Models\SalesRetailReport;
use App\Models\TechnicianReport;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    function index()
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $employee = Employee::where('id', $employee_id)->first();

        $posisi = $employee->position->name;
        $departement_id = $employee->departement_id;

        $deptCoordinate = Departement::where('id', $departement_id)->first();

        $locationLat = $deptCoordinate->latitude;
        $locationLon = $deptCoordinate->longitude;


        $latitudeDept = $locationLat;
        $longitudeDept = $locationLon;



        //$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        $ip = $_SERVER['HTTP_HOST'];
        $info = Location::get($ip);

        // posisi
        if ($posisi == 'Promotor') {
            return view('frontend.reports.promotor.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'Sales Retail') {
            return view('frontend.reports.sales_retail.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'Sales Industri') {
            return view('frontend.reports.sales_industri.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'Teknisi') {
            return view('frontend.reports.technician.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'Admin') {
            return view('frontend.reports.admin.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'Online') {
            return view('frontend.reports.online.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'Manager') {
            return view('frontend.reports.manager.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'HR') {
            return view('frontend.reports.hr.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } elseif ($posisi == 'Produksi') {
            return view('frontend.reports.production.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        } else {
            return view('frontend.reports.user.index', compact('employee', 'info', 'latitudeDept', 'longitudeDept'));
        }
    }

    public function DistanceApply(Request $request)
    {

        $lat1 = $request->lat1;
        $lon1 = $request->lon1;
        $lat2 = $request->lat2;
        $lon2 = $request->lon2;
        $unit = 'K';


        $distance = round(distance($lat1, $lon1, $lat2, $lon2, $unit), 2);

        if ($distance <= 80) {
            $ket = "Dalam Kota";
        } else {
            $ket = "Luar Kota";
        }

        return response()->json(
            array(
                'data' => $distance,
                'ket' => $ket,
            )
        );
    } // End Method


    function storePromotor(Request $request)
    {
        $lat1 = $request->latitude1;
        $lon1 = $request->longitude1;
        $lat2 = $request->latitude2;
        $lon2 = $request->longitude2;

        $sharelok = "https://www.google.com/maps/dir/" . $lat1 . "," . $lon1 . "/" . $lat2 . "," . $lon2 . "/";

        //dd(gettype(floatval($lat1)));

        $request->validate([
            'waktu_kunjungan' => 'required',
            'lokasi_pemasangan_spanduk' => 'required|min:3',
            'jenis_spanduk' => 'required|min:3',
            'catatan_pemasangan_spanduk' => 'required|min:3',
            'follow_up' => 'required',
            'lokasi_event' => 'nullable',
            'jenis_event' => 'nullable',
            'jumlah_peserta' => 'nullable',
            'hasil_event' => 'nullable',
            'catatan' => 'nullable',
            'employee_id' => 'required',
        ], [
            'waktu_kunjungan.required' => 'Waktu Kunjungan Wajib Di isi',
            'lokasi_pemasangan_spanduk.required' => 'Lokasi Pemasangan Spanduk Wajib Di isi',
            'jenis_spanduk.required' => 'Jenis Spanduk Wajib Di isi',
            'catatan_pemasangan_spanduk.required' => 'Catatan Pemasangan Spanduk Wajib Di isi',
            'follow_up.required' => 'Follow Up Wajib Di isi',
            'employee_id.required' => 'Nama Karyawan Wajib Di isi',

        ]);

        $loc = ModelsLocation::insertGetId([
            'ip' => $request->ip,
            'latitude1' => $lat1,
            'latitude2' => $lat2,
            'longitude1' => $lon1,
            'longitude2' => $lon2,
            'distance' => $request->jarak,
            'city_name' => $request->city_name,
            'sharelok' => $sharelok,
            'keterangan' => $request->keterangan,
        ]);

        PromotorReport::create([
            'waktu_kunjungan' => $request->waktu_kunjungan,
            'lokasi_pemasangan_spanduk' => $request->lokasi_pemasangan_spanduk,
            'jenis_spanduk' => $request->jenis_spanduk,
            'catatan_pemasangan_spanduk' => $request->catatan_pemasangan_spanduk,
            'lokasi_event' => $request->lokasi_event,
            'jenis_event' => $request->jenis_event,
            'jumlah_peserta' => $request->jumlah_peserta,
            'hasil_event' => $request->hasil_event,
            'follow_up' => $request->follow_up,
            'catatan' => $request->catatan,
            'employee_id' => $request->employee_id,
            'location_id' => $loc,
        ]);

        Session::flash('success', 'Laporan berhasil terkirim');

        return redirect('/laporan-terkirim')->with('success', 'Berhasil Kirim Laporan');
    }

    function storeSalesIndustri(Request $request)
    {

        $lat1 = $request->latitude1;
        $lon1 = $request->longitude1;
        $lat2 = $request->latitude2;
        $lon2 = $request->longitude2;

        $sharelok = "https://www.google.com/maps/dir/" . $lat1 . "," . $lon1 . "/" . $lat2 . "," . $lon2 . "/";


        $request->validate([
            'waktu_kunjungan' => 'required',
            'nama_customer' => 'required|min:3',
            'jenis_customer' => 'required|min:3',
            'jenis_kunjungan' => 'required|min:3',
            'hasil_kunjungan' => 'nullable',
            'follow_up' => 'required',
            'employee_id' => 'required',
        ], [
            'waktu_kunjungan.required' => 'Waktu Kunjungan Wajib Di isi',
            'nama_customer.required' => 'Nama Customer Wajib Di isi',
            'jenis_customer.required' => 'Jenis Customer Wajib Di isi',
            'jenis_kunjungan.required' => 'Jenis Kunjungan Wajib Di isi',
            'hasil_kunjungan.required' => 'Hasil Kunjungan Wajib Di isi',
            'follow_up.required' => 'Follow Up Wajib Di isi',
            'employee_id.required' => 'Nama Karyawan Wajib Di isi',

        ]);

        $loc = ModelsLocation::insertGetId([
            'ip' => $request->ip,
            'latitude1' => $lat1,
            'latitude2' => $lat2,
            'longitude1' => $lon1,
            'longitude2' => $lon2,
            'distance' => $request->jarak,
            'city_name' => $request->city_name,
            'sharelok' => $sharelok,
            'keterangan' => $request->keterangan,
        ]);

        SalesIndustriReport::create([
            'waktu_kunjungan' => $request->waktu_kunjungan,
            'nama_customer' => $request->nama_customer,
            'jenis_customer' => $request->jenis_customer,
            'jenis_kunjungan' => $request->jenis_kunjungan,
            'hasil_kunjungan' => $request->hasil_kunjungan,
            'follow_up' => $request->follow_up,
            'employee_id' => $request->employee_id,
            'location_id' => $loc,
        ]);

        Session::flash('success', 'Laporan berhasil terkirim');

        return redirect('/laporan-terkirim')->with('success', 'Berhasil Kirim Laporan');
    }

    function storeSalesRetail(Request $request)
    {

        $lat1 = $request->latitude1;
        $lon1 = $request->longitude1;
        $lat2 = $request->latitude2;
        $lon2 = $request->longitude2;

        $sharelok = "https://www.google.com/maps/dir/" . $lat1 . "," . $lon1 . "/" . $lat2 . "," . $lon2 . "/";

        $request->validate([
            'waktu_kunjungan' => 'required',
            'nama_customer' => 'required|min:3',
            'jenis_customer' => 'required|min:3',
            'jenis_kunjungan' => 'required|min:3',
            'hasil_kunjungan' => 'nullable',
            'lokasi_event' => 'nullable',
            'jenis_event' => 'nullable',
            'jumlah_peserta' => 'nullable',
            'hasil_event' => 'nullable',
            'catatan' => 'nullable',
            'follow_up' => 'required',
            'employee_id' => 'required',
        ], [
            'waktu_kunjungan.required' => 'Waktu Kunjungan Wajib Di isi',
            'nama_customer.required' => 'Nama Customer Wajib Di isi',
            'jenis_customer.required' => 'Jenis Customer Wajib Di isi',
            'jenis_kunjungan.required' => 'Jenis Kunjungan Wajib Di isi',
            'follow_up.required' => 'Follow Up Wajib Di isi',
            'employee_id.required' => 'Nama Karyawan Wajib Di isi',

        ]);

        $loc = ModelsLocation::insertGetId([
            'ip' => $request->ip,
            'latitude1' => $lat1,
            'latitude2' => $lat2,
            'longitude1' => $lon1,
            'longitude2' => $lon2,
            'distance' => $request->jarak,
            'city_name' => $request->city_name,
            'sharelok' => $sharelok,
            'keterangan' => $request->keterangan,
        ]);

        SalesRetailReport::create([
            'waktu_kunjungan' => $request->waktu_kunjungan,
            'nama_customer' => $request->nama_customer,
            'jenis_customer' => $request->jenis_customer,
            'jenis_kunjungan' => $request->jenis_kunjungan,
            'hasil_kunjungan' => $request->hasil_kunjungan,
            'follow_up' => $request->follow_up,
            'lokasi_event' => $request->lokasi_event,
            'jenis_event' => $request->jenis_event,
            'jumlah_peserta' => $request->jumlah_peserta,
            'hasil_event' => $request->hasil_event,
            'catatan' => $request->catatan,
            'employee_id' => $request->employee_id,
            'location_id' => $loc,
        ]);

        Session::flash('success', 'Laporan berhasil terkirim');

        return redirect('/laporan-terkirim')->with('success', 'Berhasil Kirim Laporan');
    }

    function storeTechnician(Request $request)
    {

        $lat1 = $request->latitude1;
        $lon1 = $request->longitude1;
        $lat2 = $request->latitude2;
        $lon2 = $request->longitude2;

        $sharelok = "https://www.google.com/maps/dir/" . $lat1 . "," . $lon1 . "/" . $lat2 . "," . $lon2 . "/";

        $request->validate([
            'waktu_kunjungan' => 'required',
            'nama_customer' => 'required|min:3',
            'jenis_customer' => 'required|min:3',
            'jenis_kunjungan' => 'required|min:3',
            'hasil_kunjungan' => 'nullable',
            'aktivitas_kantor' => 'nullable',
            'keterangan_aktivitas' => 'nullable',
            'keterangan_tujuan' => 'nullable',
            'durasi_aktivitas' => 'nullable',
            'follow_up' => 'required',
            'employee_id' => 'required',
        ], [
            'waktu_kunjungan.required' => 'Waktu Kunjungan Wajib Di isi',
            'nama_customer.required' => 'Nama Customer Wajib Di isi',
            'jenis_customer.required' => 'Jenis Customer Wajib Di isi',
            'jenis_kunjungan.required' => 'Jenis Kunjungan Wajib Di isi',
            'follow_up.required' => 'Follow Up Wajib Di isi',
            'employee_id.required' => 'Nama Karyawan Wajib Di isi',

        ]);

        $loc = ModelsLocation::insertGetId([
            'ip' => $request->ip,
            'latitude1' => $lat1,
            'latitude2' => $lat2,
            'longitude1' => $lon1,
            'longitude2' => $lon2,
            'distance' => $request->jarak,
            'city_name' => $request->city_name,
            'sharelok' => $sharelok,
            'keterangan' => $request->keterangan,
        ]);

        TechnicianReport::create([
            'waktu_kunjungan' => $request->waktu_kunjungan,
            'nama_customer' => $request->nama_customer,
            'jenis_customer' => $request->jenis_customer,
            'jenis_kunjungan' => $request->jenis_kunjungan,
            'hasil_kunjungan' => $request->hasil_kunjungan,
            'follow_up' => $request->follow_up,
            'aktivitas_kantor' => $request->aktivitas_kantor,
            'keterangan_aktivitas' => $request->keterangan_aktivitas,
            'keterangan_tujuan' => $request->keterangan_tujuan,
            'durasi_aktivitas' => $request->durasi_aktivitas,
            'employee_id' => $request->employee_id,
            'location_id' => $loc,
        ]);

        Session::flash('success', 'Laporan berhasil terkirim');

        return redirect('/laporan-terkirim')->with('success', 'Berhasil Kirim Laporan');
    }

    function storeAdmin(Request $request)
    {
        //dd($request->all());

        $lat1 = $request->latitude1;
        $lon1 = $request->longitude1;
        $lat2 = $request->latitude2;
        $lon2 = $request->longitude2;

        $sharelok = "https://www.google.com/maps/dir/" . $lat1 . "," . $lon1 . "/" . $lat2 . "," . $lon2 . "/";

        $request->validate([
            'employee_id' => 'required',
        ], [
            'employee_id.required' => 'Nama Karyawan Wajib Di isi',
        ]);


        if ($request->hasFile('file')) {

            $request->validate(['file' => 'mimes:csv,xlsx,xls|file|max:4048']);

            $report_file = $request->file('file');
            $file_ekstensi = $report_file->extension();
            $nama_file = str_replace(" ", "_", $request->nama_admin) . "-" . date('d-m-y-H-i-s') . "-" . str_replace(" ", "_", $request->file->getClientOriginalName());
            $report_file->move(public_path('files'), $nama_file);
            $fileReport = $nama_file;
        } else {
            $fileReport = "none";
        }

        $loc = ModelsLocation::insertGetId([
            'ip' => $request->ip,
            'latitude1' => $lat1,
            'latitude2' => $lat2,
            'longitude1' => $lon1,
            'longitude2' => $lon2,
            'distance' => $request->jarak,
            'city_name' => $request->city_name,
            'sharelok' => $sharelok,
            'keterangan' => $request->keterangan,
        ]);

        AdminReport::create([
            'employee_id' => $request->employee_id,
            'file' => $fileReport,
            'location_id' => $loc,
        ]);



        Session::flash('success', 'Laporan berhasil terkirim');

        return redirect('/laporan-terkirim')->with('success', 'Berhasil Kirim Laporan');
    }

    function send()
    {
        return view('reports/laporan_terkirim');
    }
}
