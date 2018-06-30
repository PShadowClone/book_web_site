<script>
    const BASE_URL = '{{route('driver.profits.show' , ['id' => $driver ? $driver->id : null ])}}';
    const url = BASE_URL;
    const SAVE_NEW_PROFIT = '{{route('driver.profits.save' , ['id' => $driver ? $driver->id : null ])}}'
    const DELETE_PROFIT_URL = '{{route('driver.profit.remove')}}/{{$driver ? $driver->id : null}}';
    const SHOW_PROFIT_URL = '{{route('driver.profits.edit')}}';
    const UPDATE_PROFIT_URL = '{{route('driver.profit.update')}}';
    const AREAS_URL = '{{route('driver.areas.show' , ['id' => $driver ? $driver->id : null ])}}';
    const SAVE_NEW_AREA = '{{route('driver.area.save', ['id' => $driver ? $driver->id : null ])}}';
    const DELETE_AREA = '{{route('driver.area.remove')}}';
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
    function drawAreasDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var driver_table = $('#driver_areas').on('error.dt', function (e, settings, techNote, message) {
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
                {"data": "quarter.city.area.name"},
                {"data": "quarter.city.name"},
                {"data": "quarter.name"},
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '' +
                            '<a class="btn btn-danger remove-area" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</a>';
                    }
                },
            ]
        });

        return driver_table;
    }
</script>

<script>
    var datatable = drawDatatable(url);
    var areasDatatable = drawAreasDatatable(AREAS_URL);
</script>
<script>

    /**
     *
     *  add new area to driver
     *
     * */

    $('#areaSave').click(function () {
        var quarter = $('#quarter').val()
        if (quarter == '-1') {
            $('.quarter_error').val('@lang('driver.choose_area')')
        }
        $('.quarter_error').val('')
        var data = JSON.stringify({id: quarter, user_id: '{{$driver  ? $driver->id : null}}'})
        sendAjax(SAVE_NEW_AREA, data, POST, function (response) {
            if (response.status == 200) {
                $('#addAreas').modal('hide')
                resetAreaModal();
                success('تم الحفظ', response.message);

            } else {
                error('خطأ', response.message);

            }
            $('select').selectpicker('refresh')
            areasDatatable.ajax.url(AREAS_URL).load();
        });
    })

    /**
     *
     * remove driver payments according to its id
     *
     */

    $('body').on('click', '.remove-area', function () {
        var area_id = $(this).data('value')
        ask('تأكيد الحذف !', 'هل تريد حذف المنطقة ؟ ', 'حذف !', function (flag) {
            sendAjax(DELETE_AREA + '/' + area_id, null, DELETE, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('تم الحذف', response.message);

                } else {
                    error('خطأ', response.message);

                }
                areasDatatable.ajax.url(AREAS_URL).load();
            });
        });
    })


    /**
     *
     * save new profits
     */
    $('#profitSave').click(function () {
        var profitMoney = $('#profitMoney').val()
        var profitType = $('#profitType').val()
        if (!profitMoney.match(/\d+/)) {
            $('.profitMuch_error').html('all inputs should be number')
            return;
        }
        $('.profitMuch_error').html('')
        if (profitType != '1' && profitType != '2') {
            $('.profitType_error').html('you should chose a valid value')
            return;
        }
        $('.profitType_error').html('')
        var data = JSON.stringify({money: profitMoney, type: profitType})
        sendAjax(SAVE_NEW_PROFIT, data, POST, function (response) {
            $('#profitsForm').modal('hide')
            if (response.status == 200) {

                resetPaymentForm();
                success('تم الحفظ', response.message);

            } else {
                error('خطأ', response.message);

            }
            datatable.ajax.url(BASE_URL).load();
        });
    })

    /**
     * show payment's edit modal (send request to make sure all displayed data are up-to-date)
     */

    $('body').on('click', '.edit', function () {
        var payment_id = $(this).data('value')
        sendAjax(SHOW_PROFIT_URL + '/' + payment_id, null, GET, function (response) {
            console.log(response)
            if (response.status == 200) {
                showEditPaymentModal(response.data);

            } else {
                error('خطأ', response.message);

            }
        });

    })
    /**
     *
     * update payment's info. using payment's id
     *
     */


    $('#editProfitSave').click(function () {
        var profitMoney = $('#editProfitMoney').val()
        var profitType = $('#editProfitType').val()
        var payment_id = $('#payment_id').val()
        if (!profitMoney.match(/\d+/)) {
            $('.editProfitMuch_error').html('all inputs should be number')
            return;
        }
        $('.editProfitMuch_error').html('')
        if (profitType != '1' && profitType != '2') {
            $('.editProfitType_error').html('you should chose a valid value')
            return;
        }
        $('.editProfitType_error').html('')
        var data = JSON.stringify({money: profitMoney, type: profitType})
        sendAjax(UPDATE_PROFIT_URL + '/' + payment_id, data, PUT, function (response) {
            if (response.status == 200) {
                $('#editProfitsForm').modal('hide')
                resetPaymentForm();
                success('تم التحديث', response.message);

            } else {
                error('خطأ', response.message);

            }
            datatable.ajax.url(BASE_URL).load();
        });
    })

    /**
     *
     * remove driver payments according to its id
     *
     */

    $('body').on('click', '.remove', function () {
        var payment_id = $(this).data('value')
        ask('تأكيد الحذف !', 'هل تريد حذف السداد ؟ ', 'حذف !', function (flag) {
            sendAjax(DELETE_PROFIT_URL + '/' + payment_id, null, DELETE, function (response) {
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
     * cancel updating and redirect user to (show drivers)
     *
     */

    $('#cancel').click(function () {
        window.location = '{{route('driver.show')}}';
    })

</script>
<script>
    /**
     * reset #profitMoney and #editProfitMoney forms (reinitialize form inputs)
     */
    function resetPaymentForm() {
        $('#profitMoney').val(null)
        $('#profitType').val(1)
        $('#editProfitMoney').val(null)
        $('#editProfitType').val(1)
    }

    function showEditPaymentModal($data) {
        $('#payment_id').val($data.id)
        $('#editProfitMoney').val($data.money)
        $('#editProfitType').val($data.type)
        $('#editProfitsForm').modal('show')
    }

    function resetAreaModal() {
        $('#quarter').val('-1')
        $('#area').val('-1')
        $('#city').val('-1')
    }
</script>


<script>
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
</script>
<script>

    // form validation
    $("#driver").validate({
        rules: {
            name: {
                required: true,
                number: false,
            },
            phone: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: false,
                minlength: 6,

            },
            confirm_password: {
                required: false,
                equalTo: "#password"
            },
            instRate: {
                required: true,
                min: 1,
                max: 100
            },
            status:
                {
                    required: true
                }
            , single_company: {
                required: true
            }, company_phone: {
                required: function () {
                    return $('#single_company').val() == COMPANY;
                },
                minlength: 5,
                maxlength: 15
            }, company_email: {
                required: function () {
                    return $('#single_company').val() == COMPANY;
                },
                email: true
            }, company_address: {
                required: function () {
                    return $('#single_company').val() == COMPANY;
                },
            }
        },
        messages: {
            name: {
                required: "@lang('driver.name_required')",
                number: "@lang('driver.name_string')",
                minlength: "@lang('driver.name_min')",


            },
            phone: {
                required: "@lang('driver.phone_required')",
                number: "@lang('driver.phone_string')",
                minlength: "@lang('driver.phone_min')",
                maxlength: "@lang('driver.phone_min')",



            },
            password: {
                required: "@lang('driver.password_required')",
                minlength: "@lang('driver.password_min')"
            },
            confirm_password: {
                required: "@lang('driver.confirm_password_required')",
                equalTo: "@lang('driver.confirm_password_required')"

            },
            email: {
                required: "@lang('driver.email_required')",
                email: "@lang('driver.email_email')"
            },
            status: {
                required: '@lang('driver.status_required')'
            },
            single_company: {
                required: "@lang('driver.single_company_required')"
            },
            company_phone: {
                required: "@lang('driver.company_phone_required')",
                minlength: "@lang('driver.company_phone_min')",
                maxlength: "@lang('driver.company_phone_max')"
            }, company_email: {
                required: "@lang('driver.company_email_required')",
                email: "@lang('driver.email_email')"
            }, company_address: {
                required: "@lang('driver.company_address_required')"
            },
            instRate: {
                required: "@lang('driver.inst_profit_rate_required')",
                min: "@lang('driver.inst_profit_rate_min')",
                max: "@lang('driver.inst_profit_rate_max')"
            }

        }
    });
</script>
