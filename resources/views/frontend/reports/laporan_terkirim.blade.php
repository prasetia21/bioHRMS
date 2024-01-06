<html>
<title>Laporan Terkirim</title>
<head>
    <link rel="stylesheet" href="{{ asset('form/bootstrap-4.6.2-dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('form/fontawesome-free-5.6.3-web/css/all.min.css') }}" />
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
</head>

<body>
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



    <script src="{{ asset('form/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('form/bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js') }}">
</body>

</html>
