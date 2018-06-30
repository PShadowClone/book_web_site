@extends('web_base_layout._layout')
@section('style')
    <style>
        .login-form-wrapper {
            direction: rtl;
        }

        h3 {
            margin-bottom: 25px;
        }
    </style>
@endsection
@section('body')
    <!-- ==========================
    	ACCOUNT - START
    =========================== -->
    <section class="content account">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                    <div class="login-form-wrapper no-border">
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
                        <form method="POST" action="{{route('web.forget.password.action')}}">
                            {{csrf_field()}}
                            <h3 style="margin-bottom: 25px">@lang('login.web.change_password')</h3>
                            <p>@lang('login.web.change_password_desc')</p>
                            <div class="form-group">
                                <label>@lang('login.web.email')<span class="required">*</span></label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <button type="submit"
                                    class="btn btn-primary btn-lg btn-block">@lang('login.web.send')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
    	ACCOUNT - END
    =========================== -->
@endsection