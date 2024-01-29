@extends('frontend.layouts.template')

@section('title')
    Pengajuan Ijin - BIO HRMS
@endsection

@section('header')
    <style>
        body {
            background: -webkit-linear-gradient(left, #0c0125a6, #275377);
        }

        .contact-form {
            background: #fff;
            margin-top: 5%;
            margin-bottom: 5%;
            width: 80%;
        }

        .contact-form .form-control {
            border-radius: 1rem;
        }

        .contact-image {
            text-align: center;
        }

        .contact-image img {
            border-radius: 6rem;
            width: 11%;
            margin-top: -3%;
            transform: rotate(29deg);
        }

        .contact-form form {
            padding: 14%;
        }

        .contact-form form .row {
            margin-bottom: -7%;
        }

        .contact-form h3 {
            margin-bottom: 8%;
            margin-top: -10%;
            text-align: center;
            color: #0062cc;
        }

        .contact-form .btnContact {
            width: 50%;
            border: none;
            border-radius: 1rem;
            padding: 1.5%;
            background: #dc3545;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
        }

        .btnContactSubmit {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
        }

        @media only screen and (max-width: 600px) {
            .contact-form {
                width: 100%;
                margin-top: 0%;
                margin-bottom: 0%;
            }

            .contact-form form {
                padding: 17% 5%;
            }

            .contact-form .btnContact {
                width: 90%;
                padding: 4.5%;
            }
        }
    </style>



    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Pengajuan Ijin</div>
        <div class="right"></div>
    </div>
@endsection

@section('main')

    <div class="container contact-form" style="margin-top: 30px;margin-bottom: 30px">
        @if ($errors->any())
            <div class="alert alert-danger">

                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="frmIjin" action="{{ route('store.ijin') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <input type="text" class="form-control" value="{{ $employee->id }}" id="employee_id" name="employee_id"
                    hidden />
                <input type="text" class="form-control" value="{{ $employee->departement->branch }}" id="kantor_cabang"
                    name="kantor_cabang" hidden />
                <input type="text" class="form-control" value="{{ $employee->fullname }}" id="nama_pegawai"
                    name="nama_pegawai" hidden />
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group mb-5">
                        <label class="form-label" for="start_date">Tanggal Mulai Ijin <sup><span style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="start_date" name="start_date"
                            placeholder="Pilih Tanggal Mulai Ijin">
                    </div>

                    <div class="form-group mb-5">
                        <label class="form-label" for="end_date">Tanggal Akhir Ijin <sup><span style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="end_date" name="end_date"
                            placeholder="Pilih Tanggal Akhir Ijin">
                    </div>

                    <div class="form-group mb-5">
                        <label for="present_id" class="form-label">Alasan Ijin <sup><span
                                    style="color: #dc3545">(*)</span></sup></label>
                        <select name="present_id" class="form-control" id="present_id" required>
                            <option selected>Pilih salah satu</option>
                            <option value="2">Sakit</option>
                            <option value="3">Terlambat</option>
                            <option value="4">Acara Keluarga</option>
                            <option value="5">Melayat</option>
                        </select>
                    </div>

                    <div class="form-group mb-5">
                        <label for="note">Keterangan <sup><span style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="note" placeholder="Ijin Karena...."
                            name="note" required>
                    </div>

                    <div class="form-group mb-5">
                        <label class="form-label" for="attachment">Attachment (Opsional), <sup><span style="color: #d66a12">(Screenshot/ Foto (Format: PNG, JPG), Max: 2MB)</span></sup></label>
                        <input type="file" class="form-control" id="attachment" name="attachment">
                    </div>
                </div>
            </div>

            <div class="form-group mb-5 text-center">
                <input type="submit" name="btnSubmit" id="btnSubmited" class="btnContact" value="Submit" />
                <div id="msg"></div>
            </div>

        </form>
    </div>


@endsection

@push('myscript')
    <script>
        flatpickr('#start_date', {
            dateFormat: "d-m-Y",
            "minDate": new Date().fp_incr(1)
        });

        flatpickr('#end_date', {
            dateFormat: "d-m-Y",
            "minDate": new Date().fp_incr(1)
        });
    </script>
@endpush
