<script>
    // form validation
    $("#category").validate({
        rules: {
            name: {
                required: true,
                number: false,
                minlength:6
            },
            arrange: {
                required: true,
                number: true,
            }

        },
        messages: {
            name: {
                required: "@lang('category.name_required')",
                number: "@lang('category.name_string')",
                minlength : "@lang('category.name_min')",


            },
            arrange: {
                required: "@lang('category.arrange_required')",
                number: "@lang('category.arrange_string')",


            }
        }
    });
</script>
<script>
    /*
    *
    *   redirect user to show all categories page
    *
    * */
    $('#cancel').click(function(){
        window.location = '{{route('category.show')}}';
    });
</script>