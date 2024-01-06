@extends('frontend.layouts.template')

@section('title')
    Laporan Promotor - BIO HRMS
@endsection

@section('header')
    <style>

    </style>



    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Laporan Promotor</div>
        <div class="right"></div>
    </div>
@endsection

@section('main')

    <div class="container contact-form">
        @if ($errors->any())
            <div class="alert alert-danger">

                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="frmPromotor" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">



                <div class="form-group mb-5 col-md-12">
                    <label for="office_id" class="form-label">Kantor Cabang <sup><span
                                style="color: #dc3545">(*)</span></sup></label>
                    <select name="office_id" class="form-control" id="office_id" required>
                        <option></option>
                        @foreach ($kacabs as $kacab)
                            <option value="{{ $kacab->id }}">{{ $kacab->kantor_cabang }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="text" class="form-control" id="kantor_cabang" name="kantor_cabang" hidden />
                <input type="text" class="form-control" id="nama_promotor" name="nama_promotor" hidden />
                <input type="text" class="form-control" value="{{ $info->ip }}" id="ip" name="ip"
                    hidden />
                <input type="text" class="form-control" id="latitude2" name="latitude2" hidden />
                <input type="text" class="form-control" id="longitude2" name="longitude2" hidden />
                <input type="text" class="form-control" value="{{ $info->cityName }}" id="city_name" name="city_name"
                    hidden />
                <input type="text" class="form-control" id="latitude1" name="latitude1" hidden />
                <input type="text" class="form-control" id="longitude1" name="longitude1" hidden />
                <input type="text" class="form-control" id="jarak" name="jarak" hidden />
                <input type="text" class="form-control" id="keterangan" name="keterangan" hidden />
                <input type="text" class="form-control" id="sharelok" name="sharelok" hidden />


                <div class="form-group mb-5 col-md-12">
                    <label for="employee_id" class="form-label">Nama <sup><span
                                style="color: #dc3545">(*)</span></sup></label>
                    <select name="employee_id" class="form-control" id="employee_id" required>
                        <option></option>

                    </select>
                </div>

                <div class="form-group mb-5 col-md-12">
                    <label for="waktu_kunjungan">Waktu Kunjungan <sup><span style="color: #dc3545">(*)</span></sup></label>
                    <input type="date" class="form-control" id="waktu_kunjungan" placeholder="Jawaban Anda...."
                        name="waktu_kunjungan" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group mb-5">
                        <label for="lokasi_pemasangan_spanduk">Lokasi Pemasangan Spanduk <sup><span
                                    style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="lokasi_pemasangan_spanduk"
                            placeholder="Jawaban Anda...." name="lokasi_pemasangan_spanduk" required>
                    </div>

                    <div class="form-group mb-5">
                        <label for="jenis_spanduk">Jenis Spanduk <sup><span style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="jenis_spanduk" placeholder="Jawaban Anda...."
                            name="jenis_spanduk" required>
                    </div>

                    <div class="form-group mb-5">
                        <label for="catatan_pemasangan_spanduk">Catatan Pemasangan Spanduk <sup><span
                                    style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="catatan_pemasangan_spanduk"
                            placeholder="Jawaban Anda...." name="catatan_pemasangan_spanduk" required>
                    </div>

                    <div class="form-group mb-5">
                        <label for="follow_up">Follow Up <sup><span style="color: #dc3545">(*)</span></sup></label>
                        <input type="text" class="form-control" id="follow_up" placeholder="Jawaban Anda...."
                            name="follow_up" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-5">
                        <label for="lokasi_event">Lokasi Event</label>
                        <input type="text" class="form-control" id="lokasi_event" placeholder="Jawaban Anda...."
                            name="lokasi_event">
                    </div>

                    <div class="form-group mb-5">
                        <label for="jenis_event">Jenis Event</label>
                        <input type="text" class="form-control" id="jenis_event" placeholder="Jawaban Anda...."
                            name="jenis_event">
                    </div>

                    <div class="form-group mb-5">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" class="form-control" id="jumlah_peserta" placeholder="Jawaban Anda...."
                            name="jumlah_peserta">
                    </div>

                    <div class="form-group mb-5">
                        <label for="hasil_event">Hasil Event</label>
                        <input type="text" class="form-control" id="hasil_event" placeholder="Jawaban Anda...."
                            name="hasil_event">
                    </div>
                </div>


            </div>

            <div class="form-group mb-5">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" id="catatan" style="width: 100%; height: 150px;" placeholder="Catatan Tambahan *"
                    name="catatan"></textarea>
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
            $('select[name="office_id"]').on('change', function() {
                var office_id = $(this).val();
                if (office_id) {
                    $.ajax({
                        url: "{{ url('/promotor/ajax') }}/" + office_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="employee_id"]').html('');
                            var d = $('select[name="employee_id"]').empty();
                            $('select[name="employee_id"]').append(
                                '<option value="0">Pilih Salah Satu</option>');
                            $.each(data, function(key, value) {
                                $('select[name="employee_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .nama_karyawan + '</option>');
                            });
                        },

                    });
                } else {
                    $('select[name="office_id"]').append(
                        '<option value="0" selected>Pilih Salah Satu</option>');
                }
            });
        });

        $(document).ready(function() {

            // Office function
            $("#office_id").change(function() {
                var value = $(this).val();
                var kacab = $(this).find("option:selected").text();
                $("#kantor_cabang").val(kacab);
            }).change(); // Trigger initial change

            // Employee function
            $("#employee_id").change(function() {
                var value = $(this).val();
                var promotor = $(this).find("option:selected").text();
                $("#nama_promotor").val(promotor);
            }).change(); // Trigger initial change

        });

        $(document).ready(function() {
            getLocation(); // Call the function directly on page load
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


        $(function() {
            let kantor = $('#kantor_cabang').val();
            let latYog = "-7.824743884482511";
            let longYog = "110.3851776668307";
            let latJep = "-6.652100557453785";
            let longJep = "110.70972057237938";
            let latCir = "-6.709089464556359";
            let longCir = "108.4885450319081";
            let latSby = "-7.446453578935748";
            let longSby = "112.56573042028272";



            $('#office_id').change(function() {
                let lat2 = $('#latitude2').val();
                let lon2 = $('#longitude2').val();
                if ($('#kantor_cabang').val() == "Yogyakarta") {
                    $('#latitude1').val(parseFloat(latYog));
                    $('#longitude1').val(parseFloat(longYog));
                    $('#sharelok').val("https://www.google.com/maps/dir/" + latYog + "," + longYog + "/" +
                        lat2 + "," + lon2);
                } else if ($('#kantor_cabang').val() == "Jepara") {
                    $('#latitude1').val(parseFloat(latJep));
                    $('#longitude1').val(parseFloat(longJep));
                    $('#sharelok').val("https://www.google.com/maps/dir/" + latJep + "," + longJep + "/" +
                        lat2 + "," + lon2);
                } else if ($('#kantor_cabang').val() == "Cirebon") {
                    $('#latitude1').val(parseFloat(latCir));
                    $('#longitude1').val(parseFloat(longCir));
                    $('#sharelok').val("https://www.google.com/maps/dir/" + latCir + "," + longCir + "/" +
                        lat2 + "," + lon2);
                } else if ($('#kantor_cabang').val() == "Surabaya") {
                    $('#latitude1').val(parseFloat(latSby));
                    $('#longitude1').val(parseFloat(longSby));
                    $('#sharelok').val("https://www.google.com/maps/dir/" + latSby + "," + longSby + "/" +
                        lat2 + "," + lon2);
                }
                applyDistance();
            });
        });

        $('#frmPromotor').on('submit', function(e) {
            e.preventDefault();
            $('#btnSubmited').hide('fast');
            $('#msg').html('Please wait...');
            $('#btnSubmited').prop('disabled', true);
            $.ajax({
                url: 'https://script.google.com/macros/s/AKfycbzDtg3_yrqpiAYt_mtivDykdkDwuA_tHtoVxqaO_sjmM_6lZnq8TVJ7CKGO-JUDpq7Q/exec',

                type: 'post',
                data: $('#frmPromotor').serialize(),

                success: function(result) {

                    resend();

                }
            });
        });

        function resend() {
            $.ajax({
                url: '/create-promotor',
                type: 'post',

                data: $('#frmPromotor').serialize(),
                success: function(result) {

                    $('#frmPromotor')[0].reset();

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

                }
            })
        }
    </script>
@endpush
