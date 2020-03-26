@include('front.layout.loading')

@extends('front.layout.master')

@section('body-class', 'page home page-template-default')

@section('content')

    <!--  hero-section -->
    <div id="particles-js" class="hero-section">
    </div>
    <div class="hero-container">
        <div class="container">
            <div class="row ">
                <div class="offset-xl-7 col-xl-5 offset-lg-7 col-lg-5 col-md-12 col-sm-12 col-12 text-center ">
                    <!--  hero-block-->
                    <div class="hero-block">
                        <h2 class="hero-title mb30">برای خرید آسان و امن با قیمت مناسب با ما همراه باشید .</h2>
                    </div>
                    <!--  /.hero-block-->
                </div>
            </div>
        </div>
    </div>
    <!--  about-section -->
    <div class="space-medium" id="rules">
        <div class="container mt">
            <div class="row">
                <!--  section-title -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="section-title">
                        <h2 class="text-right mt-120">قوانین </h2>
                    </div>
                </div>
                <!--  /.section-title -->
            </div>
            <!-- about -->
            <div class="row text-right">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="mb20">
                        <ul>
                            <li> <p class="lead"> کلیه فعالیت های سایت مشهد اکسچنج تابع قوانین جمهوری اسلامی ایران به صورت عام و جرایم رایانه ای به صورت خاص می باشد  </p> </li>
                            <li> <p> براساس تکلیفی که قوانین جرایم رایانه ای و همپنین پلیس فتا بر عهده فروشندگان در فضای مجازی قرار داده سایت مشهد اکسچنج خود را ملزم به احراز هویت متقاضیان خرید و فروش می داند .  </p> </li>
                            <li> <p> در صورت تلاش جهت استفاده از کارتهای بانکی سرقتی و یا اطلاعات هک شده دیگران در هنگام خرید ، کلیه اطلاعات و مشخصات شما در اختیار پلیس فتا قرار داده خواهد شد .  </p> </li>
                            <li> <p> واریز به حساب شخص ثالث طبق قوانین جمهوری اسلامی و بانک مرکزی ممنوع می باشد لذا واریز کننده وجه و درخواست کننده سفارش باید یکسان باشد. </p> </li>
                            <li> <p> در صورت ثبت نادرست حساب گیرنده و عدم اطمینان از گیرنده ، سایت مشهد اکسچنج هیچگونه مسئولیتی در این راستا نمی پذیرد .  </p> </li>
                            <li> <p> ثبت نام و ثبت سفارش در سایت کاربر تایید می کند که موارد فوق را مطالعه و پذیرفته است .  </p> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.about description -->
            <hr>
        </div>
    </div>
    <!-- /.about -->
    <!--  buy/sell-section -->
    <div class="space-medium bg-light" id="about">
        <div class="container">
            <div class="row ">
                <!--  buy/sell-details -->
                <div class="offset-xl-1 col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="pdt40 text-right">
                        <h3> خرید و فروش انواع ارزهای الکترونیکی و دیجیتال </h3>
                        <p> سایت مشهد اکسچنج با هدف دور زدن تحریم های مالی و کم کردن آثار آن در زمینه تامین ارز های مجازی برای هموطنان جهت معاملات بین المللی و نقد کردن درآمد های ارزی شما فعال می باشد . </p>
                        @guest
                            @if (Route::has('register'))
                            <div class="row">
                                
                                <div class="col-12">
                                        <a class="btn btn-default custom-btn-warning mb" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>
                                </div>
                            </div>
                            @endif
                        @endguest
                    </div>
                </div>
                <!--  /.buy/sell-details -->
                <!--  buy/sell-image -->
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="">
                        <img class="custom-border-radius custom-drop-shadow" src="./images/bitcoin/bitcoin_PNG1.png" alt="تصویر">
                    </div>
                </div>
                <!--  /.buy/sell-image -->
            </div>
        </div>
    </div>
    <!--  buy/sell-section -->
    <!-- feature-section -->
    <div class="space-medium bg-light">
        <div class="container">
            <div class="row text-right">
                <!-- feature-left -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="feature-left">
                        <div class="feature-icon float-right">
                            <img src="/images/bitcoin/icons/reload.png" class="custom-icons" alt="تصویر">
                        </div>
                        <div class="feature-content">
                            <h4>به روز رسانی</h4>
                            <p> به روز رسانی نرخ ها بصورت روزانه </p>
                        </div>
                    </div>
                </div>
                <!-- /.feature-left -->
                <!-- feature-left -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="feature-left">
                        <div class="feature-icon float-right">
                            <img src="/images/bitcoin/icons/choices.png" class="custom-icons" alt="تصویر">
                        </div>
                        <div class="feature-content">
                            <h4>سفارشات</h4>
                            <p> دریافت سفارش در کمترین زمان ممکن </p>
                        </div>
                    </div>
                </div>
                <!-- /.feature-left -->
                <!-- feature-left -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="feature-left">
                        <div class="feature-icon float-right">
                            <img src="/images/bitcoin/icons/call-center.png" class="custom-icons" alt="تصویر">    
                        </div>
                        <div class="feature-content">
                            <h4>پشتیبانی</h4>
                            <p> پشتیبانی با کیفیت از طریق تیکت </p>
                        </div>
                    </div>
                </div>
                <!-- /.feature-left -->
            </div>
        </div>
    </div>
    <!-- /.feature-section -->
    <!-- cta-section -->
    <div class="cta-section">
        <div class="container">
            <div class="row ">
                <div class="col-xl-6col-lg-6 col-md-12 col-sm-12 col-12">
                    {{-- <div style="width: 100%; height: 100%; position: relative; top: 0px; bottom: 0px;">  --}}
                        <div class="cta-block">
                            <h2 class="text-white text-shadow-custom">سادگی و امنیت خاطر را با ما تجربه کنید</h2>
                            {{-- <p>سادگی و امنیت خاطر را با ما تجربه کنید</p> --}}
                            {{-- <a href="#" class="btn btn-default custom-btn-warning">همین حالا ثبت نام کنید</a> --}}
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        <div class="shadow-effect"></div>
    </div>
    <!-- /.cta-section -->
@endsection
    
    <!-- footer -->
@section('script')
    
    <a href="javascript:" id="return-to-top"><i class="fa fa-angle-up"></i></a>
    <script>
    /* ---- particles.js config ---- */
    /* -----------------------------------------------
/* How to use? : Check the GitHub README
/* ----------------------------------------------- */

    /* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */
    /*
    particlesJS.load('particles-js', 'particles.json', function() {
      console.log('particles.js loaded - callback');
    });
    */

    /* Otherwise just put the config content (json): */

    particlesJS('particles-js',

        {
            "particles": {
                "number": {
                    "value": 20,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ff9f2a"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.4,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 5,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ff9f2a",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true,
            "config_demo": {
                "hide_card": false,
                "background_color": "#b61924",
                "background_image": "",
                "background_position": "50% 50%",
                "background_repeat": "no-repeat",
                "background_size": "cover"
            }
        }

    );
    </script>
@endsection
