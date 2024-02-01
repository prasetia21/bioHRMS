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
                        <h4 class="card-title">Status Pengajuan Cuti / Ijin Kamu</h4>
                    </div>
                </div>


                @if (!empty($cekReqIjin) && $cekReqIjin->count() > 0)

                    <div class="card-body">
                        <ul class="list-inline m-0 p-0">

                            <li class="d-flex mb-4 align-items-center">
                                <div class="img-fluid bg-soft-warning ">
                                    <p>Attachment:</p>
                                    <img id="imgAttachment" src="{{ asset('picture/ijin/' . $cekReqIjin->attachment) }}"
                                        alt="story-img" style="width: 80px; height:80px" class="avatar-40">

                                    <div id="imgModal" class="modal">
                                        <img class="modal-content" id="imgA01">
                                    </div>
                                </div>

                                <div class="ml-3 ms-3 flex-grow-1">
                                    <h3>{{ $cekReqIjin->employee->fullname }} /
                                        {{ $cekReqIjin->employee->position->name }}</h3>
                                    @if (
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 == null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 == null))
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p>
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 1 &&
                                            $cekReqIjin->status_1 != null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 == null))
                                        <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p>
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 == null &&
                                            ($cekReqIjin->approval_2 == 1 && $cekReqIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p>
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 1 &&
                                            $cekReqIjin->status_1 != null &&
                                            ($cekReqIjin->approval_2 == 1 && $cekReqIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p>
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 != null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 == null))
                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqIjin->status_1 }}, Alasannya:
                                                {{ $cekReqIjin->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk Informasi lebih lanjut</strong>
                                        </p>

                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 == null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p>

                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqIjin->status_2 }}, Alasannya:
                                                {{ $cekReqIjin->reject_2 }},</span>
                                            <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                lanjut</strong>
                                        </p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 != null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqIjin->status_1 }}, Alasannya:
                                                {{ $cekReqIjin->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk
                                                Informasi lebih lanjut</strong>
                                        </p>

                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqIjin->status_2 }}, Alasannya:
                                                {{ $cekReqIjin->reject_2 }},</span>
                                            <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                lanjut</strong>
                                        </p>
                                    @endif


                                </div>
                                @if ($cekReqIjin->status_1 == 'TIDAK ACC HR' && $cekReqIjin->status_2 == 'TIDAK ACC MANAGER')
                                    <span class="stamp is-denied">DITOLAK</span>
                                @else
                                    <span class="stamp is-pending">PENDING</span>
                                @endif

                            </li>

                        </ul>
                    </div>
                    <hr>
                @else
                    @if (!empty($cekAccIjin))

                        <div class="card-body">
                            <ul class="list-inline m-0 p-0">

                                <li class="d-flex mb-4 align-items-center">
                                    <div class="img-fluid bg-soft-warning ">
                                        <p>Attachment:</p>
                                        <img id="imgAttachment"
                                            src="{{ asset('picture/ijin/' . $cekAccIjin->attachment) }}"
                                            alt="story-img" style="width: 80px; height:80px" class="avatar-40">

                                        <div id="imgModal" class="modal">
                                            <img class="modal-content" id="imgA01">
                                        </div>
                                    </div>

                                    <div class="ml-3 ms-3 flex-grow-1">
                                        <h3>{{ $cekAccIjin->employee->fullname }} /
                                            {{ $cekAccIjin->employee->position->name }}</h3>
                                            @if (
                                        $cekAccIjin->approval_1 == 0 &&
                                            $cekAccIjin->status_1 == null &&
                                            ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 == null))
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p>
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekAccIjin->approval_1 == 1 &&
                                            $cekAccIjin->status_1 != null &&
                                            ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 == null))
                                        <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p>
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekAccIjin->approval_1 == 0 &&
                                            $cekAccIjin->status_1 == null &&
                                            ($cekAccIjin->approval_2 == 1 && $cekAccIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p>
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span></p>
                                    @elseif(
                                        $cekAccIjin->approval_1 == 1 &&
                                            $cekAccIjin->status_1 != null &&
                                            ($cekAccIjin->approval_2 == 1 && $cekAccIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p>
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span></p>
                                    @elseif(
                                        $cekAccIjin->approval_1 == 0 &&
                                            $cekAccIjin->status_1 != null &&
                                            ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 == null))
                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekAccIjin->status_1 }}, Alasannya:
                                                {{ $cekAccIjin->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk Informasi lebih lanjut</strong>
                                        </p>

                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekAccIjin->approval_1 == 0 &&
                                            $cekAccIjin->status_1 == null &&
                                            ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p>

                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekAccIjin->status_2 }}, Alasannya:
                                                {{ $cekAccIjin->reject_2 }},</span>
                                            <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                lanjut</strong>
                                        </p>
                                    @elseif(
                                        $cekAccIjin->approval_1 == 0 &&
                                            $cekAccIjin->status_1 != null &&
                                            ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 != null))
                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekAccIjin->status_1 }}, Alasannya:
                                                {{ $cekAccIjin->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk
                                                Informasi lebih lanjut</strong>
                                        </p>

                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekAccIjin->status_2 }}, Alasannya:
                                                {{ $cekAccIjin->reject_2 }},</span>
                                            <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                lanjut</strong>
                                        </p>
                                    @endif

                                    </div>
                                    @if ($cekAccIjin->status_1 == 'ACC HR' && $cekAccIjin->status_2 == 'ACC MANAGER')
                                        <span class="stamp is-approved">DISETUJUI</span>
                                    @else
                                        <span class="stamp is-denied">DITOLAK</span>
                                    @endif

                                </li>

                            </ul>
                        </div>
                        <hr>
                    @else
                        <h4 class="d-flex ml-3 mt-3">Hari ini Kamu tidak mengajukkan Ijin / Cuti</h4>

                    @endif
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
                    <span class="count-numbers">{{ $report->jmlLaporan }}</span>
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
        // Get the modal
        var modal = document.getElementById('imgModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('imgAttachment');
        var modalImg = document.getElementById("imgA01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            modalImg.alt = this.alt;
            captionText.innerHTML = this.alt;
        }


        // When the user clicks on <span> (x), close the modal
        modal.onclick = function() {
            imgA01.className += " out";
            setTimeout(function() {
                modal.style.display = "none";
                imgA01.className = "modal-content";
            }, 400);

        }
    </script>
@endpush
