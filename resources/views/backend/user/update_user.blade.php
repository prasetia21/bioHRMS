@extends('backend.layouts.template')

@section('title')
    User - BIO HRMS
@endsection

@section('banner-title')
    User
@endsection

@section('banner-desc')
    Update Data
@endsection

@section('main')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="new-user-info">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $item)
                                        @php
                                            toastr()->error($item);
                                        @endphp
                                    @endforeach
                                @endif
                                <form id="myForm" action="{{ route('change.user') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $user->id }}">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="name">Nama User:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $user->name }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $user->email }}" style="background-color: beige" readonly>
                                        </div>

                                        @if (!empty($data) && $data->count() > 0)
                                            <div class="form-group col-md-4">
                                                <label for="user_level_id" class="form-label">Role Akses</label>
                                                <select name="user_level_id" class="form-control" id="user_level_id"
                                                    required>
                                                    <option value="{{ $user->level->id }}">{{ $user->level->role }}</option>
                                                    @foreach ($data as $userlevel)
                                                        <option value="{{ $userlevel->id }}">{{ $userlevel->role }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="alert alert-bottom alert-danger alert-dismissible fade show "
                                                role="alert">
                                                <span> Tambahkan Dahulu data Role Akses!</span>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
    
    </script>
@endpush
