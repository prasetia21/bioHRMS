<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\GetLeave;
use App\Models\Leave;
use App\Models\LeaveRequest;
use App\Models\Presence;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LeaveController extends Controller
{
    public function index()
    {
        $hariini = date('Y-m-d');
        $employee_id = Auth::guard('employee')->user()->id;

        $getJatahCuti = GetLeave::with('employee.position')
        ->with('employee.departement')->where('employee_id', $employee_id)->first();

        if ($getJatahCuti === null) {
            return Redirect::back();
        }
        $posisi = $getJatahCuti->employee->position->name;
        $departement_id = $getJatahCuti->employee->departement_id;

        $employees = Employee::with('position')
            ->with('departement')
            ->with('leave')
            ->where('departement_id', $departement_id)
            ->get();

        return view('frontend.leave.request', compact('employees', 'getJatahCuti'));
    }

    function store(Request $request)
    {
        $employee_id = Auth::guard('employee')->user()->id;
        $attachment = '';
        $departement = $request->kantor_cabang;
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

        if ($jumlah_hari >= 13) {
            Session::flash('danger', 'Jumlah hari cuti maksimal 12 Hari, Harap Hubungi HR untuk info lebih lanjut');
            return Redirect::back();
        }

        $dateRange = $this->dateRange($startDate, $endDate);


        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'number_leave_day' => 'required',
            'note' => 'required',
        ], [
            'start_date.required' => 'Tanggal Mulai Cuti Wajib Di isi',
            'end_date.required' => 'Tanggal Akhir Cuti Wajib Di isi',
            'number_leave_day.required' => 'Jumlah Pengambilan Cuti Wajib Di isi',
            'note.required' => 'Alasan Pengajuan Cuti Wajib Di isi',
        ]);

        if ($request->hasFile('attachment')) {

            $request->validate(['attachment' => 'mimes:jpeg,jpg,png,gif|image|file|max:2048']);

            $attachment_file = $request->file('attachment');
            $foto_ekstensi = $attachment_file->extension();
            $nama_file = date('ymdhis') . "." . $foto_ekstensi;
            $attachment_file->move(public_path('picture/cuti'), $nama_file);
            $attachment = $nama_file;
        } else {
            $attachment = "null";
        }

        $hariini = date('Y-m-d');

        LeaveRequest::create([
            'employee_id'  => $employee_id,
            'present_id' => $request->present_id,
            'req_date' => $hariini,
            'time_in' => $time,
            'time_out' => '00:00:00',
            'photo_in'  => $attachment,
            'photo_out'  => $attachment,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'number_leave_day' => $request->total_hari,
            'note' => $request->note,
            'pic' => $request->pic,
            'attachment' => $attachment,
            'departement' => $departement,
            'approval_1' => false,
            'approval_2' => false,
        ]);

        Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Approval Atasan Anda');
        return redirect('/dashboard');
    }

    function tolakCuti(Request $request)
    {
        $hariini = date('Y-m-d');

        $cuti = LeaveRequest::where('req_date', $hariini)->count();

        if ($cuti >= 1) {
            $idPegawai = $request->id;
            $cuti = LeaveRequest::with('employee')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('employee_id', $idPegawai)
                ->first();

            $namaReq = $request->route()->getName();

            if ($namaReq == "tolak-cuti.hr") {
                LeaveRequest::where('employee_id', $idPegawai)
                    ->update([
                        'approval_1' => $request->approval_1,
                        'reject_1' => $request->reject_1,
                        'status_1' => $request->status_1,
                    ]);
                $cekCuti = LeaveRequest::where('employee_id', $idPegawai)->first();


                if (
                    $cekCuti->approval_1 == 0 &&
                    $cekCuti->status_1 != null &&
                    ($cekCuti->approval_2 == 0 && $cekCuti->status_2 != null)
                ) {

                    LeaveRequest::where('employee_id', $cekCuti->employee_id)->delete();
                }
                Session::flash('success', 'Berhasil Ditolak');
                return Redirect::back();
            } elseif ($namaReq == "tolak-cuti.manager") {
                LeaveRequest::where('employee_id', $idPegawai)
                    ->update([
                        'approval_2' => $request->approval_2,
                        'reject_2' => $request->reject_2,
                        'status_2' => $request->status_2,
                    ]);
                $cekCuti = LeaveRequest::where('employee_id', $idPegawai)->first();
                if (
                    $cekCuti->approval_1 == 0 &&
                    $cekCuti->status_1 != null &&
                    ($cekCuti->approval_2 == 0 && $cekCuti->status_2 != null)
                ) {

                    LeaveRequest::where('employee_id', $cekCuti->employee_id)->delete();
                }
                Session::flash('success', 'Berhasil Ditolak');
                return Redirect::back();
            }
        } else {
            Session::flash('danger', 'Request Sesi Berakhir');
            return Redirect::back();
        }
    }

    function approveCuti(Request $request)
    {
        $hariini = date('Y-m-d');

        $cuti = LeaveRequest::where('req_date', $hariini)->count();


        if ($cuti >= 1) {
            $idPegawai = $request->id;

            $cuti = LeaveRequest::with('employee')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('employee_id', $idPegawai)
                ->first();
            
            $jmlCuti = GetLeave::where('employee_id', $idPegawai)
                ->first();
           
            $jatahCuti = $jmlCuti->total_days;

            $ambilCuti = $jatahCuti - $cuti->number_leave_day;

            $presentId = $cuti->present_id;
            $timeIn = $cuti->time_in;
            $fotoin = $cuti->attachment;
            $fotoout = $cuti->attachment;

            $namaReq = $request->route()->getName();


            if ($namaReq == "approve-cuti.hr") {
                LeaveRequest::where('employee_id', $idPegawai)
                    ->update([
                        'approval_1' => $request->approval_1,
                        'status_1' => $request->status_1,
                    ]);

                $cekCuti = LeaveRequest::where('employee_id', $idPegawai)->first();


                if ($cekCuti->approval_1 == 1 && $cekCuti->approval_2 == 1) {
                    $dateRange = $this->dateRange($cekCuti->start_date, $cekCuti->end_date);

                    Leave::create([
                        'req_date' => $hariini,
                        'start_date' => $cekCuti->start_date,
                        'end_date' => $cekCuti->end_date,
                        'employee_id' => $cekCuti->employee_id,
                        'present_id' => $cekCuti->present_id,
                        'note' => $cekCuti->note,
                        'attachment' => $cekCuti->attachment,
                        'approval_1' => $cekCuti->approval_1,
                        'approval_2' => $cekCuti->approval_2,
                        'pic' => $cekCuti->pic,
                    ]);

                    GetLeave::where('employee_id', $idPegawai)
                    ->update([
                        'total_days' => $ambilCuti,
                    ]);


                    // $dateRange = $Cuti[0]['start_date'];
                    // dd($dateRange);
                    foreach ($dateRange as $date => $value) {
                        Presence::create([
                            'employee_id'  => $idPegawai,
                            'present_id' => $presentId,
                            'presence_date' => $value->format('Y-m-d'),
                            'time_in' => $timeIn,
                            'time_out' => '00:00:00',
                            'photo_in'  => $fotoin,
                            'photo_out'  => $fotoout,
                        ]);
                    }

                    LeaveRequest::where('employee_id', $cekCuti->employee_id)->delete();
                    Session::flash('success', 'Berhasil Disetujui');
                    return Redirect::back();
                } else {
                    Session::flash('success', 'Berhasil Disetujui');
                    return Redirect::back();
                }
            } elseif ($namaReq == "approve-cuti.manager") {

                LeaveRequest::where('employee_id', $idPegawai)
                    ->update([
                        'approval_2' => $request->approval_2,
                        'status_2' => $request->status_2,
                    ]);

                $cekCuti = LeaveRequest::where('employee_id', $idPegawai)->first();

                if ($cekCuti->approval_1 == 1 && $cekCuti->approval_2 == 1) {
                    $dateRange = $this->dateRange($cekCuti->start_date, $cekCuti->end_date);

                    Leave::create([
                        'req_date' => $hariini,
                        'start_date' => $cekCuti->start_date,
                        'end_date' => $cekCuti->end_date,
                        'employee_id' => $cekCuti->employee_id,
                        'present_id' => $cekCuti->present_id,
                        'note' => $cekCuti->note,
                        'attachment' => $cekCuti->attachment,
                        'approval_1' => $cekCuti->approval_1,
                        'approval_2' => $cekCuti->approval_2,
                        'pic' => $cekCuti->pic,
                    ]);

                    GetLeave::where('employee_id', $idPegawai)
                    ->update([
                        'total_days' => $ambilCuti,
                    ]);

                    // $dateRange = $ijin[0]['start_date'];
                    // dd($dateRange);
                    foreach ($dateRange as $date => $value) {
                        Presence::create([
                            'employee_id'  => $idPegawai,
                            'present_id' => $presentId,
                            'presence_date' => $value->format('Y-m-d'),
                            'time_in' => $timeIn,
                            'time_out' => '00:00:00',
                            'photo_in'  => $fotoin,
                            'photo_out'  => $fotoout,
                        ]);
                    }
                    LeaveRequest::where('employee_id', $cekCuti->employee_id)->delete();

                    Session::flash('success', 'Berhasil Disetujui');
                    return Redirect::back();
                } else {
                    Session::flash('success', 'Berhasil Disetujui');
                    return Redirect::back();
                }
            }
        } else {
            Session::flash('danger', 'Tidak Ada Pengajuan');
            return Redirect::back();
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
