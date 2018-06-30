<script>
    const COMPANY = '2';
    const SINALGE = '1';
    $('#single_company').change(function () {
        var value = $(this).val()
        if (value == COMPANY)
            showCompanyComponent();
        else
            hideCompanyComponent();
    })

    function showCompanyComponent() {
        $('.company').fadeIn(1000);
    }

    function hideCompanyComponent() {
        $('.company').fadeOut(1000);
        $('#company_phone').val(null)
        $('#company_email').val(null)
        $('#company_address').val(null)
    }

    /**
     *
     * cancel updating and redirect user to (show drivers)
     *
     */

    $('#cancel').click(function(){
        window.location = '{{route('driver.show')}}';
    })


</script>
<script>

    // form validation
    $("#driver").validate({
        rules: {
            name: {
                required: true,
                number: false,
            },
            phone: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,

            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            inst_rate:{
                required:true,
                min:1,
                max:100
            },
            status:
                {
                    required: true
                }
            , single_company: {
                required: true
            }, company_phone: {
                required: function () {
                    return $('#single_company').val() == COMPANY;
                },
                minlength: 5,
                maxlength: 15
            },company_email:{
                required: function () {
                    return $('#single_company').val() == COMPANY;
                },
                email:true
            },company_address:{
                required: function () {
                    return $('#single_company').val() == COMPANY;
                },
            }
        },
        messages: {
            name: {
                required: "@lang('driver.name_required')",
                number: "@lang('driver.name_string')",
                minlength: "@lang('driver.name_min')",


            },
            phone: {
                required: "@lang('driver.phone_required')",
                number: "@lang('driver.phone_string')",
                minlength: "@lang('driver.phone_min')",


            },
            password: {
                required: "@lang('driver.password_required')",
                minlength: "@lang('driver.password_min')"
            },
            confirm_password: {
                required: "@lang('driver.confirm_password_required')",
                equalTo: "@lang('driver.confirm_password_required')"

            },
            email: {
                required: "@lang('driver.email_required')",
                email: "@lang('driver.email_email')"
            },
            status:{
                required:'@lang('driver.status_required')'
            },
            single_company:{
                required:"@lang('driver.single_company_required')"
            },
            company_phone : {
                required:"@lang('driver.company_phone_required')",
                minlength:"@lang('driver.company_phone_min')",
                maxlength:"@lang('driver.company_phone_max')"
            },company_email:{
                required:"@lang('driver.company_email_required')",
                email :"@lang('driver.email_email')"
            },company_address:{
                required:"@lang('driver.company_address_required')"
            },
            inst_rate:{
                required:"@lang('driver.inst_profit_rate_required')",
                min:"@lang('driver.inst_profit_rate_min')",
                max:"@lang('driver.inst_profit_rate_max')"
            }

        }
    });
</script>
