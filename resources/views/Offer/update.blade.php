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

        tr > td:nth-child(3) {
            text-align: center !important;
            font-size: 20px;
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
                <a href="{{route('offer.show')}}">@lang('offer.offers')</a>
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
        <form method="POST" action="{{route('offer.update',['id' => $offer->id])}}" id="offer">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i>@lang('offer.newOffer')
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
                                <input name="title" class="form-control" placeholder="@lang('offer.title')"
                                       value="{{old('title') ? old('title') : $offer->title}}"/>
                                <span class="error">{{$errors->first('title')}}</span>
                            </div>
                            <div class="col-md-3 ">
                                <label for="publish_date"></label>
                                <div class="col-md-12 input-group date input-icon right">
                                    <i class="fa fa-calendar"></i>
                                    <input type="text" size="16" name="start_date" id="start_date"
                                           value="{{old('start_date') ? old('start_date') : (sizeof(explode(' ',$offer->start_date)) > 0 ? explode(' ',$offer->start_date)[0] :'') }}"
                                           class="form-control date-picker m-input" data-date-format="{{DATE_FORMAT}}"
                                           placeholder="@lang('offer.start_date')">
                                </div>
                                <span class="error">{{$errors->first('start_date')}}</span>
                            </div>
                            <div class="col-md-3 ">
                                <label for="publish_date"></label>
                                <div class="col-md-12 input-group date input-icon right">
                                    <i class="fa fa-calendar"></i>

                                    <input type="text" size="16" name="expire_date" id="expire_date"
                                           value="{{old('expire_date') ? old('expire_date') : (sizeof(explode(' ',$offer->expire_date)) > 0 ? explode(' ',$offer->expire_date)[0] :'') }}"
                                           class="form-control date-picker m-input" data-date-format="{{DATE_FORMAT}}"
                                           placeholder="@lang('offer.expire_date')">
                                </div>
                                <span class="error">{{$errors->first('expire_date')}}</span>
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
                        <i class="fa fa-book"></i>@lang('offer.offer_details')
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">
                        @includeIf('Offer.partials.update.add_book')
                        @includeIf('Offer.partials.update.master_tab')
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('scripts')
    @includeIf('Offer.scripts.update')
@endsection