@extends('frontend.layouts.template')

@include('frontend.layouts.body.header')
@include('frontend.layouts.body.navigation')

@section('main')

@section('title')
{{ $employee->fullname . ' / ' . $employee->departement->name }} - BIO HRMS
@endsection

{{-- Content Goes Here --}}
@include('frontend.dashboard.position.manager')
{{-- End Content Goes Here --}}

@endsection