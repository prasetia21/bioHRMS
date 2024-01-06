<script src="{{ asset('hopeui/js/core/libs.min.js') }}"></script>
<script src="{{ asset('hopeui/js/core/external.min.js') }}"></script>
<script src="{{ asset('hopeui/js/charts/widgetcharts.js') }}"></script>
<script src="{{ asset('hopeui/js/charts/vectore-chart.js') }}"></script>
<script src="{{ asset('hopeui/js/charts/dashboard.js') }}"></script>
<script src="{{ asset('hopeui/js/plugins/fslightbox.js') }}"></script>
<script src="{{ asset('hopeui/js/plugins/setting.js') }}"></script>
<script src="{{ asset('hopeui/js/plugins/slider-tabs.js') }}"></script>
<script src="{{ asset('hopeui/js/plugins/form-wizard.js') }}"></script>
<script src="{{ asset('hopeui/vendor/aos/dist/aos.js') }}"></script>
<script src="{{ asset('hopeui/js/hope-ui.js') }}" defer></script>
<script src="{{ asset('hopeui/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
    @endif
</script>

@stack('myscript')
