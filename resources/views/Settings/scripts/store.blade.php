<script>
    const BASE_URL = '{{route('promocode.show.all')}}';
    var url = BASE_URL
    const DELETE_URL = '{{route('promocode.delete')}}'
    var SAVE_PROMOCODE = '{{route('promocode.store')}}';
    const ANIMATION_DURATION = 1000
</script>
<script>
    $("#setting").validate({
        rules: {
            in_city: {
                required: true
            },
            out_city: {
                required: true
            }
        },
        messages: {
            in_city: {
                required: "@lang('setting.in_city_required')"
            },
            out_city: {
                required: "@lang('setting.out_city_required')"
            }
        }
    });
</script>
<script>
    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var promocodes = $('#promocodes').on('error.dt', function (e, settings, techNote, message) {
            error('@lang('lang.error')', '@lang('ads.show_error')');
        }).DataTable({
            // "order": [[5, "desc"]],
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
                    "data": "code", mRender: function (data, type, row, full) {
                        return data;

                    }
                },
                {
                    "data": "discount_rate", mRender: function (data, type, row, full) {
                        return data + '%';

                    }
                },
                {
                    "data": "admin", mRender: function (data, type, row, full) {
                        if (data == null)
                            return "-"
                        else
                            return data.name

                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<a class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</a>';
                    }
                }
            ]
        });

        return promocodes;
    }

</script>
<script>
    datatable = drawDatatable(url)
</script>
<script>
    $('#savePromoCode').click(function () {
        var discount_rate = $('#discount_rate').val()
        var validationResult = validateDiscount("" + discount_rate);
        if (!validationResult)
            return
        var promo_code = $('#promo_code').val()
        if(promo_code == undefined || promo_code.trim() == "")
        {
            showError("@lang('setting.promo_code_is_required')");
            return;
        }

        var data = {
            'discount_rate': discount_rate,
            'promo_code' : promo_code
        }
        save(data);
        $('#promoModal').modal('hide')
        $('#discount_rate').val(null)
        $('#promo_code').val(null)


    })

    /**
     *
     * remove notification according to its id
     *
     */

    $('body').on('click', '.remove', function () {
        var promo_code_id = $(this).data('value')
        ask('@lang('setting.confirm_removing')', '@lang('setting.promo_do_remove')', '@lang('lang.yes')', function (flag) {
            sendAjax(DELETE_URL + '/' + promo_code_id, null, DELETE, function (response) {
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

    /**
     *
     *    Search Function
     *
     * */
    $('#search').click(function () {
        var code = $('#code').val()
        var client = $('#client').val()
        url = url + "?code=" + code + "&client=" + client
        datatable.ajax.url(url).load();
        url = BASE_URL
    })

    /**
     *
     * cancel searching re-filling datatable
     *
     */
    $('#cancelSearch').click(function () {

        url = BASE_URL
        datatable.ajax.url(BASE_URL).load();
        $('#client').val(null)
        $('#code').val(null)
    })

    /**
     *
     * discount validation function
     * @param discount_rates
     * @returns {boolean}
     */
    function validateDiscount(discount_rates) {

        if (!discount_rates.match(/^[1-9][0-9]?$|^100$/g)) { // check if discount_rate valid or not
            showError('@lang('setting.discount_rate_digits_between')')
            return false
        }
        hideError();

        return true
    }

    /**
     *
     * show error of discount's validation
     *
     * @param msg
     */
    function showError(msg) {
        $('#addPromoValidation').html(msg)
        $('.promo-alert').fadeIn(ANIMATION_DURATION)
    }

    /**
     *
     * reset error panel
     *
     */
    function hideError() {
        $('.promo-alert').fadeOut(ANIMATION_DURATION)
        $('#addPromoValidation').html('')

    }

    /**
     *
     * save promo code by using ajax request
     *
     * @param content
     */
    function save(content) {
        content = JSON.stringify(content)
        sendAjax(SAVE_PROMOCODE, content, POST, function (response) {
            if (response.status == 200) {
                $('#addBook').modal('hide')
                success('تم الحفظ', response.message);

            } else {
                error('خطأ', response.message);

            }
            datatable.ajax.url(BASE_URL).load();
        });
    }
</script>