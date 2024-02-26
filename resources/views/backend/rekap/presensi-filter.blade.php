@extends('backend.layouts.template')

@section('title')
    Rekap Presensi - BIO HRMS
@endsection

@section('banner-title')
    Rekap Presensi
@endsection

@section('banner-desc')
    Halaman untuk Menambah Data Rekap Presensi yang Berjalan di Bioindustries
@endsection

@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <div class="form-group col-md-6">
                                <div class="header-title">
                                    <h4 class="card-title">Rekap Presensi Bulan {{ $namemonth[$numbermonth] }}
                                        {{ $year }}</h4>
                                </div>
                            </div>

                            <div class="form-group col-md-6 d-flex justify-content-end">
                                <div class="form-group">

                                    <form method="get" action="rekap-presensi">
                                        <div class="input-group">
                                            <select class="custom-select" name="month_filter" id="inputGroupSelect04"
                                                aria-label="Example select with button addon">
                                                <option value="">Pilih Bulan</option>
                                                <option value="01" {{ $monthFilter == '01' ? 'selected' : '' }}>
                                                    Januari
                                                </option>
                                                <option value="02" {{ $monthFilter == '02' ? 'selected' : '' }}>
                                                    Februari
                                                </option>
                                                <option value="03" {{ $monthFilter == '03' ? 'selected' : '' }}>Maret
                                                </option>
                                                <option value="04" {{ $monthFilter == '04' ? 'selected' : '' }}>April
                                                </option>
                                                <option value="05" {{ $monthFilter == '05' ? 'selected' : '' }}>Mei
                                                </option>
                                                <option value="06" {{ $monthFilter == '06' ? 'selected' : '' }}>Juni
                                                </option>
                                                <option value="07" {{ $monthFilter == '07' ? 'selected' : '' }}>Juli
                                                </option>
                                                <option value="08" {{ $monthFilter == '08' ? 'selected' : '' }}>
                                                    Agustus
                                                </option>
                                                <option value="09" {{ $monthFilter == '09' ? 'selected' : '' }}>
                                                    September
                                                </option>
                                                <option value="10" {{ $monthFilter == '10' ? 'selected' : '' }}>
                                                    Oktober
                                                </option>
                                                <option value="11" {{ $monthFilter == '11' ? 'selected' : '' }}>
                                                    November
                                                </option>
                                                <option value="12" {{ $monthFilter == '12' ? 'selected' : '' }}>
                                                    Desember
                                                </option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Filter</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>


                        @if (!empty($data) && $data->count() > 0)
                            <div class="card-body px-0">
                                <div class="table-responsive">
                                    <p style="margin-left:20px">Jumlah karyawan : {{ $total_karyawan }}</p>
                                    <table id="user-list-table" class="table table-striped" role="grid"
                                        data-bs-toggle="data-table">
                                        <thead>
                                            <tr class="ligth">
                                                <th>NO</th>
                                                <th>Foto</th>
                                                <th>Nama Karyawan</th>
                                                <th>Posisi</th>
                                                <th>Divisi</th>
                                                <th>Tepat Waktu</th>
                                                <th>Terlambat</th>
                                                <th>Sakit</th>
                                                <th>Ijin</th>
                                                <th>Cuti</th>
                                                <th>Total Kehadiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                @php
                                                    $employee_id = $item->id;

                                                    $hadir = App\Models\Presence::selectRaw('COUNT(id) as jmlHadir')
                                                        ->where('employee_id', $employee_id)
                                                        ->where('present_id', 1)
                                                        ->whereRaw('MONTH(presence_date)="' . $monthFilter . '"')
                                                        ->whereRaw('YEAR(presence_date)="' . $year . '"')
                                                        ->first();

                                                    $telat = App\Models\Presence::selectRaw('COUNT(id) as jmlTelat')
                                                        ->where('employee_id', $employee_id)
                                                        ->where('present_id', 3)
                                                        ->whereRaw('MONTH(presence_date)="' . $monthFilter . '"')
                                                        ->whereRaw('YEAR(presence_date)="' . $year . '"')
                                                        ->first();

                                                    $sakit = App\Models\Presence::selectRaw('COUNT(id) as jmlSakit')
                                                        ->where('employee_id', $employee_id)
                                                        ->where('present_id', 2)
                                                        ->whereRaw('MONTH(presence_date)="' . $monthFilter . '"')
                                                        ->whereRaw('YEAR(presence_date)="' . $year . '"')
                                                        ->first();

                                                    $ijin = App\Models\Presence::selectRaw('COUNT(id) as jmlIjin')
                                                        ->where('employee_id', $employee_id)
                                                        ->where('present_id', 4)
                                                        ->whereRaw('MONTH(presence_date)="' . $monthFilter . '"')
                                                        ->whereRaw('YEAR(presence_date)="' . $year . '"')
                                                        ->first();

                                                    $cuti = App\Models\Presence::selectRaw('COUNT(id) as jmlCuti')
                                                        ->where('employee_id', $employee_id)
                                                        ->where('present_id', 5)
                                                        ->whereRaw('MONTH(presence_date)="' . $monthFilter . '"')
                                                        ->whereRaw('YEAR(presence_date)="' . $year . '"')
                                                        ->first();

                                                    $total = App\Models\Presence::selectRaw('COUNT(id) as jmlTotal')
                                                        ->where('employee_id', $employee_id)
                                                        ->whereIn('present_id', ['1', '3'])
                                                        ->whereRaw('MONTH(presence_date)="' . $monthFilter . '"')
                                                        ->whereRaw('YEAR(presence_date)="' . $year . '"')
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td> {{ $key + 1 }} </td>
                                                    <td> <img src="{{ asset('/picture/accounts/' . $item->photo) }}"
                                                            style="width: 80px; height:80px;" class="rounded"></td>
                                                    <td>{{ $item->fullname }}</td>
                                                    <td>{{ $item->position->name }}</td>
                                                    <td>{{ $item->departement->name }}</td>
                                                    <td><span class="badge bg-success">{{ $hadir->jmlHadir }}</span></td>
                                                    <td><span class="badge bg-danger">{{ $telat->jmlTelat }}</span></td>
                                                    <td><span class="badge bg-warning">{{ $sakit->jmlSakit }}</span></td>
                                                    <td><span class="badge bg-primary">{{ $ijin->jmlIjin }}</span></td>
                                                    <td><span class="badge bg-info">{{ $cuti->jmlCuti }}</span></td>
                                                    <td><span class="badge bg-dark">{{ $total->jmlTotal }}</span></td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <hr>
                            <div class="d-flex justify-content-center">Data tidak tersedia</div>
                            <hr>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script></script>
@endpush
