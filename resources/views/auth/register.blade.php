<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>ایجاد حساب کاربری</title>
    <!-- Bootstrap -->
    <link href="/css/front/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Dropify CSS -->
	<link rel="stylesheet" href="/vendors/bower_components/dropify/dist/css/dropify.min.css">
	<!-- Style CSS -->
    <link href="/css/front/style.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="/css/front/font-awesome.min.css" rel="stylesheet">
    <!-- Fontello CSS -->
    <link rel="stylesheet" type="text/css" href="/css/fontello.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->
</head>

<body class="bg-primary pdt30 pdb30">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="offset-xl-3 col-xl-6 offset-lg-1 col-lg-10 col-md-12 col-sm-12 col-12 ">
                    <div class="register-form rounded">
                        <h2 class="text-center mb30">ایجاد حساب کاربری</h2>
						<form method="POST" action="{{ route('register') }}" class="validate-form">
							@csrf
							@php
								// dd(route('register'))
							@endphp
							@include('errors.errors-show')
							<div class="row">
								<div class="col-lg-6 form-group">
									<label class="control-label sr-only" for="first_name"></label>
									<input id="first_name" type="text" name="first_name" placeholder="نام" class="rounded text-right form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" required>
									@if ($errors->has('first_name'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('first_name') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-lg-6 form-group">
									<label class="control-label sr-only" for="last_name"></label>
									<input id="last_name" type="text" name="last_name" placeholder="نام خانوادگی" class="rounded text-right form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" required>
									@if ($errors->has('last_name'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('last_name') }}</strong>
										</span>
									@endif
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label sr-only" for="national_code"></label>
                                <input id="national_code" type="text" name="national_code" placeholder="کد ملی" class="rounded text-right form-control{{ $errors->has('national_code') ? ' is-invalid' : '' }}" value="{{ old('national_code') }}" required>
								@if ($errors->has('national_code'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('national_code') }}</strong>
									</span>
								@endif
							</div>
                            <div class="form-group">
                                <label class="control-label sr-only" for="phone_number"></label>
                                <input id="phone_number" type="text" name="phone_number" placeholder="تلفن ثابت / تلفن همراه" class="rounded text-right form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number') }}" required>
								@if ($errors->has('phone_number'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('phone_number') }}</strong>
									</span>
								@endif
							</div>
                            <div class="form-group">
                                <label class="control-label sr-only" for="birthday"></label>
                                <input id="birthday" type="text" name="birthday" name="تاریخ تولد" placeholder="روز/ماه/سال" class="rounded text-right form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" value="{{ old('birthday') }}" required>
								@if ($errors->has('birthday'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('birthday') }}</strong>
									</span>
								@endif
							</div>
                            <div class="form-group">
                                <label class="control-label sr-only" for="address"></label>
                                <input id="address" type="text" name="address" placeholder="آدرس" class="rounded text-right form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" required>
								@if ($errors->has('address'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('address') }}</strong>
									</span>
								@endif
							</div>
                            <div class="form-group">
                                <label class="control-label sr-only" for="email"></label>
                                <input id="email" type="text" name="email" placeholder="آدرس ایمیل" class="rounded text-right form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
								@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
                            <div class="form-group">
                                <label class="control-label sr-only" for="password"></label>
								<input id="password" type="password" name="password" placeholder="رمز عبور" class="rounded text-right form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
								@if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
                            </div>
                            <div class="form-group">
                                <label class="control-label sr-only" for="password_confirmation"></label>
                                <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" class="rounded text-right form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" required>
								@if ($errors->has('password-confirm'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password-confirm') }}</strong>
									</span>
								@endif
							</div>
							<div class="container-login100-form-btn">
								<button type="submit" name="singlebutton" class="btn btn-default custom-btn-warning btn-lg btn-block mb10 rounded">
									ثبت نام
								</button>
							</div>
                        </form>
                    </div>
                    <p class="text-white">قبلا ثبت نام کرده اید ؟<a href="{{ route('login') }}" class="text-yellow"> ورود</a> <span class="pull-right"><a href="{{route('index')}}" class="text-white">بازگشتن به صفحه اصلی</a></span> </p>
                </div>
                <!-- /.register-form -->
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/front/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/js/front/bootstrap.min.js"></script>
	<!-- Bootstrap Daterangepicker JavaScript -->
	<script src="/vendors/bower_components/dropify/dist/js/dropify.min.js"></script>
</body>

</html>