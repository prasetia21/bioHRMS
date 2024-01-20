<?php

namespace App\Http\Controllers;

use App\Models\LeaveRule;
use App\Models\PresenceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    function ruleListAttendance()
    {
        $data = PresenceRule::all();

        return view('backend.settings.rule_attendance', ['data' => $data]);
    }

    function storeRuleAttendance(Request $request)
    {
        $request->validate([
            'arrived_time' => 'required',
            'leave_time' => 'required',
        ], [
            'arrived_time.required' => 'Waktu Absen Masuk Wajib Di isi',
            'leave_time.required' => 'Waktu Absen Pulang Wajib Di isi',
        ]);

        PresenceRule::create([
            'arrived_time' => $request->arrived_time,
            'leave_time' => $request->leave_time,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/manage/rule-attendance')->with('success', 'Berhasil Menambahkan Data');
    }

    function updateRuleAttendance($id)
    {
        $data = PresenceRule::find($id);

        return view('backend.settings.update_rule_attendance', ['data' => $data]);
    }

    function changeRuleAttendance(Request $request)
    {
        $request->validate([
            'arrived_time' => 'required',
            'leave_time' => 'required',
        ], [
            'arrived_time.required' => 'Waktu Absen Masuk Wajib Di isi',
            'leave_time.required' => 'Waktu Absen Pulang Wajib Di isi',
        ]);

        $rule = PresenceRule::find($request->id);

        $rule->arrived_time = $request->arrived_time;
        $rule->leave_time = $request->leave_time;
        $rule->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/rule-attendance');
    }

    function destroyRuleAttendance(Request $request)
    {
        PresenceRule::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/rule-attendance');
    }


    // 

    function ruleListLeave()
    {
        $data = LeaveRule::all();

        return view('backend.settings.rule_leave', ['data' => $data]);
    }

    function storeRuleLeave(Request $request)
    {
        $request->validate([
            'total_leave' => 'required',
            'number_year' => 'required',
        ], [
            'total_leave.required' => 'Jatah Cuti Tahunan Wajib Di isi',
            'number_year.required' => 'Masa Kerja Minimal Wajib Di isi',
        ]);

        LeaveRule::create([
            'total_leave' => $request->total_leave,
            'number_year' => $request->number_year,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/manage/rule-leave')->with('success', 'Berhasil Menambahkan Data');
    }

    function updateRuleLeave($id)
    {
        $data = LeaveRule::find($id);

        return view('backend.settings.update_rule_leave', ['data' => $data]);
    }

    function changeRuleLeave(Request $request)
    {
        $request->validate([
            'total_leave' => 'required',
            'number_year' => 'required',
        ], [
            'total_leave.required' => 'Jatah Cuti Tahunan Wajib Di isi',
            'number_year.required' => 'Masa Kerja Minimal Wajib Di isi',
        ]);

        $rule = LeaveRule::find($request->id);

        $rule->total_leave = $request->total_leave;
        $rule->number_year = $request->number_year;
        $rule->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/rule-leave');
    }

    function destroyRuleLeave(Request $request)
    {
        LeaveRule::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/rule-leave');
    }
}