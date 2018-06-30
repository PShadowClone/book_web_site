<script>
    // form validation
    $("#category").validate({
        rules: {
            name: {
                required: true,
                number: false
            },
            arrange: {
                required: true,
                number: true,
            },
            image: {
                required: true,
                image:true
            }
        },
        messages: {
            name: {
                required: "@lang('category.name_required')",
                number: "@lang('category.name_string')",


            },
            arrange: {
                required: "@lang('category.arrange_required')",
                number: "@lang('category.arrange_numeric')",


            },
            image: {
                required: "@lang('category.image_required')",
                image: "@lang('category.image_image')"
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