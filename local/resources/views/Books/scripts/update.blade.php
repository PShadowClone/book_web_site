<script>
    // form validation
    $("#book").validate({
        rules: {
            name: {
                required: true,
            },
            arrange: {
                required: true,
            }
            ,
            writer: {
                required: true,
            },

            publisher: {
                required: true,
            },

            publish_date: {
                required: true,
                date:true
            },
            library_id: {
                required: function () {
                    return $('#library').val() == "-1"
                }

            },
            category_id: {
                required: true,
            },

            inquisitor: {
                required: true,
            },
            price: {
                required: true,
            },
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
    $('#cancel').click(function () {
        window.location = '{{route('book.show')}}';
    });
</script>