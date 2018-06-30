{{--{{dd(session()->get('title'))}}--}}
        <!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>{{project_name()}}</title>
    @include('base_layout.partials.header.meta_header')
    @yield('style')
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

<div class="page-wrapper">
    <!-- BEGIN HEADER -->

@include('base_layout.partials.header.header')
<!-- END HEADER -->

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">


        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        @include('base_layout.partials.navbar')
        <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->


            <div class="page-content">
            @yield('breadcrumb')


            <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN THEME PANEL -->
            @yield('body')
            <!-- END THEME PANEL -->
                <!-- BEGIN PAGE BAR -->
            </div>

            <!-- END CONTENT BODY -->
        </div>

        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->

        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
@include('base_layout.partials.footer.footer')
<!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
@include('base_layout.partials.footer.meat_footer')
        <!-- END THEME LAYOUT SCRIPTS -->
@includeIf('base_layout.scripts.Global_Scripts')
@yield('scripts')
@include('base_layout.partials.msgs')

</body>

</html>