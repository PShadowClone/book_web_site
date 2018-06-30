<script>
    const BASE_URL = '{{route('driver.show.all')}}';
    var url = BASE_URL;
    const DELETE_URL = '{{route('driver.remove')}}';
    const CHANGE_STATUS = '{{route('driver.change.status')}}';
    const ENABLE = '1';
    const DISABLE = '2';
    const UPDATE_URL = '{{route('driver.update')}}';

</script>
<script>
    /**
     * fill datatable with library objects using ajax
     * @param url
     * @returns {*|jQuery}
     */

    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var library_table = $('#driver').on('error.dt', function (e, settings, techNote, message) {
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
                    "data": "name", mRender: function (data, type, row, full) {
                        return '<a href="{{route('user.profile')}}/' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    "data": "phone", mRender: function (data, type, row, full) {
                        return '<a href="{{route('user.profile')}}/' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    "data": "email", mRender: function (data, type, row, full) {
                        return '<a href="{{route('user.profile')}}/' + row.id + '">' + data + '</a>';
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
                        return '<a  href="{{route('driver.evaluations.show')}}/' + row.id + '" style="font-size: 20px; text-align: center ; cursor: pointer;"> <i class="fa fa-star"></i></a>';
                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        // UPDATE_URL
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
        var phone = $('#phone').val()
        var city = $('#city').val()
        var quarter = $('#quarter').val()
        var area = $('#area').val()
        var email = $('#email').val()
        var status = $('#status').val()
        url = url + "?name=" + name + '&phone=' + phone + '&email=' + email + "&city=" + city + "&area=" + area + "&quarter=" + quarter + "&status=" + status
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
        resetSearchForm();
    })

    /**
     *
     * remove driver according to its id
     *
     */

    $('body').on('click', '.remove', function () {
        var user_id = $(this).data('value')
        ask('تأكيد الحذف !', 'هل تريد حذف السائق ؟ ', 'حذف !', function (flag) {
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


    /**
     *
     *  disable driver (you can not deal with it in system any more)
     *
     */


    $('body').on('click', '.disable', function () {
        var driver_id = $(this).data('value')
        ask('تأكيد الالغاء !', 'هل أنت متأكد من الغاء تفعيل السائق ؟', 'الغاء !', function (flag) {
            sendAjax(CHANGE_STATUS + '/' + driver_id + "/" + DISABLE, null, PUT, function (response) {
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
         *  enable driver
         *
         */

    })
    $('body').on('click', '.enable', function () {
        var driver_id = $(this).data('value')
        ask('تأكيد التفعيل !', 'هل أنت متأكد من تفعيل السائق ؟', 'الغاء !', function (flag) {

            sendAjax(CHANGE_STATUS + '/' + driver_id + "/" + ENABLE, null, PUT, function (response) {
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

    /*
   *
   *         change cities according to chosen area
   *
   * */
    $('#area').change(function () {
        var id = $(this).val();
        $('#city > option').each(function (key, value) {
            var option = $(this);
            var option_area = option.data('area');
            if (option_area != id && option.val() != '-1') {
                option.hide();
            } else {
                option.show();
            }
        })
        $('#city').selectpicker('refresh');
    })
    /*
  *
  *         change quarters according to chosen city
  *
  * */
    $('#city').change(function () {
        var id = $(this).val();
        $('#quarter > option').each(function (key, value) {
            var option = $(this);
            var option_city = option.data('city');
            if (option_city != id && option.val() != '-1') {
                option.hide();
            } else {
                option.show();
            }
        })
        $('#quarter').selectpicker('refresh');
    })

    /**
     *
     * reset functions
     *
     */
    function resetSearchForm() {
        $('input').val(null)
        $('select').val('-1')
        $('select').selectpicker('refresh')
    }

</script>
