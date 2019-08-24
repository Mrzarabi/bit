
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Cointrade HTML Website Template - Sign in Page </title>
    <!-- Bootstrap -->
    <link href="css/front/bootstrap.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link href="css/front/style.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Fontello CSS -->
    <link rel="stylesheet" type="text/css" href="css/front/fontello.css">
    @foreach ([
        'assets/css/font.css',
        // 'css/fontello.css'
    ] as $item)
        <link rel="stylesheet" type="text/css" href="{{ asset($item) }}" media="all" />
    @endforeach
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->
</head>

<body class="bg-primary pdt100">
	<div class="content">
		<div class="container">
			<div class="row text-right">
				<!-- login-form -->
				<div class="offset-xl-3 col-xl-6 offset-lg-1 col-lg-10 col-md-12 col-sm-12 col-12 ">
					<div class="login-form rounded">
						<h2 class="text-center mb30">ورود به حساب کاربری</h2>
						<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
							@csrf
                            <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
                                <label class="control-label sr-only" for="email"></label>
								<input id="email" type="email" name="email" placeholder=" ایمیل"class="rounded text-right form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required>
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
                            <button type="submit" name="singlebutton" class="btn btn-default btn-lg rounded custom-btn-warning btn-block mt20">ورود به حساب</button>
                        </form>
					</div>
						<a href="{{ route('register') }}" class="text-yellow pull-left pl-3">هنوز ثبت نام نکرده اید ؟</a>
						<span class="pull-right">
							<a href="{{route('index')}}" class="text-white">برگشتن به صفحه اصلی</a>
						</span>
                </div>
                <!-- /.login-form -->
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/front/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/front/bootstrap.min.js"></script>
</body>

</html>