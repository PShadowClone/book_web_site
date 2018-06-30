<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/ie8.fix.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/ui-toastr.min.js')}}" type="text/javascript"></script>

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/table-datatables-responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-bootstrap-select.min.js')}}" type="text/javascript"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="{{asset('assets/RatingLibrary/js/star-rating.js')}}" type="text/javascript"></script>
{{--<script src="{{asset('assets/RatingLibrary/themes/krajee-fa/theme.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('assets/RatingLibrary/themes/krajee-svg/theme.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('assets/RatingLibrary/themes/krajee-uni/theme.js')}}" type="text/javascript"></script>--}}


<script>

    // just for change arrows direction in datatable
    $(document).ready(function () {

        $('li.next').each(function (key, value) {
            $(this).find('i.fa.fa-angle-right').removeClass('fa-angle-right').addClass('fa-angle-left')
        })
        $('li.prev').each(function (key, value) {
            $(this).find('i.fa.fa-angle-left').removeClass('fa-angle-left').addClass('fa-angle-right')
        })
    })


</script>

