<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ route('profile') }}">
                            <img src="{{ asset('assets/img/upload/web/profile.svg') }}" alt="avatar" class="imaged w64 rounded">
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
               
                @if (!empty($cekReqCuti) && $cekReqCuti->req_date == $hariini || empty($getJatahCuti) || $getJatahCuti->total_days <= 0)
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a>
                            <img src="{{ asset('assets/img/upload/web/calendar-remove.svg') }}" alt="avatar" class="imaged w64 rounded opacity-25">
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div>
                @else
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ route('cuti') }}">
                            <img src="{{ asset('assets/img/upload/web/calendar-date.svg') }}" alt="avatar" class="imaged w64 rounded">
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div>
                @endif

                @if (!empty($cekReqIjin) && $cekReqIjin->req_date == $hariini)
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a>
                            <img src="{{ asset('assets/img/upload/web/clipboard.svg') }}" alt="avatar" class="imaged w64 rounded opacity-25">
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Ijin</span>
                    </div>
                </div>
                @else
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ route('ijin') }}">
                            <img src="{{ asset('assets/img/upload/web/clipboard.svg') }}" alt="avatar" class="imaged w64 rounded">
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Ijin</span>
                    </div>
                </div>
                @endif

                
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="">
                            <img src="{{ asset('assets/img/upload/web/location-finder.svg') }}" alt="avatar" class="imaged w64 rounded">
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>