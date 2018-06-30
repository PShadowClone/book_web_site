<!-- Modal -->
<div class="modal fade" id="addAreas" tabindex="-1" role="dialog" aria-labelledby="addAreasTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAreasTitle">@lang("driver.addAreas")</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="margin-top: 15px" >
                        <div class="col-md-12">
                            <select id="area" class="bs-select form-control" name="area" data-live-search="true">
                                <option value="-1" selected>@lang('library.area')</option>
                                @if(areas())
                                    @foreach(areas() as $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <select id="city" class="bs-select form-control " name="city" data-live-search="true">
                                <option value="-1" selected>@lang('library.city')</option>
                                @if(cities())
                                    @foreach(cities() as $city)
                                        <option value="{{$city->id}}" data-area="{{$city->area_id}}">{{$city->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <select id="quarter" class="bs-select form-control" name="quarter" data-live-search="true">
                                <option value="-1" selected>@lang('library.quarter')</option>
                                @if(quarters())
                                    @foreach(quarters() as $quarter)
                                        <option value="{{$quarter->id}}" data-city="{{$quarter->cityId}}">{{$quarter->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="error quarter_error"></span>
                        </div>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="areaSave">@lang('lang.submit')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
            </div>
        </div>
    </div>
</div>