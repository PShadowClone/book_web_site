@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('ads.show')}}">@lang('ads.advertisements')</a>
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
        tr > td {
            text-align: center !important;
        }

        .datepicker-dropdown {
            left: 500px;
        }

        .datepicker-rtl{
            left: auto !important;
        }
    </style>
@endsection
@section('body')
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
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-12" style="padding:10px;margin-bottom: 15px">

                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input class="form-control" name="request_identifier" id="contact_phone"
                                       placeholder="@lang('ads.contact_phone')"/>
                            </div>

                            <div class="col-md-9">
                                <div class="input-group date-picker input-daterange" data-date="10/11/2012"
                                     data-date-format="yyyy-mm-dd" style="width: 100%;">
                                    <input type="text" class="form-control" name="start_publish" id="start_publish" placeholder="@lang('ads.start_publish_from')">
                                    <span class="input-group-addon"> @lang('request.to') </span>
                                    <input type="text" class="form-control" name="end_publish" id="end_publish" placeholder="@lang('request.to')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px;text-align: left;padding-left: 30px">
                            <button class="btn btn-primary" name="search" id="search">@lang('lang.search')</button>
                            <button class="btn btn-default" name="cancel" id="cancel">@lang('lang.cancel')</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-tags"></i>@lang('ads.advertisements')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="ads"
                               width="100%">
                            <thead>
                            <tr>
                                <th>الترتيب</th>
                                <th>الاعلان</th>
                                <th>رقم الجوال للاتصال</th>
                                <th>تاريخ بداية النشر</th>
                                <th>تاريخ نهاية النشر</th>
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
@endsection
@section('scripts')
    @includeIf('Advertisements.scripts.show')

@endsection