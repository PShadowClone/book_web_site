@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.show')}}">@lang('admin.admins')</a>
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


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>@lang('admin.editAdmin')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="admin" method="Post" action="{{route('admin.update')}}/{{$admin->id}}">
                            {{csrf_field()}}
                            <div class="col-md-12">

                                <div class="col-md-4"><label for="name"></label>
                                    <input class="form-control" name="name" placeholder="@lang('admin.name')"
                                           value="{{$admin->name}}">
                                    <span class="error">{{$errors->first('name')}}</span>

                                </div>
                                <div class="col-md-4"><label for="username"></label>
                                    <input class="form-control" name="username" placeholder="@lang('admin.username')"
                                           value="{{$admin->username}}" disabled="disabled">
                                    <span class="error">{{$errors->first('username')}}</span>
                                </div>
                                <div class="col-md-4"><label for="email"></label>
                                    <input class="form-control" name="email" placeholder="@lang('admin.email')"
                                           value="{{$admin->email}}">
                                    <span class="error">{{$errors->first('email')}}</span>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4"><label for="password"></label>
                                    <input class="form-control" name="password" id="password" type="password"
                                           placeholder="@lang('admin.password')">
                                    <span class="error">{{$errors->first('password')}}</span>

                                </div>
                                <div class="col-md-4"><label for="confirm_password"></label>
                                    <input class="form-control" name="confirm_password" type="password"
                                           placeholder="@lang('admin.confirm_password')">
                                    <span class="error">{{$errors->first('confirm_password')}}</span>

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
    @includeIf('Admin.scripts.update')
@endsection