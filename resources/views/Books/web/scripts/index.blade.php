<script>

    const ADD_TO_CART = '{{route('ajax.web.cart.add')}}';
    const LOGIN = '{{route('web.login.show')}}'

    /**
     *
     * add to cart script
     *
     */
    $('.add-to-cart').click(function () {
        var id = $(this).data('value');
        var amount = $('.book-amount').val();
        var data = {
            id: id,
            amount: amount
        }
        data = JSON.stringify(data)
        // + "<a href='" + LOGIN + "'> هنا </a>"
        sendAjax(ADD_TO_CART, data, POST, function (response) {
            if (response.status == parseInt('{{REQUESTED_BEFORE}}')) {
                web_warnning('@lang('lang.web.excuse_without')', response.message);
                return;
            }
            if (response.status != 200) {
                web_error('@lang('lang.web.excuse_without')', response.message);
                return;
            }
            web_success('@lang('lang.web.success')', response.message);
        });
    })
</script>