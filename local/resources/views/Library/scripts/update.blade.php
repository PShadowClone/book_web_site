<script>

    const BASE_URL = '{{route('library.profits.show.all')}}/{{$library->id}}';
    var url = BASE_URL;
    const SAVE_NEW_PROFIT = '{{route('library.profits.save')}}/{{$library->id}}';
    const DELETE_PROFIT_URL = '{{route('library.profit.remove')}}/{{$library->id}}';
    const SHOW_PROFIT_URL = '{{route('library.profits.show')}}';
    const UPDATE_PROFIT_URL = '{{route('library.profit.update')}}';

    /**
     * fill library's profits datatable
     * @param url
     * @returns {*|jQuery}
     */
    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var library_table = $('#inst_profits_table').on('error.dt', function (e, settings, techNote, message) {
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

        return library_table;
    }
</script>
<script>
    var datatable = drawDatatable(url);
</script>
<script>
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
                window.location = '{{route('library.edit' , ['id' => $library->id])}}#instProfit'

            } else {
                error('خطأ', response.message);
            }
            datatable.ajax.url(BASE_URL).load();
        });
    })

    /**
     *
     * remove library payments according to its id
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

        /**
         *
         * update payment's info. using payment's id
         *
         */

    })
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
     * move user to show libraries page (update library has been canceled)
     *
     */
    $('#cancel').click(function () {
        window.location = '{{route('library.show')}}';
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
</script>

<script>
    function initMap() {
        var uluru = {
            lat: parseFloat('{{ $library->latitude ? $library->latitude : LOCATION_LAT}}'),
            lng: parseFloat('{{$library->longitude ? $library->longitude : LOCATION_LONG}}')
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });

        google.maps.event.addListener(map, 'click', function (event) {
            //Get the location that the user clicked.
            var clickedLocation = event.latLng;
            //If the marker hasn't been added.
            if (marker === false) {
                //Create the marker.
                marker = new google.maps.Marker({
                    position: clickedLocation,
                    map: map,
                    draggable: true //make it draggable
                });
                //Listen for drag events!
                google.maps.event.addListener(marker, 'dragend', function (event) {
                    markerLocation();
                });
            } else {
                //Marker has already been added, so just change its location.
                marker.setPosition(clickedLocation);
            }
            //Get the marker's location.
            markerLocation();
        });

        function markerLocation() {
            //Get location.
            var currentLocation = marker.getPosition();
            //Add lat and lng values to a field that we can save.
            document.getElementById('latitude').value = currentLocation.lat(); //latitude
            document.getElementById('longitude').value = currentLocation.lng(); //longitude
        }
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&language={{app()->getLocale()}}&callback=initMap">
</script>
<script>

    // form validation
    $("#library").validate({
        rules: {
            name: {
                required: true,
                number: false,
            },
            phone: {
                required: true,
                number: true,
            },
            mobile: {
                required: true,
                number: true,
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
            address: {
                required: true
            },
            quarter: {
                required: true,
                min: 1
            },
            inst_profit_rate: {
                required: true,
                min: 1,
                max: 100
            }
        },
        messages: {
            name: {
                required: "@lang('library.name_required')",
                number: "@lang('library.name_string')",


            },
            password: {
                required: "@lang('library.password_required')",
                minlength: "@lang('library.password_min')"
            },
            confirm_password: {
                required: "@lang('library.confirm_password_required')",
                equalTo: "@lang('library.confirm_password_required')"

            },
            email: {
                required: "@lang('library.email_required')",
                email: "@lang('library.email_email')"
            },
            phone: {
                required: "@lang('library.phone_required')",
                number: "@lang('library.phone_number')",
            },
            mobile: {
                required: "@lang('library.mobile_required')",
                number: "@lang('library.mobile_number')",
            },
            address: {
                required: "@lang('library.address_required')",
            },
            quarter: {
                required: "@lang('library.quarter_required')",
                min: "@lang('library.quarter_required')",
            },
            inst_profit_rate: {
                required: "@lang('library.inst_profit_rate_required')",
                min: "@lang('library.inst_profit_rate_min')",
                max: "@lang('library.inst_profit_rate_max')"
            }

        }
    });
</script>

