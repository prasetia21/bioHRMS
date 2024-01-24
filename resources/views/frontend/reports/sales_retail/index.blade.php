@extends('frontend.layouts.template')

@section('title')
    Laporan Sales Retail - BIO HRMS
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
        <div class="pageTitle">Laporan Sales Retail</div>
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

        <form id="frmSalesRetail" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-row">
               

                <input type="text" class="form-control" value="{{ $employee->id }}" id="employee_id"
                name="employee_id" hidden />
                <input type="text" class="form-control" id="nama_sales" name="nama_sales" value="{{ $employee->fullname }}" hidden>
                <input type="text" class="form-control" value="{{ $info->ip }}" id="ip" name="ip"
                    hidden />
                <input type="text" class="form-control" id="latitude2"
                    name="latitude2" hidden />
                <input type="text" class="form-control" id="longitude2"
                    name="longitude2" hidden />
                <input type="text" class="form-control" value="{{ $info->cityName }}" id="city_name" name="city_name"
                    hidden />
                    <input type="text" class="form-control" id="latitude1" name="latitude1" value="{{ $latitudeDept }}"
                    hidden />
                <input type="text" class="form-control" id="longitude1" name="longitude1" value="{{ $longitudeDept }}"
                    hidden />
                <input type="text" class="form-control" id="jarak" name="jarak" hidden />
                <input type="text" class="form-control" id="keterangan" name="keterangan" hidden />
                <input type="text" class="form-control" id="sharelok" name="sharelok" hidden />

                <div class="form-group mb-5 col-md-12">
                    <label for="waktu_kunjungan">Waktu Kunjungan <sup><span
                                style="color: #dc3545">(*)</span></sup></label>
                    <input type="date" class="form-control" id="waktu_kunjungan" placeholder="Jawaban Anda...."
                        name="waktu_kunjungan" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group mb-5">
                        <label for="nama_customer">Nama Customer <sup><span
                                    style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="nama_customer" placeholder="Jawaban Anda...."
                            name="nama_customer" required>
                    </div>

                    <div class="form-group mb-5">
                        <label for="jenis_kunjungan" class="form-label">Jenis Kunjungan <sup><span
                                    style="color: #dc3545">(*)</span></sup></label>
                        <select name="jenis_kunjungan" class="form-control" id="jenis_kunjungan" required>
                            <option>Penjajakan / Penawaran Produk</option>
                            <option>Penagihan</option>
                        </select>
                    </div>

                    <div class="form-group mb-5">
                        <label for="lokasi_event">Lokasi Event</label>
                        <input type="text" class="form-control" id="lokasi_event" placeholder="Jawaban Anda...."
                            name="lokasi_event">
                    </div>

                    <div class="form-group mb-5">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" class="form-control" id="jumlah_peserta"
                            placeholder="Jawaban Anda...." name="jumlah_peserta">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-5">
                        <label for="jenis_customer" class="form-label">Jenis Customer <sup><span
                                    style="color: #dc3545">(*)</span></sup></label>
                        <select name="jenis_customer" class="form-control" id="jenis_customer" required>
                            <option>Exiting</option>
                            <option>Prospek</option>
                        </select>
                    </div>

                    <div class="form-group mb-5">
                        <label for="hasil_kunjungan">Hasil Kunjungan</label>
                        <input type="text" class="form-control" id="hasil_kunjungan"
                            placeholder="Jawaban Anda...." name="hasil_kunjungan">
                    </div>

                    <div class="form-group mb-5">
                        <label for="jenis_event">Jenis Event</label>
                        <input type="text" class="form-control" id="jenis_event" placeholder="Jawaban Anda...."
                            name="jenis_event">
                    </div>

                    <div class="form-group mb-5">
                        <label for="hasil_event">Hasil Event</label>
                        <input type="text" class="form-control" id="hasil_event" placeholder="Jawaban Anda...."
                            name="hasil_event">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group mb-5">
                        <label for="follow_up">Follow Up <sup><span style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="follow_up" placeholder="Jawaban Anda...."
                            name="follow_up" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group mb-5">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" style="width: 100%; height: 150px;" placeholder="Catatan Tambahan *"
                            name="catatan"></textarea>
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

    <script type="text/javascript">

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


        $('#frmSalesRetail').on('submit', function(e) {
            e.preventDefault();
            $('#btnSubmited').hide('fast');
            $('#msg').html('Please wait...');
            $('#btnSubmited').prop('disabled', true);
            $.ajax({
                url: 'https://script.google.com/macros/s/AKfycbyidxnNac2qn4JJd0PgEaVuaygtim1a5cPibbtBbRoTiDR3cy37Bkqjbrozm_9phS1PBQ/exec',

                type: 'post',
                data: $('#frmSalesRetail').serialize(),

                success: function(result) {

                    resend();

                }
            });
        });

        function resend() {
            $.ajax({
                url: '/create-sales-retail',
                type: 'post',

                data: $('#frmSalesRetail').serialize(),
                success: function(result) {

                    $('#frmSalesRetail')[0].reset();

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
