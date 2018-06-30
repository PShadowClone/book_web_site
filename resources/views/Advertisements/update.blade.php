@extends('base_layout._layout')
@section('style')
    <style>
        .datepicker-dropdown{
            margin-left: 29%;
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('ads.show')}}">@lang('ads.advertisements')</a>
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
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-tag"></i>@lang('ads.editAdvertisement')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-12">
                        <form id="ads" method="POST" action="{{route('ads.update' , ['id' => $advertisement->id])}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="col-md-12" style="text-align: center">

                                <div class="{{$advertisement->image ? 'fileinput fileinput-exists' : 'fileinput fileinput-new'}}"
                                     data-provides="fileinput">
                                    <div class="fileinput-new thumbnail"
                                         style="width: 200px; height: 150px;">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;">
                                        <img src="{{$advertisement->image ? URL::to('/').$advertisement->image  : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=".trans('book.no_image')}}"
                                             alt=""/>
                                    </div>
                                    <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> @lang('book.choose_image')</span>
                                                                <span class="fileinput-exists"> @lang('book.change') </span>
                                                                <input type="file" name="ads_image"></span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput"> @lang('book.remove') </a>
                                    </div>

                                    <label id="image-error" class="error"
                                           for="image">{{$errors->first('ads_image')}}</label>

                                </div>


                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label for="arrange"></label>
                                        <input name="arrange" class="form-control" placeholder="@lang('ads.arrange')"
                                               value="{{old('arrange') ? old('arrange') : $advertisement->arrange}}"/>
                                        <span class="error">{{$errors->first('arrange')}}</span>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="name"></label>
                                        <input name="content" class="form-control" placeholder="@lang('ads.content')"
                                               value="{{old('content') ? old('content') : $advertisement->content}}"/>
                                        <span class="error">{{$errors->first('content')}}</span>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="name"></label>
                                        <input name="contact_phone" class="form-control" placeholder="@lang('ads.contact_phone')"
                                               value="{{old('contact_phone') ? old('contact_phone') : $advertisement->contact_phone}}"/>
                                        <span class="error">{{$errors->first('contact_phone')}}</span>

                                    </div>
                                </div>
                                <div class="col-md-6">


                                    <div class="col-md-12" style="padding-left: 0;padding-right: 0">
                                        <div class="col-md-12 ">
                                            <label for="publish_date"></label>
                                            <div class="col-md-12 input-group date" >
                                                <input type="text" size="16" name="start_publish" id="start_publish"
                                                       class="form-control date-picker m-input"
                                                       data-date-format="{{DATE_FORMAT}}"
                                                       value="{{old('start_publish') ? old('start_publish') : ($advertisement->start_publish && trim($advertisement->start_publish) != '' ? explode(' ',$advertisement->start_publish)[0] :$advertisement->start_publish)}}"
                                                       placeholder="@lang('ads.start_publish')">
                                            </div>
                                            <span class="error">{{$errors->first('start_publish')}}</span>
                                        </div>

                                        <div class="col-md-12 ">
                                            <label for="publish_date"></label>
                                            <div class="col-md-12 input-group date" >
                                                <input type="text" size="16" name="end_publish" id="end_publish"
                                                       class="form-control date-picker m-input"
                                                       data-date-format="{{DATE_FORMAT}}"
                                                       value="{{old('end_publish') ? old('end_publish') : ($advertisement->end_publish && trim($advertisement->end_publish) != '' ? explode(' ',$advertisement->end_publish)[0] :$advertisement->end_publish)}}"
                                                       placeholder="@lang('ads.end_publish')">
                                            </div>
                                            <span class="error">{{$errors->first('end_publish')}}</span>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="col-md-12" style="margin-top: 15px; text-align: center">
                                <input type="submit" value="@lang('lang.submit')" class="btn btn-primary">
                                <input type="button" id="cancel" value="@lang('lang.reset')" class="btn btn-default">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @includeIf('Advertisements.scripts.update')
@endsection