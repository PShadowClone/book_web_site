@extends('web_base_layout._layout')
@section('style')
    <style>
        .login-form-wrapper {
            direction: rtl;
        }

        .error {
            color: red
        }
    </style>
@endsection
@section('body')
    <section class="content account">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                    <div class="login-form-wrapper">
                        @if(session('success'))
                            <div class="col-md-12 alert-panel">
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            </div>
                        @endif
                        <form method="POST" id="user" action="{{route('web.register.action')}}">
                            <h3><i class="fa fa-user-plus" style="margin-left: 10px"></i> @lang('login.web.new_account')
                            </h3>
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>@lang('user.name')<span class="required">*</span></label>
                                <input type="text" class="form-control" name="name">
                                <span class="error">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group">
                                <label>@lang('user.email')<span class="required">*</span></label>
                                <input type="text" class="form-control" name="email">
                                <span class="error">{{$errors->first('email')}}</span>
                            </div>
                            <div class="form-group">
                                <label>@lang('user.phone')<span class="required">*</span></label>
                                <input type="text" class="form-control" name="phone">
                                <span class="error">{{$errors->first('phone')}}</span>
                            </div>
                            <div class="form-group">
                                <label>@lang('user.password')<span class="required">*</span></label>
                                <input type="password" class="form-control" name="password">
                                <span class="error">{{$errors->first('password')}}</span>
                            </div>
                            <div class="form-group">
                                <label>@lang('user.confirm_password')<span class="required">*</span></label>
                                <input type="password" class="form-control" name="confirm_password">
                                <span class="error">{{$errors->first('confirm_password')}}</span>
                            </div>
                            <button type="submit"
                                    class="btn btn-primary btn-lg btn-block">@lang('login.web.register')</button>
                        </form>
                    </div>
                    <p class="form-text">@lang('login.web.i_have_account') <a
                                href="{{route('web.login.show')}}">@lang('login.web.login')</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    {{--@includeIf('Login.web.scripts.register')--}}
@endsection