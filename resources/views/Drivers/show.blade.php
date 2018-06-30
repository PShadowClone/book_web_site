@extends('base_layout._layout')
@section('style')
    <style>
        /*td.sorting_1{*/
        /*text-align: center !important;*/
        /*color: #438054;*/
        /*}*/
        /*td{*/
        /*text-align: center !important;*/
        /*} > span.disable*/
        tr > td:nth-child(4) {
            text-align: center !important;
        }

        tr > td:nth-child(5) {
            text-align: center !important;
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('driver.show')}}">@lang('driver.drivers')</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>@lang('lang.show')</span>
            </li>
        </ul>
    </div>
@endsection
@section('body')
    <div class="row">


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

                    <div class="col-md-12" style="padding:13px;margin-bottom: 15px">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input class="form-control" name="name" id="name" placeholder="@lang('driver.name')"/>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" name="phone" id="phone"
                                       placeholder="@lang('driver.mobile')"/>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" name="email" id="email"
                                       placeholder="@lang('driver.email')"/>
                            </div>
                            <div class="col-md-3">
                                <select name="status" id="status" class="bs-select form-control">
                                    <option value="-1">@lang('driver.status')</option>
                                    <option value="1">@lang('driver.active')</option>
                                    <option value="2">@lang('driver.inactive')</option>
                                </select>
                                <span class="error">{{$errors->first('status')}}</span>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="col-md-3">
                                <select id="area" class="bs-select form-control" name="area" data-live-search="true">
                                    <option value="-1" selected>@lang('driver.area')</option>
                                    @if(areas())
                                        @foreach(areas() as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="city" class="bs-select form-control " name="city" data-live-search="true">
                                    <option value="-1" selected>@lang('driver.city')</option>
                                    @if(cities())
                                        @foreach(cities() as $city)
                                            <option value="{{$city->id}}" data-area="{{$city->area_id}}"
                                                    style="display: none" >{{$city->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="quarter" class="bs-select form-control" name="quarter"
                                        data-live-search="true">
                                    <option value="-1" selected>@lang('driver.quarter')</option>
                                    @if(quarters())
                                        @foreach(quarters() as $quarter)
                                            <option value="{{$quarter->id}}" data-city="{{$quarter->cityId}}"
                                            style="display: none">{{$quarter->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="error">{{$errors->first('quarter')}}</span>
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
                    <i class="fa fa-car"></i>@lang('driver.drivers')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="driver"
                               width="100%">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>رقم الجوال</th>
                                <th>البريد الالكتروني</th>
                                <th>مفعل</th>
                                <th>التقييم</th>
                                <th>العملية</th>
                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    @includeIf('Drivers.scripts.show')

@endsection