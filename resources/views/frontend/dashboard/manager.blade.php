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
            border: 0.25rem solid #555;
            display: inline-block;
            padding: 0.25rem 1rem;
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
    </style>
@endsection

@section('main')
    {{-- Content Goes Here --}}
    @include('frontend.layouts.body.header')
    @include('frontend.layouts.body.navigation')
    @include('frontend.dashboard.position.manager')
    {{-- End Content Goes Here --}}
@endsection
