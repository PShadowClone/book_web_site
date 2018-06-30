{{--{{dd()}}--}}
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200" style="padding-top: 20px">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <li class="sidebar-search-wrapper">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
            <form class="sidebar-search  " action="page_general_search_3.html" method="POST" style="display: none">
                <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                </a>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>

        <li class="nav-item start {{Route::current()->action['prefix'] == '/home' ? 'active': ''}} "
            style="display: none">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-bar-chart"></i>
                <span class="title">الاحصائيات</span>
                <span class="selected"></span>
            </a>
        </li>

        {{--{{dd(\Illuminate\Support\Facades\Auth::user()->permissions()->get())}}--}}
        <li class="nav-item  {{Route::current()->action['prefix'] == '/admin' ? 'active': ''}} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">المديرين</span>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{route('admin.create')}}" class="nav-link">
                            <i class="fa fa-user-plus"></i>
                            <span class="title">@lang('lang.add')</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.show')}}" class="nav-link ">
                            <i class="fa fa-list"></i>
                            <span class="title">@lang('lang.show')</span>
                        </a>
                    </li>
                </ul>
            </a>

        </li>

        <li class="nav-item {{Route::current()->action['prefix'] == '/library' ? 'active': ''}} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">@lang('library.libraries')</span>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{route('library.create')}}" class="nav-link">
                            <i class="fa fa-plus"></i>
                            <span class="title">@lang('lang.add')</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('library.show')}}" class="nav-link ">
                            <i class="fa fa-list"></i>
                            <span class="title">@lang('lang.show')</span>
                        </a>
                    </li>
                </ul>
            </a>
        </li>
        <li class="nav-item {{Route::current()->action['prefix'] == '/driver' ? 'active': ''}} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-group"></i>
                <span class="title">@lang('driver.drivers')</span>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{route('driver.create')}}" class="nav-link">
                            <i class="fa fa-user-plus"></i>
                            <span class="title">@lang('lang.add')</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('driver.show')}}" class="nav-link ">
                            <i class="fa fa-list"></i>
                            <span class="title">@lang('lang.show')</span>
                        </a>
                    </li>
                </ul>
            </a>
        </li>

        <li class="nav-item {{Route::current()->action['prefix'] == '/client' ? 'active': ''}} ">
            <a href="{{route('client.show')}}" class="nav-link nav-toggle">
                <i class="fa fa-group"></i>
                <span class="title">@lang('client.clients')</span>
                <span class="arrow"></span>
                {{--<ul class="sub-menu">--}}
                {{--<li class="nav-item ">--}}
                {{--<a href="{{route('client.show')}}" class="nav-link ">--}}
                {{--<i class="fa fa-list"></i>--}}
                {{--<span class="title">@lang('lang.show')</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
            </a>
        </li>


        <li class="nav-item {{Route::current()->action['prefix'] == '/category' ? 'active': ''}} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-list"></i>
                <span class="title">@lang('category.categories')</span>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{route('category.create')}}" class="nav-link">
                            <i class="fa fa-plus"></i>
                            <span class="title">@lang('lang.add')</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('category.show')}}" class="nav-link ">
                            <i class="fa fa-list"></i>
                            <span class="title">@lang('lang.show')</span>
                        </a>
                    </li>
                </ul>
            </a>
        </li>

        <li class="nav-item {{Route::current()->action['prefix'] == '/book' ? 'active': ''}} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">@lang('book.books')</span>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{route('book.create')}}" class="nav-link">
                            <i class="fa fa-plus"></i>
                            <span class="title">@lang('lang.add')</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('book.show')}}" class="nav-link ">
                            <i class="fa fa-list"></i>
                            <span class="title">@lang('lang.show')</span>
                        </a>
                    </li>
                </ul>
            </a>
        </li>


        <li class="nav-item {{Route::current()->action['prefix'] == '/request' ? 'active': ''}} ">
            <a href="{{route('request.show')}}" class="nav-link nav-toggle">
                <i class="fa fa-group"></i>
                <span class="title">@lang('request.requests')</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item {{session('title') == 'complaint' ? 'active': ''}} hidden">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-bulb"></i>
                <span class="title">الشكاوي</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item {{Route::current()->action['prefix'] == '/ads' ? 'active': ''}} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-tags"></i>
                <span class="title">@lang('ads.advertisements')</span>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{route('ads.create')}}" class="nav-link">
                            <i class="fa fa-plus"></i>
                            <span class="title">@lang('lang.add')</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('ads.show')}}" class="nav-link ">
                            <i class="fa fa-list"></i>
                            <span class="title">@lang('lang.show')</span>
                        </a>
                    </li>
                </ul>
            </a>
        </li>

        <li class="nav-item {{Route::current()->action['prefix'] == '/offer' ? 'active': ''}} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-tags"></i>
                <span class="title">@lang('offer.offers')</span>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{route('offer.create')}}" class="nav-link">
                            <i class="fa fa-plus"></i>
                            <span class="title">@lang('lang.add')</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('offer.show')}}" class="nav-link ">
                            <i class="fa fa-list"></i>
                            <span class="title">@lang('lang.show')</span>
                        </a>
                    </li>
                </ul>
            </a>
        </li>

        <li class="nav-item {{Route::current()->action['prefix'] == '/notification' ? 'active': ''}} ">
            <a href="{{route('notification.show')}}" class="nav-link nav-toggle">
                <i class="fa fa-send"></i>
                <span class="title">@lang('notify.notifications')</span>
                <span class="arrow"></span>
            </a>
        </li>

        <li class="nav-item {{Route::current()->action['prefix'] == '/setting' ? 'active': ''}} ">
            <a href="{{route('setting.create')}}" class="nav-link nav-toggle">
                <i class="fa fa-cogs"></i>
                <span class="title">@lang('setting.settings')</span>
                <span class="arrow"></span>
            </a>
        </li>



        <li class="nav-item  {{session('title') == 'payment' ? 'active': ''}} hidden">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-money"></i>
                <span class="title">المدفوعات</span>
                {{--<span class="arrow"></span>--}}
                <span class="selected"></span>

            </a>
        </li>
        <li class="nav-item  {{Route::current()->action['prefix'] == '/notification' ? 'active': ''}}}} hidden">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-send"></i>
                <span class="title">الاشعارات</span>
                {{--<span class="arrow"></span>--}}
                <span class="selected"></span>

            </a>
            {{--<ul class="sub-menu">--}}
            {{--<li class="nav-item ">--}}
            {{--<a href="{{route('notification.show.show')}}" class="nav-link ">--}}
            {{--<i class="fa fa-list"></i>--}}
            {{--<span class="title">عرض</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
        </li>

    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>