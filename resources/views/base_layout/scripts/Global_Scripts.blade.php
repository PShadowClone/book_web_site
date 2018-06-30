<script>
    const POST = 'POST'
    const GET = 'GET'
    const DELETE = 'delete'
    const PUT = 'PUT'
    const MESSAGE_DURATION = 3000

    /*
    *
    *    Global function to handel all Control panel ajax requests
    *
    * */
    function sendAjax(url, content, method, handelData) {

        $.ajax({
            url: url,
            method: method,
            data: {body: content, post_id: '', _token: '{{csrf_token()}}'}
        }).success(function (message) {
            handelData(message);
        });

    }

    /*
       *
       *    Global function to handel all Control panel success responses
       *
       * */
    function success(title, text, button) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-left",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",

        }
        toastr.options.preventDuplicates = true;
        toastr.success(text, title)
        // toastr.clear()


    }

    /*
   *
   *    Global function to handel all Control panel error responses
   *
   * */
    function error(title, text, button) {
        swal({
            title: "خطأ",
            text: text,
            icon: "error",
            button: button == undefined ? 'خطأ' : button,
        });
    }

    function ask(title, question, confirm_option, success) {
        swal({
            title: title,
            text: question,
            icon: "warning",
            buttons: ["@lang('lang.no')", "@lang('lang.yes')"],
            dangerMode: true,
        })
            .then(function (willDelete) {
                if (willDelete) {
                    success(willDelete);
                }
            })
    }

    /**
     *
     * return the request's status name
     * @param status
     * @returns {string}
     */

    function showRequestStatus(status) {
        switch (status) {
            case '1':
                return 'لتأكد';
            case '2':
                return 'مؤكد';
            case '3':
                return 'تم الشراء';
            case '4':
                return 'جاري التحضير';
            case '5':
                return 'تم التحضير';
            case '6':
                return 'جاري التوصيل';
            case '7':
                return 'تم التسليم';
            case '8':
                return 'ملغي';
            case '9':
                return 'مرفوض';
        }
    }

    /**
     * show all message which has a specific show time
     * @param note
     */
    function show_timed_message(note) {
        swal(note, {
            buttons: false,
            timer: 100000,
        });
    }

    /**
     *  show all notification's type according to type number
     * @param type
     * @returns {string}
     */
    function notificationTypes(type) {
        switch (type) {
            case '1':
                return "@lang('notify.clients')"
            case '2':
                return "@lang('driver.driver')"
            case '3':
                return "@lang('library.library')"

        }
    }
</script>
<script>
    const CONFIRM_REQUEST = '{{route('request.confirm.update')}}'
    $('body').on('click', '.request-confirm', function () {
        var request_id = $(this).data('value')
        ask('تأكيد الطلب !', 'هل تريد  تأكيد الطلب ؟ ', '@lang('lang.yes')', function (flag) {
            sendAjax(CONFIRM_REQUEST + '/' + request_id, null, PUT, function (response) {
                console.log(response)
                if (response.status == 200) {
                    success('تم التأكيد', response.message);

                } else {
                    error('خطأ', response.message);

                }
                datatable.ajax.url(BASE_URL).load();
            });
        });
    })

    $('body .kv-gly-star').rating({
        containerClass: 'is-star'
    });
</script>