<script>
    const LIBRARY_BASE_URL = '{{route('library.request.show' , ['library_id' => $library->id])}}?status=-1';
    var url = LIBRARY_BASE_URL;
    const DELETE_URL = '{{route('book.remove')}}';
    const CHANGE_AMOUNT = '{{route('book.amount.change')}}';
</script>

<script>


    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var book_table = $('#request').on('error.dt', function (e, settings, techNote, message) {
            error('خطأ', '@lang('category.show_error')');
        }).DataTable({
            // "order": [[3, "desc"]],
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
                {"data": "request_identifier"},
                {
                    "data": "client", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.name;

                    }
                },
                {
                    "data": "driver", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return data.name;

                    }
                },
                {"data": "created_at"},
                {"data": "delivery_time"},
                {
                    "data": "status", mRender: function (data, type, row, full) {
                        if(data == '{{FOR_CONFIRMING}}')
                            return '<a href="#" class="request-confirm" data-value="'+row.id+'">'+showRequestStatus(data)+'</a>';
                        return showRequestStatus(data);

                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '' +
                            '<a href="{{route('request.info.show')}}/' + row.id + '" class="btn btn-primary" data-value="' + row.id + '"><i class="fa fa-info-circle" style="margin-left: 10px"></i> التفاصيل</a>';
                    }
                }
            ]
        });

        return book_table;
    }

</script>
<script>
    var datatable_requests = drawDatatable(url);
</script>

<script>

    /*
    *
    *    Search Function
    *
    * */
    $('#search').click(function () {
        var status = $('#request_status').val()
        var request_identifier = $('#request_identifier').val()
        var client = $('#client').val()
        var driver = $('#driver').val()
        var from = $('#from').val()
        var to = $('#to').val()
        url = url + "?status=" + status + "&request_identifier=" + request_identifier + "&client=" + client + "&driver=" + driver + "&from=" + from + '&to=' + to
        datatable_requests.ajax.url(url).load();
        url = LIBRARY_BASE_URL

    })

    /*
    *
    *    Reload Datatable again and make all search attributes equal null
    *
    * */
    /*
      *
      *    Reload Datatable again and make all search attributes equal null
      *
      * */
    $('#cancel_search').click(function () {
        $('#library_requests').find('input').val(null)
        datatable_requests.ajax.url(LIBRARY_BASE_URL).load();
    })

</script>
<script>
    /**
     *
     * custom style for (from) date picker
     *
     */
    $('#to').click(function () {
        $('.datepicker-dropdown').css('left', '7%')
    })

    /**
     *
     * custom style for (to) date picker
     *
     */
    $('#from').click(function () {
        $('.datepicker-dropdown').css('left', '500px')
    })
</script>



