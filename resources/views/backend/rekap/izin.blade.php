@extends('backend.layouts.template')

@section('title')
    Rekap Izin - BIO HRMS
@endsection

@section('banner-title')
    Rekap Izin
@endsection

@section('banner-desc')
    Halaman untuk Menambah Data Rekap Izin yang Berjalan di Bioindustries
@endsection

@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Rekap Izin</h4>
                            </div>

                        </div>
                        @if (!empty($data) && $data->count() > 0)
                            <div class="card-body px-0">
                                <div class="table-responsive">
                                    <table id="user-list-table" class="table table-striped" role="grid"
                                        data-bs-toggle="data-table">
                                        <thead>
                                            <tr class="ligth">
                                                <th>NO</th>
                                                <th>Foto</th>
                                                <th>Nama Karyawan</th>
                                                <th>Posisi</th>
                                                <th>Divisi</th>
                                                <th>Tanggal Ijin</th>
                                                <th>Keterangan</th>
                                                <th>Alasan Ijin</th>
                                                <th>Attachment</th>
                                                <th>Approval HR</th>
                                                <th>Approval Manager</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td> {{ $key + 1 }} </td>
                                                    <td> <img
                                                            src="{{ asset('/picture/accounts/' . $item->employee->photo) }}"
                                                            style="width: 80px; height:80px;" class="rounded"></td>
                                                    <td>{{ $item->employee->fullname }}</td>
                                                    <td>{{ $item->employee->position->name }}</td>
                                                    <td>{{ $item->employee->departement->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') . ' s/d ' . \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</td>
                                                    <td>
                                                        @if ($item->present->name == 'Terlambat')
                                                            <span class="badge bg-danger">{{ $item->present->name }}</span>
                                                        @else
                                                            <span class="badge bg-info">{{ $item->present->name }}</span>
                                                        @endif

                                                    </td>
                                                    <td>{{ $item->note }}</td>
                                                    <td> <img src="{{ asset('/picture/ijin/' . $item->attachment) }}"
                                                            style="width: 80px; height:80px;"></td>
                                                    <td>
                                                        @if ($item->approval_1 == 1)
                                                            <span class="badge bg-success">ACC HR</span>
                                                        @else
                                                            <span class="badge bg-danger">TIDAK ACC HR</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->approval_2 == 1)
                                                            <span class="badge bg-success">ACC MANAGER</span>
                                                        @else
                                                            <span class="badge bg-danger">TIDAK ACC MANAGER</span>
                                                        @endif
                                                    </td>
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
