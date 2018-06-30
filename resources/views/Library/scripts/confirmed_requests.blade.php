<script>
    const CONFIRMED_LIBRARY_BASE_URL = '{{route('library.request.show' , ['library_id' => $library->id])}}?status='+"1";
    var confirmed_url = CONFIRMED_LIBRARY_BASE_URL;
    {{--const DELETE_URL = '{{route('book.remove')}}';--}}
    {{--const CHANGE_AMOUNT = '{{route('book.amount.change')}}';--}}
</script>

<script>


    function drawDatatableConfirmedRequests(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var confirmed_request = $('#confirmed_request').on('error.dt', function (e, settings, techNote, message) {
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

        return confirmed_request;
    }

</script>
<script>
    var datatable_confirmed_requests = drawDatatableConfirmedRequests(confirmed_url);
</script>

<script>

    /*
    *
    *    Search Function
    *
    * */
    $('#confirmed_search').click(function () {

        var status = "{{FOR_CONFIRMING}}"
        var request_identifier = $('#confirmed_request_identifier').val()
        var client = $('#confirmed_client').val()
        var driver = $('#confirmed_driver').val()
        var from = $('#confirmed_from').val()
        var to = $('#confirmed_to').val()
        confirmed_url = confirmed_url +"&request_identifier=" + request_identifier + "&client=" + client + "&driver=" + driver + "&from=" + from + '&to=' + to
        datatable_confirmed_requests.ajax.url(confirmed_url).load();
        confirmed_url = CONFIRMED_LIBRARY_BASE_URL

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
    $('#confirmed_cancel_search').click(function () {
        $('#library_requests_confirmed').find('input').val(null)
        datatable_confirmed_requests.ajax.url(CONFIRMED_LIBRARY_BASE_URL).load();
    })


</script>



