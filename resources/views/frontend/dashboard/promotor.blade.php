@extends('frontend.layouts.template')

@section('title')
    {{ $employee->fullname . ' / ' . $employee->departement->name }} - BIO HRMS
@endsection

@section('header')
    <style>
        .stamp {
            transform: rotate(12deg);
            color: #555;
            font-size: 1rem;
            font-weight: 700;
            border: 0.15rem solid #555;
            display: inline-block;
            padding: 0.15rem 1rem;
            text-transform: uppercase;
            border-radius: 1rem;
            font-family: 'Courier';
            -webkit-mask-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/8399/grunge.png');
            -webkit-mask-size: 944px 604px;
            mix-blend-mode: multiply;
            position: absolute;
            right: 20px;
            z-index: 999;
        }

        .is-denied {
            color: #cf180b;
            border: 0.5rem solid #991f0a;
            -webkit-mask-position: 13rem 6rem;
            transform: rotate(-14deg);
            border-radius: 0;
        }

        .is-pending {
            color: #ec9f0f;
            border: 0.5rem solid #ec9f0f;
            -webkit-mask-position: 13rem 6rem;
            transform: rotate(-14deg);
            border-radius: 0;
        }

        .is-approved {
            color: #0fec0f;
            border: 0.5rem solid #0fec1a;
            -webkit-mask-position: 13rem 6rem;
            transform: rotate(-14deg);
            border-radius: 0;
        }

        #imgAttachment {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            display: block;
            margin-left: auto;
            margin-right: auto
        }

        #imgAttachment:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 999;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 50%;
            //max-width: 50%;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        .out {
            animation-name: zoom-out;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(1)
            }

            to {
                -webkit-transform: scale(2)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0.4)
            }

            to {
                transform: scale(1)
            }
        }

        @keyframes zoom-out {
            from {
                transform: scale(1)
            }

            to {
                transform: scale(0)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endsection

@include('frontend.layouts.body.header')
@include('frontend.layouts.body.navigation')

@section('main')
    {{-- Content Goes Here --}}
    @include('frontend.dashboard.position.promotor')
    {{-- End Content Goes Here --}}
@endsection
