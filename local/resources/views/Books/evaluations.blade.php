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
        tr > td:nth-child(4){
            text-align: center !important;
        }
        tr > td:nth-child(5){
            text-align: center !important;
        }
        .rating-rtl{
            float: initial;
        }
        .datepicker.datepicker-dropdown{
            left: 9%;
        }

        /*.filled-stars{*/
        /*width: ;*/
        /*}*/
    </style>
@endsection
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('book.show')}}">@lang('book.books')</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li class="breadcrumb-item">
                <a href="#">@lang('driver.evaluations')</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>@lang('book.book')</span> : <span> {{$book->name}}</span>
            </li>
        </ul>
    </div>
@endsection
@section('body')
    <div class="row" >
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
                        <div class="col-md-12" style="text-align: center;padding: 15px;font-size: 17px">
                            <span class="">@lang('request.totalEvaluations')</span> : <span style="font-weight: bold"> {{number_format($book['evaluations'] , 2,'.',',') }} </span>  <input type="text" class="kv-gly-star rating-loading" value="{{$book['evaluations']}}" dir="rtl" data-size="xs" title="" disabled>
                        </div>
                        <div class="col-md-12" >
                            <div class="col-md-3">
                                <input class="form-control" name="request_identifier"  id="request_identifier" placeholder="@lang('request.request_identifier')" />
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" name="client_name"  id="client_name" placeholder="@lang('request.client_name')" />
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" name="client_phone"  id="client_phone" placeholder="@lang('request.client_phone')" />
                            </div>
                            <div class="col-md-3">
                                <div class="input-group date-picker input-daterange" data-date="10/11/2012"
                                     data-date-format="yyyy-mm-dd" style="width: 100%;">
                                    <input type="text" class="form-control" name="from" id="from" placeholder="@lang('request.created_at')" style="text-align: right">
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
                    <i class="fa fa-star"></i>@lang('driver.evaluations')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="evaluation"
                               width="100%">
                            <thead>
                            <tr>
                                <th>معرف الطلب</th>
                                <th>اسم العميل</th>
                                <th>تاريخ الطلب</th>
                                <th>تاريخ التسليم</th>
                                <th>التعليق</th>
                                <th>التقييم</th>
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
    @includeIf('Books.scripts.evaluations')

@endsection