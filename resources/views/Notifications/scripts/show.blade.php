<script>
    const BASE_URL = "{{route('notification.show.all')}}";
    const DELETE_URL = "{{route('notification.delete')}}";
    const GET_TYPE_DATA = "{{route('notification.type.show')}}"
    const STORE_URL = "{{route('notification.store')}}";
    const RE_SEND_URL = "{{route('notification.reSend')}}"
    const ANIMATION_DURATION = 1000
    var url = BASE_URL;
</script>
<script>
    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var ads = $('#notifications').on('error.dt', function (e, settings, techNote, message) {
            error('@lang('lang.error')', '@lang('ads.show_error')');
        }).DataTable({
            "order": [[5, "desc"]],
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
                    "data": "type", mRender: function (data, type, row, full) {
                        return notificationTypes(data);

                    }
                },
                {
                    "data": "type_all", mRender: function (data, type, row, full) {
                        if (data == "1")
                            return "@lang('notify.all')"
                        else if (row.data != null)
                            return row.data.name
                        return "-";

                    }
                },
                {
                    "data": "admin", mRender: function (data, type, row, full) {
                        if (data != null)
                            return data.name
                        return '-';

                    }
                },
                {
                    "data": "created_at", mRender: function (data, type, row, full) {
                        if (data != null && data.trim() != '')
                            return data.split(" ")[0]
                        return "-";

                    }
                },
                {
                    "data": "created_at", mRender: function (data, type, row, full) {
                        if (data != null && data.trim() != '')
                            return data.split(" ")[1]
                        return "-";

                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<button class="btn btn-primary re-send" data-value="' + row.id + '"> <i class="fa fa-send"></i>  @lang('notify.reSend')</button>' +
                            '<button class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</button>';
                    }
                }
            ]
        });

        return ads;
    }

</script>

<script>
    // var datatable = null;
    var datatable = drawDatatable(url);
</script>
<script>

    /**
     *
     *    Search Function
     *
     * */
    $('#search').click(function () {
        var contact_phone = $('#contact_phone').val()
        var start_publish = $('#start_publish').val()
        var end_publish = $('#end_publish').val()
        url = url + "?contact_phone=" + contact_phone + "&start_publish=" + start_publish + "&end_publish=" + end_publish
        datatable.ajax.url(url).load();
        url = BASE_URL
    })

    /**
     *
     *    Reload Datatable again and make all search attributes equal null
     *
     * */
    $('#cancel').click(function () {
        $('input').val(null)
        datatable.ajax.url(BASE_URL).load();
    })

    /**
     *
     * remove notification according to its id
     *
     */

    $('body').on('click', '.remove', function () {
        var adsId = $(this).data('value')
        ask('@lang('notify.confirm_removing')', '@lang('notify.do_remove')', '@lang('lang.yes')', function (flag) {
            sendAjax(DELETE_URL + '/' + adsId, null, DELETE, function (response) {
                console.log(response)
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
     * resed notification
     *
     * */
    $('body').on('click', '.re-send', function () {
        var adsId = $(this).data('value')
        ask('@lang('notify.confirm_resending')', '@lang('notify.do_resend')', '@lang('lang.yes')', function (flag) {
            sendAjax(RE_SEND_URL + '/' + adsId, null, GET, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('@lang('lang.alert')', response.message);

                } else {
                    error('@lang('lang.error')', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        });
    })


    /**
     *
     * fill target  drop-down list which represents (to) attributes according to selected type
     *
     *
     */

    $('#type').change(function () {
        var option = $(this).val()
        sendAjax(GET_TYPE_DATA + '/' + option, null, GET, function (response) {
            console.log(response)
            if (response.status == 200) {
                updateTypeData(response.data);
            }
        });

    })

    /**
     *
     * handel send operation
     *
     */
    $('#send').click(function () {
        var content = $('#content').val()
        var type = $('#type').val()
        var typeData = $('#to').val()
        if (content == null || content.trim() == '') {
            showError('@lang('notify.content_required')'); // show bootstrap alert
        }
        if (type == '-1') {
            showError('@lang('notify.type_required')');
        }
        var data = {
            content: content,
            type: type,
            to: typeData
        }
        save(data); // handle save request which is ajax request
        hideError();  // hide bootstrap alert
        resetForm(); // reset sending form
        datatable.ajax.url(BASE_URL).load(); // update datatable
    })


    /**
     * handel ajax request for saving notification
     *
     * @param data
     */
    function save(data) {
        data = JSON.stringify(data)

        sendAjax(STORE_URL, data, POST, function (response) {
            console.log(response)
            if (response.status == 200) {
                success('@lang('lang.done')', response.message);
            }
        });
    }

    /**
     *
     * show bootstrap error
     * @param msg
     */
    function showError(msg) {
        $('#validation_msg').html(msg)
        $('.send-error').fadeIn(ANIMATION_DURATION)
    }

    /**
     *
     * hide bootstrap error
     *
     */
    function hideError() {
        $('.send-error').fadeOut(ANIMATION_DURATION)
        $('#validation_msg').html("")

    }


    /**
     *
     * reinitialize sending form
     *
     */
    function resetForm() {
        $('#content').val(null)
        $('#to').val('val', '-1')
        $('#type').val('val', '-1');
        $('.bs-select').selectpicker('refresh');

    }

    /**
     *fill target options according to a selected option
     *
     * @param data
     */
    function updateTypeData(data) {

        $('#to > option').each(function (key, value) {
            var option = $(this)
            if (option.val() != '-1')
                option.remove()
        })

        $('#to').selectpicker('refresh');
        $.each(data, function (key, value) {
            $('#to').append('<option value="' + value.id + '">' + value.name + '</option>')
        })
        $('#to').selectpicker('refresh');
    }

</script>
