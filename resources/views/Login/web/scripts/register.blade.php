<script>
    // form validation
    $("#user").validate({
        rules: {
            name: {
                required: true,
                number: false,
            },

            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 6
            },
            password: {
                required: true,
                minlength: 6,

            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            phone: {
                required: "@lang('user.validation.phone_required')",
            },
            name: {
                required: "@lang('user.validation.name_required')",
                number: "@lang('user.validation.name_string')",


            },
            password: {
                required: "@lang('user.validation.password_required')",
                minlength: "@lang('user.validation.password_min')"
            },
            confirm_password: {
                required: "@lang('user.validation.confirm_password_required')",
                equalTo: "@lang('user.validation.confirm_password_required')"

            },
            email: {
                required: "@lang('user.validation.email_required')",
                email: "@lang('user.validation.email_email')"
            },

        }
    });
</script>