@extends('frontend.layouts.template')

@section('title')
    Laporan Admin - BIO HRMS
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
        <div class="pageTitle">Laporan Admin</div>
        <div class="right"></div>
    </div>
@endsection

@section('main')

    <div class="container contact-form" style="margin-top: 100px;margin-bottom: 100px">
        @if ($errors->any())
            <div class="alert alert-danger">

                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="frmAdmin" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">

                <input type="text" class="form-control" value="{{ $employee->id }}" id="employee_id" name="employee_id"
                    hidden />
                <input type="text" class="form-control" value="{{ $employee->departement->branch }}" id="kantor_cabang"
                    name="kantor_cabang" hidden />
                <input type="text" class="form-control" value="{{ $employee->fullname }}" id="nama_admin"
                    name="nama_admin" hidden />
                <input type="text" class="form-control" id="fileContent" name="fileContent" hidden />
                <input type="text" class="form-control" id="filename" name="filename" hidden />
                <input type="text" class="form-control" value="{{ $info->ip }}" id="ip" name="ip"
                    hidden />
                <input type="text" class="form-control" id="latitude2" name="latitude2" hidden />
                <input type="text" class="form-control" id="longitude2" name="longitude2" hidden />
                <input type="text" class="form-control" value="{{ $info->cityName }}" id="city_name" name="city_name"
                    hidden />
                <input type="text" class="form-control" id="latitude1" name="latitude1" value="{{ $latitudeDept }}"
                    hidden />
                <input type="text" class="form-control" id="longitude1" name="longitude1" value="{{ $longitudeDept }}"
                    hidden />
                <input type="text" class="form-control" id="jarak" name="jarak" hidden />
                <input type="text" class="form-control" id="keterangan" name="keterangan" hidden />
                <input type="text" class="form-control" id="sharelok" name="sharelok" hidden />

                <!-- <span id='csrf' style='display:inline'>{{ csrf_token() }}<span> -->


                {{-- <input name="_token" id="token" value="{{ csrf_token() }}"> --}}


                <div class="form-group mb-5 col-md-12">

                    <div class="custom-file">
                        <label for="attach" class="form-label">Format yang disarankan (xlsx, xls, csv)<sup><span
                                    style="color: #dc3545">(*)</span></sup></label>
                        <input type="file" class="form-control" id="attach" name="file" />
                    </div>

                </div>
            </div>

            <div class="form-group mb-5 text-center">
                <input type="submit" name="btnSubmit" id="btnSubmited" class="btnContact" value="Submit" />
                <div id="msg"></div>
            </div>

        </form>
        {{-- <button type="button" onclick="UploadFile();">Upload </button> --}}
    </div>

@endsection

@push('myscript')
    <script>
        $('#attach').change(function() {
            let date = new Date();
            const fileInput = $("#attach");
            const file = fileInput[0].files[0];
            const reader = new FileReader();
            reader.onload = function() {
                $("#fileContent").val(reader.result);
                $("#filename").val($("#nama_admin").val().replace(/\s+/g, "_") + "-" + date.getDate() + "-" + (
                        date.getMonth() + 1) + "-" + date.getFullYear() + "-" + date.getHours() + "-" + date
                    .getMinutes() + "-" + date.getSeconds() + "-" + (file.name).replace(/\s+/g, "_"));
            };
            reader.readAsDataURL(file);
        });

        $(document).ready(function() {
            getLocation(); // Call the function directly on page load
            applyDistance();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation Tidak Support pada Browser Anda, Coba Ganti Browser Lain.");
            }
        }

        function showPosition(position) {

            $('#latitude2').val(parseFloat(position.coords.latitude));
            $('#longitude2').val(parseFloat(position.coords.longitude));
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Permintaan Ijin Akses Lokasi Ditolak, Ijinkan / Allow Akses Lokasi untuk Melanjutkan.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Lokasi Tidak Tersedia / Anda Sedang Diluar Jangkauan / Ijin Lokasi Belum Diaktifkan.");
                    break;
                case error.TIMEOUT:
                    alert("Waktu Permintaan Ijin Akses Lokasi Habis.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Error pada System Geolocation Gadget Anda.");
                    break;
            }
        }

        $('#frmAdmin').on('submit', function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $('#btnSubmited').hide('fast');
            $('#msg').html('Please wait...');
            $('#btnSubmited').prop('disabled', true);
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                method: 'post',
                contentType: 'multipart/form-data',
                url: '/create-admin',

                // data: $('#frmAdmin').serialize(),
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,

                success: function(result) {

                    resend();

                }
            });
        });

        function resend() {
            $.ajax({
                url: 'https://script.google.com/macros/s/AKfycbycFkK6sQ7hswXKIF4mQSx4N2AaqjK-dz11-rrQYPy9HEIppxS2jwKAG799YriZdIni/exec',
                type: 'post',

                data: $('#frmAdmin').serialize(),
                success: function(result) {

                    $('#frmAdmin')[0].reset();



                    window.location.href = '/laporan-terkirim';
                }

            });

        }

        function applyDistance() {
            var lat1 = $('#latitude1').val();
            var lat2 = $('#latitude2').val();
            var lon1 = $('#longitude1').val();
            var lon2 = $('#longitude2').val();
            $.ajax({
                type: "POST",
                dataType: 'json',

                data: {
                    lat1: lat1,
                    lat2: lat2,
                    lon1: lon1,
                    lon2: lon2,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                url: "/distance-apply",

                success: function(data) {
                    $('#jarak').val(data.data);
                    $('#keterangan').val(data.ket);
                    $('#sharelok').val("https://www.google.com/maps/dir/" + lat1 + "," + lon1 + "/" +
                        lat2 + "," + lon2);

                }
            })
        }
    </script>
@endpush
