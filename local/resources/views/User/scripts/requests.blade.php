<script>
    const REQUEST_BASE_URL = '{{route('user.requests.show.all' , ['id' => $user->id])}}';
    var request_url = REQUEST_BASE_URL;
    const REQUEST_DELETE_URL = '{{route('book.remove')}}';
    const REQUEST_CHANGE_AMOUNT = '{{route('book.amount.change')}}';
</script>

<script>


    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var book_table = $('#request').on('error.dt', function (e, settings, techNote, message) {
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
                        return '<a href="{{route('user.profile')}}/' + data.id + '">' + data.name + '</a>';

                    }
                },
                {

                    "data": "driver", mRender: function (data, type, row, full) {
                        if (data == null)
                            return '-';
                        return '<a href="{{route('user.profile')}}/' + data.id + '">' + data.name + '</a>';

                    }
                },
                {"data": "created_at"},
                {"data": "delivery_time"},
                {
                    "data": "status", mRender: function (data, type, row, full) {
                        if (data == '{{FOR_CONFIRMING}}')
                            return '<a href="#" class="request-confirm" data-value="' + row.id + '">' + showRequestStatus(data) + '</a>';
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

        return book_table;
    }

</script>
<script>
    var datatable = drawDatatable(request_url);
</script>

<script>

    /*
    *
    *    Search Function
    *
    * */
    $('#search_request').click(function () {
        var name = $('#status').val()
        var request_identifier = $('#request_identifier').val()
        var client = $('#client').val()
        var driver = $('#driver').val()
        var from = $('#from').val()
        var to = $('#to').val()
        request_url = request_url + "?status=" + name + "&request_identifier=" + request_identifier + "&client=" + (client == undefined ? '':client) + "&driver=" +( driver == undefined ? '' :driver) + "&from=" + from + '&to=' + to
        datatable.ajax.url(request_url).load();
        request_url = REQUEST_BASE_URL

    })

    /*
    *
    *    Reload Datatable again and make all search attributes equal null
    *
    * */
    $('#cancel_request').click(function () {
        $('input').val(null)
        datatable.ajax.url(REQUEST_BASE_URL).load();
    })

    $('body').on('click', '.remove', function () {
        var user_id = $(this).data('value')
        ask('@lang("lang.confirm_removing")', '@lang("category.ask_remove")', '@lang("lang.remove")', function (flag) {
            sendAjax(REQUEST_DELETE_URL + '/' + user_id, null, DELETE, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('@lang("lang.remove_successfully")', response.message);

                } else {
                    error('@lang("lang.error")', response.message);

                }
                datatable.ajax.url(REQUEST_BASE_URL).load();
            });
        });
    })

    $('body').on('click', '.show-image', function () {
        var image = $(this).data('value');
        $('#image-view').attr('src', '{{\Illuminate\Support\Facades\URL::to('/')}}' + image)
        $('#imageView').modal('show')
    })


    $('body').on('click', '.change-amount', function () {
        var amount = $(this).data('value');
        var id = $(this).data('id');
        // alert(amount);
        $('#current_amount').html(amount)
        $('#amountModel').modal('show')
        changeAmount(id, "" + amount);
    })


    function changeAmount(id, amount) {
        $('#save_new_amount').click(function () {
            var new_amount = $('#new_amount').val()
            if (new_amount == undefined || !new_amount.match(/^\d+$/g)) {
                $('#new_amount_error').html('@lang('book.check_amount_value')')
                return
            }
            $('#new_amount_error').html('')
            sendAjax(REQUEST_CHANGE_AMOUNT + '/' + id + '/' + new_amount, null, PUT, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('@lang("lang.change_successfully")', response.message);
                    $('#amountModel').modal('hide')

                } else {
                    error('@lang("lang.error")', response.message);

                }
                datatable.ajax.url(REQUEST_BASE_URL).load();
            });

        })
    }


</script>
<script>
    /**
     *
     * custom style for (from) date picker
     *
     */
    $('#to').click(function () {
        $('.datepicker-dropdown').css('left', '7%')
    })

    /**
     *
     * custom style for (to) date picker
     *
     */
    $('#from').click(function () {
        $('.datepicker-dropdown').css('left', '500px')
    })
</script>



