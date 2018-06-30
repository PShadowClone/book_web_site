@extends('beautymail::templates.sunny')

@section('content')

    <style>
        img{
            height: 260px;
        }
    </style>
    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'اعادة تعيين كلمة المرور',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <p style="float: right;">@lang('lang.reset_password_message')</p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'الرابط',
        	'link' => route('password.reset.show',['email' => $email , 'token' => $token])
    ])

@stop