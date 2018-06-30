<script>
    const ANIMATION_DURATION = 1000

    // form validation
    $("#offer").validate({
        rules: {
            title: {
                required: true,
                number: false,
            },
            start_date: {
                required: true,

            },
            expire_date: {
                required: true,

            }
        },
        messages: {
            title: {
                required: "@lang('offer.title_required')",


            },
            start_date: {
                required: "@lang('offer.start_date')",


            },
            expire_date: {
                required: "@lang('offer.expire_date')",
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
    $('#start_date').on('change', function () {
        $('#expire_date').datepicker('setStartDate', $(this).val())
        $('.datepicker').css('left', '427.5px !important')
    });

    /**
     *
     * show and hide files according to book_offer_type's value
     *
     */
    $('input[name="book_offer_type"]').change(function () {
        var option_value = $(this).val()
        if (option_value == '1') {
            $('#from_book').fadeIn(ANIMATION_DURATION)
            $('#book_more_than').fadeIn(ANIMATION_DURATION)
            $('#book_discount_rate_container').fadeOut(ANIMATION_DURATION)
        }else{
            $('#from_book').fadeOut(ANIMATION_DURATION)
            $('#book_more_than').fadeOut(ANIMATION_DURATION)
            $('#book_discount_rate_container').fadeIn(ANIMATION_DURATION)
        }
    })
</script>

<script>
    /*
    *
    *   redirect user to show all admin page
    *
    * */
    $('#cancel').click(function () {
        window.location = '{{route('admin.show')}}';
    });
</script>