@extends('backend.layouts.template')

@section('title')
    Pengumuman - BIO HRMS
@endsection

@section('banner-title')
    Pengumuman
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
                <form id="myForm" style="display: block ruby" action="{{ route('store.news') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Data Pengumuman</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="title">Judul Pengumuman:</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Mis: Pengumuman HR">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="short_information">Deskripsi Pendek:</label>
                                            <input type="text" class="form-control" id="short_information" name="short_information"
                                                placeholder="Mis: Dengan Hormat, Diberitahukan xxxxxxx...">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="detail_information">Deskripsi Lengkap:</label>
                                            <textarea class="form-control" id="detail_information" name="detail_information" rows="5"></textarea>
                                        </div>

                                        @if (!empty($data) && $data->count() > 0)
                                            <div class="form-group col-md-12">
                                                <label for="employee_id" class="form-label">Author</label>
                                                <select name="employee_id" class="form-control" id="employee_id"
                                                    required>
                                                    <option></option>
                                                    @foreach ($data as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->fullname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                                role="alert">
                                                <span> Tambahkan Dahulu data Pegawai! <a href="{{ route('employee') }}">Klik disini </a>untuk menambahkan</span>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <div class="header-title">
                                                <h5 class="card-title">Attachment File</h5>
                                            </div>
                                            <div class="profile-img-edit position-relative">
                                                <img id="preview" src="{{ asset('hopeui/images/avatars/01.png') }}" alt="profile-pic"
                                                    class="theme-color-default-img profile-pic rounded avatar-100">
                                                
                                                <div class="upload-icone bg-primary col-md-12">
                                                    <svg class="upload-button icon-14" width="14" viewBox="0 0 24 24">
                                                        <path fill="#ffffff"
                                                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    <input class="form-control form-control-lg" type="file" name="attachment" id="attachment" accept="image/*" style="margin-top:-40px; margin-left:-20px; padding:50px; opacity: 10%">
                                                
                                                
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
  attachment.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = attachment.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
