<script>
    // form validation
    $("#admin").validate({
        rules: {
            name: {
                required: true,
                number:false,
            },
            username: {
                required: false,
                minlength: 6,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: false,
                minlength: 6,

            },
            confirm_password: {
                required: false,
                equalTo: "#password"
            }
        },
        messages: {
            name: {
                required: "@lang('admin.name_required')",
                number: "@lang('admin.name_string')",
                minlength : "@lang('admin.name_min')",


            },
            username: {
                required: "@lang('admin.username_required')",
                number: "@lang('admin.username_string')",
                minlength : "@lang('admin.username_min')",


            },
            password: {
                required: "@lang('admin.password_required')",
                minlength: "@lang('admin.password_min')"
            },
            confirm_password: {
                required: "@lang('admin.confirm_password_required')",
                equalTo : "@lang('admin.confirm_password_required')"

            },
            email: {
                required: "@lang('admin.email_required')",
                email: "@lang('admin.email_email')"
            },

        }
    });
</script>
<script>
    /*
    *
    *   redirect user to show all admin page
    *
    * */
    $('#cancel').click(function(){
        window.location = '{{route('admin.show')}}';
    });
</script>