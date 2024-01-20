@extends('backend.layouts.template')

@section('title')
    List Aturan Absensi - BIO HRMS
@endsection

@section('banner-title')
    Aturan Absensi
@endsection

@section('banner-desc')
    Halaman untuk Melihat Aturan Absensi yang Berjalan di Sistem Bioindustries
@endsection

@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                        <div class="header-title">
                            <h4 class="card-title mb-0">Rule Absensi</h4>
                        </div>
                        <div class="">
                            @if ($errors->any())
                                @foreach ($errors->all() as $item)
                                    @php
                                        toastr()->error($item);
                                    @endphp
                                @endforeach
                            @endif
                            @if (Session::has('success'))
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire(
                                            'Sukses',
                                            '{{ Session::get('success') }}',
                                            'success'
                                        );
                                    });
                                </script>
                            @endif


                            @if ($data->count() == 0)
                                <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="btn-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </i>
                                    <span>Tambah Baru</span>
                                </a>
                            @endif

                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Rule Absensi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $item)
                                                    @php
                                                        toastr()->error($item);
                                                    @endphp
                                                @endforeach
                                            @endif

                                            <form id="myForm" action="{{ route('store.ruleattendance') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="arrived_time" class="form-label">Waktu Absen
                                                        Masuk</label>
                                                    <input type="text" id="arrived_time" name="arrived_time"
                                                        class="form-control time_flatpicker" placeholder="Mis: 08:00">
                                                </div>

                                                <div class="form-group">
                                                    <label for="leave_time" class="form-label">Waktu Absen
                                                        Pulang</label>
                                                    <input type="text" id="leave_time" name="leave_time"
                                                        class="form-control time_flatpicker" placeholder="Mis: 16:00">
                                                </div>
                                                <div class="text-start">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @if (!empty($data) && $data->count() > 0)
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="ligth">
                                            <th>NO</th>
                                            <th>Waktu Datang</th>
                                            <th>Waktu Pulang</th>
                                            <th style="min-width: 100px">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td>{{ $item->arrived_time }}</td>
                                                <td>{{ $item->leave_time }}</td>
                                                <td>
                                                    <div>
                                                        <a href="/manage/rule-attendance/update/{{ $item->id }}"
                                                            class="btn btn-sm btn-icon btn-warning"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Edit" data-original-title="Edit" href="#">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <form onsubmit="return confirmHapus(event)"
                                                            action="/manage/rule-attendance/remove/{{ $item->id }}"
                                                            method="post" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-icon btn-danger"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Delete" href="#">
                                                                <span class="btn-inner">
                                                                    <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                        stroke="currentColor">
                                                                        <path
                                                                            d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    @else
                        <hr>
                        <div class="d-flex justify-content-center">Data tidak tersedia</div>
                        <hr>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        function confirmHapus(event) {
            event.preventDefault(); // Menghentikan form dari pengiriman langsung

            Swal.fire({
                title: 'Yakin Hapus Data?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    event.target.submit(); // Melanjutkan pengiriman form
                } else {
                    swal('Your imaginary file is safe!');
                }
            });
        }
    </script>
@endpush
