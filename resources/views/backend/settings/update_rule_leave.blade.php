@extends('backend.layouts.template')

@section('title')
    Update Aturan Cuti - BIO HRMS
@endsection

@section('banner-title')
    Aturan Cuti
@endsection

@section('banner-desc')
    Halaman untuk Mengubah Aturan Cuti yang Berjalan di Sistem Bioindustries
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
                                <form id="myForm" action="{{ route('change.ruleleave') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $data->id }}">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="total_leave" class="form-label">Jatah Cuti</label>
                                            <input type="number" id="total_leave" name="total_leave" class="form-control"
                                                value="{{ $data->total_leave }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="leave_time">Masa Kerja:</label>
                                            <input type="number" id="number_year" name="number_year" class="form-control"
                                                value="{{ $data->number_year }}">
                                        </div>


                                    </div>
                                    <hr>
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
@push('myscript')
    <script></script>
@endpush
