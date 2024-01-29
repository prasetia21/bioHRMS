@extends('frontend.layouts.template')

@section('title')
    Pengajuan Cuti - BIO HRMS
@endsection

@section('header')
    <style>
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

        .card-message {
            color: #434e65;
        }

        .card-message .card-content {
            padding: 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
        }


        .card-message h4 {
            text-align: center;
            font-size: 50px;
            margin: 15px 0;
        }

        .card-message .form-control,
        .card-message .btn {
            min-height: 40px;
            border-radius: 3px;
        }


        .card-message .btn,
        .card-message .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #eeb711 !important;
            text-decoration: none;
            transition: all 0.4s;
            border-radius: 30px;
            margin-top: 10px;
            padding: 6px 20px;
            border: none;
        }
    </style>



    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Pengajuan Cuti</div>
        <div class="right"></div>
    </div>
@endsection

@section('main')
    @if ($employee->leave->total_days <= 0)

        <div class="container h-75" style="margin-top:100px">
            <div class="row h-75 justify-content-center align-items-center">
                <div class="card-success card-message">
                    <div class="card-content">

                        <div class="modal-body text-center">
                            <h2>Peringatan!</h2>
                            <h3>Jatah Cuti Anda Sudah Habis</h3>
                            <a href="" class="btn btn-primary" data-dismiss="modal"><span>Harap Hubungi HR untuk
                                    Keterangan lebih lanjut
                                </span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
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


            <form id="frmCuti" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <input type="text" class="form-control" value="{{ $employee->id }}" id="employee_id"
                        name="employee_id" hidden />
                    <input type="text" class="form-control" value="{{ $employee->departement->branch }}"
                        id="kantor_cabang" name="kantor_cabang" hidden />
                    <input type="text" class="form-control" value="{{ $employee->fullname }}" id="nama_pegawai"
                        name="nama_pegawai" hidden />
                    <input type="text" class="form-control" name="total_hari" id="total_hari" hidden>

                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label class="form-label" for="number_leave_day">Berapa Hari Pengajuan Cuti:</label>
                        <div class="input-group mb-5">

                            <input type="number" id="number_leave_day" name="number_leave_day" min="1"
                                max="{{ $employee->leave->total_days }}" class="form-control"
                                placeholder="Total Pengajuan Cuti" aria-label="Total Pengajuan Cuti"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text ml-1" id="basic-addon2">hari</span>
                            </div>

                        </div>

                        <div class="form-group mb-5">
                            <label class="form-label" for="start_date">Tanggal Mulai Cuti:</label>
                            <input type="text" class="form-control" id="start_date" name="start_date"
                                placeholder="Pilih Tanggal Mulai Cuti">
                        </div>

                        <div class="form-group mb-5">
                            <label class="form-label" for="end_date">Tanggal Akhir Cuti:</label>
                            <input type="text" class="form-control" id="end_date" name="end_date"
                                placeholder="Pilih Tanggal Akhir Cuti">
                        </div>

                        <div class="form-group mb-5">
                            <label for="note">Alasan Cuti <sup><span style="color: #dc3545">(*)</span></sup></label>
                            <input type="text" class="form-control" id="note" placeholder="Cuti Karena...."
                                name="note" required>
                        </div>


                        <div class="form-group mb-5">
                            <label for="pic" class="form-label">PIC Penganti</label>
                            <select name="pic" class="form-control" id="pic" required>
                                <option></option>
                                @foreach ($employees as $pic)
                                    <option value="{{ $pic->id }}">{{ $pic->fullname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mb-5">
                            <label class="form-label" for="attachment">Attachment (Opsional)</label>
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

    @endif

@endsection

@push('myscript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>

    <script>
        flatpickr('#start_date', {
            dateFormat: "d-m-Y",
            "minDate": new Date().fp_incr(1)
        });

        flatpickr('#end_date', {
            dateFormat: "d-m-Y",
            "minDate": new Date().fp_incr(1)
        });


        $('#end_date').change(function() {

            const jmlAmbilCuti = document.getElementById('number_leave_day').value;
            const endDateIn = document.getElementById('end_date');

            const startDateInput = document.getElementById('start_date').value;
            const endDateInput = document.getElementById('end_date').value;

            const partStartDate = startDateInput.split('-');
            const partEndDate = endDateInput.split('-');

            const dateStart = partStartDate[2] + '/' + partStartDate[1] + '/' + partStartDate[0];
            const dateEnd = partEndDate[2] + '/' + partEndDate[1] + '/' + partEndDate[0];


            let tgl_awal = $('#start_date').val();
            let tgl_akhir = $('#end_date').val();
            let tgl_aw = moment(dateStart)
            let tgl_ak = moment(dateEnd)
            let numYears, numMonths, numDays;

            numYears = tgl_ak.diff(tgl_aw, 'years');
            tgl_aw = tgl_aw.add(numYears, 'years');
            numMonths = tgl_ak.diff(tgl_aw, 'months');
            tgl_aw = tgl_aw.add(numMonths, 'months');
            numDays = tgl_ak.diff(tgl_aw, 'days');

            console.log(tgl_aw);

            console.log();
            console.log();
            console.log();


            if (numYears == 0 && numMonths == 0) {
                if (numDays == 0) {
                    var hasil = 1
                } else {
                    var hasil = numDays + 1
                }
            }
            $('#total_hari').val(hasil)

            if (hasil > jmlAmbilCuti) {
                endDateIn.value = "";
                alert("jumlah hari tidak boleh melebihi jumlah jatah cuti");
            }
        })
    </script>
@endpush
