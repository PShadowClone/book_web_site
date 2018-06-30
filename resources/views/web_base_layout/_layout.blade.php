{{--{{dd(\Illuminate\Support\Facades\Session::all())}}--}}
        <!DOCTYPE html>
<html>
<head>
    <!--
    ==========================
    	Meta Tags start
    ===========================
    -->

@includeIf('web_base_layout.partials.header.meta_header')

@yield('style')

<!--
   ==========================
       Meta Tags end
   ===========================
   -->


</head>
<body>

<!-- ==========================
    SCROLL TOP - START
=========================== -->
<div id="scrolltop" class="hidden-xs"><i class="fa fa-angle-up"></i></div>
<!-- ==========================
    SCROLL TOP - END
=========================== -->

<!-- ==========================
    COLOR SWITCHER - START
=========================== -->
<div id="color-switcher">
    <div id="toggle-switcher"><i class="fa fa-gear"></i></div>
    <span>Color Scheme:</span>
    <ul class="list-unstyled list-inline">
        <li id="red" data-toggle="tooltip" data-placement="top" title="" data-original-title="Red"></li>
        <li id="purple" data-toggle="tooltip" data-placement="top" title="" data-original-title="Purple"></li>
        <li id="yellow" data-toggle="tooltip" data-placement="top" title="" data-original-title="Yellow"></li>
        <li id="blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="Blue"></li>
        <li id="dark-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dark Blue"></li>
        <li id="orange" data-toggle="tooltip" data-placement="top" title="" data-original-title="Orange"></li>
        <li id="green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Green"></li>
        <li id="brown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Brown"></li>
        <li id="dark-red" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dark Red"></li>
        <li id="light-green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Light Green"></li>
    </ul>
</div>
<!-- ==========================
    COLOR SWITCHER - END
=========================== -->

<div id="page-wrapper"> <!-- PAGE - START -->

    <!-- ==========================
        HEADER - START
    =========================== -->
@includeIf('web_base_layout.partials.header.header')
<!-- ==========================
    	HEADER - END
    =========================== -->

    <!-- ==========================
    	BREADCRUMB - START
    =========================== -->

@yield('breadcrumb')

<!-- ==========================
           BREADCRUMB - START
       =========================== -->

@yield('body')


@includeIf('web_base_layout.partials.footer.footer')
<!-- ==========================
    	FOOTER - END
    =========================== -->

</div> <!-- PAGE - END -->

<!--
==========================
 JS start
===========================
-->
@includeIf('web_base_layout.scripts.Global_Scripts')
@includeIf('web_base_layout.partials.footer.meta_footer')
@yield('script')



<!--
==========================
 JS end
===========================
-->
</body>
</html>