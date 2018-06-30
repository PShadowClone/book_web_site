<div class="portlet-body">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <input id="offer_type_value" name="offer_type" type="hidden" value="{{BOOK_OFFER}}" />
                <a href="#book_offers" data-toggle="tab" id="book_offer_choice"> @lang('offer.book_offers') </a>
            </li>
            <li>
                <a href="#buy_offers" data-toggle="tab"  id="buy_offer_choice">  @lang('offer.buy_offers') </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="book_offers">
                @includeIf('Offer.partials.tabs.book_offers')
            </div>
            <div class="tab-pane" id="buy_offers">
                @includeIf('Offer.partials.tabs.buy_offers')
            </div>
        </div>
    </div>
</div>
<script>
    /**
     *
     * 1 => book_offer_choice
     * 2 => buy_offer_choice
     *
     */
    $('#book_offer_choice').click(function () {
        $('#offer_type_value').val('{{BOOK_OFFER}}')
    })
    $('#buy_offer_choice').click(function () {
        $('#offer_type_value').val('{{BUY_OFFER}}')
    })
</script>