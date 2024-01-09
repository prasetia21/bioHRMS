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
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        @php
                            toastr()->error($item);
                        @endphp
                    @endforeach
                @endif
                <form id="myForm" style="display: block ruby" action="{{ route('store.employee') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Avatar</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="profile-img-edit position-relative">
                                        <img id="preview" src="{{ asset('hopeui/images/avatars/01.png') }}" alt="profile-pic"
                                            class="theme-color-default-img profile-pic rounded avatar-100">
                                        
                                        <div class="upload-icone bg-primary col-md-12">
                                            <svg class="upload-button icon-14" width="14" viewBox="0 0 24 24">
                                                <path fill="#ffffff"
                                                    d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                            </svg>
                                            <input class="form-control form-control-lg" type="file" name="photo" id="photo" accept="image/*" style="margin-top:-40px; margin-left:-20px; padding:50px; opacity: 10%">
                                        
                                        
                                        </div>
                                    </div>
                                    <div class="img-extension mt-3">
                                        <div class="d-inline-block align-items-center">
                                            <span>Only</span>
                                            <a href="javascript:void();">.jpg</a>
                                            <a href="javascript:void();">.png</a>
                                            <a href="javascript:void();">.jpeg</a>
                                            <span>allowed</span>
                                        </div>
                                    </div>
                                </div>

                                @if (!empty($positions) && $positions->count() > 0)
                                    <div class="form-group">
                                        <label for="position_id" class="form-label">Posisi Jabatan</label>
                                        <select name="position_id" class="selectpicker form-control" data-style="py-0"
                                            id="position_id" required>
                                            <option>Pilih Posisi</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                        role="alert">
                                        <span> Tambahkan Dahulu data Posisi! <a href="{{ route('position') }}">Klik disini </a>untuk menambahkan</span>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif


                                @if (!empty($levels) && $levels->count() > 0)
                                    <div class="form-group">
                                        <label for="user_level_id" class="form-label">Level User</label>
                                        <select name="user_level_id" class="selectpicker form-control" data-style="py-0"
                                            id="user_level_id" required>
                                            <option>Pilih Level User</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}">{{ $level->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                        role="alert">
                                        <span> Tambahkan Dahulu data Level User! <a href="{{ route('userlevel') }}">Klik disini </a>untuk menambahkan</span>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Data Pegawai</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="nip">Nomor Induk Pegawai:</label>
                                            <input type="text" class="form-control" id="nip" name="nip"
                                                placeholder="Mis: 123xxx">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="fullname">Nama Pegawai:</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname"
                                                placeholder="Mis: Karto">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="address">Alamat Pegawai:</label>
                                            <textarea class="form-control" id="address" name="address" rows="5"></textarea>
                                        </div>

                                        @if (!empty($departements) && $departements->count() > 0)
                                            <div class="form-group col-md-12">
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
                                                <span> Tambahkan Dahulu data Departemen! <a href="{{ route('departemen') }}">Klik disini </a>untuk menambahkan</span>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

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
                                            <label class="form-label" for="phone">No Telepon:</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Mis: 0274-12345 / 08xxxxxxxxx">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="birth_place">Tempat Lahir:</label>
                                            <input type="text" class="form-control" id="birth_place"
                                                name="birth_place" placeholder="Mis: Yogyakarta">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="birth_date">Tanggal Lahir:</label>
                                            <input type="text" class="form-control" id="birth_date" name="birth_date"
                                                placeholder="Pilih Tanggal Lahir">
                                        </div>


                                    </div>
                                    <hr>
                                    <h5 class="mb-3">Kontrak Kerja</h5>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="start_work_date">Tanggal Mulai Kerja:
                                            </label>
                                            <input type="text" class="form-control" id="start_work_date"
                                                name="start_work_date" placeholder="Pilih Tanggal Mulai Bekerja">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Status:</label>
                                            <select id="status" name="status"
                                                class="selectpicker form-control" data-style="py-0">
                                                <option>Pilih Status Pegawai</option>
                                                <option value="tetap">Tetap</option>
                                                <option value="kontrak">Kontrak</option>
                                                <option value="part-time">Part-Time</option>
                                            </select>
                                        </div>
                                        <div id="contract" class="form-group col-md-6">
                                            <label class="form-label" for="contact_date">Tanggal Kontrak:
                                                (Opsional)</label>
                                            <input type="text" class="form-control" id="contact_date"
                                                name="contact_date" placeholder="Pilih Range Kontak">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

        photo.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = photo.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
