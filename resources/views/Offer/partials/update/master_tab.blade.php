<div class="portlet-body">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="{{ strval($offer->type) == BOOK_OFFER  ?  'active' : ''}}">
                <input id="offer_type_value" name="offer_type" type="hidden" value="{{$offer->type == "3" || $offer->type == BOOK_OFFER ? ''.BOOK_OFFER : $offer->type}}"/>
                <a href="#book_offers" data-toggle="tab" id="book_offer_choice"> @lang('offer.book_offers') </a>
            </li>
            <li class="{{strval($offer->type) == BUY_OFFER ? 'active' : ''}}">
                <a href="#buy_offers" data-toggle="tab" id="buy_offer_choice">  @lang('offer.buy_offers') </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane {{$offer->type == BOOK_OFFER || $offer->type == "3" ? 'active' : ''}}" id="book_offers">
                @includeIf('Offer.partials.update.tabs.book_offers')
            </div>
            <div class="tab-pane {{$offer->type == BUY_OFFER ? 'active' : ''}}" id="buy_offers">
                @includeIf('Offer.partials.update.tabs.buy_offers')
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