@extends('base_layout._layout')
@section('style')
    <style>
        .datepicker-dropdown {
            margin-left: 29%;
        }

        .rating-rtl {
            float: initial;
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('book.show')}}">@lang('book.books')</a>
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
                    <i class="fa fa-book"></i>@lang('book.editBook')
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-12" style="text-align: center;padding: 15px;font-size: 17px">
                        <span class="">@lang('request.totalEvaluations')</span>
                        : <span style="font-weight: bold"> {{number_format($book['evaluations'], 2,'.',',') }} <a
                                    href="{{route('book.evaluations.show.all' , ['id' => $book->id])}}" style="font-size: 21px;margin-right: 9px;"> <i class="fa fa-eye"></i> </a> </span>
                        <input type="text" class="kv-gly-star rating-loading" value="{{$book['evaluations']}}" dir="rtl"
                               data-size="xs" title="" disabled>

                    </div>

                    <div class="col-md-12">
                        <form id="book" method="POST" action="{{route('book.update', ['id' => $book->id])}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-md-12" style="text-align: center">

                                <div class="{{$book->image ? 'fileinput fileinput-exists' : 'fileinput fileinput-new'}}"
                                     data-provides="fileinput">
                                    <div class="fileinput-new thumbnail"
                                         style="width: 200px; height: 150px;">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;">
                                        <img src="{{$book->image ? URL::to('/').$book->image  : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=".trans('book.no_image')}}"
                                             alt=""/>
                                    </div>
                                    <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> @lang('book.choose_image')</span>
                                                                <span class="fileinput-exists"> @lang('book.change') </span>
                                                                <input type="file" name="image"></span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput"> @lang('book.remove') </a>
                                    </div>

                                    <label id="image-error" class="error"
                                           for="image">{{$errors->first('image')}}</label>

                                </div>


                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label for="arrange"></label>
                                        <input name="arrange" class="form-control" placeholder="@lang('book.arrange')"
                                               value="{{old('arrange') ? old('arrange') : $book->arrange }}"/>
                                        <span class="error">{{$errors->first('arrange')}}</span>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="name"></label>
                                        <input name="name" class="form-control" placeholder="@lang('book.name')"
                                               value="{{old('name') ? old('name') :  $book->name}}"/>
                                        <span class="error">{{$errors->first('name')}}</span>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="publisher"></label>
                                        <input name="publisher" class="form-control"
                                               placeholder="@lang('book.publisher')"
                                               value="{{old('publisher') ? old('publisher')  : $book->publisher}}"/>
                                        <span class="error">{{$errors->first('publisher')}}</span>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="description"></label>
                                        <textarea class="form-control" name="description"
                                                  placeholder="@lang('book.description')"
                                                  rows="5">{{old('description') ? old('description') : $book->description }}</textarea>
                                        <span class="error">{{$errors->first('description')}}</span>

                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="col-md-12">
                                        <label for="library"></label>
                                        <select name="library_id" id="library" class="bs-select form-control"
                                                data-live-search="true">
                                            <option value="-1">@lang('library.library')</option>
                                            @if(libraries())
                                                @foreach(libraries() as $library)
                                                    <option value="{{$library->id}}" {{$library->id == $book->library_id ? 'selected' : ''}}>{{$library->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error">{{$errors->first('library_id')}}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="category"></label>
                                        <select name="category_id" class="bs-select form-control"
                                                data-live-search="true">
                                            <option value="-1">@lang('category.category')</option>
                                            @if(categories())
                                                @foreach(categories() as $category)
                                                    <option value="{{$category->id}}" {{$category->id == $book->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error">{{$errors->first('category_id')}}</span>

                                    </div>

                                    <div class="col-md-12" style="padding-left: 0;padding-right: 0">
                                        <div class="col-md-6">
                                            <label for="writer"></label>
                                            <input name="writer" class="form-control" placeholder="@lang('book.writer')"
                                                   value="{{old('writer') ? old('writer') : $book->writer }}"/>
                                            <span class="error">{{$errors->first('writer')}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inquisitor"></label>
                                            <input name="inquisitor" class="form-control"
                                                   placeholder="@lang('book.inquisitor')"
                                                   value="{{old('inquisitor') ? old('inquisitor') : $book->inquisitor }}"/>
                                            <span class="error">{{$errors->first('inquisitor')}}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="price"></label>
                                            <input name="price" class="form-control" placeholder="@lang('book.price')"
                                                   value="{{old('price') ? old('price') : $book->price}}"/>
                                            <span class="error">{{$errors->first('price')}}</span>

                                        </div>
                                        <div class="col-md-12 ">
                                            <label for="publish_date"></label>
                                            <div class="col-md-12 input-group date">
                                                <input type="text" size="16" name="publish_date"
                                                       value="{{old('publish_date') ? old('publish_date')  : $book->publish_date}}"
                                                       class="form-control date-picker m-input"
                                                       placeholder="@lang('book.publish_date')">
                                            </div>
                                            <span class="error">{{$errors->first('publish_date')}}</span>
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
    @includeIf('Books.scripts.update')
@endsection