<script>
    const SHOW_PROFIT_URL = '{{route('driver.profits.edit',['id' => $user->id])}}';
    const url = SHOW_PROFIT_URL;

</script>
<script>
    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var driver_table = $('#inst_profits_table').on('error.dt', function (e, settings, techNote, message) {
            error('خطأ', '@lang('admin.show_error')');
        }).DataTable({
            // "order": [[ 3, "desc" ]],
            bFilter: false,
            bInfo: false,
            "bLengthChange": false,
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
                {"data": "money"},
                {
                    "data": "type", mRender: function (data, type, row, full) {
                        if (data == '1')
                            return '@lang("library.cache")'
                        return '@lang("library.bank_transaction")';
                    }
                },
                {
                    "data": "created_at", mRender: function (data, type, row, full) {
                        var date = data.split(' ')
                        if (date.length > 0)
                            return date[0]
                        return '-'
                    }
                },
                {
                    "data": "created_at", mRender: function (data, type, row, full) {
                        var date = data.split(' ')
                        if (date.length > 0)
                            return date[1]
                        return '-'
                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<a class="btn btn-warning edit"  data-value="' + row.id + '"> <i class="fa fa-edit "></i>  تعديل</a>' +
                            '<a class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</a>';
                    }
                },
            ]
        });

        return driver_table;
    }
</script>
<script>
    datatable = drawDatatable(url);
</script>
