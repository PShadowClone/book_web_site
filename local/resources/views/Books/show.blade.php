@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('book.show')}}">@lang('book.books')</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>@lang('lang.show')</span>
            </li>
        </ul>
    </div>
@endsection
@section('style')
    <style>
        tr > td {
            text-align: center !important;
        }
        .dataTables_wrapper{
            position: initial;
        }
    </style>
@endsection
@section('body')
    <div class="row" style="">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-search"></i>@lang('lang.search')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-12" style="padding:10px;margin-bottom: 15px">

                        <div class="col-md-12">
                            <div class="col-md-6">
                                <input class="form-control" name="name" id="name" placeholder="@lang('book.name')"/>
                            </div>
                            <div class="col-md-6">
                                <select name="category_id" id="category_id" class="bs-select form-control"
                                        data-live-search="true">
                                    <option value="-1">@lang('book.category')</option>
                                    @if(categories())
                                        @foreach(categories() as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>
                        <div class="col-md-12" style="margin-top: 15px;text-align: left;padding-left: 30px">
                            <button class="btn btn-primary" name="search" id="search">@lang('lang.search')</button>
                            <button class="btn btn-default" name="cancel" id="cancel">@lang('lang.cancel')</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-book"></i>@lang('book.books')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <a class="btn btn-success" style="float: right;margin-bottom: -30px;margin-right: 0px;" data-toggle="modal" data-target="#books_list"><i class="fa fa-file"
                                                                         style="padding-left: 10px;"></i>استيراد الكتب
                        </a>

                        <table class="table table-striped table-bordered table-hover dt-responsive" id="book"
                               width="100%" >
                            <thead>
                            <tr>
                                <th>الترتيب</th>
                                <th>الصورة</th>
                                <th>الصنف</th>
                                <th>اسم الكتاب</th>
                                <th>الكمية</th>
                                <th>العملية</th>
                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        @includeIf('Books.modals.image_view')
        @includeIf('Books.modals.change_amount')
        @includeIf('Books.modals.upload_file')
    </div>
@endsection
@section('scripts')
    @includeIf('Books.scripts.show')

@endsection