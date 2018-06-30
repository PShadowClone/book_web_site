<script>
    const BASE_URL = '{{route('library.show.all')}}';
    var url = BASE_URL;
    const CHANGE_STATUS = '{{route('library.status.change')}}';
    const DISABLE = '2';
    const ENABLE = '1';
    const DELETE_URL = '{{route('library.remove')}}';
    const UPDATE_URL = '{{route('library.update')}}';
</script>

<script>
    /**
     * fill datatable with library objects using ajax
     * @param url
     * @returns {*|jQuery}
     */

    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var library_table = $('#library').on('error.dt', function (e, settings, techNote, message) {
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
                {"data": "name"},
                {"data": "mobile"},
                {"data": "email"},
                {
                    "data": "status", mRender: function (data, type, row, full) {
                        if (data == '1')
                            return '<span data-status="' + data + '" data-value="' + row.id + '" class="disable" style="font-size: 20px; text-align: center; cursor: pointer;color: #77ed76;"> <i class="fa fa-check"></i></span>';
                        return '<span data-status="' + data + '" data-value="' + row.id + '" class="enable" style="font-size: 20px; text-align: center ; cursor: pointer;color: #ed6b75;"> <i class="fa fa-close"></i></span>';
                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<a class="btn btn-warning" href="' + UPDATE_URL + '/' + row.id + '" > <i class="fa fa-edit "></i>  تعديل</a>' +
                            '<button class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</button>';
                    }
                },
            ]
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
        var name = $('#name').val()
        var mobile = $('#mobile').val()
        var city = $('#city').val()
        var quarter = $('#quarter').val()
        var area = $('#area').val()
        var email = $('#email').val()
        var status = $('#status').val()
        url = url + "?name=" + name + '&mobile=' + mobile + '&email=' + email + "&city=" + city + "&area=" + area + "&quarter=" + quarter + "&status=" + status
        datatable.ajax.url(url).load();
        url = BASE_URL
    })

    /**
     *
     *  cancel search refill datatable
     *
     * */

    $('#cancel').click(function () {
        datatable.ajax.url(BASE_URL).load();
        resetSearchForm();

    })


    /**
     *
     *  disable library (you can not deal with it in system any more)
     *
     */


    $('body').on('click', '.disable', function () {
        var library_id = $(this).data('value')
        ask('تأكيد الالغاء !', 'هل أنت متأكد من الغاء تفعيل المكتبة ؟', 'الغاء !', function (flag) {
            sendAjax(CHANGE_STATUS + '/' + library_id + "/" + DISABLE, null, PUT, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('تم الالغاء', response.message);

                } else {
                    error('خطأ', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        });


        /**
         *
         *  enable library
         *
         */

    })
    $('body').on('click', '.enable', function () {
        var library_id = $(this).data('value')
        ask('تأكيد التفعيل !', 'هل تريد تفعيل المكتبة ؟ ', 'حذف !', function (flag) {
            sendAjax(CHANGE_STATUS + '/' + library_id + "/" + ENABLE, null, PUT, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('تم التعيل', response.message);

                } else {
                    error('خطأ', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        })


    })

    /**
     *
     * remove library according to its id
     *
     */

    $('body').on('click', '.remove', function () {
        var user_id = $(this).data('value')
        ask('تأكيد الحذف !', 'هل تريد حذف المكتبة ؟ ', 'حذف !', function (flag) {
            sendAjax(DELETE_URL + '/' + user_id, null, DELETE, function (response) {
                if (response.status == 200) {
                    success('تم الحذف', response.message);

                } else {
                    error('خطأ', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        });


    })

    /**
     *
     * reset form search
     *
     */
    function resetSearchForm() {
        $('input').val(null)
        $('#area').val('-1')
        $('#city').val('-1')
        $('#quarter').val('-1')
        $('#status').val('-1')
        $('select').selectpicker('refresh')
    }

</script>


