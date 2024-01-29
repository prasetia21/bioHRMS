<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="{{ asset('assets/__manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('hopeui/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <script src="https://kit.fontawesome.com/4a6f1bff27.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/vendor/leaflet/leaflet.js') }}"></script>
    
</head>