<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    function index()
    {
        $data = News::with('employee')->get();

        return view('backend.news.list_news', ['data' => $data]);
    }

    function addNew()
    {
        $data = Employee::all();
        
        return view('backend.news.add_news', ['data' => $data]);
    }

    function store(Request $request)
    {
        $attachment = '';

        $request->validate([
            'employee_id' => 'required',
            'title' => 'required|min:5',
            'short_information' => 'required',
            'detail_information' => 'required',
        ], [
            'employee_id.required' => 'Nama Pegawai Wajib Di isi / Tidak Sesuai',
            'title.required' => 'Judul Wajib Di isi',
            'title.min' => 'Bidang Judul minimal harus 5 karakter.',
            'short_information.required' => 'Deskripsi Pendek Wajib Di isi',
            'detail_information.required' => 'Deskripsi Lengkap Wajib Di isi',
        ]);

        $cekJudul = $request->title;
        $sameTitle = News::where('title', $cekJudul)->first();

        if ($sameTitle) {
            Session::flash('danger', 'Judul sudah Terdaftar, Coba Judul Pengumuman Lainnya');
            return Redirect::back();
        }

        if ($request->hasFile('attachment')) {

            $request->validate(['attachment' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

            $attachment_file = $request->file('attachment');
            $attachment_ekstensi = $attachment_file->extension();
            $nama_attachment = date('ymdhis') . "." . $attachment_ekstensi;
            $attachment_file->move(public_path('news'), $nama_attachment);
            $attachment = $nama_attachment;
        } else {
            $attachment = "user.jpeg";
        }

        News::create([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'short_information' => $request->short_information,
            'detail_information' => $request->detail_information,
            'attachment' =>$attachment,
            'link' => Str::slug($request->title),
        ]);

        Session::flash('success', 'Data berhasil ditambahkan.');

        return redirect('/manage/news');
    }

    function update($id)
    {
        $data = News::find($id);

        return view('backend.news.update_news', ['data' => $data]);
    }

    function destroy(Request $request)
    {
        News::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('/manage/news');
    }

    function change(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'title' => 'required|min:5',
            'short_information' => 'required',
            'detail_information' => 'required',
        ], [
            'employee_id.required' => 'Nama Pegawai Wajib Di isi / Tidak Sesuai',
            'title.required' => 'Judul Wajib Di isi',
            'title.min' => 'Bidang Judul minimal harus 5 karakter.',
            'short_information.required' => 'Deskripsi Pendek Wajib Di isi',
            'detail_information.required' => 'Deskripsi Lengkap Wajib Di isi',
        ]);

        $berita = News::find($request->id);

        $berita->employee_id = $request->employee_id;
        $berita->title = $request->title;
        $berita->short_information = $request->short_information;
        $berita->detail_information = $request->detail_information;
        $berita->link = $request->link;
        $berita->author = $request->author;
        $berita->status = $request->status;
        $berita->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/news');
    }

    function detail($param)
    {
        $slug = explode("-", $param);
        $id = end($slug);
        
        $data = News::with('employee')->where('id', $id)
        ->firstOrFail();

        return view('backend.news.detail_news', ['data' => $data]);
    }

    function approve(Request $request)
    {
        $approve = News::find($request->id);

        $approve->approval = 1;
        $approve->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/manage/news');
    }

}
