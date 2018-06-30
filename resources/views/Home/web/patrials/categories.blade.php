<style>
    .col-xs-7.col-md-6 > .category-body.right {
        text-align: right;
    }
</style>
<section class="content categories-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-title">
                <h2>@lang('lang.web.categories')</h2>
            </div>
        @for($counter = 0 ; $counter < HOME_CATEGORY_LIMIT ; $counter++)
            @if(isset(categories()[$counter]))
                <!-- CATEGORY - START -->
                    <div class="col-sm-6">
                        <div class="category">
                            <div class="row">

                                <div class="col-xs-5 col-md-6">
                                    <img src="{{URL::to('/').categories()[$counter]->image}}"
                                         class="img-responsive"
                                         alt="">
                                </div>
                                <div class="col-xs-7 col-md-6">
                                    <div class="category-body right">
                                        <h3 class="category-title">{{categories()[$counter]->name}}</h3>
                                        <a href="{{route('web.book.search.show')}}?category_id={{categories()[$counter]->id}}"
                                           class="btn btn-default">@lang('lang.web.show_more')</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- CATEGORY - END -->
                @endif
            @endfor
        </div>
    </div>
</section>
