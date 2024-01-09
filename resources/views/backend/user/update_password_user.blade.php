@extends('backend.layouts.template')

@section('title')
    User - BIO HRMS
@endsection

@section('banner-title')
    User
@endsection

@section('banner-desc')
    Update Password
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
                                <form id="myForm" action="{{ route('change.password.user') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $user->id }}">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="passwordOld">Password Lama:</label>
                                            <input type="password" class="form-control" id="passwordOld" name="passwordOld"
                                                >
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="passwordNew">Password Baru:</label>
                                            <input type="password" class="form-control" id="passwordNew" name="passwordNew"
                                                >
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="confirmpasswordNew">Konfirmasi Password Baru:</label>
                                            <input type="password" class="form-control" id="confirmpasswordNew" name="confirmpasswordNew"
                                                >
                                        </div>


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
