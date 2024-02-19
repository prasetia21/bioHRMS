<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use App\Models\ReqWorkPermit;
use App\Models\WorkPermit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $employee = Employee::find($employee_id);


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
        $hariini = date('Y-m-d');


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

        if ($request->upload_option === 'file') {
            // Proses upload file

            // if ($request->hasFile('file_input')) {

            //     $filenameWithExt = $request->file('file_input')->getClientOriginalName();

            //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //     $extension = $request->file('file_input')->getClientOriginalExtension();

            //     $fileName = uniqid() . $fullname . '.' . $extension;

            //     $path = $request->file('file_input')->storeAs('public/uploads/ijin/', $fileName);
            // } else {
            //     $fileName = 'null';
            // }

            $file = $request->file('file_input');
            $fileName = $file->getClientOriginalName();
            $extension = $request->file('file_input')->getClientOriginalExtension();

            $fileName = uniqid() . '-' . $employee->fullname . '-' . date('d-m-y-H-i-s') . '.' .$extension;

            $file->storeAs('public/uploads/ijin/', $fileName);


            if ($request->present_id == 2) {

                if ($jumlah_hari < 2) {
                    WorkPermit::create([
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'req_date' => $hariini,
                        'employee_id' => $employee_id,
                        'present_id' => $request->present_id,
                        'note' => $request->note,
                        'attachment' => $fileName,
                        'approval_1' => true,
                        'approval_2' => true,
                    ]);

                    if ($jumlah_hari == 1) {
                        Presence::create([
                            'employee_id'  => $employee_id,
                            'present_id' => $request->present_id,
                            'presence_date' => $startDate,
                            'time_in' => $time,
                            'time_out' => '00:00:00',
                            'photo_in'  => $fileName,
                            'photo_out'  => $fileName,
                        ]);

                        Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Persetujuan Atasan Anda');
                        return redirect('/dashboard');
                    } else {

                        foreach ($dateRange as $date => $value) {
                            Presence::create([
                                'employee_id'  => $employee_id,
                                'present_id' => $request->present_id,
                                'presence_date' => $value->format('Y-m-d'),
                                'time_in' => $time,
                                'time_out' => '00:00:00',
                                'photo_in'  => $fileName,
                                'photo_out'  => $fileName,
                            ]);
                        }
                        Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Persetujuan Atasan Anda');
                        return redirect('/dashboard');
                    }
                } else {
                    ReqWorkPermit::create([
                        'employee_id'  => $employee_id,
                        'present_id' => $request->present_id,
                        'req_date' => $hariini,
                        'time_in' => $time,
                        'time_out' => '00:00:00',
                        'photo_in'  => $fileName,
                        'photo_out'  => $fileName,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'note' => $request->note,
                        'attachment' => $fileName,
                        'departement' => $departement,
                        'approval_1' => false,
                        'approval_2' => false,
                    ]);

                    Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Approval Atasan Anda');
                    return redirect('/dashboard');
                }
            } else {


                ReqWorkPermit::create([
                    'employee_id'  => $employee_id,
                    'present_id' => $request->present_id,
                    'req_date' => $hariini,
                    'time_in' => $time,
                    'time_out' => '00:00:00',
                    'photo_in'  => $fileName,
                    'photo_out'  => $fileName,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'note' => $request->note,
                    'attachment' => $fileName,
                    'departement' => $departement,
                    'approval_1' => false,
                    'approval_2' => false,
                ]);

                Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Approval Atasan Anda');
                return redirect('/dashboard');
            }
        } else {
            // Proses capture webcam
            $imageData = $request->image_data;

            $folderPath = 'public/uploads/ijin/';
            $formatName = uniqid() . '-' . $employee->fullname . '-' . date('d-m-y-H-i-s');
            $image_part = explode(';base64', $imageData);
            $image_base64 = base64_decode($image_part[1]);
            $fileName = $formatName . ".png";

            Storage::put($fileName, $image_base64);

            if ($request->present_id == 2) {

                if ($jumlah_hari < 2) {
                    WorkPermit::create([
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'req_date' => $hariini,
                        'employee_id' => $employee_id,
                        'present_id' => $request->present_id,
                        'note' => $request->note,
                        'attachment' => $fileName,
                        'approval_1' => true,
                        'approval_2' => true,
                    ]);

                    if ($jumlah_hari == 1) {
                        Presence::create([
                            'employee_id'  => $employee_id,
                            'present_id' => $request->present_id,
                            'presence_date' => $startDate,
                            'time_in' => $time,
                            'time_out' => '00:00:00',
                            'photo_in'  => $fileName,
                            'photo_out'  => $fileName,
                        ]);


                        Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Persetujuan Atasan Anda');
                        return redirect('/dashboard');
                    } else {

                        foreach ($dateRange as $date => $value) {
                            Presence::create([
                                'employee_id'  => $employee_id,
                                'present_id' => $request->present_id,
                                'presence_date' => $value->format('Y-m-d'),
                                'time_in' => $time,
                                'time_out' => '00:00:00',
                                'photo_in'  => $fileName,
                                'photo_out'  => $fileName,
                            ]);
                        }


                        Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Persetujuan Atasan Anda');
                        return redirect('/dashboard');
                    }
                } else {
                    ReqWorkPermit::create([
                        'employee_id'  => $employee_id,
                        'present_id' => $request->present_id,
                        'req_date' => $hariini,
                        'time_in' => $time,
                        'time_out' => '00:00:00',
                        'photo_in'  => $fileName,
                        'photo_out'  => $fileName,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'note' => $request->note,
                        'attachment' => $fileName,
                        'departement' => $departement,
                        'approval_1' => false,
                        'approval_2' => false,
                    ]);


                    Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Approval Atasan Anda');
                    return redirect('/dashboard');
                }
            } else {


                ReqWorkPermit::create([
                    'employee_id'  => $employee_id,
                    'present_id' => $request->present_id,
                    'req_date' => $hariini,
                    'time_in' => $time,
                    'time_out' => '00:00:00',
                    'photo_in'  => $fileName,
                    'photo_out'  => $fileName,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'note' => $request->note,
                    'attachment' => $fileName,
                    'departement' => $departement,
                    'approval_1' => false,
                    'approval_2' => false,
                ]);



                Session::flash('success', 'Pengajuan Berhasil, Harap Menunggu Approval Atasan Anda');
                return redirect('/dashboard');
            }
        }
    }

    function tolakIjin(Request $request)
    {
        $hariini = date('Y-m-d');

        $ijin = ReqWorkPermit::where('req_date', $hariini)->count();

        if ($ijin >= 1) {
            $idPegawai = $request->id;
            $ijin = ReqWorkPermit::with('employee')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('employee_id', $idPegawai)
                ->first();

            $namaReq = $request->route()->getName();

            if ($namaReq == "tolak.hr") {
                ReqWorkPermit::where('employee_id', $idPegawai)
                    ->update([
                        'approval_1' => $request->approval_1,
                        'reject_1' => $request->reject_1,
                        'status_1' => $request->status_1,
                    ]);
                $cekIjin = ReqWorkPermit::where('employee_id', $idPegawai)->first();


                if (
                    $cekIjin->approval_1 == 0 &&
                    $cekIjin->status_1 != null &&
                    ($cekIjin->approval_2 == 0 && $cekIjin->status_2 != null)
                ) {

                    ReqWorkPermit::where('employee_id', $cekIjin->employee_id)->delete();
                }
                Session::flash('success', 'Berhasil Ditolak');
                return Redirect::back();
            } elseif ($namaReq == "tolak.manager") {
                ReqWorkPermit::where('employee_id', $idPegawai)
                    ->update([
                        'approval_1' => false,
                        'reject_1' => $request->reject_2,
                        'status_1' => "TIDAK ACC HR",

                        'approval_2' => $request->approval_2,
                        'reject_2' => $request->reject_2,
                        'status_2' => $request->status_2,
                    ]);
                $cekIjin = ReqWorkPermit::where('employee_id', $idPegawai)->first();
                if (
                    $cekIjin->approval_1 == 0 &&
                    $cekIjin->status_1 != null &&
                    ($cekIjin->approval_2 == 0 && $cekIjin->status_2 != null)
                ) {

                    ReqWorkPermit::where('employee_id', $cekIjin->employee_id)->delete();
                }
                Session::flash('success', 'Berhasil Ditolak');
                return Redirect::back();
            }
        } else {
            Session::flash('danger', 'Request Sesi Berakhir');
            return Redirect::back();
        }
    }

    function approveIjin(Request $request)
    {
        $hariini = date('Y-m-d');

        $ijin = ReqWorkPermit::where('req_date', $hariini)->count();


        if ($ijin >= 1) {
            $idPegawai = $request->id;

            $ijin = ReqWorkPermit::with('employee')
                ->with('present')
                ->where('req_date', $hariini)
                ->where('employee_id', $idPegawai)
                ->first();

            $presentId = $ijin->present_id;
            $timeIn = $ijin->time_in;
            $fotoin = $ijin->attachment;
            $fotoout = $ijin->attachment;

            $namaReq = $request->route()->getName();


            if ($namaReq == "approve.hr") {
                ReqWorkPermit::where('employee_id', $idPegawai)
                    ->update([
                        'approval_1' => $request->approval_1,
                        'status_1' => $request->status_1,
                    ]);

                $cekIjin = ReqWorkPermit::where('employee_id', $idPegawai)->first();


                if ($cekIjin->approval_1 == 1 && $cekIjin->approval_2 == 1) {
                    $dateRange = $this->dateRange($cekIjin->start_date, $cekIjin->end_date);

                    WorkPermit::create([
                        'req_date' => $hariini,
                        'start_date' => $cekIjin->start_date,
                        'end_date' => $cekIjin->end_date,
                        'employee_id' => $cekIjin->employee_id,
                        'present_id' => $cekIjin->present_id,
                        'note' => $cekIjin->note,
                        'attachment' => $cekIjin->attachment,
                        'approval_1' => $cekIjin->approval_1,
                        'approval_2' => $cekIjin->approval_2,
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

                    ReqWorkPermit::where('employee_id', $cekIjin->employee_id)->delete();
                    Session::flash('success', 'Berhasil Disetujui');
                    return Redirect::back();
                } else {
                    Session::flash('success', 'Berhasil Disetujui');
                    return Redirect::back();
                }
            } elseif ($namaReq == "approve.manager") {

                ReqWorkPermit::where('employee_id', $idPegawai)
                    ->update([
                        'approval_1' => true,
                        'status_1' => "ACC HR",

                        'approval_2' => $request->approval_2,
                        'status_2' => $request->status_2,
                    ]);

                $cekIjin = ReqWorkPermit::where('employee_id', $idPegawai)->first();

                if ($cekIjin->approval_1 == 1 && $cekIjin->approval_2 == 1) {
                    $dateRange = $this->dateRange($cekIjin->start_date, $cekIjin->end_date);

                    WorkPermit::create([
                        'req_date' => $hariini,
                        'start_date' => $cekIjin->start_date,
                        'end_date' => $cekIjin->end_date,
                        'employee_id' => $cekIjin->employee_id,
                        'present_id' => $cekIjin->present_id,
                        'note' => $cekIjin->note,
                        'attachment' => $cekIjin->attachment,
                        'approval_1' => $cekIjin->approval_1,
                        'approval_2' => $cekIjin->approval_2,
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
                    ReqWorkPermit::where('employee_id', $cekIjin->employee_id)->delete();

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
