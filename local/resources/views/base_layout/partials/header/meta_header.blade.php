<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="التجارة الالكترونية" name="description"/>
<meta property="og:image" content="{{asset('assets/logo.png')}}">
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
      type="text/css"/>-->
<link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet"
      type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{asset('assets/global/css/components-rtl.min.css')}}" rel="stylesheet" id="style_components"
      type="text/css"/>
<link href="{{asset('assets/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- END THEME GLOBAL STYLES -->
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />

<!-- BEGIN THEME LAYOUT STYLES -->
<link href="{{asset('assets/layouts/layout/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/layouts/layout/css/themes/darkblue-rtl.min.css')}}" rel="stylesheet" type="text/css"
      id="style_color"/>
<link href="{{asset('assets/layouts/layout/css/custom-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet"
      type="text/css"/>

<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}"
      rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{asset('assets/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-select/css/bootstrap-select-rtl.css')}}" rel="stylesheet"
      type="text/css">

<link rel="stylesheet" href="{{asset('assets/RatingLibrary/css/star-rating.css')}}" media="all" type="text/css"/>
{{--<link rel="stylesheet" href="{{asset('assets/RatingLibrary/themes/krajee-fa/theme.css')}}" media="all" type="text/css"/>--}}
{{--<link rel="stylesheet" href="{{asset('assets/RatingLibrary/themes/krajee-svg/theme.css')}}" media="all" type="text/css"/>--}}
{{--<link rel="stylesheet" href="{{asset('assets/RatingLibrary/themes/krajee-uni/theme.css')}}" media="all" type="text/css"/>--}}


<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="{{asset('assets/logo.png')}}"/>
<style>
    @import url('https://fonts.googleapis.com/css?family=Cairo');

    body {
        font-family: 'Cairo', sans-serif !important;
    }

    li, h1, h2, h3, h4, h5, h6, div {
        font-family: 'Cairo', sans-serif !important;
    }

    .swal-icon {
        border-radius: 50% !important;

    }

    .swal-icon > div {
        border-radius: 50% !important;
    }

    table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable td:last-child, table.table-bordered.dataTable td:last-child {
        border-right-width: 1px;
    }

    .swal-footer {
        text-align: center;
        direction: ltr;
    }

    .dataTables_wrapper.no-footer > .row {
        margin-left: 0px;
    }

    .swal-modal > .swal-text {
        font-size: 24px;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: left;
    }

    .page-sidebar-closed > div > div > div > div > a {
        display: none !important;
    }

    .breadcrumb {
        background-color: #ffffff;

    }

    .error {
        color: red;
    }

    .col-md-12 > .dataTables_wrapper > .row {
        float: left;
        margin-left: -15px;
    }

    .col-md-12 > .dataTables_wrapper > .row:last-child {
        width: 144.5%;
    }

    .col-md-12 > .dataTables_wrapper > .row:first-child > div {
        float: left;
    }

    .page-content {
        background: #eef1f5;
    }

    .page-content > .row {
        margin-top: 10px;
        padding: 10px;
    }
     tr > td:last-child {
         text-align: center !important;
     }
    .toast-top-left{
        margin-top: 39px;
    }
    span.label{
        display: none !important;
    }
    .clear-rating{
        display: none !important;
    }
    .filled-stars{
        text-align: left !important;
        left: -3px !important;
        right: auto !important;
    }
    .swal-footer{
        direction: rtl;
    }
    .swal-button--danger{
        background-color: #7cd1f9 !important;
    }
    .swal-text{
        text-align: right;
    }
</style>
<script>
    $(document).ready(function () {
        $('a.nav-link.nav-toggle').each(function (key, value) {
            var content = $(this).html().trim()
            if (content == '')
                $(this).remove()

        })
    })

</script>
