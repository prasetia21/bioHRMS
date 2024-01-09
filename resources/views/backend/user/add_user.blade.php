@extends('backend.layouts.template')

@section('title')
    User - BIO HRMS
@endsection

@section('banner-title')
    User
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
                                <form id="myForm" action="{{ route('store.user') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Nama User:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Mis: Karto">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Mis: kartoxx@gmail.com">
                                        </div>

                                        @if (!empty($data) && $data->count() > 0)
                                            <div class="form-group col-md-4">
                                                <label for="user_level_id" class="form-label">Role Akses</label>
                                                <select name="user_level_id" class="form-control" id="user_level_id"
                                                    required>
                                                    <option></option>
                                                    @foreach ($data as $userlevel)
                                                        <option value="{{ $userlevel->id }}">{{ $userlevel->role }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                                role="alert">
                                                <span> Tambahkan Dahulu data Role Akses!</span>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="password">Password:</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="xxxxxxxxxxx">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="confirmpassword">Konfirmasi Password:</label>
                                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                                                placeholder="xxxxxxxxxxx">
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
    
    </script>
@endpush
