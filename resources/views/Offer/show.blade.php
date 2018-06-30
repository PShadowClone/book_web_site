@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('offer.show')}}">@lang('offer.offers')</a>
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

        .datepicker-rtl {
            left: auto !important;
        }
    </style>
@endsection
@section('body')
    <div class="row" style="">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-send"></i>@lang('offer.offers')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="offers"
                               width="100%">
                            <thead>
                            <tr>
                                <th>الرتيب</th>
                                <th>العنوان</th>
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
    @includeIf('Offer.scripts.show')
@endsection