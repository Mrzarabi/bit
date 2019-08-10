<!-- Top Menu Items -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="nav-wrap">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-right">
            <div class="logo-wrap">
                <a href="/panel/currency">
                    <span class="brand-img brand-text"><img src="{{ asset('logo/'.$options['site_logo']) }}" class="rounded" alt="brand"/></span>
                </a>
            </div>
        </div>	
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        {{-- <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a> --}}
        {{-- <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a> --}}
        <form id="search_form" role="search" class="top-nav-search collapse pull-right">
            <div class="input-group">
                {{-- <input type="text" onkeyup="this.nextElementSibling.childNodes[0].href = '/panel/products/search/'+this.value" name="example-input1-group2" class="form-control" placeholder="جستجو ...">
                <span class="input-group-btn"><a href="/panel/products/search/" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></a></span> --}}
            </div>
        </form>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><span class="user-auth-name inline-block">{{Auth::user()->first_name.' '.Auth::user()->last_name}} &nbsp;<span class="ti-angle-down"></span></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                @if (\auth::user()->hasRole('owner'))
                    <li>
                        <a @if( !auth()->user()->can("create-currency") ) disabled @endif href="/panel/currency/create"><i class="zmdi zmdi-plus"></i><span>ثبت محصول</span></a>
                    </li>
                    <li>
                        <a @if( !auth()->user()->can("read-setting") ) disabled @endif href="/panel/setting"><i class="zmdi zmdi-settings"></i><span>تنظیمات</span></a>
                    </li>
                @else
                    <li>
                        <a href="/panel/profile-setting/{{\auth::user()->id}}"><i class="zmdi zmdi-settings"></i><span>پروفایل</span></a>
                    </li>
                @endif
                    <li>
                            <a href="/"><i class="zmdi zmdi-eye"></i><span>مشاهده وبسایت</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="zmdi zmdi-power"></i><span>خروج</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>	
    </div>
</nav>
<!-- /Top Menu Items -->

@if (\Auth::user()->hasRole('owner'))
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li>
                <a @if( in_array(request()->route()->getName(), ['profile-setting' ,'user', 'ticket', 'role']) ) class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><span class="right-nav-text"><i class="ti-user ml-5" aria-hidden="true"></i>کاربران</span></div><div class="pull-left"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
                <ul id="ecom_dr" class="collapse collapse-level-1">
                    <li>
                        <a @if(request()->route()->getName() == 'profile-setting') class="active-page" @endif href="/panel/profile-setting/{{\Auth::user()->id}}" ><i class="fa fa-sitemap ml-5" aria-hidden="true"></i>پروفایل</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'user') class="active-page" @endif @if( auth()->user()->can("read-user") ) href="/panel/user" @endif ><i class="fa fa-sitemap ml-5" aria-hidden="true"></i>کاربران</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'role') class="active-page" @endif @if( auth()->user()->can("read-role") ) href="/panel/role" @endif ><i class="fa fa-sitemap ml-5" aria-hidden="true"></i>نقش ها</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'ticket') class="active-page" @endif @if( auth()->user()->can("read-ticket") ) href="/panel/ticket" @endif ><i class="fa fa-university ml-5" aria-hidden="true"></i>تیکت ها</a>
                    </li>
                </ul>
            </li>
            <li>
                <a @if( in_array(request()->route()->getName(), ['category', 'subject','specification']) ) class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><span class="right-nav-text"><i class="fa fa-shopping-basket ml-5" aria-hidden="true"></i>فروشگاه</span></div><div class="pull-left"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
                <ul id="ecom_dr" class="collapse collapse-level-1">
                    <li>
                        <a @if(request()->route()->getName() == 'category') class="active-page" @endif @if( auth()->user()->can("read-category") ) href="/panel/category" @endif ><i class="fa fa-sitemap ml-5" aria-hidden="true"></i>گروه بندی محصولات</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'subject') class="active-page" @endif @if( auth()->user()->can("read-subject") ) href="/panel/subject" @endif ><i class="fa fa-university ml-5" aria-hidden="true"></i>گروه بندی مقالات</a>
                    </li>
                    <li>
                        {{-- <a @if(request()->route()->getName() == 'specification') class="active-page" @endif @if( auth()->user()->can("read-spec") ) href="/panel/specification" @endif ><i class="fa fa-table ml-5" aria-hidden="true"></i>جداول مشخصات فنی</a> --}}
                    </li>
                </ul>
            </li>
            <li>
                <a @if( in_array(request()->route()->getName(), ['add_currency', 'currencies'] ) ) class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#product_dr"><div class="pull-left"><span class="right-nav-text"><i class="fa fa-th ml-5" aria-hidden="true"></i>محصولات</span></div><div class="pull-left"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
                <ul id="product_dr" class="collapse collapse-level-1">
                    <li>
                        <a @if(request()->route()->getName() == 'add_currency') class="active-page" @endif @if( auth()->user()->can("create-currency") ) href="/panel/currency/create" @endif ><i class="fa fa-cart-plus ml-5" aria-hidden="true"></i>افزودن محصول</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'currencies') class="active-page" @endif @if( auth()->user()->can("read-currency") ) href="/panel/currency" @endif ><i class="fa fa-shopping-cart ml-5" aria-hidden="true"></i>لیست محصولات</a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a @if( in_array(request()->route()->getName(), ['comments'] ) ) class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#product_dr"><div class="pull-left"><span class="right-nav-text"><i class="fa fa-th ml-5" aria-hidden="true"></i>محصولات</span></div><div class="pull-left"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
                <ul id="product_dr" class="collapse collapse-level-1">
                    <li>
                        <a @if(request()->route()->getName() == 'add_currency') class="active-page" @endif href="/panel/currency/create"><i class="fa fa-cart-plus ml-5" aria-hidden="true"></i>افزودن محصول</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'comments') class="active-page" @endif href="/panel/comment"><i class="fa fa-shopping-cart ml-5" aria-hidden="true"></i>لیست کامنت های مفالات</a>
                    </li>
                </ul>
            </li> --}}
            <li>
                <a @if( in_array(request()->route()->getName(), ['article.index', 'article.create']) ) class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#blog_dr"><div class="pull-left"><span class="right-nav-text"><i class="fa fa-newspaper-o ml-5" aria-hidden="true"></i>وبلاگ</span></div><div class="pull-left"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
                <ul id="blog_dr" class="collapse collapse-level-1">
                    <li>
                        <a @if(request()->route()->getName() == 'article.create') class="active-page" @endif @if( auth()->user()->can("create-article") ) href="/panel/article/create" @endif ><i class="fa fa-file-text-o ml-5" aria-hidden="true"></i>افزودن پست</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'article.index') class="active-page" @endif @if( auth()->user()->can("read-article") ) href="/panel/article" @endif ><i class="fa fa-newspaper-o ml-5" aria-hidden="true"></i>مشاهده پست ها</a>
                    </li>
                </ul>
            </li>
            <li>
                <a @if(request()->route()->getName() == 'setting') class="active" @endif @if( auth()->user()->can("read-setting") ) href="/panel/setting" @endif ><div class="pull-left"><span class="right-nav-text"><i class="fa fa-sliders ml-5" aria-hidden="true"></i>تنظیمات</span></div><div class="clearfix"></div></a>
            </li>
            <li>
                <a href="/"><div class="pull-left"><span class="right-nav-text"><i class="fa fa-eye ml-5" aria-hidden="true"></i>مشاهده وبسایت</span></div><div class="clearfix"></div></a>
            </li>
        </ul>
    </div>
    <!-- /Left Sidebar Menu -->
@else
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li>
                <a @if( in_array(request()->route()->getName(), ['profile-setting', 'client.create']) ) class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><span class="right-nav-text"><i class="ti-user ml-5" aria-hidden="true"></i>مشخصات</span></div><div class="pull-left"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
                <ul id="ecom_dr" class="collapse collapse-level-1">
                    <li>
                        <a @if(request()->route()->getName() == 'profile-setting') class="active-page" @endif href="/panel/profile-setting/{{\Auth::user()->id}}" ><i class="fa fa-sitemap ml-5" aria-hidden="true"></i>پروفایل</a>
                    </li>
                    <li>
                        <a @if(request()->route()->getName() == 'client.create') class="active-page" @endif href="/panel/client/create" ><i class="fa fa-university ml-5" aria-hidden="true"></i>تیکت ها</a>
                    </li>
                </ul>
            </li>
            <li>
                <a @if( in_array(request()->route()->getName(), ['client']) ) class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><span class="right-nav-text"><i class="fa fa-shopping-basket ml-5" aria-hidden="true"></i>فروشگاه</span></div><div class="pull-left"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
                <ul id="ecom_dr" class="collapse collapse-level-1">
                    <li>
                        <a @if(request()->route()->getName() == 'client') class="active-page" @endif href="/panel/client" ><i class="fa fa-sitemap ml-5" aria-hidden="true"></i>محصولات</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/"><div class="pull-left"><span class="right-nav-text"><i class="fa fa-eye ml-5" aria-hidden="true"></i>مشاهده وبسایت</span></div><div class="clearfix"></div></a>
            </li>
        </ul>
    </div>
    <!-- /Left Sidebar Menu -->
@endif