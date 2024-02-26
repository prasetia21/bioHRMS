@extends('backend.layouts.template')

@section('title')
Dashboard - BIO HRMS
@endsection

@section('banner-title')
    Dashboard
@endsection

@section('main')

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-01"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="{{ $total_karyawan }}" data-value="{{ $total_karyawan }}"
                                        data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Karyawan</p>
                                        <h4 class="counter">{{ $total_karyawan }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-02"
                                        class="text-center circle-progress-01 circle-progress circle-progress-info"
                                        data-min-value="0" data-max-value="{{ $total_departement }}" data-value="{{ $total_departement }}"
                                        data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Unit Kerja</p>
                                        <h4 class="counter">{{ $total_departement }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-03"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="{{ $total_karyawan }}" data-value="0"
                                        data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Terlambat</p>
                                        <h4 class="counter">0</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-04"
                                        class="text-center circle-progress-01 circle-progress circle-progress-info"
                                        data-min-value="0" data-max-value="{{ $total_karyawan }}" data-value="0"
                                        data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24px"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Ijin</p>
                                        <h4 class="counter">0</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-05"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="{{ $total_karyawan }}" data-value="0"
                                        data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24px"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Cuti</p>
                                        <h4 class="counter">0</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-06"
                                        class="text-center circle-progress-01 circle-progress circle-progress-info"
                                        data-min-value="0" data-max-value="100" data-value="40"
                                        data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Today</p>
                                        <h4 class="counter">$4600</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-07"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="100" data-value="30"
                                        data-type="percent">
                                        <svg class="card-slie-arrow icon-24 " width="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Members</p>
                                        <h4 class="counter">11.2M</h4>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-wrap card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="mb-2 card-title">Daftar Terlambat</h4>
                                <p class="mb-0">
                                    <svg class ="me-2 text-primary icon-24" width="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                    </svg>
                                    15 Orang Terlambat Bulan ini
                                </p>
                            </div>
                        </div>
                        <div class="p-0 card-body">
                            <div class="mt-4 table-responsive">
                                <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                    <thead>
                                        <tr>
                                            <th>PEGAWAI</th>
                                            <th>DIVISI</th>
                                            <th>JUMLAH TERLAMBAT</th>
                                            <th>PERSENTASE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                        src="../assets/images/shapes/01.png" alt="profile">
                                                    <h6>Addidis Sportwear</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                                    </a>
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                                    </a>
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>$14,000</td>
                                            <td>
                                                <div class="mb-2 d-flex align-items-center">
                                                    <h6>60%</h6>
                                                </div>
                                                <div class="shadow-none progress bg-soft-primary w-100"
                                                    style="height: 4px">
                                                    <div class="progress-bar bg-primary"
                                                        data-toggle="progress-bar" role="progressbar"
                                                        aria-valuenow="60" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                        src="../assets/images/shapes/05.png" alt="profile">
                                                    <h6>Netflixer Platforms</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                                    </a>
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>$30,000</td>
                                            <td>
                                                <div class="mb-2 d-flex align-items-center">
                                                    <h6>25%</h6>
                                                </div>
                                                <div class="shadow-none progress bg-soft-primary w-100"
                                                    style="height: 4px">
                                                    <div class="progress-bar bg-primary"
                                                        data-toggle="progress-bar" role="progressbar"
                                                        aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                        src="../assets/images/shapes/02.png" alt="profile">
                                                    <h6>Shopifi Stores</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                                    </a>
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">TP</div>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>$8,500</td>
                                            <td>
                                                <div class="mb-2 d-flex align-items-center">
                                                    <h6>100%</h6>
                                                </div>
                                                <div class="shadow-none progress bg-soft-success w-100"
                                                    style="height: 4px">
                                                    <div class="progress-bar bg-success"
                                                        data-toggle="progress-bar" role="progressbar"
                                                        aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                        src="../assets/images/shapes/03.png" alt="profile">
                                                    <h6>Bootstrap Technologies</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                                    </a>
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                                    </a>
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                                    </a>
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">TP</div>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>$20,500</td>
                                            <td>
                                                <div class="mb-2 d-flex align-items-center">
                                                    <h6>100%</h6>
                                                </div>
                                                <div class="shadow-none progress bg-soft-success w-100"
                                                    style="height: 4px">
                                                    <div class="progress-bar bg-success"
                                                        data-toggle="progress-bar" role="progressbar"
                                                        aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                        src="../assets/images/shapes/04.png" alt="profile">
                                                    <h6>Community First</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#" class="iq-media-1">
                                                        <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>$9,800</td>
                                            <td>
                                                <div class="mb-2 d-flex align-items-center">
                                                    <h6>75%</h6>
                                                </div>
                                                <div class="shadow-none progress bg-soft-primary w-100"
                                                    style="height: 4px">
                                                    <div class="progress-bar bg-primary"
                                                        data-toggle="progress-bar" role="progressbar"
                                                        aria-valuenow="75" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>

@endsection