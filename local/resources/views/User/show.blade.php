{{--{{dd($userRequest)}}--}}
@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route($user->type == CLIENT ? 'client.show' : 'driver.show')}}">@if($user->type == CLIENT) @lang('client.clients') @else  @lang('driver.drivers') @endif</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>@lang('lang.show')</span>
            </li>
        </ul>
    </div>
@endsection
@section('style')
    <style>
        tr > td:nth-child(2) {
            text-align: center !important;
        }

        .datepicker-dropdown {
            left: 500px;
        }

        #map {
            height: 550px;
            width: 100%;
        }

        .map-style {
            padding-left: 31px !important;
            padding-right: 32px !important;
        }
    </style>
@endsection
@section('body')
    <div class="row" style="">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user"></i>@if($user->type == CLIENT) @lang('client.client') @else  @lang('driver.driver') @endif
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12" style="padding:10px;margin-bottom: 15px;font-size: 17px">

                            <div class="col-md-12" style="line-height: 2; ">
                                <div class="col-md-12" style="text-align: right;;direction: ltr">
                                    <span><span> </span>{{$user->name}} : @lang('user.name') </span>
                                </div>
                                @if($user->user_name)
                                    <div class="col-md-12" style="direction: ltr;text-align: right">
                                        <span> <span></span>{{$user->user_name}} : @lang('user.user_name')</span>
                                    </div>
                                @endif
                                <div class="col-md-12" style="text-align: right;direction: ltr">
                                    <span> {{$user->email}} : @lang('user.email')</span>
                                </div>
                                <div class="col-md-12" style="text-align: right;direction: ltr">
                                    <span> {{$user->phone}} : @lang('user.phone')</span>
                                </div>
                                @if($user->mobile)
                                    <div class="col-md-12" style="direction: ltr;text-align: right">
                                        <span> <span></span>{{$user->mobile}} : @lang('user.mobile')</span>
                                    </div>
                                @endif
                                @if($user->type == CLIENT)
                                    <div class="col-md-12" style="direction: ltr;text-align: right">
                                        <span><span></span> {{$user->client_requests->count()}}
                                            : @lang('user.requests_count')</span>
                                    </div>
                                @endif
                                @if($user->type == DRIVER)
                                    <div class="col-md-12" style="direction: ltr;text-align: right">
                                        <span><span></span> {{$user->driver_requests->count()}}
                                            : @lang('user.requests_count')</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if($user->type == DRIVER)
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-building"></i>@lang('user.company_details')
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="" class="fullscreen"> </a>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12" style="padding:10px;margin-bottom: 15px;font-size: 17px">

                                <div class="col-md-12" style="line-height: 2; ">
                                    <div class="col-md-12" style="text-align: right;;direction: ltr">
                                        <span><span> </span> % {{$user->instRate}} : @lang('user.instRate') </span>
                                    </div>
                                    @if($user->company)
                                        <div class="col-md-12" style="text-align: right;;direction: ltr">
                                            <span><span> </span> {{$user->company->email}} : @lang('user.company_email') </span>
                                        </div>
                                        <div class="col-md-12" style="text-align: right;;direction: ltr">
                                            <span><span> </span> {{$user->company->phone}} : @lang('user.company_phone') </span>
                                        </div>
                                        <div class="col-md-12" style="text-align: right;;direction: ltr">
                                            <span><span> </span> {{$user->company->address}}
                                                : @lang('user.company_address') </span>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-12" style="display: none">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-money"></i>@lang('user.payments_details')
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="" class="fullscreen"> </a>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12" style="margin-bottom: 10px;margin-right: 30px"><span
                                            class="btn btn-primary" data-toggle="modal"
                                            data-target="#profitsForm">@lang('library.add_profits')</span></div>

                                <div class="col-md-8">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-hover dt-responsive"
                                                   id="inst_profits_table"
                                                   width="100%">
                                                <thead>
                                                <tr>
                                                    <th>المبلغ</th>
                                                    <th>طريقة التسديد</th>
                                                    <th>التاريخ</th>
                                                    <th>الوقت</th>
                                                    <th>العملية</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"
                                     style="line-height: 2; font-size: 15px; border:1px solid #cccccc;padding:5px;margin-top: 12px">
                                    <div class="col-md-12">
                                        <div class="col-md-4 money">@lang('driver.totalSales'):</div>
                                        <div class="col-md-4 ">{{number_format($user ? $user->total_profits : 00.00,2,'.','')}}
                                            ريال
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4 money">@lang('driver.instProfit'):</div>
                                        <div class="col-md-4 ">{{number_format($user->instProfits,2,'.','')}} ريال</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3 money">@lang('driver.beenPayed'):</div>
                                        <div class="col-md-4">{{number_format($instPayedProfits,2,'.','')}} ريال</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4 money">@lang('driver.reset'):</div>
                                        <div class="col-md-4 ">{{number_format($user->resetPayment,2,'.','')}}ريال
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3 money">@lang('driver.pureProfits'):</div>
                                        <div class="col-md-4 ">{{number_format($pureProfits,2,'.','')}} ريال</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="col-md-12">
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
                    <div class="row" style="padding-left: 38px;padding-right: 38px;">

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
                            <div class="portlet-body">
                                <div class="row">

                                    <div class="col-md-12" style="padding:10px;margin-bottom: 15px">

                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <input class="form-control" name="request_identifier"
                                                       id="request_identifier"
                                                       placeholder="@lang('request.request_identifier')"/>
                                            </div>
                                            @if($user->type == DRIVER)
                                                <div class="col-md-3">
                                                    <input class="form-control" name="client" id="client"
                                                           placeholder="@lang('request.client_phone_name')"/>
                                                </div>
                                            @endif
                                            @if($user->type == CLIENT)
                                                <div class="col-md-3">
                                                    <input class="form-control" name="driver" id="driver"
                                                           placeholder="@lang('request.driver_phone_name')"/>
                                                </div>
                                            @endif
                                            <div class="col-md-3" style="display: none">
                                                <input class="form-control" name="giver" id="giver"
                                                       placeholder="@lang('request.giver_phone_name')"/>
                                            </div>


                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px">
                                            <div class="col-md-3">
                                                <select name="status" id="status" class="bs-select form-control"
                                                        data-live-search="true">
                                                    <option value="-1">@lang('request.status')</option>
                                                    @includeIf('Requests.partials.status')
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="category_id" id="category_id"
                                                        class="bs-select form-control"
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
                                                <div class="input-group date-picker input-daterange"
                                                     data-date="10/11/2012"
                                                     data-date-format="yyyy-mm-dd" style="width: 100%;">
                                                    <input type="text" class="form-control" name="from" id="from"
                                                           placeholder="@lang('request.created_at')">
                                                    <span class="input-group-addon"> @lang('request.to') </span>
                                                    <input type="text" class="form-control" name="to" id="to"
                                                           placeholder="@lang('request.delivery_time')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"
                                             style="margin-top: 15px;text-align: left;padding-left: 30px">
                                            <button class="btn btn-primary" name="search"
                                                    id="search_request">@lang('lang.search')</button>
                                            <button class="btn btn-default" name="cancel"
                                                    id="cancel_request">@lang('lang.cancel')</button>
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
                                        <table class="table table-striped table-bordered table-hover dt-responsive"
                                               id="request"
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
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    @includeIf('User.scripts.show')
    @includeIf('User.scripts.requests')
@endsection