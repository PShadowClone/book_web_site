@extends('base_layout._layout')
@if(!$company)
@section('style')
    <style>
        .company {
            display: none;
        }

        li.active{
            border-top: 3px solid #34c7d4 !important;
        }
    </style>
@endsection
@endif

@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('driver.show')}}">@lang('driver.drivers')</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>@lang('lang.edit')</span>
            </li>
        </ul>
    </div>
@endsection



@section('body')
    <div class="row">
        <form id="driver" method="POST" action="{{route('driver.update' , ['id' => $driver->id])}}">
            {{csrf_field()}}

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user"></i>@lang('driver.editDriver')
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="col-md-12">

                            <div class="col-md-4"><label for="name"></label>
                                <input class="form-control" name="name" placeholder="@lang('driver.name')"
                                       value="{{old('name') ?old('name')  : $driver->name }}">
                                <span class="error">{{$errors->first('name')}}</span>

                            </div>
                            <div class="col-md-4"><label for="email"></label>
                                <input class="form-control" name="email" placeholder="@lang('driver.email')"
                                       value="{{old('email') ? old('email') :$driver->email}}">
                                <span class="error">{{$errors->first('email')}}</span>

                            </div>
                            <div class="col-md-4">
                                <label for="status"></label>
                                <select name="status" id="status" class="bs-select form-control">
                                    <option value="1" {{$driver->status == ACTIVE ? 'selected' : ''}}>@lang('lang.enable')</option>
                                    <option value="2" {{$driver->status == INACTIVE ? 'selected' : ''}}>@lang('lang.disable')</option>
                                </select>
                                <span class="error">{{$errors->first('status')}}</span>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4"><label for="password"></label>
                                <input class="form-control" name="password" id="password" type="password"
                                       placeholder="@lang('driver.password')">
                                <span class="error">{{$errors->first('password')}}</span>

                            </div>
                            <div class="col-md-4"><label for="confirm_password"></label>
                                <input class="form-control" name="confirm_password" type="password"
                                       placeholder="@lang('driver.confirm_password')">
                                <span class="error">{{$errors->first('confirm_password')}}</span>

                            </div>
                            <div class="col-md-4"><label for="phone"></label>
                                <input class="form-control" name="phone" placeholder="@lang('driver.phone')"
                                       value="{{old('phone') ?old('phone')  :$driver->phone }}">
                                <span class="error">{{$errors->first('phone')}}</span>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label for="single_company"></label>
                                <select name="single_company" id="single_company" class="bs-select form-control">
                                    <option value="1" {{$driver->status == SINGLE_TYPE ? 'selected' : ''}}>@lang('driver.single')</option>
                                    <option value="2" {{$driver->status == COMPANY_TYPE ? 'selected' : ''}}>@lang('driver.company')</option>
                                </select>
                                <span class="error">{{$errors->first('single_company')}}</span>

                            </div>

                            <div class="col-md-4"><label for="password"></label>
                                <input class="form-control" name="instRate" id="instRate" type="text"
                                       placeholder="@lang('driver.inst_rate')"
                                       value="{{old('instRate') ?old('instRate')  :$driver->instRate }}">
                                <span class="error">{{$errors->first('instRate')}}</span>

                            </div>
                            @if($company)
                                <div class="col-md-4 company"><label for="company_phone"></label>
                                    <input class="form-control " name="company_phone" id="company_phone" type="text"
                                           placeholder="@lang('driver.company_phone')"
                                           value="{{old('company_phone') ?old('company_phone')  :$company->phone }}">
                                    <span class="error">{{$errors->first('company_phone')}}</span>

                                </div>
                            @endif
                        </div>
                        @if($company)
                            <div class="col-md-12">
                                <div class="col-md-4 company"><label for="company_email"></label>
                                    <input class="form-control " name="company_url" id="company_email" type="text"
                                           placeholder="@lang('driver.company_email')"
                                           value="{{old('company_url') ?old('company_url')  :$company->email }}">
                                    <span class="error">{{$errors->first('company_url')}}</span>

                                </div>
                                <div class="col-md-4 company"><label for="company_address"></label>
                                    <input class="form-control " name="company_address" id="company_address" type="text"
                                           placeholder="@lang('driver.company_address')"
                                           value="{{old('company_address') ?old('company_address')  :$company->address }}">
                                    <span class="error">{{$errors->first('company_address')}}</span>

                                </div>
                            </div>
                        @endif
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
                        <i class="fa fa-cogs"></i>@lang('driver.properties')
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="col-md-12" style="margin-top: 15px">
                            @includeIf('Drivers.partials.master_tab')
                        </div>
                    </div>
                </div>
            </div>

            @includeIf('Drivers.partials.models.add_payment')
            @includeIf('Drivers.partials.models.edit_payment')
            @includeIf('Drivers.partials.models.add_areas')
        </form>

    </div>
@endsection
@section('scripts')
    @includeIf('Drivers.scripts.update')
    @includeIf('Drivers.scripts.requests')
@endsection