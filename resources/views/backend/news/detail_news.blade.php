@extends('backend.layouts.template')

@section('title')
    Detail Pengumuman - BIO HRMS
@endsection

@section('banner-title')
    {{ $data->title }}
@endsection

@section('banner-desc')
@endsection

@section('main')

    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        @php
                            toastr()->error($item);
                        @endphp
                    @endforeach
                @endif
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex  justify-content-start align-items-center mb-3">
                                <div class="pe-3">
                                    <img src="{{ asset('/picture/accounts/' . $data->employee->photo) }}"
                                        class="rounded-circle p-1 bg-soft-danger" width="60" height="60"
                                        alt="1">
                                </div>
                                <div>
                                    <h6 class="">{{ $data->employee->fullname }}</h6>
                                </div>
                            </div>
                            <div>
                                <h6 class="">{{ $data->short_information }}</h6>
                                <small>{{ $data->detail_information }}</small>
                                <div>
                                    <img src="{{ asset('/news/' . $data->attachment) }}" width="300" height="300"
                                        alt="attachment">
                                </div>

                            </div>

                        </div>

                        @if ($data->approval == 0)
                        <form onsubmit="return confirmApprove(event)" action="/manage/news/approve/{{ $data->id }}"
                            method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Approve" href="#">
                                <span class="btn-inner">
                                    <svg class="icon-20" width="20" viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" stroke="#000000">

                                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                        
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                        
                                        <g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g id="Layer_1"/> <g id="Layer_2"> <g> <path class="st0" d="M256,27.5c-61.03,0-118.42,23.77-161.57,66.93C51.27,137.58,27.5,194.97,27.5,256s23.77,118.42,66.93,161.57 C137.58,460.73,194.97,484.5,256,484.5s118.42-23.77,161.57-66.93C460.73,374.42,484.5,317.03,484.5,256 s-23.77-118.42-66.93-161.57C374.42,51.27,317.03,27.5,256,27.5z M256,452.5c-108.35,0-196.5-88.15-196.5-196.5 S147.65,59.5,256,59.5S452.5,147.65,452.5,256S364.35,452.5,256,452.5z"/> <path class="st0" d="M347.7,131.81c-16.03,0-31.09,6.24-42.43,17.57l-85.16,85.16l-13.39-13.39 c-11.33-11.33-26.4-17.58-42.43-17.58c-16.03,0-31.1,6.24-42.43,17.57c-11.32,11.32-17.56,26.39-17.56,42.43 s6.24,31.1,17.56,42.43l57.17,57.17c10.97,10.97,25.56,17.01,41.08,17.01s30.1-6.04,41.08-17.01l128.94-128.94 c11.32-11.32,17.56-26.39,17.56-42.43c0-16.04-6.24-31.1-17.56-42.42C378.8,138.05,363.73,131.81,347.7,131.81z M367.5,211.61 L238.57,340.55c-4.93,4.93-11.48,7.64-18.45,7.64s-13.52-2.71-18.45-7.64l-57.17-57.17c-5.28-5.28-8.18-12.31-8.18-19.8 s2.91-14.52,8.19-19.8c5.29-5.29,12.32-8.2,19.8-8.2s14.51,2.91,19.8,8.2l24.71,24.7c6.25,6.25,16.38,6.25,22.63,0l96.47-96.47 c5.29-5.29,12.32-8.2,19.8-8.2s14.51,2.91,19.8,8.2c5.28,5.28,8.18,12.31,8.18,19.8S372.78,206.33,367.5,211.61z"/> </g> </g> </g>
                                        
                                        </svg>
                                </span>Approve
                            </button>
                        </form>
                        @else
                        <span style="font-size: 20px" class="badge bg-success p-3">Disetujui</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('myscript')
    <script>
        attachment.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = attachment.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }

        function confirmApprove(event) {
            event.preventDefault(); // Menghentikan form dari pengiriman langsung

            Swal.fire({
                title: 'Yakin Data Ingin Disetujui?',
                text: "Status pengumuman akan automatis disetujui oleh sistem!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Approve',
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
