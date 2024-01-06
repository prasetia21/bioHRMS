@extends('backend.layouts.template')

@section('title')
    Posisi - BIO HRMS
@endsection

@section('banner-title')
    Posisi
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
                                <form action="{{ route('change.position') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Nama Posisi:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $data->name }}" placeholder="Mis: Admin">
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
