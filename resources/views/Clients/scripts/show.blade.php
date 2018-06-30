<script>
    const BASE_URL = '{{route('client.show.all')}}';
    var url = BASE_URL;
    const CHANGE_STATUS = '{{route('client.change.status')}}';
    const ENABLE = '1';
    const DISABLE = '2';
    const DELETE_URL = '{{route('client.remove')}}';
</script>

<script>

    /**
     * show all clients using ajax datatable
     * @param url
     * @returns {*|jQuery}
     */

    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var client_table = $('#clients').on('error.dt', function (e, settings, techNote, message) {
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
                    "data": "name", mRender: function (data, type, row, full) {
                        return '<a href="{{route('user.profile')}}/' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    "data": "phone", mRender: function (data, type, row, full) {
                        {{--return '<a href="{{route('user.profile')}}/' + row.id + '">' + data + '</a>';--}}
                        return data;
                    }
                },
                {
                    "data": "email", mRender: function (data, type, row, full) {
                        {{--return '<a href="{{route('user.profile')}}/' + row.id + '">' + data + '</a>';--}}
                        return data;
                    }
                },
                {
                    "data": "status", mRender: function (data, type, row, full) {
                        if (data == '1')
                            return '<span data-status="' + data + '" data-value="' + row.id + '" class="disable" style="font-size: 20px; text-align: center; cursor: pointer;color: #77ed76;"> <i class="fa fa-check"></i></span>';
                        return '<span data-status="' + data + '" data-value="' + row.id + '" class="enable" style="font-size: 20px; text-align: center ; cursor: pointer;color: #ed6b75;"> <i class="fa fa-close"></i></span>';
                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '' +
                            '<button class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</button>';
                    }
                }
            ]
        });

        return client_table
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
        var phone = $('#phone').val()
        var email = $('#email').val()
        var status = $('#status').val()
        console.log(name, phone, email, status);
        url = url + "?name=" + name + '&phone=' + phone + '&email=' + email + "&status=" + status
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
    })


    /**
     *
     *  enable driver
     *
     */


    $('body').on('click', '.enable', function () {
        var client_id = $(this).data('value')
        ask('تأكيد التفعيل !', 'هل أنت متأكد من تفعيل العميل ؟', 'نعم', function (flag) {

            sendAjax(CHANGE_STATUS + '/' + client_id + "/" + ENABLE, null, PUT, function (response) {
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
     *  disable driver (you can not deal with it in system any more)
     *
     */


    $('body').on('click', '.disable', function () {
        var client_id = $(this).data('value')
        ask('تأكيد الالغاء !', 'هل أنت متأكد من الغاء تفعيل العميل ؟', 'الغاء !', function (flag) {
            sendAjax(CHANGE_STATUS + '/' + client_id + "/" + DISABLE, null, PUT, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('تم الالغاء', response.message);

                } else {
                    error('خطأ', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        })
    })

    /**
     *
     * remove driver according to its id
     *
     */

    $('body').on('click', '.remove', function () {
        var user_id = $(this).data('value')
        ask('تأكيد الحذف !', 'هل تريد حذف العميل ؟ ', 'حذف !', function (flag) {
            sendAjax(DELETE_URL + '/' + user_id, null, DELETE, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('تم الحذف', response.message);

                } else {
                    error('خطأ', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        });
    })
</script>
