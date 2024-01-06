@extends('backend.layouts.template')

@section('title')
    Departement - BIO HRMS
@endsection

@section('banner-title')
    Departemen
@endsection

@section('banner-desc')
    Update Data
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
                                <form action="{{ route('change.departemen') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Nama Departemen:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $data->name }}" placeholder="Mis: BIO Yogyakarta">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="address">Alamat Departemen:</label>
                                            <textarea class="form-control" id="address" name="address" rows="5">{{ $data->address }}"</textarea>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="form-label">Kantor Cabang:</label>
                                            <select id="branch" name="branch" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option selected value="{{ $data->branch }}">{{ $data->branch }}</option>
                                                <option>Yogyakarta</option>
                                                <option>Jepara</option>
                                                <option>Cirebon</option>
                                                <option>Surabaya</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="phone">No Telepon:</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $data->phone }}" placeholder="Mis: 0274-12345 / 08xxxxxxxxx">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $data->email }}" placeholder="Mis: info@bioindustries.co.id">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="mb-3">Kebutuhan Data Absensi</h5>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="latitude">Latitude:</label>
                                            <input type="text" class="form-control" id="latitude" name="latitude"
                                                value="{{ $data->latitude }}" placeholder="Mis: -00000">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="longitude">Longitude:</label>
                                            <input type="text" class="form-control" id="longitude" name="longitude"
                                                value="{{ $data->longitude }}" placeholder="Mis: 00000">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="qrcode">QRCode:</label>
                                            <input type="text" class="form-control" id="qrcode" name="qrcode"
                                                value="{{ $data->qrcode }}" placeholder="QRCode">
                                        </div>


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
