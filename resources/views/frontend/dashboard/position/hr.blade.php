<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($todayattendance != null)
                                    @php
                                        $path = Storage::url('uploads/absensi/' . $todayattendance->photo_in);
                                    @endphp

                                    <img src="{{ url($path) }}" alt="" class="imaged w64">
                                @else
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{ $todayattendance != null ? $todayattendance->time_in : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($todayattendance != null && $todayattendance->time_out != null)
                                    @php
                                        $path = Storage::url('uploads/absensi/' . $todayattendance->photo_out);
                                    @endphp

                                    <img src="{{ url($path) }}" alt="" class="imaged w64">
                                @else
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{ $todayattendance != null && $todayattendance->time_out != null ? $todayattendance->time_out : 'Belum Absen Pulang' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="notif-pegawai">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Notif Pengajuan Cuti / Ijin</h4>
                    </div>
                </div>

                @if (!empty($ijin) && $ijin->count() > 0)
                    @foreach ($ijin as $key => $item)
                        <div class="modal fade" id="approval_ijin" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">Alasan Penolakan Permohonan Ijin
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="tidakacc" action="{{ route('tolak.hr') }}" method="post" hidden
                                        class="d-inline">
                                        @csrf
                                        <div class="modal-body approval_ijin">


                                            <input type="hidden" name="id" value="{{ $item->employee_id }}">
                                            <input type="hidden" name="approval_1" value="0">
                                            <input type="hidden" name="status_1" value="TIDAK ACC HR">
                                            <div class="form-group col-md-12">
                                                <label class="form-label" for="fullname">Alasan Penolakan:</label>
                                                <textarea class="form-control" id="reject_1" name="reject_1" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="list-inline m-0 p-0">

                                <li class="d-flex mb-4 align-items-center">
                                    <div class="img-fluid bg-soft-warning rounded-pill"><img
                                            src="{{ asset('picture/accounts/' . $item->employee->photo) }}"
                                            alt="story-img" style="width: 80px; height:80px"
                                            class="rounded-pill avatar-40"></div>
                                    <div class="ml-3 ms-3 flex-grow-1">
                                        <h3>{{ $item->employee->fullname }} / {{ $item->employee->position->name }}</h3>
                                        <p class="mb-0">Ingin Mengajukan <strong><span
                                                    class="badge badge-pill badge-primary">Ijin
                                                    {{ $item->present->name }}</span></strong> kepada HRD dan
                                            Manager
                                        </p>
                                    </div>
                                    <form onsubmit="return confirmApprove(event)" action="{{ route('approve.hr') }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->employee_id }}">
                                        <input type="hidden" name="status_1" value="ACC HR">
                                        <input type="hidden" name="approval_1" value="1">

                                        @if ($item->status_1 == 'TIDAK ACC HR')
                                        <span class="stamp is-denied">DITOLAK</span>
                                            <button disabled type="submit" class="btn btn-sm btn-icon btn-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"
                                                href="#">
                                                <span class="btn-inner">
                                                    <svg class="icon-20" width="50" viewBox="0 0 1024 1024"
                                                        class="icon" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M810.666667 554.666667m-85.333334 0a85.333333 85.333333 0 1 0 170.666667 0 85.333333 85.333333 0 1 0-170.666667 0Z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M213.333333 554.666667m-85.333333 0a85.333333 85.333333 0 1 0 170.666667 0 85.333333 85.333333 0 1 0-170.666667 0Z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M832 405.333333c0-270.933333-640-177.066667-640 0v213.333334c0 177.066667 142.933333 320 320 320s320-142.933333 320-320V405.333333z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M512 85.333333C324.266667 85.333333 170.666667 238.933333 170.666667 426.666667v74.666666l44.8 12.8V405.333333l416-134.4 174.933333 134.4v108.8l44.8-12.8V426.666667C853.333333 266.666667 738.133333 85.333333 512 85.333333z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M695.466667 396.8L475.733333 616.533333 371.2 512l-59.733333 59.733333 164.266666 164.266667 279.466667-279.466667z"
                                                            fill="#4CAF50" />
                                                    </svg>

                                                </span>
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-icon btn-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"
                                                href="#">
                                                <span class="btn-inner">


                                                    <svg class="icon-20" width="50" viewBox="0 0 1024 1024"
                                                        class="icon" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M810.666667 554.666667m-85.333334 0a85.333333 85.333333 0 1 0 170.666667 0 85.333333 85.333333 0 1 0-170.666667 0Z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M213.333333 554.666667m-85.333333 0a85.333333 85.333333 0 1 0 170.666667 0 85.333333 85.333333 0 1 0-170.666667 0Z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M832 405.333333c0-270.933333-640-177.066667-640 0v213.333334c0 177.066667 142.933333 320 320 320s320-142.933333 320-320V405.333333z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M512 85.333333C324.266667 85.333333 170.666667 238.933333 170.666667 426.666667v74.666666l44.8 12.8V405.333333l416-134.4 174.933333 134.4v108.8l44.8-12.8V426.666667C853.333333 266.666667 738.133333 85.333333 512 85.333333z"
                                                            fill="#FFCC80" />
                                                        <path
                                                            d="M695.466667 396.8L475.733333 616.533333 371.2 512l-59.733333 59.733333 164.266666 164.266667 279.466667-279.466667z"
                                                            fill="#4CAF50" />
                                                    </svg>

                                                </span>
                                            </button>
                                        @endif


                                    </form>

                                </li>

                            </ul>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <h4 class="d-flex ml-3 mt-3">Tidak ada Pengajuan Ijin Hari ini</h4>
                @endif



            </div>
        </div>

    </div>




    <br>
    <div id="laporan-pegawai">
        <h3>Form Laporan</h3>
        <div class="row">

            <div class="col-md-12">
                <div class="card-counter info">
                    <i class="fas fa-file-upload"></i>
                    <a href="{{ route('kirim-laporan') }}" class="btn btn-outline-dark btn-lg">Kirim Laporan</a>
                    <span class="count-name">Laporan Terkirim</span>
                    <span class="count-numbers"></span>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div id="rekappresensi">
        <h3>Rekap Presensi Bulan {{ $namemonth[$numbermonth] }} {{ $year }}</h3>
        <div class="row">

            <div class="col-md-3">
                <div class="card-counter success">
                    <i class="fas fa-fingerprint"></i>
                    <span class="count-numbers">{{ $hadir->jmlHadir }}</span>
                    <span class="count-name">Hadir</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter info">
                    <i class='fas fa-calendar-check'></i>
                    <span class="count-numbers">10</span>
                    <span class="count-name">Izin</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter secondary">
                    <i class='fas fa-medkit'></i>
                    <span class="count-numbers">10</span>
                    <span class="count-name">Sakit</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter danger">
                    <i class='fas fa-user-clock'></i>
                    <span class="count-numbers">{{ $telat->jmlTelat }}</span>
                    <span class="count-name">Terlambat</span>
                </div>
            </div>
        </div>
    </div>


    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($history as $histories)
                        @php
                            $path = Storage::url('uploads/absensi/' . $histories->photo_in);
                        @endphp
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <img src="{{ url($path) }}" alt="" class="imaged w64">
                                </div>
                                <div class="in">
                                    <div>{{ date('d-m-Y', strtotime($histories->presence_date)) }}</div>
                                    <span class="badge badge-success">{{ $histories->time_in }}</span>
                                    <span
                                        class="badge badge-danger">{{ $todayattendance != null && $histories->time_out != null ? $histories->time_out : 'Belum Absen Pulang' }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Edward Lindgren</div>
                                <span class="text-muted">Designer</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Emelda Scandroot</div>
                                <span class="badge badge-primary">3</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>


@push('myscript')
    <script>
        function confirmApprove(event) {
            event.preventDefault(); // Menghentikan form dari pengiriman langsung

            Swal.fire({
                title: 'Konfirmasi Approval Pengajuan Ijin / Cuti?',
                text: "Setelah Proses Approvement Otomatis Rekap Akan Tercatat!",
                icon: 'info',
                showDenyButton: true,
                confirmButtonColor: '#d33',
                denyButtonColor: '#3085d6',
                confirmButtonText: 'ACC',
                denyButtonText: 'TIDAK ACC',

            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                } else if (result.isDenied) {
                    $('#approval_ijin').modal('show');

                    // document.getElementById("tidakacc").submit();
                    // document.getElementById("form_id").submit();
                }
            });
        }
    </script>
@endpush
