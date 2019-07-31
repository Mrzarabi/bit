<!-- header-section-->
<div class=" header-wrapper fixed-top ">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="header-logo">
                    <a href="/" class="header-logo-link">
                        <img src="{{ asset('logo/'.$options['site_logo']) }}" style="max-height: 60px;display: block;margin: auto" alt="لوگوی فروشگاه">
                    </a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
                <!-- navigations-->
                <div class="navigation">
                    <div id="navigation">
                        <ul>
                            {{-- <li class=""><a href="index.html">درباره ما</a></li> --}}
                            <li class=""><a href="{{route('blog')}}">مقالات</a>
                            <li class="active"><a href="{{route('index')}}">صفحه اصلی</a></li>
                            </li>
                            {{-- <li class="has-sub"><a href="#">Pages</a>
                                <ul>
                                    <li><a href="about.html">about</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Sign up</a></li>
                                    <li><a href="error-page.html">404 page</a> </li>
                                    <li><a href="styleguide.html">styleguide</a> </li>
                                </ul>
                            </li> --}}
                            {{-- <li><a href="contact-us.html">Contact</a></li> --}}
                        </ul>
                    </div>
                </div>
                <!-- /.navigations-->
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 d-none d-xl-block d-lg-block">
                <div class="header-quick-info">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-white btn-xs mr-1 custom-btn-white">{{ __('ورود') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-default btn-xs custom-btn-warning">{{ __('ثبت نام') }}</a>
                        @endif
                    @else
                        @if (\Auth::user()->type == 1)
                            <a target="_blank" class="btn btn-default custom-btn-warning" href="/panel">پنل مدیریت</a>
                        @endif
                            <a onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            title="خروج" href="{{ route('logout') }}" class="btn btn-white btn-xs mr-1 custom-btn-white">
                                خروج
                            </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. header-section-->