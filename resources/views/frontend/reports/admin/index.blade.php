<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Form Penilaian Admin</title>
    {{-- <link rel="stylesheet" href="{{ asset('form/bootstrap-4.6.2-dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('form/fontawesome-free-5.6.3-web/css/all.min.css') }}" /> --}}

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.3/css/all.min.css" />

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
</head>

<body>



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
        <form id="frmAdmin" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Form Penilaian admin</h3>
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
                <input type="text" class="form-control" id="nama_admin" name="nama_admin" hidden />
                <input type="text" class="form-control" id="fileContent" name="fileContent" hidden />
                <input type="text" class="form-control" id="filename" name="filename" hidden />
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

                <!-- <span id='csrf' style='display:inline'>{{ csrf_token() }}<span> -->


                {{-- <input name="_token" id="token" value="{{ csrf_token() }}"> --}}

                <div class="form-group mb-5 col-md-12">
                    <label for="employee_id" class="form-label">Nama <sup><span
                                style="color: #dc3545">(*)</span></sup></label>
                    <select name="employee_id" class="form-control" id="employee_id" required>
                        <option></option>

                    </select>
                </div>

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

    {{-- <script src="{{ asset('form/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('form/bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js') }}"> </script> --}}

    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="office_id"]').on('change', function() {
                var office_id = $(this).val();
                if (office_id) {
                    $.ajax({
                        url: "{{ url('/admin/ajax') }}/" + office_id,
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
    </script>

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

            // Office function
            $("#office_id").change(function() {
                var value = $(this).val();
                var kacab = $(this).find("option:selected").text();
                $("#kantor_cabang").val(kacab);
            }).change(); // Trigger initial change

            // Employee function
            $("#employee_id").change(function() {
                var value = $(this).val();
                var admin = $(this).find("option:selected").text();
                $("#nama_admin").val(admin);
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

                }
            })
        }
    </script>
</body>

</html>