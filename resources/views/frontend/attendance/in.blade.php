@extends('frontend.layouts.template')

@section('title')
Absensi - BIO HRMS
@endsection

@section('header')
    <style>
        #webcam-picture,
        #webcam-picture video {
            display: inline-block;
            width: 100% !important;
            height: auto !important;
            margin: auto;
            border-radius: 15px;
        }

        #map {
            height: 200px;
        }
    </style>



    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Absensi Bio</div>
        <div class="right"></div>
    </div>
@endsection

@section('main')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <input type="text" id="lokasi" hidden>
            <div id="webcam-picture">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if ($cek > 0)
                <button id="absen" class="btn btn-danger btn-block"><ion-icon name="camera-outline"></ion-icon>Absen
                    Pulang</button>
            @else
                <button id="absen" class="btn btn-primary btn-block"><ion-icon name="camera-outline"></ion-icon>Absen
                    Masuk</button>
            @endif


        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <input type="number" class="form-control" name="lat_kantor" id="lat_kantor" value="{{ $employee->departement->latitude }}" hidden>
            <input type="number" class="form-control" name="lon_kantor" id="lon_kantor" value="{{ $employee->departement->longitude }}" hidden>
            <div id="map"></div>
        </div>
    </div>

    <audio id="notif_in">
        <source src="{{ asset('assets/audio/notification_in.mp3') }}" type="audio/mpeg">
    </audio>

    <audio id="notif_out">
        <source src="{{ asset('assets/audio/notification_out.mp3') }}" type="audio/mpeg">
    </audio>

    <audio id="radius_distance">
        <source src="{{ asset('assets/audio/radius_distance.mp3') }}" type="audio/mpeg">
    </audio>

    <audio id="departement">
        <source src="{{ asset('assets/audio/departement.mp3') }}" type="audio/mpeg">
    </audio>

    <audio id="image">
        <source src="{{ asset('assets/audio/image.mp3') }}" type="audio/mpeg">
    </audio>

    <audio id="sunday">
        <source src="{{ asset('assets/audio/sunday.mp3') }}" type="audio/mpeg">
    </audio>
@endsection

@push('myscript')
    <script>
        let notification_in = document.getElementById('notif_in');
        let notification_out = document.getElementById('notif_out');
        let radius_distance = document.getElementById('radius_distance');
        let departement = document.getElementById('departement');
        let image = document.getElementById('image');
        let sunday = document.getElementById('sunday');

        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80,
        });

        Webcam.attach('#webcam-picture');

        let lokasi = document.getElementById('lokasi');
        let lat_kantor = document.getElementById('lat_kantor').value;
        let lon_kantor = document.getElementById('lon_kantor').value;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation Tidak Support pada Browser Anda, Coba Ganti Browser Lain.");
        }

        function showPosition(position) {
            let config = {
                minZoom: 5, // 17
                maxZoom: 18,
            };

            const zoom = 13;
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            lokasi.value = lat + "," + lng;

            const map = L.map("map", config).setView([lat, lng], zoom);

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            const marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
                .bindPopup('<b>Ini adalah lokasi absensimu</b>').openPopup();

            const circle = L.circle([lat_kantor, lon_kantor], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 10
            }).addTo(map).bindPopup('Radius Absensi Kantor.');

            const popup = L.popup()
                .setLatLng([position.coords.latitude, position.coords.longitude])
                .setContent('Posisimu Saat ini!.')
                .openOn(map);

            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent(`Kamu mengklik koordinat lokasi ${e.latlng.toString()}`)
                    .openOn(map);
            }

            map.on('click', onMapClick);

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


        $("#absen").click(function(e) {
            
            Webcam.snap(function(data_uri) {
                image = data_uri;
            });
            let lokasi = $("#lokasi").val();
            
            $.ajax({
                type: 'POST',
                url: '/absensi/store',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    image: image,
                    lokasi: lokasi
                },

                cache: false,
                success: function(response) {
                    let status = response.split('|');
               
                    if (status[0] == 'success') {
                        if (status[2] == 'in') {
                            notification_in.play();
                        } else {
                            notification_out.play();
                        }
                        Swal.fire({
                            title: 'Berhasil',
                            text: status[1],
                            icon: 'success',
                        })
                        setTimeout("location.href='/dashboard'", 3000);
                    } else {
                        if (status[2] == 'radius') {
                            radius_distance.play();
                        } else if (status[2] == 'departement') {
                            departement.play();
                        } else if (status[2] == 'image') {
                            image.play();
                        } else if (status[2] == 'sunday') {
                            sunday.play();
                        }
                        Swal.fire({
                            title: 'Gagal Absen',
                            text: status[1],
                            icon: 'error',
                        })
                    }
                }
            })
        })
    </script>
@endpush
