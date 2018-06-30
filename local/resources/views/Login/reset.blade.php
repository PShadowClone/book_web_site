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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="التجارة الالكترونية" name="description"/>
    <meta property="og:image" content="{{asset('assets/logo.png')}}">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>-->
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/global/css/components-rtl.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('assets/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('assets/pages/css/login-4-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('assets/logo.png')}}"/>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Cairo');

        body, h3, h4 {
            font-family: 'Cairo', sans-serif !important;
        }

        .help-block {
            display: none !important;
        }

        span.error {
            line-height: 2;
            color: #ff8b8b;
        }
    </style>
    {{--<script type="text/javascript" language="javascript">--}}
    {{--function disableBackButton()--}}
    {{--{--}}
    {{--window.history.forward()--}}
    {{--}--}}
    {{--disableBackButton();--}}
    {{--window.onload=disableBackButton();--}}
    {{--window.onpageshow=function(evt) { if(evt.persisted) disableBackButton() }--}}
    {{--window.onunload=function() { void(0) }--}}
    {{--</script>--}}
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo" style="margin: 0px auto -5px;">
    <a href="index.html">
        <img src="{{asset('assets/logo.png')}}" alt="" style="width: 14%"/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{route('password.reset',['email' => $email , 'token' => $token])}}" method="post">
        {{csrf_field()}}
        <h3 class="form-title">تسجيل الدخول</h3>
        @if(session('error'))
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span>{{session('error')}} </span>
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span>{{session('success')}} </span>
            </div>
        @endif
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>@lang('admin.password_required')</span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">@lang('admin.password')</label>
            <div class="input-icon">
                <i class="fa fa-key"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" minlength="6"
                       placeholder="@lang('admin.password')" name="password" value=""/></div>
            <span class="error">{{$errors->first('password')}}</span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">@lang('admin.confirm_password')</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" minlength="6"
                       placeholder="@lang('admin.confirm_password')" name="confirm_password"/>
                <span class="error">{{$errors->first('confirm_password')}}</span>
            </div>
        </div>
        <div class="form-actions" style="margin-bottom: 16px;">

            <button type="submit" class="btn green pull-right" style="width: 100%">@lang('lang.reset_password')</button>
        </div>

    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->

    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<!-- END COPYRIGHT -->
<!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/ie8.fix.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/login-4.min.js')}}" type="text/javascript"></script>
{{--<script src="env.js?ver=1.1"></script>--}}
{{--<script type="text/javascript" src="simpleLoader.js?ver=1.1"></script>--}}
{{--<script type="text/javascript" src="init.js?ver=1.1"></script>--}}
{{--<script>--}}
{{--function deleteAllCookies() {--}}
{{--var cookies = document.cookie.split(";");--}}

{{--for (var i = 0; i < cookies.length; i++) {--}}
{{--var cookie = cookies[i];--}}
{{--var eqPos = cookie.indexOf("=");--}}
{{--var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;--}}
{{--document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";--}}
{{--}--}}
{{--}--}}
{{--deleteAllCookies();--}}
{{--</script>--}}
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>