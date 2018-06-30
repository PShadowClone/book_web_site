<script>
    const BASE_URL = '{{route('admin.show.all')}}';
    var url = BASE_URL;
    const DELETE_URL = '{{route('admin.remove')}}';
</script>

<script>


    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var admin_table = $('#admin').on('error.dt', function (e, settings, techNote, message) {
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
                {"data": "name"},
                {"data": "username"},
                {"data": "email"},
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<a class="btn btn-warning" href="{{route('admin.update')}}/' + row.id + '" > <i class="fa fa-edit "></i>  تعديل</a>' +
                            '<button class="btn btn-danger remove" data-value="' + row.id + '" style="{{\Illuminate\Support\Facades\Auth::user()->type != SUPER_ADMIN || trim(\Illuminate\Support\Facades\Auth::user()->type) == '' ? 'display:none': ''}}" ><i class="fa fa-trash" ></i> حذف</button>';
                    }
                }
            ]
        });

        return admin_table;
    }

</script>
<script>
    var datatable = drawDatatable(url);
</script>

<script>

    /*
    *
    *    Search Function
    *
    * */
    $('#search').click(function () {
        var name = $('#name').val()
        var username = $('#username').val()
        var email = $('#email').val()
        url = url + "?name=" + name + '&username=' + username + '&email=' + email
        datatable.ajax.url(url).load();
        url = BASE_URL;
        // console.log(url)
    })

    /*
    *
    *    Reload Datatable again and make all search attributes equal null
    *
    * */
    $('#cancel').click(function () {
        $('input').val(null)
        datatable.ajax.url(BASE_URL).load();
    })

    $('body').on('click', '.remove', function () {
        var user_id = $(this).data('value')
        ask('تأكيد الحذف !', 'هل تريد حذف المدير ؟ ', 'حذف !', function (flag) {
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



