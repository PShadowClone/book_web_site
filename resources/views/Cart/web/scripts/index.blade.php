<script>

    const DELETE_URL = '{{route('ajax.web.request.delete')}}'; //delete url
    const SHOW_REQUEST_URL = '{{route('web.request.show')}}'
    const UPDATE_REQUEST_URL = '{{route('web.request.update')}}'
    const ADD_PROMO_CODE = '{{route('web.code.store')}}'
    const SEND_CONFIRMING_REQUESTS = '{{route('ajax.web.request.confirm.request')}}'
    const MAKE_DELIVERY = '{{route('ajax.web.request.delivery')}}'

    /**
     *
     * handles delete action
     *
     * */
    $('.delete_request').click(function () {
        var id = $(this).data('value')
        ask('@lang('request.web.delete')', '@lang('request.web.delete_question')', '', function (response) {
            delete_request(id);
        })
    })

    /**
     *
     * handles delete request
     *
     * @param id
     */
    function delete_request(id) {
        sendAjax(DELETE_URL + "/" + id, '', DELETE, function (response) {
            if (response.status != 200) {
                web_error('@lang('lang.web.excuse_without')', response.message);
                return;
            }
            web_success('@lang('lang.web.success')', response.message);
            console.log(response)
            location.reload();
        })
    }

    $('.edit_request').click(function () {
        var id = $(this).data('value')
        sendAjax(SHOW_REQUEST_URL + "/" + id, '', GET, function (response) {
            if (response.status != 200) {
                web_error('@lang('lang.web.excuse_without')', response.message);
                return;
            }
            console.log(response.data, id)
            fillModalThenShow(response.data, id);
        })

    })

    /**
     *
     * fill form then show modal
     * @param book
     */
    function fillModalThenShow(book, request_id) {
        $('#request_id').val(request_id)
        $('#book_id').val(book.id)
        $('#book_name').val(book.name)
        $('#request_identifier').val(book.request_identifier)
        $('#book_price').val(book.price)
        $('#book_requested_amount').val(book.requested_amount)
        $('#editModal').modal('show')
    }

    /**
     *
     *
     *  reset input then hide it
     *
     *
     * */
    function resetFormThenHide() {
        $('#edit_request_form').find('input').each(function (key, value) {
            $(this).val(null)
        })
        $('#editModal').modal('hide')
    }

    /**
     *
     *
     * prepare request json object
     *
     * *
     * */
    function prepareRequestForUpdating() {
        var content = {
            book_amount: $('#book_requested_amount').val()
        }

        return JSON.stringify(content)
    }


    /**
     *
     * handel operations of editing
     *
     */
    $('#edit_request').click(function () {
        ask('@lang('request.web.confirm')', '@lang('request.web.edit_question')', '', function (response) {
            var book_id = $('#book_id').val()
            var request_id = $('#request_id').val()
            var content = prepareRequestForUpdating()
            sendAjax(UPDATE_REQUEST_URL + "/" + request_id + "/" + book_id, content, PUT, function (response) {
                if (response.status != 200) {
                    web_error('@lang('lang.web.excuse_without')', response.message);
                    return;
                }
                resetFormThenHide()
                web_success('@lang('lang.web.success')', response.message);
                location.reload()
            })

        })
    })


    /**
     *
     * assign new promo code for client
     *
     */
    $('.add-promo-code').click(function () {
        var content = {
            promo_code: $('#promo_code').val()
        }
        content = JSON.stringify(content)
        sendAjax(ADD_PROMO_CODE, content, POST, function (response) {
            if (response.status == parseInt('{{REQUESTED_BEFORE}}')) {
                web_warnning('@lang('lang.web.excuse_without')', response.message)
                return;
            }
            if (response.status != 200) {
                web_error('@lang('lang.web.excuse_without')', response.message);
                return;
            }
            $('#promo_code').val(null)
            web_success('@lang('lang.web.success')', response.message);
            location.reload()
        })
    })

    /**
     *
     * send confirm requests to libraries
     *
     */
    $('.confirming-requests').click(function () {
        ask('@lang('request.web.confirm')', '@lang('request.web.confirm_question')', '', function (response) {
            sendAjax(SEND_CONFIRMING_REQUESTS, '', GET, function (response) {

                if (response.status != 200) {
                    web_error('@lang('lang.web.excuse_without')', response.message);
                    return;
                }
                $('#promo_code').val(null)
                web_success('@lang('lang.web.success')', response.message);
            })
        })
    })

    $('.make-deliver').click(function () {
        sendAjax(MAKE_DELIVERY, '', GET, function (response) {

            if (response.status != 200) {
                web_error('@lang('lang.web.excuse_without')', response.message);
                return;
            }
            $('#promo_code').val(null)
            web_success('@lang('lang.web.success')', response.message);
        })
    })

</script>