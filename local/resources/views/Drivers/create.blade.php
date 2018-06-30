@extends('base_layout._layout')
@section('style')
    <style>
        .company{
            display: none;
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
                    <i class="fa fa-user-plus"></i>@lang('driver.addDriver')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-12">
                        <form id="driver" method="POST" action="{{route('driver.store')}}">
                            {{csrf_field()}}
                            <div class="col-md-12">

                                <div class="col-md-4"> <label for="name"></label>
                                    <input class="form-control" name="name" placeholder="@lang('admin.name')" value="{{old('name')}}">
                                    <span class="error">{{$errors->first('name')}}</span>

                                </div>
                                <div class="col-md-4"> <label for="email"></label>
                                    <input class="form-control" name="email" placeholder="@lang('admin.email')" value="{{old('email')}}">
                                    <span class="error">{{$errors->first('email')}}</span>

                                </div>
                                <div class="col-md-4">
                                    <label for="status"></label>
                                    <select name="status" id="status" class="bs-select form-control">
                                        <option value="1">@lang('lang.enable')</option>
                                        <option value="2">@lang('lang.disable')</option>
                                    </select>
                                    <span class="error">{{$errors->first('status')}}</span>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4"> <label for="password"></label>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="@lang('driver.password')">
                                    <span class="error">{{$errors->first('password')}}</span>

                                </div>
                                <div class="col-md-4"> <label for="confirm_password"></label>
                                    <input class="form-control" name="confirm_password" type="password" placeholder="@lang('driver.confirm_password')">
                                    <span class="error">{{$errors->first('confirm_password')}}</span>

                                </div>
                                <div class="col-md-4"> <label for="phone"></label>
                                    <input class="form-control" name="phone" placeholder="@lang('driver.phone')" value="{{old('phone')}}">
                                    <span class="error">{{$errors->first('phone')}}</span>

                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="single_company"></label>
                                    <select name="single_company" id="single_company" class="bs-select form-control">
                                        <option value="1">@lang('driver.single')</option>
                                        <option value="2">@lang('driver.company')</option>
                                    </select>
                                    <span class="error">{{$errors->first('single_company')}}</span>

                                </div>
                                <div class="col-md-4"> <label for="password"></label>
                                    <input class="form-control" name="inst_rate" id="inst_rate" type="text" placeholder="@lang('driver.inst_rate')">
                                    <span class="error">{{$errors->first('inst_rate')}}</span>

                                </div>
                                <div class="col-md-4 company"> <label for="company_phone"></label>
                                    <input class="form-control " name="company_phone" id="company_phone" type="text" placeholder="@lang('driver.company_phone')">
                                    <span class="error">{{$errors->first('company_phone')}}</span>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4 company"> <label for="company_email"></label>
                                    <input class="form-control " name="company_url" id="company_url" type="text" placeholder="@lang('driver.company_email')">
                                    <span class="error">{{$errors->first('company_email')}}</span>

                                </div>
                                <div class="col-md-4 company"> <label for="company_address"></label>
                                    <input class="form-control " name="company_address" id="company_address" type="text" placeholder="@lang('driver.company_address')">
                                    <span class="error">{{$errors->first('company_address')}}</span>

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
    @includeIf('Drivers.scripts.create')
@endsection