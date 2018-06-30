@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('category.show')}}">@lang('category.categories')</a>
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
                    <i class="fa fa-list"></i>@lang('category.editCategory')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-12">
                        <form id="category" method="POST" action="{{route('category.update' , ['id' => $category->id])}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-md-12">

                                <div class="col-md-3" style="text-align: center">
                                    <div class="{{$category->image ? 'fileinput fileinput-exists' : 'fileinput fileinput-new'}}" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail"
                                             style="width: 200px; height: 150px;">
                                            </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                            <img src="{{$category->image ? URL::to('/').$category->image  : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=@lang('category.no_image')"}}"
                                                 alt=""/>
                                        </div>
                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> @lang('category.choose_image')</span>
                                                                <span class="fileinput-exists"> @lang('category.change') </span>
                                                                <input type="file" name="image"></span>
                                            <a href="javascript:;" class="btn red fileinput-exists"
                                               data-dismiss="fileinput"> @lang('category.remove') </a>
                                        </div>
                                    </div>
                                    <label id="image-error" class="error" for="image">{{$errors->first('image')}}</label>
                                </div>
                                <div class="col-md-8"><label for="username"></label>
                                    <input class="form-control" name="arrange" placeholder="@lang('category.arrange')"
                                           value="{{old('arrange') ? old('arrange') : $category->arrange }}" >
                                    <span class="error">{{$errors->first('arrange')}}</span>
                                </div>
                                <div class="col-md-8"><label for="name"></label>
                                    <input class="form-control" name="name" placeholder="@lang('category.name')"
                                           value="{{old('name') ? old('name')  : $category->name}}">
                                    <span class="error">{{$errors->first('name')}}</span>

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
    @includeIf('Categories.scripts.update')
@endsection