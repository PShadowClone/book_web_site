<script>
    const BASE_URL = '{{route('driver.evaluations.show.all' , ['id' => $driver->id])}}';
    var url = BASE_URL;

</script>
<script>
    /**
     * fill datatable with library objects using ajax
     * @param url
     * @returns {*|jQuery}
     */

    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var library_table = $('#evaluation').on('error.dt', function (e, settings, techNote, message) {
            error('خطأ', '@lang('admin.show_error')');
        }).DataTable({
            // "order": [[ 3, "desc" ]],
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
                    "data": "request", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.request_identifier;
                    }
                },
                {
                    "data": "client", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.name;
                    }
                },
                {
                    "data": "client", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.phone;
                    }
                },
                // {"data": "email"},
                {
                    "data": "request", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.created_at;
                    }
                },
                {
                    "data": "request", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.delivery_time;
                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<span class="show-note" data-value="' + row.note + '" style="font-size: 25px; cursor: pointer"><i class="fa fa-commenting-o"></i></span>'
                    }
                },
                {

                    "data": "evaluate", mRender: function (data, type, row, full) {
                        return '<input type="text" class="kv-gly-star rating-loading" value="' + data + '" dir="rtl" data-size="xs" title="" disabled>';
                    }
                },
            ],
            "initComplete": function (settings, json) {
                $('body .kv-gly-star').rating({
                    containerClass: 'is-star'
                });
            },
            "drawCallback": function (settings, json) {
                $('body .kv-gly-star').rating({
                    containerClass: 'is-star'
                });
            }

        });

        return library_table;
    }

</script>
<script>
    var datatable = drawDatatable(url);
</script>
<script>
    /**
     *
     *    Search Function
     *
     * */
    $('#search').click(function () {
        var name = $('#client_name').val()
        var phone = $('#client_phone').val()
        var request_identifier = $('#request_identifier').val()
        var from = $('#from').val()
        url = url + "?client_name=" + name + '&client_phone=' + phone + '&request_identifier=' + request_identifier + "&from=" + from
        datatable.ajax.url(url).load();
        url = BASE_URL
    })
    /**
     *
     * cancel search refill datatable
     *
     */

    $('#cancel').click(function () {
        url = BASE_URL
        datatable.ajax.url(BASE_URL).load();
        resetSreachForm();
    })

    /**
     *
     * show evaluations notes
     *
     */
    $('body').on('click', '.show-note', function () {
        var note = $(this).data('value')
        show_timed_message(note);
    })

    function resetSreachForm() {
        $('input').val(null)
    }

</script>
