<div class="portlet-body">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#instProfit" data-toggle="tab">  @lang('driver.instProfit') </a>
            </li>
            <li>
                <a href="#areas" data-toggle="tab">@lang('driver.areas')</a>
            </li>
            <li>
                <a href="#requests" data-toggle="tab">@lang('request.requests')</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="instProfit">
                @includeIf('Drivers.partials.tabs.inst_rate')
            </div>
            <div class="tab-pane" id="areas">
                @includeIf('Drivers.partials.tabs.driver_areas')
            </div>
            <div class="tab-pane" id="requests">
                @includeIf('Drivers.partials.tabs.requests')
            </div>
        </div>
    </div>

</div>
