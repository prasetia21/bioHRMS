@extends('frontend.layouts.template')

@include('frontend.layouts.body.header')
@include('frontend.layouts.body.navigation')

@section('main')

@section('title')
BIO HRMS
@endsection

{{-- Content Goes Here --}}
@include('frontend.layouts.position.online')
{{-- End Content Goes Here --}}

@endsection