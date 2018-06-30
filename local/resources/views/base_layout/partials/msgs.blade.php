@if(session('success'))
    <script>
        {{--toastr.options = {--}}
            {{--"closeButton": true,--}}
            {{--"debug": false,--}}
            {{--"positionClass": "toast-top-left",--}}
            {{--"onclick": null,--}}
            {{--"showDuration": "1000",--}}
            {{--"hideDuration": "1000",--}}
            {{--"timeOut": "5000",--}}
            {{--"extendedTimeOut": "1000",--}}
            {{--"showEasing": "swing",--}}
            {{--"hideEasing": "linear",--}}
            {{--"showMethod": "fadeIn",--}}
            {{--"hideMethod": "fadeOut"--}}
        {{--}--}}
        {{--toastr.options.preventDuplicates = true;--}}
        {{--toastr.success('{{session('success')}}' , '@lang('lang.alert')')--}}
        success('{{session('success')}}','@lang('lang.alert')')
    </script>
@elseif(session('error'))
    <script>
        swal('{{session('error')}}', "", "error");
    </script>
@endif