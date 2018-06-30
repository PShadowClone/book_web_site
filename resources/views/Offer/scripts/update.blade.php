<script>
    const BASE_URL = '{{route('offered.book.show',['offer_id' => $offer->id])}}';
    var url = BASE_URL;
    const ANIMATION_DURATION = 1000
    const SAVE_BOOK_OFFER = '{{route('offer.book.add')}}/{{$offer->id}}';
    const LIBRARY_BOOKS = '{{route('offer.library.book')}}'
    const DELETE_OFFERED_BOOK = '{{route('offered.book.delete')}}/{{$offer->id}}'

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
     * fill datatable with library objects using ajax
     * @param url
     * @returns {*|jQuery}
     */

    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var offered_books = $('#offeredBooks').on('error.dt', function (e, settings, techNote, message) {
            error('خطأ', '@lang('admin.show_error')');
        }).DataTable({
            "order": [[3, "desc"]],
            bFilter: false,
            bInfo: true,
            "bLengthChange": true,
            "serverSide": false,
            "language": { // language settings
                // metronic spesific
                "metronicGroupActions": "@lang('lang.datatable.metronicGroupActions')",
                "metronicAjaxRequestGeneralError": "@lang('lang.datatable.metronicAjaxRequestGeneralError')",

                // data tables spesific
                "lengthMenu": "@lang('lang.datatable.lengthMenu')",
                "info": "@lang('lang.datatable.info')",
                "infoEmpty": "@lang('lang.datatable.infoEmpty')",
                "emptyTable": "@lang('lang.datatable.emptyTable')",
                "zeroRecords": "@lang('lang.datatable.zeroRecords')",
                "search": '@lang('lang.datatable.search')',
                "paginate": {
                    "previous": '@lang('lang.datatable.previous')',
                    "next": "@lang('lang.datatable.next')",
                    "last": "@lang('lang.datatable.last')",
                    "first": "@lang('lang.datatable.first')",
                    "page": "@lang('lang.datatable.page')",
                    "pageOf": "@lang('lang.datatable.pageOf')"
                }
            },
            ajax: {
                url: url,
                type: GET,
            },
            "columns": [
                {
                    "data": "library", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.name;
                    }
                },
                {
                    "data": "book_name", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data;
                    }
                },

                {
                    "data": "offer", mRender: function (data, type, row, full) {
                        if (row.book_all == null)
                            return '<i style="color: #8b8a3c" class="fa fa-exclamation-circle"></i>';
                        else if (row.book_all == "1")
                            return "<i class='fa fa-check'></i>"
                        else if (row.book_all == "2")
                            return '<i class="fa fa-close"></i>';
                    }
                },
                {
                    "data": "offeredBook", mRender: function (data, type, row, full) {
                        return '' +
                            '<a class="btn btn-danger remove" data-value="' + data.id + '"><i class="fa fa-trash"></i> حذف</a>';
                    }
                },
            ]
        });

        return offered_books;
    }

</script>

<script>
    var datatable = drawDatatable(url);
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
            // $('#book_discount_rate_container').fadeOut(ANIMATION_DURATION)
        } else {
            // $('#from_book').fadeOut(ANIMATION_DURATION)
            // $('#book_more_than').fadeOut(ANIMATION_DURATION)
            $('#book_discount_rate_container').fadeIn(ANIMATION_DURATION)
        }
    })

    /**
     *
     *  add new book to offer's book list
     *
     */

    $('#saveBookOffer').click(function () {
        var book_id = $('#offered_books').val();
        var library_id = $('#libraries').val();
        $('#books_error').html(null)
        sendAjax(SAVE_BOOK_OFFER + '/' + book_id + "/" + library_id, '', GET, function (response) {
            $('#addBook').modal('hide')
            if (response.status == 200) {

                success('تم الحفظ', response.message);

            } else {

                error('خطأ', response.message);

            }
            datatable.ajax.url(BASE_URL).load();
        });

    })

    $('#libraries').change(function () {
        var library_id = $(this).val()
        sendAjax(LIBRARY_BOOKS + '/' + library_id, '', GET, function (response) {
            if (response.status == 200) {
                // $('#addBook').modal('hide')
                // resetPaymentForm();
                // success('تم الحفظ', response.message);
                console.log(response.data)
                changeBookList(response.data);

            } else {
                // error('خطأ', response.message);

            }
            console.log(response.message)
            datatable.ajax.url(BASE_URL).load();

        })

    })

    $('body').on('click', '.remove', function () {
        var offeredBookId = $(this).data('value')
        ask('@lang('offer.delete_offered_confirming')', '@lang('offer.do_remove')', '@lang('lang.yes')', function (flag) {
            sendAjax(DELETE_OFFERED_BOOK + '/' + offeredBookId, null, DELETE, function (response) {
                if (response.status == 200) {
                    success('@lang('lang.removed_done')', response.message);

                } else {
                    error('@lang('lang.error')', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        });
    })


    /**
     *
     * @Todo
     *
     */

    $('body').on('click', '.all_book_check', function () {
        var result = $(this).val();
        var library_id = $(this).data('value')
        if ($(this).is(':checked')) {
            ask('@lang('lang.alert')', '@lang('offer.active_offer_for_all_books')', '@lang('lang.yes')', function (flag) {
                sendAjax('{{route('offered.book.activate',['offer_id' => $offer->id])}}/' + library_id, '', GET, function (response) {
                    if (response.status == 200) {
                        // $('#addBook').modal('hide')
                        // resetPaymentForm();
                        success('تم الحفظ', response.message);

                    } else {
                        error('خطأ', response.message);

                    }
                    datatable.ajax.url(BASE_URL).load();

                })
            })
        } else {
            ask('@lang('lang.alert')', '@lang('offer.remove_option_to_disable_library_offer')')
        }

    })

    function changeBookList(data) {
        $('#offered_books > option').each(function (key, value) {
            var option = $(this)
            if (option.val() != '-1')
                option.remove();
        })
        $('#offered_books').selectpicker('refresh')
        $.each(data, function (key, value) {
            $('#offered_books').append('<option value="' + value.id + '">' + value.name + '</option>');
        })
        $('#offered_books').selectpicker('refresh')

    }

</script>

<script>
    /*
    *
    *   redirect user to show all admin page
    *
    * */
    $('#cancel').click(function () {
        window.location = '{{route('offer.show')}}';
    });
</script>