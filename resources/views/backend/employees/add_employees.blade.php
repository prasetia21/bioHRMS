@extends('backend.layouts.template')

@section('title')
    Pegawai - BIO HRMS
@endsection

@section('banner-title')
    Pegawai
@endsection

@section('banner-desc')
    Tambah Data Baru
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
                                <form id="myForm" action="{{ route('store.employee') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Nomor Induk Pegawai:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Mis: 123xxx">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Nama Pegawai:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Mis: Karto">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="address">Alamat Pegawai:</label>
                                            <textarea class="form-control" id="address" name="address" rows="5"></textarea>
                                        </div>

                                        @if (!empty($departements) && $departements->count() > 0)
                                            <div class="form-group col-md-4">
                                                <label for="departement_id" class="form-label">Kantor Departemen</label>
                                                <select name="departement_id" class="form-control" id="departement_id"
                                                    required>
                                                    <option></option>
                                                    @foreach ($departements as $departement)
                                                        <option value="{{ $departement->id }}">{{ $departement->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                                role="alert">
                                                <span> Tambahkan Dahulu data Departemen!</span>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if (!empty($positions) && $positions->count() > 0)
                                            <div class="form-group col-md-4">
                                                <label for="position_id" class="form-label">Posisi Jabatan</label>
                                                <select name="position_id" class="form-control" id="position_id" required>
                                                    <option></option>
                                                    @foreach ($positions as $position)
                                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                                role="alert">
                                                <span> Tambahkan Dahulu data Posisi!</span>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif


                                        @if (!empty($levels) && $levels->count() > 0)
                                            <div class="form-group col-md-4">
                                                <label for="level_user_id" class="form-label">Level User</label>
                                                <select name="level_user_id" class="form-control" id="level_user_id"
                                                    required>
                                                    <option></option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level->id }}">{{ $level->role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                                role="alert">
                                                <span> Tambahkan Dahulu data Level User!</span>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif


                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="phone">No Telepon:</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Mis: 0274-12345 / 08xxxxxxxxx">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Jenis Kelamin:</label>
                                            <select id="gender" name="gender" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option>Pilih Jenis Kelamin</option>
                                                <option>Laki-laki</option>
                                                <option>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="birth_place">Tempat Lahir:</label>
                                            <input type="text" class="form-control" id="birth_place" name="birth_place"
                                                placeholder="Mis: Yogyakarta">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="birth_date">Tanggal Lahir:</label>
                                            <input type="text" class="form-control" id="birth_date" name="birth_date"
                                                placeholder="Pilih Tanggal Lahir">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="start_work_date">Tanggal Mulai Kerja:
                                                </label>
                                                <input type="text" class="form-control" id="start_work_date"
                                                    name="start_work_date" placeholder="Pilih Tanggal Mulai Bekerja">
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-8">
                                            <label class="form-label">Status:</label>
                                            <select id="status" name="status" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option>Pilih Status Pegawai</option>
                                                <option value="tetap">Tetap</option>
                                                <option value="kontrak">Kontrak</option>
                                                <option value="part-time">Part-Time</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="contact_date">Tanggal Kontrak:
                                                    (Opsional)</label>
                                                <input type="text" class="form-control" id="contact_date"
                                                    name="contact_date" placeholder="Pilih Range Kontak">
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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
    <script>
        flatpickr('#birth_date', {
            dateFormat: "d-m-Y",
            "minDate": new Date().fp_incr(1)
        });

        flatpickr('#start_work_date', {
            dateFormat: "d-m-Y",
            "minDate": new Date().fp_incr(1)
        });

        flatpickr("#contact_date", {
            dateFormat: "d-m-Y",
            mode: "range"
        });
    </script>
@endpush
