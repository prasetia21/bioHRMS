@extends('frontend.layouts.template')

@include('frontend.layouts.body.header')
@include('frontend.layouts.body.navigation')

@section('main')

@section('title')
BIO HRMS
@endsection

{{-- Content Goes Here --}}
@include('frontend.layouts.attendance.presence')
{{-- End Content Goes Here --}}

@endsection