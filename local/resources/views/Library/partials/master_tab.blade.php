<div class="portlet-body">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#map_section" data-toggle="tab"> @lang('library.map') </a>
            </li>
            <li>
                <a href="#instProfit" data-toggle="tab">  @lang('library.instProfit') </a>
            </li>
            <li>
                <a href="#requests" data-toggle="tab">@lang('library.requests')</a>
            </li>
            <li>
                <a href="#requestsForConfirming" data-toggle="tab">@lang('library.requestsForConfirming')</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="map_section">
                @includeIf('Library.partials.library_map')
            </div>
            <div class="tab-pane" id="instProfit">
                @includeIf('Library.partials.inst_profit')
            </div>
            <div class="tab-pane" id="requests" style="padding: 30px;">
                @includeIf('Library.partials.library_requests')
            </div>
            <div class="tab-pane" id="requestsForConfirming" style="padding: 30px;">
                @includeIf('Library.partials.library_requests_for_confirming')
            </div>
        </div>
    </div>

</div>
