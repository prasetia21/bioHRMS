@include('frontend.layouts.body.head')

@include('frontend.layouts.body.header')
@include('frontend.layouts.body.navigation')

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    @yield('header')

    <!-- App Capsule -->
    <div id="appCapsule">

        <main class="main">
            @yield('main')
        </main>

    </div>
    <!-- * App Capsule -->

    <!-- App Bottom Menu -->
    @include('frontend.layouts.body.footer')

    @include('frontend.layouts.body.script')
    

</body>

</html>
