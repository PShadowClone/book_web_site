@extends('web_base_layout._layout')
@section('style')
    <style>
        .login-form-wrapper {
            direction: rtl;
        }
    </style>
@endsection
@section('body')
    <section class="content account">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                    <div class="login-form-wrapper">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        <form action="{{route('web.login.action')}}" method="POST">
                            {{csrf_field()}}
                            <h3>@lang('lang.web.login')</h3>
                            <div class="form-group">
                                <label>@lang('login.web.username')<span class="required">*</span></label>
                                <input type="text" id="username" name="username" class="form-control"
                                       value="{{old('username')}}">
                            </div>
                            <div class="form-group">
                                <label>@lang('login.web.password')<span class="required">*</span></label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input type="checkbox" id="remember_me" name="remember_me">
                                    <label for="signin-remember">@lang('login.web.remember_me')</label>
                                </div>
                            </div>
                            <div class="alert alert-danger"
                                 style="{{session('error') || count($errors) > 0 ? '' : 'display:none'}}">
                                @if(session('error')|| count($errors) > 0 )
                                    {{ trans('login.web.username_or_password') }}
                                @endif
                            </div>
                            <button type="submit"
                                    class="btn btn-primary btn-lg btn-block">@lang('login.web.login')</button>
                        </form>
                        <div class="row" style="display: none">
                            <div class="col-xs-6">
                                <a href="" class="btn btn-brand btn-facebook"><i class="fa fa-facebook"></i>Sign in with
                                    Facebook</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="" class="btn btn-brand btn-google-plus"><i class="fa fa-google-plus"></i>Sign
                                    in with Google Plus</a>
                            </div>
                        </div>
                    </div>
                    <p class="form-text"><a
                                href="{{route('web.forget.password.show')}}">@lang('login.web.forget_password')</a></p>
                </div>
            </div>
        </div>
    </section>

@endsection