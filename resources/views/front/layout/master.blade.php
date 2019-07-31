<!DOCTYPE html>
<html lang="fa" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $options['site_name'] }} @isset($page_title) | {{$page_title}} @endisset</title>
        @foreach ([
            'css/front/bootstrap.min.css',
            'assets/css/bootstrap-rtl.min.css',
            'assets/css/font-awesome.min.css',
            'assets/css/animate.min.css',
            'assets/css/font-electro.css',
            'assets/css/owl-carousel.css',
            'css/front/style.css',
            // 'assets/css/rtl.min.css',
            'assets/css/colors/red.min.css',
            'assets/css/font.css',
            'css/front/fontello.css'
            // 'css/fontello.css'
        ] as $item)
            <link rel="stylesheet" type="text/css" href="{{ asset($item) }}" media="all" />
        @endforeach

        @yield('style')

        <style>
            .alert.alert-success {
                background: linear-gradient(to bottom right, #5cb85c, #17ac17);
                color: #f9fff7;
            }
            .alert.alert-danger {
                background: linear-gradient(to bottom right, #ea1b25, #cb434a);
                color: #ffefef;
            }
        </style>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="assets/images/fav-icon.png">
    </head>

    <body class="@yield('body-class')">
        <div id="page" class="hfeed site">
            {{-- <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a> --}}

            {{-- <div class="loading">
                <div id="bitcoin">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="200px" height="200px" viewBox="100 100 400 400" xml:space="preserve">
                        <filter id="dropshadow" height="130%">
                    <feGaussianBlur in="SourceAlpha" stdDeviation="5"/>
                    <feOffset dx="0" dy="0" result="offsetblur"/>
                    <feFlood flood-color="red"/>
                    <feComposite in2="offsetblur" operator="in"/>
                    <feMerge>
                    <feMergeNode/>
                    <feMergeNode in="SourceGraphic"/>
                    </feMerge>
                    </filter>          
                    <path class="path" style="filter:url(#dropshadow)" fill="#000000" d="M446.089,261.45c6.135-41.001-25.084-63.033-67.769-77.735l13.844-55.532l-33.801-8.424l-13.48,54.068
                        c-8.896-2.217-18.015-4.304-27.091-6.371l13.568-54.429l-33.776-8.424l-13.861,55.521c-7.354-1.676-14.575-3.328-21.587-5.073
                        l0.034-0.171l-46.617-11.64l-8.993,36.102c0,0,25.08,5.746,24.549,6.105c13.689,3.42,16.159,12.478,15.75,19.658L208.93,357.23
                        c-1.675,4.158-5.925,10.401-15.494,8.031c0.338,0.485-24.579-6.134-24.579-6.134l-9.631,40.468l36.843,9.188
                        c8.178,2.051,16.209,4.19,24.098,6.217l-13.978,56.17l33.764,8.424l13.852-55.571c9.235,2.499,18.186,4.813,26.948,6.995
                        l-13.802,55.309l33.801,8.424l13.994-56.061c57.648,10.902,100.998,6.502,119.237-45.627c14.705-41.979-0.731-66.193-31.06-81.984
                        C425.008,305.984,441.655,291.455,446.089,261.45z M368.859,369.754c-10.455,41.983-81.128,19.285-104.052,13.589l18.562-74.404
                        C306.28,314.65,379.774,325.975,368.859,369.754z M379.302,260.846c-9.527,38.187-68.358,18.781-87.442,14.023l16.828-67.489
                        C327.767,212.14,389.234,221.02,379.302,260.846z"/>
                    </svg>
                </div>
            </div> --}}

            @include('front.layout.header')

            @yield('content')

            @include('front.layout.footer')

        </div><!-- #page -->

        @foreach ([
            // 'assets/js/jquery.min.js',
            'assets/js/tether.min.js',
            // 'assets/js/bootstrap.min.js',
            'assets/js/bootstrap-hover-dropdown.min.js',
            'assets/js/owl.carousel.min.js',
            'assets/js/echo.min.js',
            'assets/js/wow.min.js',
            'assets/js/jquery.easing.min.js',
            'assets/js/jquery.waypoints.min.js',
            'assets/js/electro.js',
            'js/front/jquery.min.js',
            'js/front/bootstrap.min.js',
            'js/front/menumaker.js',
            'js/front/return-to-top.js',
            'js/front/navigation.js',
            'js/front/particles.min.js',
            'js/numeral.min.js', // js numeral formatter
        ] as $item)
            <script type="text/javascript" src="{{ asset($item) }}"></script>
        @endforeach
    
        <script>
            var nums = document.getElementsByClassName('num-comma');

            for (num in nums) {
                nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
            }
        </script>

        @yield('script')
    </body>
</html>