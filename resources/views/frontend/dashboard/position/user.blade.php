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

    <div id="laporan-pegawai">
        <h3>Form Laporan</h3>
        <div class="row">

            <div class="col-md-12">
                <div class="card-counter info">
                    <i class="fas fa-file-upload"></i>
                    <a href="{{ route('kirim-laporan') }}" class="btn btn-outline-dark btn-lg">Kirim Laporan</a>
                    <span class="count-name">Laporan Terkirim</span>
                    <span class="count-numbers">{{ $hadir->jmlHadir }}</span>
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
                    <span class="count-numbers">10</span>
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
