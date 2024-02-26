@extends('backend.layouts.template')

@section('title')
    Rekap Surat Peringatan - BIO HRMS
@endsection

@section('banner-title')
    Rekap Surat Peringatan
@endsection

@section('banner-desc')
    Halaman untuk Melihat Data Rekap Surat Peringatan yang Berjalan di Bioindustries
@endsection

@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Rekap Surat Peringatan</h4>
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
                                                <th>Keterangan SP</th>
                                                <th>Masa Berlaku</th>
                                                
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
                                                    <td><a
                                                        href="{{ url('/download_steguran/' . $item->employee_id) }}">
                                                        {{ $item->teguran->status }} <i class="fa fa-eye"></i></a>
                                                    </br><a
                                                        href="{{ url('/download_sp/' . $item->employee_id) }}">
                                                        {{ $item->status }} <i class="fa fa-eye"></i></a></td>
                                                    <td>{{ \Carbon\Carbon::parse($today)->format('d-m-Y') . ' s/d ' . \Carbon\Carbon::parse($item->masa_berlaku)->format('d-m-Y') }}</td>
                                                    
                                                    
                                                    
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
