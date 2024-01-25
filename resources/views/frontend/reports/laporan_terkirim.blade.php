@extends('frontend.layouts.template')

@section('title')
    Laporan Terkirim - BIO HRMS
@endsection

@section('header')
<style>
    .card-message {
        color: #434e65;
    }

    .card-message .card-content {
        padding: 20px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
    }


    .card-message h4 {
        text-align: center;
        font-size: 50px;
        margin: 15px 0;
    }

    .card-message .form-control,
    .card-message .btn {
        min-height: 40px;
        border-radius: 3px;
    }


    .card-message .btn,
    .card-message .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #eeb711 !important;
        text-decoration: none;
        transition: all 0.4s;
        border-radius: 30px;
        margin-top: 10px;
        padding: 6px 20px;
        border: none;
    }



</style>


@endsection

@section('main')
    
<div class="container h-75">
    <div class="row h-75 justify-content-center align-items-center">
        <div class="card-success card-message">
            <div class="card-content">

                <div class="modal-body text-center">
                    <h4>Success!</h4>
                    <p>Laporan Berhasil Terkirim</p>
                    <a href="/" class="btn btn-primary" data-dismiss="modal"><span>Kembali ke Halaman
                            Utama</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
    
