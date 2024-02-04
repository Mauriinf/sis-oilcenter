<!-- BEGIN: Vendor JS-->
<script src="{!! asset('app-assets/vendors/js/vendors.min.js') !!}"></script>
<!-- END: Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
@stack('scripts-vendor')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{!! asset('app-assets/js/core/app-menu.js') !!}"></script>
<script src="{!! asset('app-assets/js/core/app.js') !!}"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{!! asset('app-assets/vendors/js/pickers/pickadate/picker.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/pickers/pickadate/legacy.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') !!}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{!! asset('app-assets/js/scripts/forms/pickers/form-pickers.js') !!}"></script>
<!-- END: Page JS-->
<!-- BEGIN: Page JS-->
@stack('scripts-page')
<!-- END: Page JS-->
<script>
	var URL_BASE = "{{URL("/")}}";
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
