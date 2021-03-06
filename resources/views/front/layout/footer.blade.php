<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="header-logo">
                    <a href="/" class="header-logo-link">
                        <img src="{{ asset('logo/'.$options['site_logo']) }}" class="rounded" style="max-height: 60px;display: block;" alt="لوگوی فروشگاه">
                    </a>
                </div>
            </div>
        </div>
        <hr class="footer-line">
        <div class="row ">
            <!-- footer-about -->
            {{-- <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <div class="footer-title"></div>
                    <ul class="list-unstyled">
                        <li><a href="#">درباره ما</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Legal & Privacy</a></li>
                    </ul>
                </div>
            </div> --}}
            <!-- /.footer-about -->
            <!-- footer-links -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="footer-widget text-right">
                    <div class="footer-title">لینک های سریع</div>
                    <ul class="list-unstyled">
                        <li><a href="{{route('blog')}}">مقالات</a></li>
                        @if (!\auth::check())
                            <li><a href="{{ route('register') }}">ثبت نام</a></li>
                            <li><a href="{{ route('login') }}">ورود</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /.footer-links -->
            <!-- footer-links -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="footer-widget text-right">
                    <div class="footer-title">شبکه های اجتماعی</div>
                    <ul class="list-unstyled">
                        <li><a href="{{ asset($options['social_link']->instagram) }}">Instagram</a></li>
                        <li><a href="{{ asset($options['social_link']->whatsapp) }}">WhatsApp</a></li>
                        <li><a href="{{ asset($options['social_link']->telegram) }}">Telegram</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.footer-links -->
            <!-- footer-links -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="footer-widget text-right">
                    <div class="footer-title">مشخصات ما</div>
                    <ul class="list-unstyled">
                        <span class="support-number"><strong>شماره تلفن :</strong> {{ $options['shop_phone'] }}</span><br/>
                        <li class="menu-item animate-dropdown"><a title="آدرس">{{ $options['shop_address'] }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.footer-links -->
            <!-- footer-links -->
            {{-- <div class="col-xl-3 col-lg-3 col-md-12 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <h3 class="footer-title">Subscribe Newsletter</h3>
                    <form>
                        <div class="newsletter-form">
                            <input class="form-control" placeholder="Enter Your Email address" type="text">
                            <button class="btn btn-default btn-sm" type="submit">Go</button>
                        </div>
                    </form>
                </div>
            </div> --}}
            <!-- /.footer-links -->
            <!-- tiny-footer -->
        </div>
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center ">
                <div class="tiny-footer">
                    <p class="pull-right"> تمام حقوق وبسایت © تا سال 2020 محفوظ است  | طراحی سایت توسط  <a href="https://www.smaat.ir " target="_blank" class="copyrightlink custom-color">SmaaT.CO</a></p>
                    <div class="pull-left" style="width: auto;">
                        <p><a class="custom-color pull-left " href="tel:09105009868"> تماس با تیم توسعه دهنده</a></p>
                        <p><a class="custom-color  pull-right " href="tel:09153388688"> تماس با پشتیبانی</a></p>
                    </div>
                </div>
            </div>
            <!-- /. tiny-footer -->
        </div>
    </div>
</div>
<!-- /.footer -->