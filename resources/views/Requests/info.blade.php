{{--{{dd($userRequest)}}--}}
@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('request.show')}}">@lang('request.requests')</a>
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

        @if($userRequest['client'])
            <div class="{{$userRequest['driver'] ? 'col-md-6'  :  'col-md-12' }}">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>@lang('request.client')
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
                                        <span><span>{{$userRequest['client']->name}} </span>: @lang('request.client_name') </span>
                                    </div>
                                    <div class="col-md-12" style="direction: ltr;text-align: right">
                                        <span> <span>{{$userRequest['client']->phone}}</span>  : @lang('request.client_phone')</span>
                                    </div>
                                    <div class="col-md-12" style="text-align: right;direction: ltr">
                                        <span> {{$userRequest['client']->email}} : @lang('request.client_email')</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @endif

        @if($userRequest['driver'])
            <div class="{{$userRequest['client'] ? 'col-md-6'  :  'col-md-12' }}">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>@lang('request.driver')
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="" class="fullscreen"> </a>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="row">

                            <div class="col-md-12" style="padding:10px;margin-bottom: 15px;font-size: 17px">

                                <div class="col-md-12" style="line-height: 2;direction: ltr">
                                    <div class="col-md-12" style="text-align: right">
                                        <span><span>{{$userRequest['driver']->name}} </span>: @lang('request.driver_name') </span>
                                    </div>
                                    <div class="col-md-12" style="direction: ltr;text-align: right">
                                        <span> <span>{{$userRequest['driver']->phone}}</span>  : @lang('request.driver_phone')</span>
                                    </div>
                                    <div class="col-md-12" style="text-align: right;direction: ltr;">
                                        <span> <span>{{$userRequest['driver']->email}}</span> : @lang('request.driver_phone')</span>
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
                        <i class="fa fa-search"></i>@lang('request.request_info')
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12" style="font-size: 17px;line-height: 2;direction: ltr;text-align: right">
                            <div class="col-md-12">
                                <span>{{$userRequest->request_identifier}} : @lang('request.request_identifier')</span>
                            </div>
                            <div class="col-md-12">
                                <span> @lang('request.status') : {{request_status($userRequest->status)}} </span>
                            </div>
                            <div class="col-md-12" dir="rtl" style="dir: ltr !important;" >
                                <span> @lang('request.book_title') :  </span>
                                <span>
                                    لا يوجد
                                    {{--{{$userRequest->book ? $userRequest->book->name : 'لا يوجد'}}--}}
                                </span>
                            </div>
                            <div class="col-md-12">
                                <span>{{$userRequest->book_amount}} : @lang('request.book_amount')</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-map"></i>@lang('request.map')
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row" style="padding-right: 27px;padding-left: 27px">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        @includeIf('Books.modals.image_view')
        @includeIf('Books.modals.change_amount')
    </div>
@endsection
@section('scripts')
    @includeIf('Requests.scripts.info')

@endsection