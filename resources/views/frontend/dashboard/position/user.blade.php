<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                <ion-icon name="camera"></ion-icon>
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
                                <ion-icon name="camera"></ion-icon>
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
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="image-outline" role="img" class="md hydrated"
                                    aria-label="image outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Photos</div>
                                <span class="badge badge-danger">10</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-secondary">
                                <ion-icon name="videocam-outline" role="img" class="md hydrated"
                                    aria-label="videocam outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Videos</div>
                                <span class="text-muted">None</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
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
