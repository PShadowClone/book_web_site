<script>
    // form validation
    $("#book").validate({
        rules: {
            name: {
                required: true,
            },
            arrange: {
                required: true,
            },
            image: {
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
                required: "@lang('book.name_required')",
                number: "@lang('book.name_string')",


            },
            arrange: {
                required: "@lang('book.arrange_required')",
                number: "@lang('book.arrange_numeric')",


            },
            image: {
                required: "@lang('book.image_required')",
            },
            writer: {
                required: "@lang('book.writer_required')",
            },
            publisher: {
                required: "@lang('book.publisher_required')",
            },
            library_id: {
                required: "@lang('book.library_required')",
            },
            category_id: {
                required: "@lang('book.category_required')",
            },
            publish_date: {
                required: "@lang('book.publish_date_required')",
            },
            price: {
                required: "@lang('book.price_required')",
            },
            inquisitor: {
                required: "@lang('book.inquisitor_required')",
            },

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