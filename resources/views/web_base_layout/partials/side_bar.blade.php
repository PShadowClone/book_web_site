<div class="col-sm-3">
    <aside class="sidebar">

        <!-- WIDGET:CATEGORIES - START -->
        <div class="widget widget-categories">
            <h3><a role="button" data-toggle="collapse" href="#widget-categories-collapse"
                   aria-expanded="true"
                   aria-controls="widget-categories-collapse">@lang('lang.web.categories')</a></h3>


            <div class="collapse in" id="widget-categories-collapse" aria-expanded="true"
                 role="tabpanel">
                <div class="widget-body">
                    <ul class="list-unstyled" id="categories" role="tablist"
                        aria-multiselectable="true">
                        @includeIf('web_base_layout.partials.side_bar_partials.categories')
                        <li class="panel"><a role="button" data-toggle="collapse"
                                             data-parent="#categories" href="#parent-2"
                                             aria-expanded="true" aria-controls="parent-2">Women<span>[34]</span></a>
                            <ul id="parent-2" class="list-unstyled panel-collapse collapse in"
                                role="menu">
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Swimwear</a></li>
                                <li><a href="#">Basics</a></li>
                                <li class="active"><a href="#">Dresses</a></li>
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">Skirts</a></li>
                                <li><a href="#">Leggings</a></li>
                            </ul>
                        </li>
                        <li class="panel"><a class="collapsed" role="button" data-toggle="collapse"
                                             data-parent="#categories" href="#parent-3"
                                             aria-expanded="false"
                                             aria-controls="parent-3">Accessories<span>[8]</span></a>
                            <ul id="parent-3" class="list-unstyled panel-collapse collapse" role="menu">
                                <li><a href="#">Basics</a></li>
                                <li><a href="#">Shirts</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="widget widget-categories">
            <h3><a role="button" data-toggle="collapse" href="#widget-libraries-collapse"
                   aria-expanded="true"
                   aria-controls="widget-categories-collapse">@lang('lang.web.libraries')</a></h3>
            <div class="collapse in" id="widget-libraries-collapse" aria-expanded="true"
                 role="tabpanel">
                <div class="widget-body">
                    <ul class="list-unstyled" id="categories" role="tablist"
                        aria-multiselectable="true">
                        <li class="panel">
                            <a class="collapsed" role="button" data-toggle="collapse"
                               data-parent="#categories" href="#parent-1"
                               aria-expanded="false" aria-controls="parent-1">Men<span>[12]</span>
                            </a>
                            <ul id="parent-1" class="list-unstyled panel-collapse collapse" role="menu">
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Jackets</a></li>
                                <li><a href="#">Jumpers</a></li>
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">Shoes</a></li>
                                <li><a href="#">T-Shirt & Polo Shirts</a></li>
                                <li><a href="#">Blazers</a></li>
                            </ul>
                        </li>
                        <li class="panel"><a role="button" data-toggle="collapse"
                                             data-parent="#categories" href="#parent-2"
                                             aria-expanded="true" aria-controls="parent-2">Women<span>[34]</span></a>
                            <ul id="parent-2" class="list-unstyled panel-collapse collapse in"
                                role="menu">
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Swimwear</a></li>
                                <li><a href="#">Basics</a></li>
                                <li class="active"><a href="#">Dresses</a></li>
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">Skirts</a></li>
                                <li><a href="#">Leggings</a></li>
                            </ul>
                        </li>
                        <li class="panel"><a class="collapsed" role="button" data-toggle="collapse"
                                             data-parent="#categories" href="#parent-3"
                                             aria-expanded="false"
                                             aria-controls="parent-3">Accessories<span>[8]</span></a>
                            <ul id="parent-3" class="list-unstyled panel-collapse collapse" role="menu">
                                <li><a href="#">Basics</a></li>
                                <li><a href="#">Shirts</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- WIDGET:CATEGORIES - END -->

        <!-- WIDGET:PRICE - START -->
        <div class="widget widget-price">
            <h3><a role="button" data-toggle="collapse" href="#widget-price-collapse"
                   aria-expanded="true" aria-controls="widget-price-collapse">@lang('lang.web.filter_by_price')</a></h3>
            <div class="collapse in" id="widget-price-collapse" aria-expanded="true" role="tabpanel">
                <div class="widget-body">
                    <div class="price-slider">
                        <input type="text" class="pull-left" id="amount" readonly>
                        <input type="text" class="pull-right" id="amount2" readonly>
                        <div id="slider-range"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- WIDGET:PRICE - END -->

        <!-- WIDGET:COLOR - START -->
        <div class="widget widget-color" style="display: none;">
            <h3><a role="button" data-toggle="collapse" href="#widget-color-collapse"
                   aria-expanded="true" aria-controls="widget-color-collapse">Filter by color</a></h3>
            <div class="collapse in" id="widget-color-collapse" aria-expanded="true" role="tabpanel">
                <div class="widget-body">
                    <div class="checkbox blue">
                        <input type="checkbox" value="blue" id="check-blue" checked>
                        <label data-toggle="tooltip" data-placement="top" title="Blue"
                               for="check-blue"></label>
                    </div>
                    <div class="checkbox red">
                        <input type="checkbox" value="red" id="check-red">
                        <label data-toggle="tooltip" data-placement="top" title="Red"
                               for="check-red"></label>
                    </div>
                    <div class="checkbox green">
                        <input type="checkbox" value="green" id="check-green">
                        <label data-toggle="tooltip" data-placement="top" title="Green"
                               for="check-green"></label>
                    </div>
                    <div class="checkbox dark-gray">
                        <input type="checkbox" value="dark-gray" id="check-dark-gray">
                        <label data-toggle="tooltip" data-placement="top" title="Dark Gray"
                               for="check-dark-gray"></label>
                    </div>
                    <div class="checkbox dark-cyan">
                        <input type="checkbox" value="dark-cyan" id="check-dark-cyan">
                        <label data-toggle="tooltip" data-placement="top" title="Dark Cyan"
                               for="check-dark-cyan"></label>
                    </div>
                    <div class="checkbox orange">
                        <input type="checkbox" value="orange" id="check-orange">
                        <label data-toggle="tooltip" data-placement="top" title="Orange"
                               for="check-orange"></label>
                    </div>
                    <div class="checkbox pink">
                        <input type="checkbox" value="pink" id="check-pink">
                        <label data-toggle="tooltip" data-placement="top" title="Pink"
                               for="check-pink"></label>
                    </div>
                    <div class="checkbox purple">
                        <input type="checkbox" value="purple" id="check-purple">
                        <label data-toggle="tooltip" data-placement="top" title="Purple"
                               for="check-purple"></label>
                    </div>
                    <div class="checkbox brown">
                        <input type="checkbox" value="brown" id="check-brown">
                        <label data-toggle="tooltip" data-placement="top" title="Brown"
                               for="check-brown"></label>
                    </div>
                    <div class="checkbox yellow">
                        <input type="checkbox" value="yellow" id="check-yellow">
                        <label data-toggle="tooltip" data-placement="top" title="Yellow"
                               for="check-yellow"></label>
                    </div>
                </div>
            </div>
        </div>
        <!-- WIDGET:COLOR - END -->

        <!-- WIDGET:SIZE - START -->
        <div class="widget widget-checkbox" style="display: none">
            <h3><a role="button" data-toggle="collapse" href="#widget-size-collapse"
                   aria-expanded="true" aria-controls="widget-size-collapse">Filter by size</a></h3>
            <div class="collapse in" id="widget-size-collapse" aria-expanded="true" role="tabpanel">
                <div class="widget-body">

                    <div class="checkbox">
                        <input id="check-size-xs" type="checkbox" value="size-xs" checked>
                        <label for="check-size-xs">XS</label>
                        <span>[12]</span>
                    </div>
                    <div class="checkbox">
                        <input id="check-size-s" type="checkbox" value="size-s">
                        <label for="check-size-s">S</label>
                        <span>[12]</span>
                    </div>
                    <div class="checkbox">
                        <input id="check-size-m" type="checkbox" value="size-m">
                        <label for="check-size-m">M</label>
                        <span>[12]</span>
                    </div>
                    <div class="checkbox">
                        <input id="check-size-l" type="checkbox" value="size-l">
                        <label for="check-size-l">L</label>
                        <span>[12]</span>
                    </div>
                    <div class="checkbox">
                        <input id="check-size-xl" type="checkbox" value="size-xl">
                        <label for="check-size-xl">XL</label>
                        <span>[12]</span>
                    </div>
                    <div class="checkbox">
                        <input id="check-size-xll" type="checkbox" value="size-xll">
                        <label for="check-size-xll">XXL</label>
                        <span>[12]</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- WIDGET:SIZE - END -->

        <!-- WIDGET:DISCOUNT - START -->
        <div class="widget widget-checkbox" style="display: none">
            <h3><a role="button" data-toggle="collapse" href="#widget-discount-collapse"
                   aria-expanded="true" aria-controls="widget-discount-collapse">Discount</a></h3>
            <div class="collapse in" id="widget-discount-collapse" aria-expanded="true" role="tabpanel">
                <div class="widget-body">
                    <div class="checkbox">
                        <input id="check-with-discount" type="checkbox" value="with-discount">
                        <label for="check-with-discount">Products with discount</label>
                        <span>[12]</span>
                    </div>
                    <div class="checkbox">
                        <input id="check-without-discount" type="checkbox" value="without-discount">
                        <label for="check-without-discount">Products without discount</label>
                        <span>[112]</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- WIDGET:SIZE - END -->

    </aside>
</div>