@include('backend.layouts.body.head')

<body>

    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body">
            </div>
        </div>
    </div>
    <!-- loader END -->

    @include('backend.layouts.body.sidebar')

    <main class="main-content">

        @include('backend.layouts.body.header')
        
        @yield('main')

        @include('backend.layouts.body.footer')
    </main>

    
    @include('backend.layouts.body.config')

    @include('backend.layouts.body.script')


</body>

</html>
