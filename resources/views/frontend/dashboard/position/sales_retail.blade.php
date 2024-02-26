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

    <div class="mt-2" id="notif-pegawai">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Status Pengajuan Cuti / Ijin Kamu</h4>
                    </div>
                </div>


                @if (!empty($cekReqIjin))

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
                                        {{ $cekReqIjin->employee->position->name }}
                                        <span class="badge badge-success">Ijin {{ $cekReqIjin->present->name }}</span>
                                    </h3>
                                    @if (
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 == null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 == null))
                                        {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p> --}}
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 1 &&
                                            $cekReqIjin->status_1 != null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 == null))
                                        {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p> --}}
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 == null &&
                                            ($cekReqIjin->approval_2 == 1 && $cekReqIjin->status_2 != null))
                                        {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p> --}}
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 1 &&
                                            $cekReqIjin->status_1 != null &&
                                            ($cekReqIjin->approval_2 == 1 && $cekReqIjin->status_2 != null))
                                        {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p> --}}
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 != null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 == null))
                                        {{-- <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqIjin->status_1 }}, Alasannya:
                                                {{ $cekReqIjin->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk Informasi lebih lanjut</strong>
                                        </p> --}}

                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqIjin->approval_1 == 0 &&
                                            $cekReqIjin->status_1 == null &&
                                            ($cekReqIjin->approval_2 == 0 && $cekReqIjin->status_2 != null))
                                        {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p> --}}

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
                                        {{-- <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqIjin->status_1 }}, Alasannya:
                                                {{ $cekReqIjin->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk
                                                Informasi lebih lanjut</strong>
                                        </p> --}}

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
                @elseif (!empty($cekReqCuti))
                    <div class="card-body">
                        <ul class="list-inline m-0 p-0">

                            <li class="d-flex mb-4 align-items-center">
                                <div class="img-fluid bg-soft-warning ">
                                    <p>Attachment:</p>
                                    <img id="imgAttachment"
                                        src="{{ asset('picture/cuti/' . $cekReqCuti->attachment) }}" alt="story-img"
                                        style="width: 80px; height:80px" class="avatar-40">

                                    <div id="imgModal" class="modal">
                                        <img class="modal-content" id="imgA01">
                                    </div>
                                </div>

                                <div class="ml-3 ms-3 flex-grow-1">
                                    <h3>{{ $cekReqCuti->employee->fullname }} /
                                        {{ $cekReqCuti->employee->position->name }}
                                        <span class="badge badge-success">{{ $cekReqCuti->present->name }}</span>
                                    </h3>
                                    @if (
                                        $cekReqCuti->approval_1 == 0 &&
                                            $cekReqCuti->status_1 == null &&
                                            ($cekReqCuti->approval_2 == 0 && $cekReqCuti->status_2 == null))
                                        {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan HR</span>
                                        </p> --}}
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqCuti->approval_1 == 1 &&
                                            $cekReqCuti->status_1 != null &&
                                            ($cekReqCuti->approval_2 == 0 && $cekReqCuti->status_2 == null))
                                        {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p> --}}
                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqCuti->approval_1 == 0 &&
                                            $cekReqCuti->status_1 == null &&
                                            ($cekReqCuti->approval_2 == 1 && $cekReqCuti->status_2 != null))
                                        {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                HR</span>
                                        </p> --}}
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span>
                                        </p>
                                    @elseif(
                                        $cekReqCuti->approval_1 == 1 &&
                                            $cekReqCuti->status_1 != null &&
                                            ($cekReqCuti->approval_2 == 1 && $cekReqCuti->status_2 != null))
                                        {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span></p> --}}
                                        <p class="mb-1"><span class="badge badge-success">Disetujui Manager</span>
                                        </p>
                                    @elseif(
                                        $cekReqCuti->approval_1 == 0 &&
                                            $cekReqCuti->status_1 != null &&
                                            ($cekReqCuti->approval_2 == 0 && $cekReqCuti->status_2 == null))
                                        {{-- <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqCuti->status_1 }}, Alasannya:
                                                {{ $cekReqCuti->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk Informasi lebih lanjut</strong>
                                        </p> --}}

                                        <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                Manager</span></p>
                                    @elseif(
                                        $cekReqCuti->approval_1 == 0 &&
                                            $cekReqCuti->status_1 == null &&
                                            ($cekReqCuti->approval_2 == 0 && $cekReqCuti->status_2 != null))
                                        {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                HR</span>
                                        </p> --}}

                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqCuti->status_2 }}, Alasannya:
                                                {{ $cekReqCuti->reject_2 }},</span>
                                            <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                lanjut</strong>
                                        </p>
                                    @elseif(
                                        $cekReqCuti->approval_1 == 0 &&
                                            $cekReqCuti->status_1 != null &&
                                            ($cekReqCuti->approval_2 == 0 && $cekReqCuti->status_2 != null))
                                        {{-- <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqCuti->status_1 }}, Alasannya:
                                                {{ $cekReqCuti->reject_1 }},</span>
                                            <strong>Harap Menghubungi Divisi HR untuk
                                                Informasi lebih lanjut</strong>
                                        </p> --}}

                                        <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                {{ $cekReqCuti->status_2 }}, Alasannya:
                                                {{ $cekReqCuti->reject_2 }},</span>
                                            <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                lanjut</strong>
                                        </p>
                                    @endif


                                </div>
                                @if ($cekReqCuti->status_1 == 'TIDAK ACC HR' && $cekReqCuti->status_2 == 'TIDAK ACC MANAGER')
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
                                            {{ $cekAccIjin->employee->position->name }}
                                            <span class="badge badge-success">Ijin
                                                {{ $cekAccIjin->present->name }}</span>
                                        </h3>
                                        @if (
                                            $cekAccIjin->approval_1 == 0 &&
                                                $cekAccIjin->status_1 == null &&
                                                ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 == null))
                                            {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    HR</span> 
                                            </p> --}}
                                            <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccIjin->approval_1 == 1 &&
                                                $cekAccIjin->status_1 != null &&
                                                ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 == null))
                                            {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span>
                                            </p> --}}
                                            <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccIjin->approval_1 == 0 &&
                                                $cekAccIjin->status_1 == null &&
                                                ($cekAccIjin->approval_2 == 1 && $cekAccIjin->status_2 != null))
                                            {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    HR</span> 
                                            </p> --}}
                                            <p class="mb-1"><span class="badge badge-success">Disetujui
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccIjin->approval_1 == 1 &&
                                                $cekAccIjin->status_1 != null &&
                                                ($cekAccIjin->approval_2 == 1 && $cekAccIjin->status_2 != null))
                                            {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span>
                                            </p> --}}
                                            <p class="mb-1"><span class="badge badge-success">Disetujui
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccIjin->approval_1 == 0 &&
                                                $cekAccIjin->status_1 != null &&
                                                ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 == null))
                                            {{-- <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                    {{ $cekAccIjin->status_1 }}, Alasannya:
                                                    {{ $cekAccIjin->reject_1 }},</span>
                                                <strong>Harap Menghubungi Divisi HR untuk Informasi lebih
                                                    lanjut</strong>
                                            </p> --}}

                                            <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccIjin->approval_1 == 0 &&
                                                $cekAccIjin->status_1 == null &&
                                                ($cekAccIjin->approval_2 == 0 && $cekAccIjin->status_2 != null))
                                            {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    HR</span> 
                                            </p> --}}

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
                                            {{-- <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                    {{ $cekAccIjin->status_1 }}, Alasannya:
                                                    {{ $cekAccIjin->reject_1 }},</span>
                                                <strong>Harap Menghubungi Divisi HR untuk
                                                    Informasi lebih lanjut</strong>
                                            </p> --}}

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
                    @elseif (!empty($cekAccCuti))
                        <div class="card-body">
                            <ul class="list-inline m-0 p-0">

                                <li class="d-flex mb-4 align-items-center">
                                    <div class="img-fluid bg-soft-warning ">
                                        <p>Attachment:</p>
                                        <img id="imgAttachment"
                                            src="{{ asset('picture/ijin/' . $cekAccCuti->attachment) }}"
                                            alt="story-img" style="width: 80px; height:80px" class="avatar-40">

                                        <div id="imgModal" class="modal">
                                            <img class="modal-content" id="imgA01">
                                        </div>
                                    </div>

                                    <div class="ml-3 ms-3 flex-grow-1">
                                        <h3>{{ $cekAccCuti->employee->fullname }} /
                                            {{ $cekAccCuti->employee->position->name }}
                                            <span class="badge badge-success">{{ $cekAccCuti->present->name }}</span>
                                        </h3>
                                        @if (
                                            $cekAccCuti->approval_1 == 0 &&
                                                $cekAccCuti->status_1 == null &&
                                                ($cekAccCuti->approval_2 == 0 && $cekAccCuti->status_2 == null))
                                            {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    HR</span> --}}
                                            </p>
                                            <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccCuti->approval_1 == 1 &&
                                                $cekAccCuti->status_1 != null &&
                                                ($cekAccCuti->approval_2 == 0 && $cekAccCuti->status_2 == null))
                                            {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span>
                                            </p> --}}
                                            <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccCuti->approval_1 == 0 &&
                                                $cekAccCuti->status_1 == null &&
                                                ($cekAccCuti->approval_2 == 1 && $cekAccCuti->status_2 != null))
                                            {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    HR</span> --}}
                                            </p>
                                            <p class="mb-1"><span class="badge badge-success">Disetujui
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccCuti->approval_1 == 1 &&
                                                $cekAccCuti->status_1 != null &&
                                                ($cekAccCuti->approval_2 == 1 && $cekAccCuti->status_2 != null))
                                            {{-- <p class="mb-1"><span class="badge badge-success">Disetujui HR</span>
                                            </p> --}}
                                            <p class="mb-1"><span class="badge badge-success">Disetujui
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccCuti->approval_1 == 0 &&
                                                $cekAccCuti->status_1 != null &&
                                                ($cekAccCuti->approval_2 == 0 && $cekAccCuti->status_2 == null))
                                            <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                    {{ $cekAccCuti->status_1 }}, Alasannya:
                                                    {{ $cekAccCuti->reject_1 }},</span>
                                                <strong>Harap Menghubungi Divisi HR untuk Informasi lebih
                                                    lanjut</strong>
                                            </p>

                                            <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    Manager</span></p>
                                        @elseif(
                                            $cekAccCuti->approval_1 == 0 &&
                                                $cekAccCuti->status_1 == null &&
                                                ($cekAccCuti->approval_2 == 0 && $cekAccCuti->status_2 != null))
                                            {{-- <p class="mb-1"><span class="badge badge-info">Menunggu Persetujuan
                                                    HR</span> --}}
                                            </p>

                                            <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                    {{ $cekAccCuti->status_2 }}, Alasannya:
                                                    {{ $cekAccCuti->reject_2 }},</span>
                                                <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                    lanjut</strong>
                                            </p>
                                        @elseif(
                                            $cekAccCuti->approval_1 == 0 &&
                                                $cekAccCuti->status_1 != null &&
                                                ($cekAccCuti->approval_2 == 0 && $cekAccCuti->status_2 != null))
                                            <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                    {{ $cekAccCuti->status_1 }}, Alasannya:
                                                    {{ $cekAccCuti->reject_1 }},</span>
                                                <strong>Harap Menghubungi Divisi HR untuk
                                                    Informasi lebih lanjut</strong>
                                            </p>

                                            <p class="mb-1"><span class="badge badge-danger">Pengajuanmu
                                                    {{ $cekAccCuti->status_2 }}, Alasannya:
                                                    {{ $cekAccCuti->reject_2 }},</span>
                                                <strong>Harap Menghubungi Manager Divisi Anda untuk Informasi lebih
                                                    lanjut</strong>
                                            </p>
                                        @endif

                                    </div>
                                    @if ($cekAccCuti->status_1 == 'ACC HR' && $cekAccCuti->status_2 == 'ACC MANAGER')
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

    <div class="mt-2" id="status-pegawai">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Status Kehadiran</h4>
                    </div>
                </div>

                <ul class="list-inline m-0 p-0 bg-warning">

                    <li class="d-flex m-2 align-items-center">
                        <p>Anda Memiliki Surat Teguran di Bulan ini, <a
                                href="{{ url('/download_steguran/' . $employee->id) }}">
                                Lihat Detail Surat Teguran Anda <i class="fa fa-eye"></i></a></p>
                    </li>
                </ul>

                @foreach ($ketSP as $key => $item)
                <ul class="list-inline m-0 p-0 bg-danger">

                    <li class="d-flex m-2 align-items-center">
                        <p>Anda Masih Mempunyai Surat Peringatan {{ $item->level }} , yang Berlaku sampai {{ $item->masa_berlaku }}, <a
                                href="{{ url('/download_sp/' . $item->employee_id) }}">
                                Lihat Detail Surat Peringatan Anda <i class="fa fa-eye"></i></a></p>
                    </li>
                </ul>
                @endforeach

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
                    <span class="count-numbers">{{ $izin->jmlIzin }}</span>
                    <span class="count-name">Izin</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter secondary">
                    <i class='fas fa-medkit'></i>
                    <span class="count-numbers">{{ $sakit->jmlSakit }}</span>
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
                        Absen Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Kehadiran
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

                                    @if ($histories->present->name == 'Terlambat')
                                        <span class="badge badge-danger">{{ $histories->time_in }}</span>
                                    @elseif ($histories->present->name == 'Sakit')
                                        <span class="badge badge-warning">{{ $histories->time_in }}</span>
                                    @elseif ($histories->present->name == 'Ijin')
                                        <span class="badge badge-dark">{{ $histories->time_in }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $histories->time_in }}</span>
                                    @endif


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

                    @php
                        $employee_id = $employee->id;

                        $jmlTepatWaktu = App\Models\Presence::where('present_id', 1)
                            ->where('employee_id', $employee_id)
                            ->whereRaw('MONTH(presence_date)="' . $month . '"')
                            ->whereRaw('YEAR(presence_date)="' . $year . '"')
                            ->count();

                        $jmlSakit = App\Models\Presence::where('present_id', 2)
                            ->where('employee_id', $employee_id)
                            ->whereRaw('MONTH(presence_date)="' . $month . '"')
                            ->whereRaw('YEAR(presence_date)="' . $year . '"')
                            ->count();

                        $jmlTelatAll = App\Models\Presence::where('present_id', 3)
                            ->where('employee_id', $employee_id)
                            ->whereRaw('MONTH(presence_date)="' . $month . '"')
                            ->whereRaw('YEAR(presence_date)="' . $year . '"')
                            ->count();

                        $jmlIjin = App\Models\Presence::where('present_id', 4)
                            ->where('employee_id', $employee_id)
                            ->whereRaw('MONTH(presence_date)="' . $month . '"')
                            ->whereRaw('YEAR(presence_date)="' . $year . '"')
                            ->count();

                        $jmlCuti = App\Models\Presence::where('present_id', 5)
                            ->where('employee_id', $employee_id)
                            ->whereRaw('MONTH(presence_date)="' . $month . '"')
                            ->whereRaw('YEAR(presence_date)="' . $year . '"')
                            ->count();

                    @endphp
                    {{-- Tepat Waktu --}}
                    <li>
                        <div class="item">
                            <svg height="32px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 451.277 451.277"
                                xml:space="preserve">
                                <circle style="fill:#EFC84A;" cx="225.638" cy="225.638" r="225.638" />
                                <path style="opacity:0.1;enable-background:new    ;"
                                    d="M267.266,113.59c-7.804,0-15.326-3.103-20.826-8.603
 c-5.735-5.782-13.257-8.65-20.779-8.65c-7.569,0-15.091,2.868-20.826,8.65c-5.5,5.5-13.022,8.603-20.779,8.603
 c-8.133,0-15.467,3.291-20.826,8.603c-5.312,5.312-8.603,12.693-8.603,20.826c0,7.804-3.103,15.279-8.65,20.779
 c-5.735,5.735-8.603,13.304-8.603,20.826c0,7.522,2.868,15.044,8.603,20.779c5.547,5.547,8.65,13.022,8.65,20.826
 c0,8.086,3.291,15.467,8.603,20.779c5.359,5.359,12.693,8.65,20.826,8.65c2.351,0,4.701,0.282,6.958,0.893l-36.246,78.557
 l112.321,112.32c87.357-16.227,157.006-82.734,177.798-168.398l-156.84-156.84C282.733,116.881,275.399,113.59,267.266,113.59z" />
                                <polygon style="fill:#2D93BA;"
                                    points="219.662,250.839 182.859,330.598 197.644,354.921 241.105,260.733 " />
                                <polygon style="fill:#27A2DB;"
                                    points="198.22,240.945 154.759,335.133 182.859,330.598 219.662,250.839 " />
                                <polygon style="fill:#3EA69B;"
                                    points="231.615,250.839 268.418,330.598 253.633,354.921 210.172,260.733 " />
                                <polygon style="fill:#44C4A1;"
                                    points="253.057,240.945 296.518,335.133 268.418,330.598 231.615,250.839 " />
                                <path style="fill:#E56353;"
                                    d="M305.284,163.814L305.284,163.814c-5.518-5.517-8.617-13.001-8.617-20.804l0,0
 c0-16.249-13.172-29.421-29.421-29.421l0,0c-7.804,0-15.286-3.1-20.804-8.617h0c-11.489-11.49-30.117-11.49-41.607,0l0,0
 c-5.518,5.517-13.001,8.617-20.804,8.617l0,0c-16.248,0-29.421,13.172-29.421,29.421l0,0c0,7.803-3.1,15.286-8.617,20.803v0
 c-11.489,11.49-11.489,30.118,0,41.607v0c5.518,5.517,8.617,13.001,8.617,20.803l0,0c0,16.249,13.172,29.421,29.421,29.421l0,0
 c7.803,0,15.286,3.1,20.804,8.617v0c11.49,11.489,30.118,11.489,41.607,0l0,0c5.517-5.517,13-8.617,20.804-8.617l0,0
 c16.248,0,29.421-13.172,29.421-29.421l0,0c0-7.803,3.1-15.286,8.617-20.804C316.773,193.932,316.773,175.304,305.284,163.814z" />
                                <g>
                                    <path style="fill:#EBF0F3;" d="M225.637,246.48c-34.107,0-61.857-27.75-61.857-61.861c0-34.111,27.75-61.861,61.857-61.861
  c34.111,0,61.861,27.75,61.861,61.861C287.498,218.73,259.747,246.48,225.637,246.48z M225.637,131.584
  c-29.241,0-53.031,23.789-53.031,53.035c0,29.246,23.79,53.035,53.031,53.035c29.245,0,53.035-23.79,53.035-53.035
  C278.671,155.373,254.882,131.584,225.637,131.584z" />
                                    <path style="fill:#EBF0F3;"
                                        d="M211.85,146.684h27.577v75.868h-12.163v-64.474H211.85V146.684z" />
                                </g>
                            </svg>
                            <div class="in ml-1">
                                <div><span class="badge badge-success">Tepat Waktu</span>
                                </div>
                                <span class="badge badge-success">{{ $jmlTepatWaktu }}</span>
                            </div>
                        </div>
                    </li>
                    {{-- Sakit --}}
                    <li>
                        <div class="item">
                            <svg width="32px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                class="iconify iconify--emojione" preserveAspectRatio="xMidYMid meet">

                                <circle cx="32" cy="32" r="30" fill="#c7e755">

                                </circle>

                                <g fill="#425e21">

                                    <circle cx="20.5" cy="27" r="4.5">

                                    </circle>

                                    <circle cx="43.5" cy="27" r="4.5">

                                    </circle>

                                    <path d="M37.4 43.2H26.6c-.7 0-.7-2.5 0-2.5h10.7c.8 0 .8 2.5.1 2.5">

                                    </path>

                                    <path
                                        d="M23.7 35c1 2 1.6 4.4 1.6 7c0 2.6-.6 5-1.6 7c2.1-.9 3.6-3.7 3.6-7s-1.5-6.1-3.6-7">

                                    </path>

                                    <path
                                        d="M40.3 49c-1-2-1.6-4.4-1.6-7c0-2.6.6-5 1.6-7c-2.1.9-3.6 3.7-3.6 7s1.5 6 3.6 7">

                                    </path>

                                </g>

                                <g fill="#75a843">

                                    <path
                                        d="M25.6 15.9c-3.2 2.7-7.5 3.9-11.7 3.1c-.6-.1-1.1 2-.4 2.2c4.8.9 9.8-.5 13.5-3.6c.5-.5-1-2.1-1.4-1.7">

                                    </path>

                                    <path
                                        d="M50.1 18.9c-4.2.7-8.5-.4-11.7-3.1c-.4-.4-2 1.2-1.4 1.7c3.7 3.2 8.7 4.5 13.5 3.6c.7-.2.2-2.3-.4-2.2">

                                    </path>

                                </g>

                                <g opacity=".5" fill="#ff717f">

                                    <path
                                        d="M51.7 30.3c4.9 0 8.8 4 8.8 8.8c0 4.9-4 8.8-8.8 8.8c-4.9 0-8.8-4-8.8-8.8c-.1-4.8 3.9-8.8 8.8-8.8"
                                        opacity=".8">

                                    </path>

                                    <circle cx="12.3" cy="39.1" r="8.8" opacity=".8">

                                    </circle>

                                </g>

                            </svg>
                            <div class="in ml-1">
                                <div><span class="badge badge-warning">Sakit</span>
                                </div>
                                <span class="badge badge-warning">{{ $jmlSakit }}</span>
                            </div>
                        </div>
                    </li>
                    {{-- Terlambat --}}
                    <li>
                        <div class="item">
                            <svg width="32px" viewBox="-7.67 -7.67 92.00 92.00" xmlns="http://www.w3.org/2000/svg"
                                fill="#000000" transform="rotate(-45)matrix(-1, 0, 0, 1, 0, 0)">

                                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                <g id="SVGRepo_iconCarrier">
                                    <g id="time_wall_clock" data-name="time wall clock"
                                        transform="translate(-866.689 -1380.935)">
                                        <path id="Path_299" data-name="Path 299"
                                            d="M905.019,1385.931a33.333,33.333,0,1,0,33.328,33.338A33.335,33.335,0,0,0,905.019,1385.931Z"
                                            fill="#f4f4f4" />
                                        <path id="Path_300" data-name="Path 300"
                                            d="M936.164,1419.269a31.151,31.151,0,1,1-31.145-31.151A31.144,31.144,0,0,1,936.164,1419.269Z"
                                            fill="#c01c28" />
                                        <path id="Path_301" data-name="Path 301"
                                            d="M905.019,1380.935a38.329,38.329,0,1,0,38.324,38.334A38.324,38.324,0,0,0,905.019,1380.935Zm0,71.662a33.333,33.333,0,1,1,33.328-33.328A33.33,33.33,0,0,1,905.019,1452.6Z"
                                            fill="#163844" />
                                        <rect id="Rectangle_29" data-name="Rectangle 29" width="2.281"
                                            height="34.375" transform="translate(904.014 1392.956)" fill="#f5c211" />
                                        <rect id="Rectangle_30" data-name="Rectangle 30" width="26.008"
                                            height="2.285" transform="translate(897.165 1418.202)" fill="#f5c211" />
                                        <path id="Path_302" data-name="Path 302"
                                            d="M910.258,1419.269a5.244,5.244,0,1,1-5.239-5.25A5.242,5.242,0,0,1,910.258,1419.269Z"
                                            fill="#163844" />
                                    </g>
                                </g>

                            </svg>
                            <div class="in ml-1">
                                <div><span class="badge badge-danger">Terlambat</span>
                                </div>
                                <span class="badge badge-danger">{{ $jmlTelatAll }}</span>
                            </div>
                        </div>
                    </li>
                    {{-- Ijin --}}
                    <li>
                        <div class="item">
                            <svg width="32px" viewBox="-102.4 -102.4 1228.80 1228.80" class="icon"
                                version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">

                                <g id="SVGRepo_bgCarrier" stroke-width="0">

                                    <rect x="-102.4" y="-102.4" width="1228.80" height="1228.80" rx="614.4"
                                        fill="#62a0ea" strokewidth="0" />

                                </g>

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                <g id="SVGRepo_iconCarrier">

                                    <path
                                        d="M817.49564 230.915833H207.052138c-13.220407 0-23.933319 15.667493-23.933319 34.990258v656.730286c0 19.323788 10.712912 34.989233 23.933319 34.989233h610.443502c13.217336 0 23.933319-15.666469 23.93332-34.989233V265.907114c0-19.323788-10.715984-34.991281-23.93332-34.991281z"
                                        fill="#DCE5F7" />

                                    <path
                                        d="M815.546163 253.387045c1.305454 1.675076 3.41261 5.990753 3.41261 12.520069V922.636377c0 6.529317-2.107156 10.843969-3.41261 12.519046H209.000592c-1.305454-1.675076-3.410562-5.989729-3.410562-12.519046V265.907114c0-6.530341 2.106132-10.844993 3.411586-12.520069h606.544547m1.949477-22.471212H207.052138c-13.220407 0-23.933319 15.667493-23.933319 34.991281V922.636377c0 19.322764 10.712912 34.989233 23.933319 34.989233h610.442479c13.217336 0 23.934343-15.666469 23.934343-34.989233V265.907114c0-19.323788-10.715984-34.991281-23.93332-34.991281z"
                                        fill="#4E6DC4" />

                                    <path
                                        d="M702.991473 332.188331H321.556306c-13.872622 0-25.114883 11.201305-25.114883 25.017614v469.538452c0 13.815285 11.242261 25.01659 25.114883 25.01659h381.435167c13.869551 0 25.114883-11.200282 25.114883-25.01659V357.205945c0.001024-13.815285-11.245333-25.017614-25.114883-25.017614z"
                                        fill="#FFFFFF" />

                                    <path
                                        d="M702.991473 354.659542c1.459037 0 2.644696 1.142656 2.644696 2.546403v469.538452c0 1.403747-1.186683 2.545379-2.644696 2.545379H321.556306c-1.458013 0-2.643672-1.141632-2.643672-2.545379V357.205945c0-1.403747 1.185659-2.546403 2.643672-2.546403h381.435167m0-22.470187H321.556306c-13.872622 0-25.113859 11.201305-25.11386 25.01659v469.538452c0 13.815285 11.241237 25.01659 25.11386 25.01659H702.992497c13.869551 0 25.114883-11.201305 25.114883-25.01659V357.205945c0-13.815285-11.246356-25.01659-25.115907-25.01659z"
                                        fill="#4E6DC4" />

                                    <path
                                        d="M540.954453 731.967428l-6.096213-0.010239-9.610188 0.056313-129.898283-0.232421 0.010239-6.254916s-2.756299-34.945206 48.716463-43.797719c0 0 39.179996-5.21772 41.942439-15.984897 0 0 1.49692-1.195898 0.415697-13.708801-2.303742-26.641496-19.710816-39.206617-26.743884-49.403491-7.033068-10.197898-7.599277-21.950054-7.599277-21.950053 0.005119-2.936503 1.237877-4.011583 3.286672-5.893484 2.531045-2.329339 1.777465-4.810213 1.29931-7.436479-1.819444-9.972643-1.952549-25.989281-0.189419-36.018238 0.41365-11.946694 11.398915-21.524117 11.398916-21.524118 2.061081-1.741629 4.126258-3.659366 5.575055-5.960036 0.405459-0.640952 0.778153-1.329003 0.998288-2.05801 0.831395-2.748108-1.961764-4.773353-1.395555-7.697569 0.511943-2.636505 5.032396-2.758347 7.76617-2.897596 6.157646-0.312285 12.347033-0.543683 18.493417-0.061433 46.003168 3.609196 61.099333 20.573952 61.099333 20.573952 3.574384 4.295199 5.9242 9.544659 7.33409 14.923128 0.422865 1.6075 0.784296 3.249812 0.978835 4.902363 1.419105 8.242277 1.398627 16.835746 0.937878 25.161982-0.220135 3.969603-0.688051 7.87675-1.277808 11.804374-0.309213 2.054938-0.155631 3.96858 1.215351 5.613963 1.146752 1.376102 2.457325 2.339578 3.017391 4.146736 0.263139 0.844705 0.329691 1.756987 0.327643 2.636505 0 0-0.608188 11.750108-7.677092 21.922408s-24.522054 22.674964-26.919993 49.30827c-1.126274 12.508807 0.367575 13.709824 0.367575 13.709824 2.722511 10.777417 41.884077 16.135409 41.884077 16.135409 52.015422 9.742269 48.557762 43.971779 48.557761 43.971779l-0.011263 6.253892-34.256131-0.061433 5.397923-0.063481-4.609531-0.009215-9.55285-0.016382-45.183036-0.080887z"
                                        fill="#4E6DC4" />

                                    <path d="M416.159214 183.617451h192.231398v102.621978H416.159214z"
                                        fill="#FFFFFF" />

                                    <path
                                        d="M608.388564 297.471451H416.160238c-6.204745 0-11.235094-5.025229-11.235094-11.235093V183.615403c0-6.209864 5.030349-11.235094 11.235094-11.235094h192.228326c6.204745 0 11.235094 5.025229 11.235094 11.235094v102.619931c0 6.210888-5.030349 11.236118-11.235094 11.236117z m-180.992208-22.471211H597.153471v-80.149743H427.396356v80.149743z"
                                        fill="#4E6DC4" />

                                    <path d="M460.564097 78.65999h103.420609v126.84301H460.564097z" fill="#FFFFFF" />

                                    <path
                                        d="M563.98573 216.740141H460.564097c-6.204745 0-11.235094-5.025229-11.235094-11.235094V78.657942c0-6.209864 5.030349-11.235094 11.235094-11.235093h103.421633c6.204745 0 11.235094 5.025229 11.235093 11.235093v126.846082c0 6.210888-5.031372 11.236118-11.235093 11.236117z m-92.18654-22.471211h80.950422V89.893036H471.79919v104.375894z"
                                        fill="#4E6DC4" />

                                </g>

                            </svg>
                            <div class="in ml-1">
                                <div><span class="badge badge-secondary">Ijin</span>
                                </div>
                                <span class="badge badge-secondary">{{ $jmlIjin }}</span>
                            </div>
                        </div>
                    </li>
                    {{-- Cuti --}}
                    <li>
                        <div class="item">
                            <svg width="32px" viewBox="-51.2 -51.2 614.40 614.40"
                                xmlns="http://www.w3.org/2000/svg" fill="#000000">

                                <g id="SVGRepo_bgCarrier" stroke-width="0">

                                    <rect x="-51.2" y="-51.2" width="614.40" height="614.40" rx="307.2"
                                        fill="#813d9c" strokewidth="0" />

                                </g>

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                <g id="SVGRepo_iconCarrier">
                                    <defs>
                                        <style>
                                            .e {
                                                fill: #f4c762;
                                            }

                                            .f {
                                                fill: #eab84b;
                                            }

                                            .g {
                                                fill: #f4f4f4;
                                            }

                                            .h {
                                                fill: #ededed;
                                            }

                                            .i {
                                                fill: #2f8474;
                                            }

                                            .j {
                                                fill: #cecece;
                                            }

                                            .k {
                                                fill: #bebebe;
                                            }

                                            .l {
                                                fill: #dfdfdf;
                                            }

                                            .m {
                                                fill: #41a08e;
                                            }

                                            .n {
                                                fill: #365650;
                                            }

                                            .o {
                                                fill: #6e6e6e;
                                            }
                                        </style>
                                    </defs>
                                    <g id="a" />
                                    <g id="b" />
                                    <g id="c">
                                        <g>
                                            <path class="f"
                                                d="M392,488H71.99997c-17.67309,0-31.99997-14.32687-31.99997-31.99997v-.00006c0-17.67309,14.32687-31.99997,31.99997-31.99997H392l-.00002,.00003c-10.07222,20.14445-10.07222,43.85549,0,63.99994l.00002,.00003Z" />
                                            <rect class="e" height="8" width="80" x="72" y="452" />
                                            <path class="e"
                                                d="M376,352H60c-19.88232,0-36,16.11768-36,36h0c0,19.88232,16.11768,36,36,36H376l-2.71265-6.78174c-8.45166-21.12939-7.4646-44.86377,2.71265-65.21826Z" />
                                            <rect class="f" height="8" width="96" x="56" y="372" />
                                            <rect class="f" height="8" width="96" x="56" y="396" />
                                            <path class="k"
                                                d="M433.54395,62.28027c-.87842-8.12354-7.73657-14.28027-15.90747-14.28027h-25.63647l-32.84473,296h104.84473l-30.45605-281.71973Z" />
                                            <path class="h"
                                                d="M414.22754,48H118.4043c-8.18823,0-15.05493,6.18188-15.91211,14.32495l-30.49219,289.67505H400l30.1394-286.3252c.99438-9.44678-6.41284-17.6748-15.91187-17.6748Z" />
                                            <path class="j"
                                                d="M430.1394,65.6748c.99438-9.44678-6.41284-17.6748-15.91187-17.6748H118.4043c-8.18823,0-15.05493,6.18188-15.91211,14.32495l-3.54468,33.67505H426.94727l3.19214-30.3252Z" />
                                            <path class="k"
                                                d="M150.35154,33.89077l-4.05443,24.32657c-1.20248,7.21485,4.36129,13.78266,11.67566,13.78266h.00002c5.78625,0,10.72441-4.18325,11.67566-9.89077l4.05443-24.32657c1.20248-7.21485-4.36129-13.78266-11.67566-13.78266h-.00002c-5.78625,0-10.72441,4.18325-11.67566,9.89077Z" />
                                            <polygon class="m"
                                                points="232.49902 177.85059 227.43262 171.65918 208.42065 187.2146 190.49902 172.87695 185.50098 179.12305 202.08984 192.39429 185.4668 205.99512 190.5332 212.18652 208.47754 197.50464 226.69043 212.0752 231.68848 205.8291 214.80835 192.32471 232.49902 177.85059" />
                                            <path class="k"
                                                d="M368.48467,33.89077l-4.05443,24.32657c-1.20248,7.21485,4.36129,13.78266,11.67566,13.78266h.00002c5.78625,0,10.72441-4.18325,11.67566-9.89077l4.05443-24.32657c1.20248-7.21485-4.36129-13.78266-11.67566-13.78266h-.00002c-5.78625,0-10.72441,4.18325-11.67566,9.89077Z" />
                                            <rect class="g" height="8" width="112" x="208" y="68" />
                                            <path class="j"
                                                d="M340.01709,96h-8.03491l-5.625,60h-71.96484l5.62476-60h-8.03467l-5.625,60h-71.96509l5.62476-60h-8.03467l-5.625,60H92.63159l-.84204,8h73.81787l-5.25,56H85.89478l-.84204,8h74.55469l-5.25,56H79.15796l-.84204,8h75.2915l-5.58984,59.62695,3.98242,.37305h4.01733l5.625-60h71.96558l-5.625,60h8.03491l5.62476-60h71.96484l-5.625,60h8.03467l5.625-60h84.67383l.84204-8h-84.76587l5.25-56h85.41064l.84204-8h-85.50269l5.25-56h86.14746l.84204-8h-86.2395l5.625-60Zm-105.65918,188h-71.96558l5.25-56h71.96533l-5.24976,56Zm5.99976-64h-71.96533l5.25-56h71.96509l-5.24976,56Zm73.99976,64h-71.96484l5.25-56h71.96484l-5.25,56Zm6-64h-71.96484l5.24976-56h71.96484l-5.24976,56Z" />
                                            <path class="m"
                                                d="M400,312c-48.60107,0-88,39.39893-88,88s39.39893,88,88,88,88-39.39893,88-88-39.39893-88-88-88Zm-66,88c0-32.70312,23.78491-59.85059,54.99976-65.0874l.00024,54.0874-45.36133,45.36084c-6.11475-10.00879-9.63867-21.77344-9.63867-34.36084Zm25.15527,51.84668l29.84473-29.84668,.00659,43.08838c-11.14575-1.86865-21.34424-6.53076-29.85132-13.2417Zm51.84497,13.24072l-.00024-43.0874,29.84521,29.84619c-8.50537,6.70996-18.7019,11.37158-29.84497,13.24121Zm45.36108-30.72705l-45.36133-45.36035-.01123-54.08936c31.22021,5.23193,55.01123,32.38232,55.01123,65.08936,0,12.5874-3.52368,24.35156-9.63867,34.36035Z" />
                                            <path class="i"
                                                d="M217.46289,393.9541l-7.17383-4.75781c3.81055-30.3374-5.74414-61.68359-27.83887-85.0459l-5.8125,5.49609c13.93579,14.73535,22.46143,32.91211,25.3584,51.88037l-2.06641,1.95361c-9.54883,9.03125-20.57812,16.08691-32.77246,20.9668l-.1748,.06934,2.94922,7.43555,.18652-.07324c12.13037-4.854,23.16626-11.72412,32.88232-20.39648,.59204,12.27686-1.15967,24.68506-5.30591,36.54004l-8.11646,.38672c-8.80664,.41895-17.38086,3.76562-24.14453,9.42188l5.13281,6.13672c5.43262-4.54395,12.31934-7.23145,19.39258-7.56836l4.45972-.2124c-1.83203,4.02051-3.94092,7.95898-6.36108,11.77588l-22.87695,36.08105,6.75586,4.2832,22.87695-36.08105c1.36328-2.15039,2.62109-4.34082,3.81177-6.55518l.98511,2.23877c4.08008,9.27246,5.71875,19.50586,4.74023,29.59082l7.96289,.77344c1.11035-11.44727-.75-23.06152-5.38086-33.58691l-3.76562-8.55762c2.47388-5.97314,4.35083-12.10645,5.66699-18.31787l4.20703,2.78955c11.17578,7.41211,17.72168,19.84277,17.50977,33.25098l7.99805,.12695c.25586-16.14844-7.62695-31.11816-21.08594-40.04492Z" />
                                            <polygon class="o"
                                                points="214.21494 318.58646 196.52808 345.11621 222.60544 333.94035 214.21494 318.58646" />
                                            <path class="k"
                                                d="M345.93087,299.67431c-.89055-2.89029-4.80674-13.40637-6.07228-16.28898l-5.11092-11.64155s-34.68784,39.31289-50.37709,57.09467c-4.28289,4.85411-10.23827,7.85626-16.68572,8.447l-3.68985,.31588,4.46899,4.50259c9.58926,9.66136,25.20092,9.70073,34.83879,.08787l42.62808-42.51748Z" />
                                            <path class="l"
                                                d="M288.54126,399.18066l-.19312-1.03662c53.23535,1.15576,94.06396-54.39404,70.95312-107.03516l-5.11084-11.6416s-34.68774,39.31299-50.37695,57.09473c-4.80029,5.44043-11.70166,8.5542-19.04175,8.5542h-.36597c-10.90137,0-20.12231-8.0625-21.57666-18.8667l-.05957-.44189c1.66797-3.51123,2.60132-7.43896,2.60132-11.58496,0-15.35254-12.79858-27.71631-28.30859-27.00244-13.73315,.63184-24.92847,11.69531-25.71021,25.42041-.6521,11.44922,5.8252,21.46338,15.40161,26.0127-11.19653,19.42285-6.97607,44.06592,10.04565,58.65576l24.70996,21.18018,2.33643,14.01855c3.50342,21.02148,13.48779,40.42285,28.55713,55.49219h.00024c24.09082-4.81836,44.1189-21.47754,53.24316-44.28857l.8208-2.05225-15.01318-2.30957c-21.21655-3.26416-38.25586-19.21387-42.9126-40.16895Z" />
                                            <rect class="o" height="8" width="11.12598" x="226.75391"
                                                y="306.36133" />
                                            <rect class="n" height="8" width="112" x="208" y="68" />
                                            <polygon class="n"
                                                points="232.49902 177.85059 227.43262 171.65918 208.42065 187.2146 190.49902 172.87695 185.50098 179.12305 202.08984 192.39429 185.4668 205.99512 190.5332 212.18652 208.47754 197.50464 226.69043 212.0752 231.68848 205.8291 214.80835 192.32471 232.49902 177.85059" />
                                            <rect class="n" height="8" width="96" x="56" y="372" />
                                            <rect class="n" height="8" width="96" x="56" y="396" />
                                            <rect class="n" height="8" width="80" x="72" y="452" />
                                            <path class="n"
                                                d="M467.3042,337.34961l-29.78369-275.49902c-1.09961-10.17676-9.64746-17.85059-19.88379-17.85059h-22.78223l.92676-5.56055c.7666-4.60059-.52246-9.28027-3.53711-12.83984-3.01562-3.55859-7.41992-5.59961-12.08398-5.59961-7.77344,0-14.34375,5.56543-15.62109,13.2334l-1.79419,10.7666H176.72168l.92676-5.56055c.7666-4.60059-.52246-9.28027-3.53711-12.83984-3.01562-3.55859-7.41992-5.59961-12.08398-5.59961-7.77344,0-14.34375,5.56543-15.62109,13.2334l-1.79443,10.7666h-26.20752c-10.26465,0-18.81543,7.69824-19.89062,17.90625l-30.11426,286.09375h-8.39941c-22.05566,0-40,17.94434-40,40,0,18.89258,13.1709,34.75732,30.81006,38.92236-8.96875,6.55371-14.81006,17.14404-14.81006,29.07764,0,19.85059,16.14941,36,36,36h192v-8H72c-15.43945,0-28-12.56055-28-28s12.56055-28,28-28h80v-8H60c-17.64453,0-32-14.35547-32-32s14.35547-32,32-32h108v-8h-11.60767l5.25-56h38.35767v-8h-37.60767l5.25-56h71.96533l-4.09009,43.62695,7.96484,.74609,4.15991-44.37305h71.96533l-2.59009,27.62695,7.96484,.74609,2.65991-28.37305h81.38794l-8.42163,80.00781c-.20312-.00146-.40527-.00781-.60864-.00781-10.55273,0-20.83789,1.76367-30.65308,5.23633-.88843-8.02637-2.99585-16.021-6.38306-23.73633l-5.11133-11.6416c-.54883-1.25-1.69727-2.13379-3.0459-2.34375-1.35156-.20996-2.71191,.2832-3.61523,1.30566l-6.60986,7.49121c-.34082-.84912-.69214-1.69482-1.06006-2.5332l-5.11035-11.6416c-.54883-1.25098-1.69824-2.13477-3.04688-2.34473-1.35254-.21094-2.71191,.2832-3.61523,1.30566l-50.37793,57.09473c-3.11621,3.53125-7.26953,5.88965-11.86353,6.78857-1.27661-1.9624-2.19263-4.18652-2.61108-6.59619,1.64258-3.8457,2.47461-7.93066,2.47461-12.16211,0-8.55957-3.41016-16.53027-9.60156-22.44336-6.18848-5.91113-14.32812-8.94238-22.89062-8.55566-15.66211,.7207-28.62891,13.54199-29.52051,29.18945-.16138,2.83594,.06104,5.62305,.62988,8.30273l-7.00464,10.50684c-4.62817-9.74219-10.80444-18.8999-18.53345-27.07227l-5.8125,5.49609c8.30347,8.77979,14.677,18.78564,19.09814,29.44775l-2.53564,3.80322c-.98242,1.47266-.87891,3.41602,.25293,4.77637,.77734,.93555,1.91406,1.44238,3.07617,1.44238,.53027,0,1.06543-.10547,1.57422-.32324l.94336-.4043c1.29126,4.31348,2.27197,8.7041,2.94922,13.13818l-2.06641,1.95361c-9.54883,9.03125-20.57812,16.08691-32.77246,20.9668l-.1748,.06934,2.94922,7.43555,.18652-.07324c12.13037-4.854,23.16626-11.72412,32.88232-20.39648,.59204,12.27686-1.15967,24.68506-5.30591,36.54004l-8.11646,.38672c-8.80664,.41895-17.38086,3.76562-24.14453,9.42188l5.13281,6.13672c5.43262-4.54395,12.31934-7.23145,19.39258-7.56836l4.45972-.2124c-1.83203,4.02051-3.94092,7.95898-6.36108,11.77588l-22.87695,36.08105,6.75586,4.2832,22.87695-36.08105c1.36328-2.15039,2.62109-4.34082,3.81177-6.55518l.98511,2.23877c4.08008,9.27246,5.71875,19.50586,4.74023,29.59082l7.96289,.77344c1.11035-11.44727-.75-23.06152-5.38086-33.58691l-3.76562-8.55762c2.47388-5.97314,4.35083-12.10645,5.66699-18.31787l4.20703,2.78955c11.17578,7.41211,17.72168,19.84277,17.50977,33.25098l7.99805,.12695c.25586-16.14844-7.62695-31.11816-21.08594-40.04492l-7.17383-4.75781c1.85498-14.76855,.55908-29.77441-3.83057-43.98389l13.67627-5.86133c.41846,.30273,.8374,.60498,1.27344,.88818-9.71191,20.44922-4.64844,45.16113,12.78809,60.10742l23.60547,20.2334,2.09863,12.58496c3.66211,21.97266,13.92383,41.91211,29.6748,57.66309,.75684,.75781,1.77734,1.17188,2.82812,1.17188,.26074,0,.52344-.02539,.78418-.07812,17.16699-3.43311,32.28418-12.47217,43.2854-25.37451,17.1792,16.44824,39.56274,25.45264,63.5271,25.45264,50.72852,0,92-41.27148,92-92,0-24.18311-9.38403-46.2124-24.6958-62.65039Zm-50.69507-181.34961h-82.2168l5.25-56h82.86157l-5.89478,56Zm-165.00146-56l-5.25,56h-71.96533l5.25-56h71.96533Zm8.03467,0h71.96533l-5.25,56h-71.96533l5.25-56Zm108.73364-41.125l4.05371-24.32715c.63281-3.79395,3.88379-6.54785,7.73047-6.54785,2.30859,0,4.4873,1.00977,5.97949,2.77148,1.49219,1.76074,2.12988,4.07617,1.75098,6.35352l-4.05469,24.32715c-.63281,3.79395-3.88379,6.54785-7.73047,6.54785-2.30762,0-4.4873-1.00977-5.97949-2.77148-1.49121-1.76074-2.12891-4.07617-1.75-6.35352ZM162.02734,28c2.30859,0,4.4873,1.00977,5.97949,2.77148,1.49219,1.76074,2.12988,4.07617,1.75098,6.35352l-4.05469,24.32715c-.63281,3.79395-3.88379,6.54785-7.73047,6.54785-2.30859,0-4.4873-1.00977-5.97949-2.77148-1.49219-1.76074-2.12988-4.07617-1.75098-6.35352l4.05469-24.32715c.63281-3.79395,3.88379-6.54785,7.73047-6.54785Zm-55.55762,34.74414c.64551-6.125,5.77637-10.74414,11.93457-10.74414h24.87402l-.92676,5.56055c-.7666,4.60059,.52246,9.28027,3.53711,12.83984,3.01562,3.55859,7.41992,5.59961,12.08398,5.59961,7.77344,0,14.34375-5.56543,15.62109-13.2334l1.79443-10.7666h186.02368l-.92651,5.55957c-.76758,4.60059,.52148,9.28027,3.53613,12.83984,3.01562,3.55957,7.41992,5.60059,12.08398,5.60059,7.77344,0,14.34375-5.56543,15.62109-13.2334l1.79443-10.7666h20.70654c3.44531,0,6.6123,1.41016,8.91797,3.9707s3.37695,5.8584,3.01562,9.28516l-2.81519,26.74414H103.39014l3.07959-29.25586Zm-3.92163,37.25586h69.05957l-5.25,56H96.65356l5.89453-56Zm63.05957,64l-5.25,56H89.91675l5.89478-56h69.79614Zm-17.25,184H76.44336l5.89453-56h71.26978l-5.25,56Zm6-64H83.18018l5.89453-56h70.53296l-5.25,56Zm14.03467-64l5.25-56h71.96533l-5.25,56h-71.96533Zm80,0l5.25-56h71.96533l-5.25,56h-71.96533Zm80,0l5.25-56h82.12476l-5.89453,56h-81.48022Zm103.66113-134.29297l26.2937,243.21533c-13.8042-11.35205-30.96045-18.76514-49.73633-20.51611l23.44263-222.69922Zm-109.3186,347.29248c-4.46582-10.43457-6.73486-21.52686-6.73486-32.99951,0-.79004,.01245-1.58252,.03418-2.37256,5.05762-1.77686,9.93945-4.06885,14.57715-6.85791-.40186,3.0498-.61133,6.13232-.61133,9.23047,0,12.89453,3.53613,25.49707,10.22559,36.44629,.05225,.08545,.12451,.15332,.18237,.23389l-8.34546-1.28369c-3.23291-.49756-6.3501-1.31055-9.32764-2.39697Zm-10.5166-5.38818c-8.85303-6.02588-15.54272-14.94482-18.79346-25.58008,4.93677-.22607,9.81006-.93164,14.57568-2.05615l-.00049,.0249c0,9.48291,1.4209,18.72949,4.21826,27.61133Zm25.78174-27.61133c0-5.396,.7002-10.7373,2.06592-15.90088,3.59985-2.9458,6.99951-6.21436,10.12842-9.83447,6.67163-7.71875,11.67529-16.37988,14.96875-25.5376,6.02637-4.09863,12.78149-7.13623,19.83691-8.89697v47.5127l-40.44043,40.44043c-4.30371-8.58008-6.55957-18.08789-6.55957-27.7832Zm-50.63086-68.51465l46.23438-52.39746,2.59277,5.90625c.8833,2.01172,1.68115,4.0625,2.3833,6.11963l-37.76514,42.80127c-4.03906,4.57617-9.88574,7.20117-16.04297,7.20117h-.36523c-2.83472,0-5.53125-.68848-7.93506-1.89844,4.14673-1.68604,7.87646-4.30811,10.89795-7.73242Zm-75.85449-1.63721c.70532,1.21191,1.48877,2.37793,2.35376,3.48486l-6.5481,2.80664,4.19434-6.2915Zm82.20312,153.77588c-13.70898-14.31348-22.6582-32.16895-25.92676-51.77441l-2.33691-14.01855c-.1543-.92578-.62891-1.76758-1.3418-2.37891l-24.70898-21.17969c-15.5498-13.32812-19.41211-35.87891-9.18359-53.62109,.55664-.9668,.68555-2.12305,.35254-3.18848-.33203-1.06543-1.09375-1.94336-2.10156-2.42285-8.50977-4.04199-13.66211-12.74512-13.12598-22.17188,.66211-11.60742,10.28223-21.11816,21.90137-21.65234,.36816-.01758,.73438-.02539,1.09961-.02539,5.96094,0,11.57031,2.24023,15.89844,6.37402,4.5957,4.38965,7.12695,10.30566,7.12695,16.6582,0,3.45508-.74512,6.77539-2.21484,9.86816-.33203,.7002-.4541,1.48242-.35059,2.25098l.05957,.44141c1.71289,12.73242,12.69336,22.33301,25.54102,22.33301h.36523c8.45117,0,16.48438-3.61133,22.04102-9.9082l46.2334-52.39844,2.59375,5.90723c11.31543,25.77539,6.91016,55.01855-11.49805,76.31738-18.4082,21.29785-46.70312,29.88867-73.84863,22.42773l-2.12109,7.71289c5.625,1.54688,11.29297,2.47363,16.92773,2.80273,5.62695,21.7627,23.38379,37.88574,45.74609,41.3252l9.97949,1.53516c-8.79492,19.62988-26.12695,33.91504-47.10742,38.78613Zm106.28223,.37598c-22.17236,0-42.85156-8.45703-58.61719-23.85693,3.16138-4.6167,5.84619-9.61816,7.97754-14.94678l.82031-2.05176c.45312-1.13281,.36426-2.41016-.24023-3.46875-.60547-1.05957-1.66016-1.78418-2.86523-1.96973l-1.0437-.16064c.14966-.1123,.30103-.22266,.4353-.35693l45.36133-45.36035c.75-.75,1.17188-1.76758,1.17188-2.82812v-54.08691c0-1.17676-.51758-2.29297-1.41602-3.05371-.89746-.75977-2.08691-1.08105-3.24512-.8916-6.96143,1.16748-13.75684,3.4292-20.0708,6.63916,1.06201-5.25977,1.58594-10.61768,1.56079-16.00146,9.61401-3.70557,19.74512-5.60547,30.17114-5.60547,46.31738,0,84,37.68262,84,84s-37.68262,84-84,84Z" />
                                            <path class="n"
                                                d="M411.64941,330.96484c-1.15918-.19238-2.34766,.13281-3.24512,.89258-.89844,.75977-1.41602,1.87695-1.41602,3.05371l.01172,54.08984c0,1.06055,.42188,2.07715,1.17188,2.82715l45.36133,45.36035c.75391,.75488,1.77344,1.17188,2.82812,1.17188,.15723,0,.31445-.00879,.47266-.02832,1.21777-.14453,2.30176-.83984,2.94043-1.88574,6.68945-10.94922,10.22559-23.55176,10.22559-36.44629,0-34.33496-24.54004-63.36816-58.35059-69.03516Zm43.79102,96.81836l-40.44043-40.44043-.01074-47.52441c27.50977,6.77734,47.01074,31.37207,47.01074,60.18164,0,9.69531-2.25586,19.20312-6.55957,27.7832Z" />
                                            <path class="n"
                                                d="M390.53027,418.30469c-1.49707-.62012-3.21582-.27734-4.3584,.86719l-29.84473,29.84668c-.80859,.80762-1.23242,1.92285-1.16504,3.06348,.06738,1.13965,.61914,2.19727,1.51562,2.90527,9.2002,7.25781,20.15039,12.11523,31.66797,14.04688,.21973,.03613,.44141,.05469,.66113,.05469,.93945,0,1.85645-.33105,2.58398-.94727,.89844-.75977,1.41602-1.87695,1.41602-3.05371l-.00684-43.08887c0-1.61719-.97461-3.07617-2.46973-3.69434Zm-25.24707,33.07031l19.71875-19.71875,.00391,28.51758c-7.01855-1.74902-13.71289-4.73535-19.72266-8.79883Z" />
                                            <path class="n"
                                                d="M413.82812,419.17188c-1.14258-1.14453-2.86523-1.4873-4.3584-.86719-1.49512,.61914-2.46973,2.07715-2.46973,3.69531v43.08789c0,1.17676,.51758,2.29395,1.41602,3.05371,.72754,.61523,1.64453,.94629,2.58398,.94629,.21973,0,.44141-.01855,.66211-.05469,11.5127-1.93262,22.46094-6.78906,31.66113-14.0459,.89648-.70801,1.44824-1.76465,1.51562-2.90527s-.35645-2.25586-1.16504-3.06348l-29.8457-29.84668Zm1.17188,41v-28.51465l19.7168,19.71777c-6.00879,4.0625-12.7002,7.04785-19.7168,8.79688Z" />
                                            <rect class="n" height="8" width="11.12598" x="226.75391"
                                                y="306.36133" />
                                        </g>
                                    </g>
                                    <g id="d" />
                                </g>

                            </svg>
                            <div class="in ml-1">
                                <div><span class="badge badge-info">Cuti</span>
                                </div>
                                <span class="badge badge-info">{{ $jmlCuti }}</span>
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
