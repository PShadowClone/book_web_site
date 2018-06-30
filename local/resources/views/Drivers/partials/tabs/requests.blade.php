<div class="row" style="">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-search"></i>@lang('lang.search')
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="" class="fullscreen"> </a>
            </div>

        </div>
        <div class="portlet-body" id="library_requests">
            <div class="row">

                <div class="col-md-12" style="padding:10px;margin-bottom: 15px">

                    <div class="col-md-12">
                        <div class="col-md-3">
                            <input class="form-control" name="request_identifier" id="request_identifier"
                                   placeholder="@lang('request.request_identifier')"/>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="client" id="request_client"
                                   placeholder="@lang('request.client_phone_name')"/>
                        </div>
                        <div class="col-md-3" style="display: none">
                            <input class="form-control" name="driver" id="request_driver"
                                   placeholder="@lang('request.driver_phone_name')"/>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="giver" id="request_giver"
                                   placeholder="@lang('request.giver_phone_name')"/>
                        </div>
                        <div class="col-md-3">
                            <select name="request_status" id="request_status" class="bs-select form-control"
                                    data-live-search="true">
                                <option value="-1">@lang('request.status')</option>
                                @includeIf('Requests.partials.status')
                            </select>
                        </div>

                    </div>
                    <div class="col-md-12" style="margin-top: 10px">

                        <div class="col-md-3">
                            <select name="category_id" id="request_category_id" class="bs-select form-control"
                                    data-live-search="true">
                                <option value="-1">@lang('category.category')</option>
                                @if(categories())
                                    @foreach(categories() as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group date-picker input-daterange" data-date="10/11/2012"
                                 data-date-format="yyyy-mm-dd" style="width: 100%;">
                                <input type="text" class="form-control" name="from" id="request_from"
                                       placeholder="@lang('request.created_at')">
                                <span class="input-group-addon"> @lang('request.to') </span>
                                <input type="text" class="form-control" name="to" id="request_to"
                                       placeholder="@lang('request.delivery_time')">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;text-align: left;padding-left: 30px">
                        <span class="btn btn-primary" name="search" id="search">@lang('lang.search')</span>
                        <span class="btn btn-default" name="cancel_search"
                              id="cancel_search">@lang('lang.cancel')</span>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-book"></i>@lang('request.requests')
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="" class="fullscreen"> </a>
            </div>

        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12" style="padding: 10px;">
                    <table class="table table-striped table-bordered table-hover dt-responsive" id="request"
                           width="100%">
                        <thead>
                        <tr>
                            <th>معرف الطلب</th>
                            <th>العميل</th>
                            <th>السائق</th>
                            <th>تاريخ الطلب</th>
                            <th>تاريخ التسليم</th>
                            <th>الحالة</th>
                            <th>العملية</th>
                        </tr>
                        </thead>
                    </table>
                </div>


            </div>
        </div>
    </div>
    @includeIf('Books.modals.image_view')
    @includeIf('Books.modals.change_amount')
</div>