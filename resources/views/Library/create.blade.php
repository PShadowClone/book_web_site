@extends('base_layout._layout')
@section('style')
    <style>
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
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('library.show')}}">@lang('library.libraries')</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>@lang('lang.add')</span>
            </li>
        </ul>
    </div>
@endsection
@section('body')
    <div class="row">
        <form method="POST" action="{{route('library.create')}}" id="library">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i>@lang('library.addLibrary')
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">
                        {{csrf_field()}}
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input name="name" class="form-control" placeholder="@lang('library.name')"/>
                                <span class="error">{{$errors->first('name')}}</span>
                            </div>
                            <div class="col-md-3">
                                <input name="phone" class="form-control" placeholder="@lang('library.phone')"/>
                                <span class="error">{{$errors->first('phone')}}</span>
                            </div>
                            <div class="col-md-3">
                                <input name="mobile" class="form-control" placeholder="@lang('library.mobile')"/>
                                <span class="error">{{$errors->first('mobile')}}</span>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="bs-select form-control">
                                    <option value="1">@lang('library.active')</option>
                                    <option value="2">@lang('library.inactive')</option>
                                </select>
                                <span class="error">{{$errors->first('status')}}</span>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="col-md-3">
                                <input id="password" name="password" class="form-control"
                                       placeholder="@lang('library.password')" type="password"/>
                                <span class="error">{{$errors->first('password')}}</span>
                            </div>
                            <div class="col-md-3">
                                <input name="confirm_password" class="form-control"
                                       placeholder="@lang('library.confirm_password')" type="password"/>
                                <span class="error">{{$errors->first('confirm_password')}}</span>
                            </div>
                            <div class="col-md-3">
                                <input name="email" class="form-control" placeholder="@lang('library.email')"/>
                                <span class="error">{{$errors->first('email')}}</span>
                            </div>
                            <div class="col-md-3">
                                <input name="address" class="form-control" placeholder="@lang('library.address')"/>
                                <span class="error">{{$errors->first('address')}}</span>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="col-md-3">
                                <select id="area" class="bs-select form-control" name="area"
                                        data-live-search="true">
                                    <option value="-1" selected>@lang('library.area')</option>
                                    @if($areas)
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="city" class="bs-select form-control " name="city"
                                        data-live-search="true">
                                    <option value="-1" selected>@lang('library.city')</option>
                                    @if($cities)
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}"
                                                    data-area="{{$city->area_id}}"
                                                    style="display: none">{{$city->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="quarter" class="bs-select form-control" name="quarter"
                                        data-live-search="true">
                                    <option value="-1" selected>@lang('library.quarter')</option>
                                    @if($quarters)
                                        @foreach($quarters as $quarter)
                                            <option value="{{$quarter->id}}"
                                                    data-city="{{$quarter->cityId}}"
                                                    style="display: none">{{$quarter->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="error">{{$errors->first('quarter')}}</span>
                            </div>
                            <div class="col-md-3">
                                <input id="inst_profit_rate" name="inst_profit_rate" class="form-control"
                                       placeholder="@lang('library.inst_profit_rate')"/>
                                <span class="error">{{$errors->first('inst_profit_rate')}}</span>
                            </div>
                            <div class="col-md-3">
                                <input id="longitude" name="longitude" class="form-control" type="hidden"
                                       value="{{LOCATION_LONG}}"/>
                                <input id="latitude" name="latitude" class="form-control" type="hidden"
                                       value="{{LOCATION_LAT}}"/>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="col-md-12">
                                <input id="commercial_record" name="commercial_record" class="form-control"
                                       placeholder="@lang('library.commercial_record')"/>
                            </div>

                        </div>

                        <div class="col-md-12" style="margin-top: 15px; text-align: center">
                            <input type="submit" value="@lang('lang.submit')" class="btn btn-primary">
                            <input type="button" id="cancel" value="@lang('lang.reset')" class="btn btn-default">
                        </div>


                    </div>
                </div>
            </div>


            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-map"></i>@lang('library.map')
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="col-md-12 map-style" style="margin-top: 20px">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection
@section('scripts')
    @includeIf('Library.scripts.create')
@endsection