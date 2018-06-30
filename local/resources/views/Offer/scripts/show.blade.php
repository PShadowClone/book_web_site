<script>
    const BASE_URL = "{{route('offer.show.all')}}";
    const DELETE_URL = "{{route('offer.delete')}}"
    var url = BASE_URL;
</script>
<script>
    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var offers = $('#offers').on('error.dt', function (e, settings, techNote, message) {
            error('@lang('lang.error')', '@lang('ads.show_error')');
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
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        // console.log()
                        return full.row + 1

                    }
                },
                {
                    "data": "title"
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<a class="btn btn-warning" href="{{route('offer.edit')}}/' + row.id + '"> <i class="fa fa-edit"></i>  @lang('lang.edit')</button>' +
                            '<a class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</button>';
                    }
                }
            ]
        });

        return offers;
    }

</script>

<script>
    // var datatable = null;
    var datatable = drawDatatable(url);
</script>

<script>
    /**
     *
     * remove notification according to its id
     *
     */

    $('body').on('click', '.remove', function () {
        var offerId = $(this).data('value')
        ask('@lang('offer.delete_offered_confirming')', '@lang('offer.do_remove_offer')', '@lang('lang.yes')', function (flag) {
            sendAjax(DELETE_URL + '/' + offerId, null, DELETE, function (response) {
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
</script>