@extends('backend.layouts.template')

@section('title')
    Laporan Admin - BIO HRMS
@endsection

@section('banner-title')
    Laporan Admin
@endsection

@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            @if ($errors->any())
                                @foreach ($errors->all() as $item)
                                    @php
                                        toastr()->error($item);
                                    @endphp
                                @endforeach
                            @endif
                            @if (Session::has('success'))
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire(
                                            'Sukses',
                                            '{{ Session::get('success') }}',
                                            'success'
                                        );
                                    });
                                </script>
                            @endif

                        </div>
                        @if (!empty($data) && $data->count() > 0)
                            <div class="card-body">
                                <div class="d-flex justify-content-between">

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="date_filter">Filter berdasar Waktu:</label>
                                            <form method="get" action="laporan-admin">
                                                <div class="input-group">
                                                    <select class="custom-select" name="date_filter" id="inputGroupSelect04"
                                                        aria-label="Example select with button addon">
                                                        <option value="">Semua Waktu</option>
                                                        <option value="today"
                                                            {{ $dateFilter == 'today' ? 'selected' : '' }}>Hari Ini
                                                        </option>
                                                        <option value="yesterday"
                                                            {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>
                                                            Kemarin
                                                        </option>
                                                        <option value="this_week"
                                                            {{ $dateFilter == 'this_week' ? 'selected' : '' }}>Minggu
                                                            ini
                                                        </option>
                                                        <option value="last_week"
                                                            {{ $dateFilter == 'last_week' ? 'selected' : '' }}>7 Hari
                                                            Terakhir
                                                        </option>
                                                        <option value="this_month"
                                                            {{ $dateFilter == 'this_month' ? 'selected' : '' }}>
                                                            Bulan Ini
                                                        </option>
                                                        <option value="last_month"
                                                            {{ $dateFilter == 'last_month' ? 'selected' : '' }}>
                                                            Akhir Bulan
                                                        </option>
                                                        <option value="this_year"
                                                            {{ $dateFilter == 'this_year' ? 'selected' : '' }}>Tahun
                                                            Ini
                                                        </option>
                                                        <option value="last_year"
                                                            {{ $dateFilter == 'last_year' ? 'selected' : '' }}>Akhir
                                                            Tahun
                                                        </option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">Filter</button>
                                                    </div>


                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="date_filter">Filter berdasar Bulan:</label>
                                            <form method="get" action="laporan-admin">
                                                <div class="input-group">
                                                    <select class="custom-select" name="month_filter"
                                                        id="inputGroupSelect04"
                                                        aria-label="Example select with button addon">
                                                        <option value="">Semua Waktu</option>
                                                        <option value="januari"
                                                            {{ $monthFilter == 'januari' ? 'selected' : '' }}>Januari
                                                        </option>
                                                        <option value="februari"
                                                            {{ $monthFilter == 'februari' ? 'selected' : '' }}>
                                                            Februari
                                                        </option>
                                                        <option value="maret"
                                                            {{ $monthFilter == 'maret' ? 'selected' : '' }}>Maret
                                                        </option>
                                                        <option value="april"
                                                            {{ $monthFilter == 'april' ? 'selected' : '' }}>April
                                                        </option>
                                                        <option value="mei"
                                                            {{ $monthFilter == 'mei' ? 'selected' : '' }}>Mei</option>
                                                        <option value="juni"
                                                            {{ $monthFilter == 'juni' ? 'selected' : '' }}>Juni
                                                        </option>
                                                        <option value="juli"
                                                            {{ $monthFilter == 'juli' ? 'selected' : '' }}>Juli
                                                        </option>
                                                        <option value="agustus"
                                                            {{ $monthFilter == 'agustus' ? 'selected' : '' }}>Agustus
                                                        </option>
                                                        <option value="september"
                                                            {{ $monthFilter == 'september' ? 'selected' : '' }}>
                                                            September
                                                        </option>
                                                        <option value="oktober"
                                                            {{ $monthFilter == 'oktober' ? 'selected' : '' }}>Oktober
                                                        </option>
                                                        <option value="november"
                                                            {{ $monthFilter == 'november' ? 'selected' : '' }}>
                                                            November
                                                        </option>
                                                        <option value="desember"
                                                            {{ $monthFilter == 'desember' ? 'selected' : '' }}>
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

                                <div class="table-responsive">
                                    <table id="user-list-table" class="table table-striped" role="grid"
                                        data-bs-toggle="data-table">
                                        <thead>
                                            <tr class="ligth">
                                                <th>No</th>
                                                <th>Nama Admin</th>
                                                <th>Cabang</th>
                                                <th>File Laporan</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Admin</th>
                                                <th>Cabang</th>
                                                <th>File Laporan</th>
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                @php
                                                    $employee = App\Models\Employee::with('departement')
                                                        ->where('id', $item->employee_id)
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td> {{ $key + 1 }} </td>
                                                    <td>{{ $employee->fullname }}</td>
                                                    <td>{{ $employee->departement->branch }}</td>
                                                    <td><a
                                                            href="{{ asset('files') }}/{{ $item->file }}">{{ $item->file }}</a>
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
                            <div class="d-flex justify-content-center"><a href="{{ route('laporan-admin') }}" class="mt-2 btn btn-primary" role="button">Reset</a></div>
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
