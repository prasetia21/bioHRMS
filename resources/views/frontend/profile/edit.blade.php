@extends('frontend.layouts.template')

@section('title')
    Edit Profile - BIO HRMS
@endsection

@section('header')
    <style>
        body {
            background: -webkit-linear-gradient(left, #0c0125a6, #275377);
        }

        #webcam-picture,
        #webcam-picture video {
            display: inline-block;
            width: 100% !important;
            height: auto !important;
            margin: auto;
            border-radius: 15px;
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

        .item .item-content {
            padding: 30px 35px;
        }

        .image-upload {
            width: 100%;
            height: 300px;
            border: 1px dashed #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            position: relative;
            text-align: center;
            background: #f8f8f9;
            color: #666;
            overflow: hidden;
        }


        .item-wrapper form img {
            margin-bottom: 20px;
            width: auto;
            height: auto;
            max-height: 400px;
            width: auto;
            border-radius: 5px;
            overflow: hidden;
        }


        .image-upload img {
            height: 100% !important;
            width: auto !important;
            border-radius: 0px;
            margin: 0 auto;
        }

        .image-upload i {
            font-size: 6em;
            color: #ccc;
        }


        .image-upload input {
            cursor: pointer;
            opacity: 0;
            height: 100%;
            width: 100%;
            z-index: 10;
            position: absolute;
            top: 0;
            left: 0;
        }


        .item-wrapper input {
            height: 43px;
            line-height: 43px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .form-row>div .form-group #preview {
            min-width: 150px;
            max-width: 150px;
            width: 150px;
            height: 150px;
            border-radius: 200px;
        }
    </style>



    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Edit Profil</div>
        <div class="right"></div>
    </div>
@endsection

@section('main')

    <div class="container contact-form" style="margin-top: 30px;margin-bottom: 30px">


        <form id="frmProfile" action="{{ route('change.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <input type="hidden" name="id" value="{{ $employee->id }}">
                <input type="hidden" name="backup_photo" value="{{ $employee->photo }}">
            </div>



            <div class="form-row">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        @php
                            Session::flash('danger',  $error);
                        @endphp
                    @endforeach
                @endif

                <div class="col-md-12">
                    <div class="form-group mb-2">
                        <div class="mt-3 mb-3" id="hasil_webcam"></div>
                        <img id="preview"
                            src="{{ !empty($employee->photo) ? asset('picture/accounts/' . $employee->photo) : asset('picture/accounts/01.png') }}"
                            alt="attachment" class="mt-3 mb-3" style="display:block" />
                        <input type="hidden" name="image_data" id="image_data">

                        <label class="form-label" for="attachment">Foto Profile, <sup><span style="color: #d66a12">(Foto
                                    (Format: PNG, JPG), Max:
                                    2MB)</span></sup></label>
                        <!-- Button trigger modal --> </br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            Foto Profile
                        </button>
                    </div>

                    <div class="form-group">
                        <select hidden readonly name="upload_option" id="upload_option" class="form-control">
                            <option value="file">Upload File</option>
                            <option value="webcam">Capture Webcam</option>
                        </select>
                    </div>


                    <div class="form-group mb-2">
                        <label class="form-label" for="nip">Nomor Induk Pegawai:</label>
                        <input type="text" class="form-control" id="nip" name="nip"
                            value="{{ $employee->nip }}" placeholder="Mis: 123xxx" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="fullname">Nama Pegawai:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="{{ $employee->fullname }}" placeholder="Mis: Karto">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="address">Alamat Pegawai:</label>
                        <textarea class="form-control" id="address" name="address" rows="2">{{ $employee->address }}</textarea>
                    </div>


                    <div class="form-group mb-2">
                        <label class="form-label">Jenis Kelamin:</label>
                        <select id="gender" name="gender" class="selectpicker form-control" data-style="py-0">
                            <option value="{{ $employee->gender }}">{{ $employee->gender }}</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="phone">No Telepon:</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $employee->phone }}" placeholder="Mis: 0274-12345 / 08xxxxxxxxx" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="birth_place">Tempat Lahir:</label>
                        <input type="text" class="form-control" id="birth_place" value="{{ $employee->birth_place }}"
                            name="birth_place" placeholder="Mis: Yogyakarta">
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label" for="birth_date">Tanggal Lahir:</label>
                        <input type="text" class="form-control" id="birth_date" name="birth_date"
                            value="{{ $employee->birth_date }}" placeholder="Pilih Tanggal Lahir">
                    </div>

                    <div class="password-section">
                        <h4 class="head">Ubah Password Baru</h4>
                    </div>
                    <hr>
                    <div class="form-group mb-2">
                        <label class="form-label" for="old_password">Password Lama:</label>
                        <input type="password" class="form-control" id="old_password" name="old_password">
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label" for="new_password">Password Baru:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Pilihan Upload Foto Profile</h5>
                                    <button type="button" id="modalClose" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">

                                            {{-- <div class="form-group">


                                                <input type="radio" name="upload_option" id="upload_option_file"
                                                    value="file">
                                                <label for="upload_option_file">Upload File</label>

                                                <input type="radio" name="upload_option" id="upload_option_webcam"
                                                    value="webcam">
                                                <label for="upload_option_webcam">Capture
                                                    Webcam</label>

                                            </div> --}}

                                            <div class="col-md-6">
                                                <div id="file_upload_section" class="form-group">
                                                    <div class="item-inner">
                                                        <div class="item-content">
                                                            <div class="image-upload">

                                                                <label style="cursor: pointer;" for="file_upload">

                                                                    <img src="" alt=""
                                                                        class="uploaded-image">

                                                                    <div class="h-100">
                                                                        <div class="dplay-tbl">
                                                                            <div class="dplay-tbl-cell">


                                                                                <svg height="100px" width="100px"
                                                                                    version="1.1"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                    viewBox="0 0 64 64"
                                                                                    xml:space="preserve">
                                                                                    <style type="text/css">
                                                                                        .st0 {
                                                                                            fill: #76C2AF;
                                                                                        }

                                                                                        .st1 {
                                                                                            opacity: 0.2;
                                                                                        }

                                                                                        .st2 {
                                                                                            fill: #231F20;
                                                                                        }

                                                                                        .st3 {
                                                                                            fill: #FFFFFF;
                                                                                        }
                                                                                    </style>
                                                                                    <g id="Layer_1">
                                                                                        <g>
                                                                                            <circle class="st0"
                                                                                                cx="32"
                                                                                                cy="32" r="32" />
                                                                                        </g>
                                                                                        <g class="st1">
                                                                                            <g>
                                                                                                <path class="st2"
                                                                                                    d="M48,32c0-8.8-7.2-16-16-16c-7.5,0-13.8,5.2-15.5,12.1C11.7,28.9,8,33,8,38c0,5.5,4.5,10,10,10h8
                                                                                                                                                                               c1.1,0,2-0.9,2-2v-5.5c0-0.8-0.7-1.5-1.5-1.5h-3.1c-1.5,0-1.9-1-0.9-2.2l7.7-9.8c1-1.2,2.6-1.2,3.5,0l7.7,9.8
                                                                                                                                                                               c1,1.2,0.6,2.2-0.9,2.2h-3.1c-0.8,0-1.5,0.7-1.5,1.5V46c0,1.1,0.9,2,2,2h10c4.4,0,8-3.6,8-8S52.4,32,48,32z" />
                                                                                            </g>
                                                                                        </g>
                                                                                        <g>
                                                                                            <g>
                                                                                                <path class="st3"
                                                                                                    d="M48,30c0-8.8-7.2-16-16-16c-7.5,0-13.8,5.2-15.5,12.1C11.7,26.9,8,31,8,36c0,5.5,4.5,10,10,10h8
                                                                                                                                                                               c1.1,0,2-0.9,2-2v-5.5c0-0.8-0.7-1.5-1.5-1.5h-3.1c-1.5,0-1.9-1-0.9-2.2l7.7-9.8c1-1.2,2.6-1.2,3.5,0l7.7,9.8
                                                                                                                                                                               c1,1.2,0.6,2.2-0.9,2.2h-3.1c-0.8,0-1.5,0.7-1.5,1.5V44c0,1.1,0.9,2,2,2h10c4.4,0,8-3.6,8-8S52.4,30,48,30z" />
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g id="Layer_2">
                                                                                    </g>
                                                                                </svg>
                                                                                <h5><b>Pilih File dari Penyimpanan</b></h5>
                                                                                <h6 class="mt-10 mb-70">atau Drag and Drop
                                                                                    File
                                                                                    anda
                                                                                </h6>


                                                                            </div>
                                                                        </div>
                                                                    </div><!--upload-content-->





                                                                    <input type="file" name="file_input"
                                                                        id="file_input" class="form-control image-input"
                                                                        data-traget-resolution="image_resolution">

                                                                </label>

                                                            </div>
                                                        </div><!--item-content-->
                                                    </div><!--item-inner-->
                                                </div>
                                            </div>



                                            <div class="col-md-6 ml-auto">
                                                <div id="webcam_section" class="form-group">
                                                    <div class="item-inner">
                                                        <div class="item-content">
                                                            <div class="image-upload">

                                                                <label style="cursor: pointer;" for="cam_upload">

                                                                    <img src="" alt=""
                                                                        class="uploaded-image">

                                                                    <div class="h-100">
                                                                        <div class="dplay-tbl">
                                                                            <div class="dplay-tbl-cell">


                                                                                <?xml version="1.0" encoding="utf-8"?>
                                                                                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->

                                                                                <svg data-toggle="modal"
                                                                                    data-target="#test2" width="100px"
                                                                                    height="100px" viewBox="0 0 1024 1024"
                                                                                    class="icon" version="1.1"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M732.1 399.3C534.6 356 696.5 82.1 425.9 104.8s-527.2 645.8-46.8 791.7 728-415 353-497.2z"
                                                                                        fill="#464BD8" />
                                                                                    <path
                                                                                        d="M695.5 779.5c-5.7 0-11.3-0.8-16.9-2.3l-402-112.4c-16.1-4.5-29.4-15-37.6-29.5a62 62 0 0 1-5.7-47.5l65-232.6a62.64 62.64 0 0 1 60.1-45.4c5.7 0 11.3 0.8 16.9 2.3L508 349.2c0.3 0.1 0.6 0.1 1 0.1 1.2 0 2.3-0.6 2.9-1.6l21.3-31.5c7.5-11.1 20-17.7 33.4-17.7 3.7 0 7.4 0.5 11 1.5L695 332.9a40.03 40.03 0 0 1 29.5 36.8l1.9 37.6c0.1 1.6 1.1 2.9 2.6 3.3l48.2 13.5c16.1 4.5 29.4 15 37.6 29.5a62 62 0 0 1 5.7 47.5l-65 232.6c-7.4 27-32.1 45.8-60 45.8z"
                                                                                        fill="#FFFFFF" />
                                                                                    <path
                                                                                        d="M566.5 306c3 0 6 0.4 9 1.3L693 340.1a32.87 32.87 0 0 1 24.1 30l1.9 37.7a11 11 0 0 0 8 10.1l48.2 13.5a55.03 55.03 0 0 1 38.2 67.8l-65.1 232.6a55.06 55.06 0 0 1-53 40.2c-4.9 0-9.9-0.7-14.9-2l-402-112.4a55.03 55.03 0 0 1-38.2-67.8l65.1-232.6c6.9-24.2 28.9-40 52.9-40 4.9 0 9.9 0.7 14.9 2l132.7 37.1c1 0.3 2 0.4 3 0.4 3.6 0 7.1-1.8 9.1-4.9l21.3-31.4c6.3-9.2 16.5-14.4 27.3-14.4m0-14.9c-15.9 0-30.6 7.8-39.5 21l-19.7 29.2L377.4 305c-6.2-1.7-12.5-2.6-18.9-2.6a70.4 70.4 0 0 0-41.8 13.9c-12.4 9.2-21.2 22-25.5 36.9v0.1l-65.1 232.6c-10.4 37.1 11.4 75.8 48.5 86.2l402 112.4c6.2 1.7 12.5 2.6 18.9 2.6 31.2 0 58.9-21 67.3-51.1l65-232.6c5-18 2.8-36.9-6.4-53.1-9.2-16.3-24.1-28-42.1-33l-45.5-12.7-1.8-34.9a47.6 47.6 0 0 0-35-43.6l-117.5-32.9a39.3 39.3 0 0 0-13-2.1z"
                                                                                        fill="#151B28" />
                                                                                    <path
                                                                                        d="M686 365.2c2.9 0.8 4.9 3.3 5 6.3l1.9 37.6c0.4 16.2 11.3 30.2 26.9 34.6l48.2 13.5a28.98 28.98 0 0 1 20.1 35.7l-65 232.6c-4.6 15-20.4 23.6-35.5 19.3l-402-112.4a28.98 28.98 0 0 1-20.1-35.7l65.1-232.6a28.87 28.87 0 0 1 35.6-19.8l132.7 37.1c15.6 4.3 32.2-2 40.9-15.6l21-30.7c1.6-2.5 4.7-3.6 7.5-2.8L686 365.2"
                                                                                        fill="#2AEFC8" />
                                                                                    <path
                                                                                        d="M597.6 454.5c56.2 15.7 89 74 73.3 130.2-15.7 56.2-74 89-130.2 73.3-56.2-15.7-89-74-73.3-130.2 15.9-56.1 74-88.8 130.2-73.3m7-25.1c-70.1-19.6-142.8 21.3-162.3 91.4-19.6 70.1 21.3 142.8 91.4 162.3 70.1 19.6 142.8-21.3 162.3-91.4 19.5-70-21.4-142.6-91.4-162.3z m0 0"
                                                                                        fill="" />
                                                                                    <path
                                                                                        d="M580.1 513.2a50.39 50.39 0 0 1-27 97.1 50.44 50.44 0 0 1-35.2-61.9 50.5 50.5 0 0 1 62.2-35.2"
                                                                                        fill="#514DDF" />
                                                                                    <path
                                                                                        d="M568.1 635.9c-28.9 0-55.7-15.6-70-41.4a79.69 79.69 0 0 1 7.6-88.8c20.4-25.4 53.8-36 85-26.8 42 12.3 66.5 56.6 54.6 98.7-8.9 31.4-35.5 54-67.9 57.8-3.1 0.3-6.2 0.5-9.3 0.5z m0-136c-16.7 0-32.7 7.5-43.5 21a55.6 55.6 0 0 0-5.3 61.9c11 19.9 32.7 31.1 55.3 28.5a55.45 55.45 0 0 0 47.3-40.3c8.3-29.4-8.8-60.2-38-68.8-5.2-1.6-10.5-2.3-15.8-2.3zM441.2 310.6L391 296.5c-6.9-1.9-11-9.1-9-16.1 1.9-6.9 9.1-11 16.1-9l50.2 14.1c6.9 1.9 11 9.1 9 16.1-1.9 6.9-9.1 10.9-16.1 9z m0 0M413.5 409.8l-50.2-14.1c-6.9-1.9-11-9.1-9-16.1 1.9-6.9 9.1-11 16.1-9.1l50.2 14.1c6.9 1.9 11 9.1 9 16.1-2 7-9.2 11.1-16.1 9.1z m0 0"
                                                                                        fill="" />
                                                                                </svg>

                                                                                <h5><b>Buka Kamera untuk Ambil Gambar</b>
                                                                                </h5>



                                                                            </div>
                                                                        </div>
                                                                    </div><!--upload-content-->
                                                                    <div class="modal-body">


                                                                    </div>

                                                                    <div id="test2" class="modal fade" role="dialog"
                                                                        style="z-index: 1600;">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLongTitle">Capture
                                                                                        Image</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <div id="webcam-picture">

                                                                                    </div>



                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">Batal</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary"
                                                                                        id="take_snapshot">Ambil
                                                                                        Gambar</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </label>

                                                            </div>
                                                        </div><!--item-content-->
                                                    </div><!--item-inner-->

                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                </div>
            </div>

            <div class="form-group mb-2 text-center">
                <input type="submit" name="btnSubmit" id="btnSubmited" class="btnContact" value="Submit" />
                <div id="msg"></div>
            </div>

        </form>
    </div>


@endsection

@push('myscript')
    <script>
        flatpickr('#birth_date', {
            dateFormat: "d-m-Y",
        });

        $(document).ready(function() {
            // Initialize Webcam
            Webcam.set({
                height: 480,
                width: 640,
                image_format: 'jpeg',
                jpeg_quality: 80,
                constraints: {
                    facingMode: 'environment'
                }
            });

            $("#file_upload_section").show();
            $("#webcam_section").show();

            $("#file_input").click(function() {
                $("#upload_option").val("file").trigger("change");
            });

            $("#test2").click(function() {
                $("#upload_option").val("webcam").trigger("change");
            });

            $("#upload_option").change(function() {
                let selectedOption = $(this).val();



                if (selectedOption === "file") {
                    console.log("file");
                    $("#file_upload_section").show();
                    $("#webcam_section").hide();
                    $('#exampleModalCenter').modal('toggle');
                } else if (selectedOption === "webcam") {
                    console.log("cam");
                    $("#file_upload_section").hide();
                    $("#webcam_section").show();

                    // Start webcam

                }
            });

            Webcam.attach('#webcam-picture');
            // Capture webcam image
            $("#take_snapshot").click(function() {
                Webcam.snap(function(data_uri) {
                    // Display captured image
                    $("#hasil_webcam").html('<img style="width:250px;height:250px" src="' +
                        data_uri + '" />');

                    // Set hidden input value with image data
                    $("#image_data").val(data_uri);
                    $('#test2').modal('toggle');
                    $('#exampleModalCenter').modal('toggle');
                });
            });
        });


        file_input.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = file_input.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
