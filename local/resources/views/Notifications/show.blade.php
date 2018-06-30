@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('ads.show')}}">@lang('notify.notifications')</a>
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
        /*tr > td:nth-child(2) {*/
            /*text-align: center !important;*/
        /*}*/

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
                    <i class="fa fa-send"></i>@lang('notify.sendNotification')
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
                            <div class="col-md-12">
                                <textarea class="form-control" name="content" id="content" rows="6" cols="11" placeholder="@lang('notify.sendNotification') ..." style="resize: none;"></textarea>
                            </div>

                            <div class="col-md-12" style="margin-top: 15px; padding-right: 0">
                               <div class="col-md-3">
                                   <select class="bs-select form-control" name="type" id="type">
                                       <option value="-1">@lang('notify.sentSide')</option>
                                       <option value="{{CLIENT_NOTIFICATION}}">@lang('notify.clients')</option>
                                       <option value="{{DRIVER_NOTIFICATION}}">@lang('notify.drivers')</option>
                                       <option value="{{LIBRARY_NOTIFICATION}}">@lang('notify.libraries')</option>
                                   </select>
                               </div>

                                <div class="col-md-6">
                                    <select class="bs-select" name="to" id="to" data-live-search="true">
                                        <option value="-1">@lang('notify.all')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 send-error" style="margin-top: 15px;display: none">
                                <div class="alert alert-danger">
                                    <strong>@lang('lang.error') ! </strong><span id="validation_msg"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px;text-align: left;padding-left: 30px">
                            <button class="btn btn-primary" name="send" id="send">@lang('notify.send')</button>
                            <button class="btn btn-default" name="cancel" id="cancel">@lang('lang.cancel')</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-send"></i>@lang('notify.notifications')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="notifications"
                               width="100%">
                            <thead>
                            <tr>
                                <th>نوع الجهة</th>
                                <th>الشخص المرسل اليه</th>
                                <th>المدير المرسل</th>
                                <th>تاريخ الارسال</th>
                                <th>وقت الارسال</th>
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
    @includeIf('Notifications.scripts.show')
@endsection