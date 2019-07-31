
@section('style')
    <link rel="stylesheet" type="text/css" href="css/fontello.css">
@endsection>

@extends('front.layout.master')

@section('body-class', 'page home page-template-default')

@section('content')
    <!-- header-section-->
    <div class="header-wrapper fixed-top header-second">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="logo"> <a href="index.html"><img src="./images/logo.png" alt=""> </a> </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
                    <!-- navigations-->
                    <div class="navigation">
                        <div id="navigation">
                            <ul>
                                <li class="active"><a href="index.html">Home</a></li>
                                   <li class="active"><a href="bitcoin-widget.html">Bitcoin Widget</a></li>
                           
                                <li class="has-sub"><a href="#">Blog</a>
                                    <ul>
                                        <li><a href="blog-default.html">Blog Default</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li class="has-sub"><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="about.html">about</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Sign up</a></li>
                                        <li><a href="error-page.html">404 page</a> </li>
                                        <li><a href="styleguide.html">styleguide</a> </li>
                                    </ul>
                                </li>
                                <li><a href="contact-us.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.navigations-->
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 d-none d-xl-block d-lg-block">
                    <div class="header-quick-info">
                        <a href="login.html" class="btn btn-white btn-xs mr-1">Login</a></li>
                        <a href="register.html" class="btn btn-default btn-xs">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. header-section-->
    <!-- page-header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-caption">
                        <h1 class="page-title">About us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- about -->
    <!-- about description -->
    <div class="content pdb0">
        <div class="container">
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="section-title">
                        <h2>Who is CoinTrade?</h2>
                    </div>
                </div>
            </div>
            <!-- about description -->
            <div class="row ">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                    <div class="mb20">
                        <p class="lead">Quisque interdum arcutlacs sollicitudin cursus at vel ligellentesque eget fs none metus aliquet tepor veid arcpretiumute impdiet dolor ultriceras dapibus.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                    <div class="mb20">
                        <p>Nam non convallis mielaoreet enimuspendis facibus magna elitmolestie ultricies ligula dign issllus rutrume egestas gravida. Etiam sodales volutpat enut ultricese sem varius vitaeis vel dui commod convstie ultricies ligula dignissllus. </p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                    <div class="mb20">
                        <p>Seronse convallis mielaoreet enimuspendis facibuses magna elitmolestie ultricies ligula dignissllus rutrume egestas gravida. Etiam semonvallis diammag naestie ultricies ligulaser sodales volutpat enut ultricese. </p>
                    </div>
                </div>
            </div>
            <!-- /.about description -->
            <hr>
            <div class="row ">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                    <!-- counter -->
                    <div class="counter-block">
                        <h2 class="counter-title">$10B+</h2>
                        <p class="counter-text">In Digital Currency Exchanged</p>
                    </div>
                </div>
                <!-- /.counter -->
                <!-- counter -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                    <div class="counter-block">
                        <h2 class="counter-title">10M+</h2>
                        <p class="counter-text">Customers Served</p>
                    </div>
                </div>
                <!-- /.counter -->
                <!-- counter -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                    <div class="counter-block">
                        <h2 class="counter-title">16+</h2>
                        <p class="counter-text">Countries Supported</p>
                    </div>
                </div>
                <!-- /.counter -->
            </div>
        </div>
        <!-- /.about -->
        <!-- feature-blurb-section -->
        <div class="bg-light mt80 pdt80 pdb80">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mb30 ">
                        <h2>Why Trade with us</h2>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                        <!-- feature-blurb -->
                        <div class="feature-blurb-block">
                            <h4>Faster Settlements</h4>
                            <p>Proin blandit venenatis nequeeu sere euismod mi condimeget. </p>
                        </div>
                    </div>
                    <!-- /.feature-blurb -->
                    <!-- feature-blurb -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                        <div class="feature-blurb-block">
                            <h4>Reliability</h4>
                            <p>Donec unulla etorciltes sceler qumllis nisi sit amet ultricies alique. </p>
                        </div>
                    </div>
                    <!-- /.feature-blurb -->
                    <!-- feature-blurb -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                        <div class="feature-blurb-block">
                            <h4>High Performance</h4>
                            <p>Proin blandit venenatis nequeeu sere euismod mi condimeget. </p>
                        </div>
                    </div>
                    <!-- /.feature-blurb -->
                </div>
            </div>
        </div>
        <!-- /.feature-blurb-section -->
        <!-- clients -->
        <div class="mt80 pdt60">
            <div class="container">
                <div class="row ">
                    <!-- client-logo -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="client-logo">
                            <a href="#"> <img src="./images/client_logo_1.png" alt="" class="grayscale" ></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="client-logo">
                            <a href="#"> <img src="./images/client_logo_2.png" alt="" class="grayscale" ></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="client-logo">
                            <a href="#"> <img src="./images/client_logo_3.png" alt="" class="grayscale" ></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="client-logo">
                            <a href="#"> <img src="./images/client_logo_3.png" alt="" class="grayscale" ></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="client-logo">
                            <a href="#"> <img src="./images/client_logo_1.png" alt="" class="grayscale" ></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="client-logo">
                            <a href="#"> <img src="./images/client_logo_4.png" alt="" class="grayscale" ></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                </div>
            </div>
        </div>
        <!-- /.clients -->
        <!-- cta-block -->
        <div class="bg-light mt80 pdt60 pdb60">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="cta-block text-center pinside40">
                            <div class="cta-icon"><i class="icon-network"></i></div>
                            <h3>We're Hiring - Join The Team</h3>
                            <p>Duis sed fringilla augliqvel vulputate eut tincidunt esmaximus ipsum nec rutrum mollisllam volutpat augueat nulla. </p>
                            <a href="#" class="btn btn-default">Open Positions</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="cta-block text-center pinside40">
                            <div class="cta-icon"><i class="icon-hierarchical-structure"></i></div>
                            <h3>Talk to Our Experts</h3>
                            <p>Sed fringilla augliqvel vulputate eut tincidunt esmaximus ipsum nec rutrum mollisllam volutpat auguea. </p>
                            <a href="#" class="btn btn-default">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.cta-block -->
    </div>
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="ft-logo"><img src="./images/logo.png" alt=""></div>
                </div>
            </div>
            <hr class="footer-line">
            <div class="row ">
                <!-- footer-about -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                    <div class="footer-widget ">
                        <div class="footer-title">Company</div>
                        <ul class="list-unstyled">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">Legal & Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-about -->
                <!-- footer-links -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                    <div class="footer-widget ">
                        <div class="footer-title">Quick Links</div>
                        <ul class="list-unstyled">
                            <li><a href="#">News</a></li>
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-links -->
                <!-- footer-links -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                    <div class="footer-widget ">
                        <div class="footer-title">Social</div>
                        <ul class="list-unstyled">
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Google +</a></li>
                            <li><a href="#">Linked In</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-links -->
                <!-- footer-links -->
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-6 col-6 ">
                    <div class="footer-widget ">
                        <h3 class="footer-title">Subscribe Newsletter</h3>
                        <form>
                            <div class="newsletter-form">
                                <input class="form-control" placeholder="Enter Your Email address" type="text">
                                <button class="btn btn-default btn-sm" type="submit">Go</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.footer-links -->
                <!-- tiny-footer -->
            </div>
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center ">
                    <div class="tiny-footer">
                        <p>Copyright © All Rights Reserved 2020 | Template Design & Development by <a href="https://easetemplate.com/ " target="_blank" class="copyrightlink">EaseTemplate</a></p>
                    </div>
                </div>
                <!-- /. tiny-footer -->
            </div>
        </div>
    </div>

@endsection