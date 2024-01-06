@extends('backend.layouts.template')

@section('title')
    Posisi - BIO HRMS
@endsection

@section('banner-title')
    Posisi
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
                                <form id="myForm" action="{{ route('store.position') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Nama Posisi:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Mis: Admin">
                                        </div>

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
