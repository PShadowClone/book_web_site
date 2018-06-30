<div class="portlet-body">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#book_offers" data-toggle="tab"> @lang('offer.book_offers') </a>
            </li>
            <li>
                <a href="#buy_offers" data-toggle="tab">  @lang('offer.buy_offers') </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="book_offers">
                @includeIf('Offer.partials.update.tabs.book_offers')
            </div>
            <div class="tab-pane" id="buy_offers">
                @includeIf('Offer.partials.update.tabs.buy_offers')
            </div>
        </div>
    </div>

</div>
