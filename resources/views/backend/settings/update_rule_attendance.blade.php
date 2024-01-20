@extends('backend.layouts.template')

@section('title')
    Update Aturan Absensi - BIO HRMS
@endsection

@section('banner-title')
    Aturan Absensi
@endsection

@section('banner-desc')
    Halaman untuk Mengubah Aturan Absensi yang Berjalan di Sistem Bioindustries
@endsection

@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="new-user-info">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $item)
                                        @php
                                            toastr()->error($item);
                                        @endphp
                                    @endforeach
                                @endif
                                <form id="myForm" action="{{ route('change.ruleattendance') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $data->id }}">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Waktu Absen
                                                Masuk:</label>
                                            <input type="text" id="arrived_time" name="arrived_time"
                                                class="form-control time_flatpicker" value="{{ $data->arrived_time }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="leave_time">Waktu Absen
                                                Pulang:</label>
                                            <input type="text" id="leave_time" name="leave_time"
                                                class="form-control time_flatpicker" value="{{ $data->leave_time }}">
                                        </div>


                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script></script>
@endpush
