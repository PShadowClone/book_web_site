<script>
    /**
     *
     *  form validation
     *
     */
    $("#ads").validate({
        rules: {
            content: {
                required: true,
            },
            contact_phone: {
                required: true,
            },
            arrange: {
                required: true,
            },

            start_publish: {
                required: true,
            },
            end_publish:{
                required:true
            },
        },
        messages: {
            content: {
                required: "@lang('ads.content_required')",
            },
            contact_phone: {
                required: "@lang('ads.contact_phone')",
            },
            ads_image: {
                required: "@lang('ads.image_required')",

            },
            arrange: {
                required: "@lang('ads.arrange')",
            },
            start_publish:{
                required:"@lang('ads.start_publish_required')",
            },
            end_publish:{
                required:"@lang('ads.end_publish_required')",
            }

        }
    });
</script>
<script>
    /**
     *
     *  make sure that expire date grater than start date
     *
     */
    $('#start_publish').on('change', function () {
        $('#end_publish').datepicker('setStartDate', $(this).val())
    });


    /**
     *
     * back to advertisements show page
     *
     */
    $('#cancel').click(function () {
        window.location = "{{route('ads.show')}}";
    });

</script>