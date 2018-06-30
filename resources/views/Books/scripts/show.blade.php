<script>
    const BASE_URL = '{{route('book.show.all')}}';
    var url = BASE_URL;
    const DELETE_URL = '{{route('book.remove')}}';
    const CHANGE_AMOUNT = '{{route('book.amount.change')}}';
</script>

<script>


    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var book_table = $('#book').on('error.dt', function (e, settings, techNote, message) {
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
                {"data": "arrange"},
                {
                    "data": "image", mRender: function (data, type, row, full) {
                        return '<span class="show-image" data-value="' + data + '" style="font-size: 24px;cursor: pointer"><img src="{{\Illuminate\Support\Facades\URL::to('/')}}/' + (data == '' || data == undefined ? 'assets/logo.png' : data) + '" width="80" height="60"></span>'
                        // return '<span class="show-image" data-value="' + data + '" style="font-size: 24px;cursor: pointer"><i class="fa fa-image"></i></span>';

                    }
                },
                {
                    "data": "category", mRender: function (data, type, row, full) {
                        if (data == null)
                            return "لا يوجد";
                        return data.name
                    }
                },
                {"data": "name"},
                {
                    "data": "amount", mRender: function (data, type, row, full) {
                        return '<a href="#" class="change-amount" data-value="' + row.amount + '" data-id="' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<a class="btn btn-warning" href="{{route('book.edit')}}/' + row.id + '" > <i class="fa fa-edit "></i>  تعديل</a>' +
                            '<button class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</button>';
                    }
                }
            ]
        });

        return book_table;
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
        var category = $('#category_id').val()
        url = url + "?name=" + name + "&category_id=" + category
        datatable.ajax.url(url).load();
        url = BASE_URL

    })

    /*
    *
    *    Reload Datatable again and make all search attributes equal null
    *
    * */
    $('#cancel').click(function () {

        datatable.ajax.url(BASE_URL).load();
        $('#category_id').val('-1')
        $('input').val(null)
        $('select').selectpicker('refresh')
    })

    $('body').on('click', '.remove', function () {
        var user_id = $(this).data('value')
        ask('@lang("lang.confirm_removing")', '@lang("book.ask_remove")', '@lang("lang.remove")', function (flag) {
            sendAjax(DELETE_URL + '/' + user_id, null, DELETE, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('@lang("lang.remove_successfully")', response.message);

                } else {
                    error('@lang("lang.error")', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
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
            sendAjax(CHANGE_AMOUNT + '/' + id + '/' + new_amount, null, PUT, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('@lang("lang.change_successfully")', response.message);
                    $('#amountModel').modal('hide')

                } else {
                    error('@lang("lang.error")', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });

        })
    }


</script>



