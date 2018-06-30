@extends('base_layout._layout')
@section('style')
    <style>
        tr > td:nth-child(4){
            text-align: center !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('client.show')}}">@lang('client.clients')</a>
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
                        <div class="col-md-12" >
                            <div class="col-md-4">
                                <input class="form-control" name="name"  id="name" placeholder="@lang('admin.name')" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" name="phone"  id="phone" placeholder="@lang('client.phone')" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" name="email"  id="email" placeholder="@lang('admin.email')" />
                            </div>
                        </div>
                        <div class="col-md-12">

                        </div>
                        <div class="col-md-12" style="margin-top: 15px;text-align: left;padding-left: 30px">
                            <div class="col-md-4" style="padding-left: 10px">
                                <select name="status" id="status" class="bs-select form-control">
                                    <option value="-1">@lang('driver.status')</option>
                                    <option value="1">@lang('driver.active')</option>
                                    <option value="2">@lang('driver.inactive')</option>
                                </select>
                            </div>

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
                    <i class="fa fa-users"></i>@lang('client.clients')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="clients"
                               width="100%">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>رقم الجوال</th>
                                <th>البريد الالكتروني</th>
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
@endsection
@section('scripts')
    @includeIf('Clients.scripts.show')

@endsection