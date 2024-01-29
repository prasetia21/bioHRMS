<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\Presence;
use App\Models\WorkPermit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class WorkPermitController extends Controller
{
    public function index(Request $request)
    {
        $hariini = date('Y-m-d');
        $employee_id = Auth::guard('employee')->user()->id;

        $employee = Employee::with('position')->with('departement')->where('id', $employee_id)->first();


        $posisi = $employee->position->name;
        $departement_id = $employee->departement_id;


        return view('frontend.work_permit.request', compact('employee'));
    }




    function store(Request $request)
    {
        $employee_id = Auth::guard('employee')->user()->id;

        $attachment = '';
        $inputstartdate = $request->start_date;
        $inputenddate = $request->end_date;

        $time = date('H:i:s');
        $formatdate = 'Y-m-d';
        $startDate = Carbon::parse($inputstartdate)->format($formatdate);
        $endDate = Carbon::parse($inputenddate)->format($formatdate);

        $date1 = date_create($startDate); //mis. tgl chekin
        $date2 = date_create($endDate);

        $jmlDate = date_diff($date1, $date2);

        $jumlah_hari = $jmlDate->format("%d%") + 1;

        if ($jumlah_hari >= 8) {
            Session::flash('danger', 'Jumlah hari ijin maksimal 7 Hari, Harap Hubungi HR untuk info lebih lanjut');
            return Redirect::back();
        }

        $dateRange = $this->dateRange($startDate, $endDate);


        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'present_id' => 'required',
            'note' => 'required',
        ], [
            'start_date.required' => 'Tanggal Mulai Ijin Wajib Di isi',
            'end_date.required' => 'Tanggal Akhir Ijin Wajib Di isi',
            'present_id.required' => 'Alasan Ijin Wajib Di isi',
            'note.required' => 'Keterangan Ijin Wajib Di isi',
        ]);

        if ($request->hasFile('attachment')) {

            $request->validate(['attachment' => 'mimes:jpeg,jpg,png,gif|image|file|max:2048']);

            $attachment_file = $request->file('attachment');
            $foto_ekstensi = $attachment_file->extension();
            $nama_file = date('ymdhis') . "." . $foto_ekstensi;
            $attachment_file->move(public_path('picture/ijin'), $nama_file);
            $attachment = $nama_file;
        } else {
            $attachment = "null";
        }

        if ($request->present_id == 2) {
            WorkPermit::create([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'employee_id' => $employee_id,
                'present_id' => $request->present_id,
                'note' => $request->note,
                'attachment' => $attachment,
                'approval' => true,
            ]);

            if ($jumlah_hari == 1) {
                Presence::create([
                    'employee_id'  => $employee_id,
                    'present_id' => $request->present_id,
                    'presence_date' => $startDate,
                    'time_in' => $time,
                    'time_out' => '00:00:00',
                    'photo_in'  => $attachment,
                    'photo_out'  => $attachment,
                ]);
            } else {

                foreach ($dateRange as $date => $value) {
                    Presence::create([
                        'employee_id'  => $employee_id,
                        'present_id' => $request->present_id,
                        'presence_date' => $value->format('Y-m-d'),
                        'time_in' => $time,
                        'time_out' => '00:00:00',
                        'photo_in'  => $attachment,
                        'photo_out'  => $attachment,
                    ]);
                }
            }
        } else {
            $ijin = WorkPermit::insertGetId([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'employee_id' => $employee_id,
                'present_id' => $request->present_id,
                'note' => $request->note,
                'attachment' => $attachment,
                'approval' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach ($dateRange as $date => $value) {
                Session::push('ijin', ([
                    'id_ijin' => $ijin,
                    'employee_id'  => $employee_id,
                    'present_id' => $request->present_id,
                    'presence_date' => $value->format('Y-m-d'),
                    'time_in' => $time,
                    'time_out' => '00:00:00',
                    'photo_in'  => $attachment,
                    'photo_out'  => $attachment,
                ]));
            }
        }

        
    }

    function dateRange($startDate, $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);



        // Convert the period to an array of dates
        $dates = $period->toArray();

        return $dates;
    }
}
