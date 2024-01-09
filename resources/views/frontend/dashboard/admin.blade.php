@extends('frontend.layouts.template')

@section('main')

@section('title')
{{ $employee->fullname . ' / ' . $employee->departement->name }} - BIO HRMS
@endsection

{{-- Content Goes Here --}}
@include('frontend.dashboard.position.admin')
{{-- End Content Goes Here --}}

@endsection