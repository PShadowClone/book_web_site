<script>
    const BASE_URL = "{{route('ads.show.all')}}";
    const DELETE_URL = "{{route('ads.delete')}}";
    var url = BASE_URL;
</script>
<script>
    function drawDatatable(url) {
        $.fn.dataTable.ext.errMode = 'none'; // stop showing dataTable default errors

        var ads = $('#ads').on('error.dt', function (e, settings, techNote, message) {
            error('@lang('lang.error')', '@lang('ads.show_error')');
        }).DataTable({
            "order": [[5, "desc"]],
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
                        return '<span class="show-image" data-value="' + data + '" style="font-size: 24px;cursor: pointer"><img src="{{\Illuminate\Support\Facades\URL::to('/')}}/'+data+'" width="80" height="60"></span>'
                        // return '<span class="show-image" data-value="' + data + '" style="font-size: 24px;cursor: pointer"><i class="fa fa-image"></i></span>';

                    }
                },
                {"data": "contact_phone"},
                {
                    "data": "start_publish", mRender: function (data, type, row, full) {
                        if (data != null && data.trim() != '')
                            return data.split(" ")[0]
                        return "-";

                    }
                },
                {
                    "data": "end_publish", mRender: function (data, type, row, full) {
                        if (data != null && data.trim() != '')
                            return data.split(" ")[0]
                        return "-";

                    }
                },
                {
                    "data": "id", mRender: function (data, type, row, full) {
                        return '<a class="btn btn-warning" href="{{route('ads.edit')}}/' + row.id + '" > <i class="fa fa-edit "></i>  تعديل</a>' +
                            '<button class="btn btn-danger remove" data-value="' + row.id + '"><i class="fa fa-trash"></i> حذف</button>';
                    }
                }
            ]
        });

        return ads;
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
        var contact_phone = $('#contact_phone').val()
        var start_publish = $('#start_publish').val()
        var end_publish = $('#end_publish').val()
        url = url + "?contact_phone=" + contact_phone + "&start_publish=" + start_publish + "&end_publish=" + end_publish
        datatable.ajax.url(url).load();
        url = BASE_URL
    })

    /**
     *
     *    Reload Datatable again and make all search attributes equal null
     *
     * */
    $('#cancel').click(function () {
        $('input').val(null)
        datatable.ajax.url(BASE_URL).load();
    })

    /**
     *
     * remove driver according to its id
     *
     */

    $('body').on('click','.remove',function(){
        var adsId = $(this).data('value')
        ask('@lang('lang.confirm_removing')' ,'@lang('ads.do_remove')','@lang('lang.yes')' ,function(flag){
            sendAjax(DELETE_URL+'/'+adsId,null,DELETE,function(response){
                console.log(response)
                if(response.status == 200)
                {
                    success('@lang('lang.removed_done')' , response.message);

                }else{
                    error('@lang('lang.error')' , response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        });
    })

    /**
     *
     * show advertisement's image by using modal
     *
     */
    $('body').on('click', '.show-image', function () {
        var image = $(this).data('value');
        $('#image-view').attr('src', '{{\Illuminate\Support\Facades\URL::to('/')}}' + image)
        $('#imageView').modal('show')
    })

</script>
