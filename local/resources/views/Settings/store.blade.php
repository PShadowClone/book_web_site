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

        .datepicker-rtl {
            left: auto !important;
        }

        /*.datepicker-orient-left{*/
        /*left: 409.5px !important;*/
        /*}*/
    </style>
@endsection
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('library.show')}}">@lang('setting.settings')</a>
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
        <form method="POST" action="{{route('setting.store')}}" id="setting">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i>@lang('setting.discounts')
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
                                <label for="name"></label>
                                <input name="in_city" class="form-control" placeholder="@lang('setting.in_city')"
                                       value="{{old('in_city') ? old('in_city') : (!system_discount() ? 0 : system_discount()->in_city ) }}"/>
                                <span class="error">{{$errors->first('in_city')}}</span>
                            </div>
                            <div class="col-md-3">
                                <label for="name"></label>
                                <input name="out_city" class="form-control" placeholder="@lang('setting.out_city')"
                                       value="{{old('out_city') ? old('out_city') : (!system_discount() ? 0 : system_discount()->out_city ) }}"/>
                                <span class="error">{{$errors->first('out_city')}}</span>
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
                        <i class="fa fa-book"></i>@lang('setting.promocodes')
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
                                <div class="col-md-6">
                                    <input class="form-control" name="code" id="code"
                                           placeholder="@lang('setting.code') ..."
                                           style="resize: none;"/>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" name="client" id="client"
                                           placeholder="@lang('setting.client_name') ..."
                                           style="resize: none;"/>
                                </div>
                            </div>


                            <div class="col-md-12" style="margin-top: 15px;text-align: left;padding-left: 15px">
                                <a class="btn btn-primary" name="send" id="search">@lang('lang.search')</a>
                                <a class="btn btn-default" name="cancel" id="cancelSearch">@lang('lang.cancel')</a>
                            </div>
                            <div class="col-md-12" style="padding: 10px;">
                                <a class="btn btn-primary" name="addPromoCode"
                                   id="addPromoCode" data-toggle="modal"
                                   data-target="#promoModal">@lang('setting.addPromoCode')</a>
                                <table class="table table-striped table-bordered table-hover dt-responsive"
                                       id="promocodes"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>الرقم</th>
                                        <th>نسبة التخفيض</th>
                                        <th>المدير</th>
                                        <th>العملية</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="col-md-12 send-error" style="margin-top: 15px;display: none">
                                <div class="alert alert-danger">
                                    <strong>@lang('lang.error') ! </strong><span id="validation_msg"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>

        @includeIf('Settings.modals.save_promocode')
    </div>

@endsection
@section('scripts')
    @includeIf('Settings.scripts.store')
@endsection