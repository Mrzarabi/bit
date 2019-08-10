@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		//  Custom Fonts
		'dist/css/font-awesome.min.css',
		//  Calendar CSS
		'vendors/bower_components/fullcalendar/dist/fullcalendar.css"',
		//  Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.product-card {
		float: right;
	}

	.product-card .info {
	    height: 130px;
		overflow: auto;
	}

	.product-card .label {
		position: absolute;
		bottom: 10px;
		left: 0px;
		box-shadow: 0px 0px 10px -3px #000;
		padding: 5px 10px !important;
	}

	.product-card .btn.btn-circle {
		height: 20px;
		width: 20px;
	}

	.product-card .btn.btn-circle i {
		font-size: 10px !important;
	}

	.product-pic {
		height: 250px;
	}
	.label.flag {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		padding: 6px 10px;
		font-size: 20px;
		background: #9797979e;
		box-shadow: 0px 0px 10px #000;
		border-radius: 5px;
		height: 32px;
	}
	.gray {
		-webkit-filter: grayscale(100%);
		filter: grayscale(100%);
	}
	.shadow {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0px;
		left: 0px;
		background: #00000085;
	}
	.photo .options {
		z-index: 100;
	}
	.pagination {
		position: relative;
		top: 15px;
		width: 100%;
		display: flex;
		justify-content: center;
	}
	.delete-item {
		background: none;
		border: none;
	}
	</style>
@endsection
	
@section('content')
	<div class="container">

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">کاربران</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>کاربران</span></li>
					<li><a href="#"><span>کاربران</span></a></li>
					<li><a href="index.html">داشبورد</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <a href="{{route('user.index')}}"><button title="بازگشت به صفحه اصلی کاربران" class="btn btn-xs btn-purple pull-left custom-btn-purple custom-pama-btn" style="margin-bottom: 10px !important;"><i class="ti-back-left"></i></button></a>
                            <div class="col-md-4">
                                @if ($user->avatar)
                                    <div class="product-pic img-responsive "
                                        style="background: url('{{ $user->avatar }}') center center;
                                            background-size: cover; margin: 50px; max-width: 300px; border-radius: 7px;">
                                    </div>    
                                @else
                                    <div class="product-pic img-responsive "
                                        style="background: url('/images/placeholder/placeholder.png') center center;
                                            background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                            <thead>
                                                <tr>
                                                    <th>نام</th>
                                                    <th>نام خانوادگی</th>
                                                    <th>کد ملی</th>
                                                    <th>شماره تماس</th>
                                                    <th>تاریخ تولد</th>
                                                    <th> اجازه دسترسی به درگاه پرداخت</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align: center;">
                                                    <td>{{ $user->first_name }}</td>
                                                    <td>{{ $user->last_name }}</td>
                                                    <td>{{ $user->national_code }}</td>
                                                    <td>{{ $user->phone_number }}</td>
                                                    <td>
                                                        <p title="میلادی : {{$user->birthday}}">
                                                            {{ \Morilog\Jalali\Jalalian::forge($user->birthday)->format('%d %B %Y') }}
                                                        </p>
                                                    </td>
                                                    <td> 
                                                        <div style="display: inline-flex; justify-content: center;">
                                                            <form action="{{route('canBuy', ['user' => $user->id])}}" method="post">
                                                                <button title="دسترسی به درگاه پرداخت" aria-id="{{ $user->id }}" @if( !auth()->user()->can("update-user") ) disabled @endif  type="submit" class="font-icon custom-style btn btn-primary custom-btn-primary"><i class="fa fa-shopping-basket custom-icon" style="color: white !important;"> </i></button>
                                                                @csrf
                                                                @method("put")
                                                            </form>
                                                            @if ($user->can_buy)
                                                                <i style="color:green; padding-right:10px;" class="fa fa-check"></i>
                                                            @else
                                                                <i style="color:red; padding-right:20px;" class="ti-close"></i>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                            <thead style="margin-top:10px;">
                                                <tr>
                                                    <th>آدرس</th>
                                                    <th>ایمیل</th>
                                                    <th>تاریخ ورود</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align: center;">
                                                    <td>{{ $user->address }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <p title="{{ \Morilog\Jalali\Jalalian::forge($user->created_at)->format('%H:i:s - %d %B %Y') }}">
                                                            {{ \Morilog\Jalali\Jalalian::forge($user->created_at)->ago() }}
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                            <thead style="margin-top:10px;">
                                                <tr>
                                                    <th>تصویر کد ملی</th>
                                                    <th>تصویر شناسنامه</th>
                                                    <th>تصویر قبض</th>
                                                    <th>تصویر سلفی با کارت ملی</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align: center;">
                                                    <td>
                                                        <button type="button" class="custom-btn-primary btn btn-primary" data-toggle="modal" data-target="#image_national_code" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>
                                                        @if ($user->accept_image_national_code)
                                                            <i style="color:green; padding-right:10px;" class="fa fa-check"></i>
                                                        @else
                                                            <i style="color:red; padding-right:20px;" class="ti-close"></i>
                                                        @endif
                                                        <div class="modal fade" id="image_national_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        @if ($user->image_national_code)
                                                                        <div class="product-pic img-responsive "
                                                                            style="background: url('{{ $user->image_national_code }}') center center;
                                                                                background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate', ['user' => $user->id])}}" method="post">
                                                                            <input type="hidden" name="type" value="image_national_code" />
                                                                            <button type="submit" name="status" value="1" class="btn btn-orange custom-btn-warning btn-icon pull-left">تایید </button>
                                                                            <button type="submit" name="status" value="0" class="btn btn-secondary custom-btn-gainsboro btn-icon pull-left">رد</button>
                                                                            @else
                                                                                <div class="product-pic img-responsive "
                                                                                    style="background: url('/images/placeholder/placeholder.png') center center;
                                                                                        background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                                </div>  
                                                                            @endif
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="custom-btn-primary btn btn-primary" data-toggle="modal" data-target="#identify_certificate" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>
                                                        @if ($user->accept_identify_certificate)
                                                            <i style="color:green; padding-right:10px;" class="fa fa-check"></i>
                                                        @else
                                                            <i style="color:red; padding-right:20px;" class="ti-close"></i>
                                                        @endif
                                                        <div class="modal fade" id="identify_certificate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        @if ($user->identify_certificate)
                                                                        <div class="product-pic img-responsive "
                                                                            style="background: url('{{ $user->identify_certificate }}') center center;
                                                                                background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate', ['user' => $user->id])}}" method="post">
                                                                            
                                                                            <input type="hidden" name="type" value="identify_certificate" />
                                                                            <button type="submit" name="status" value="1" class="btn btn-orange custom-btn-warning btn-icon pull-left">تایید </button>
                                                                            <button type="submit" name="status" value="0" class="btn btn-secondary custom-btn-gainsboro btn-icon pull-left">رد</button>
                                                                            @else
                                                                                <div class="product-pic img-responsive "
                                                                                    style="background: url('/images/placeholder/placeholder.png') center center;
                                                                                        background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                                </div>
                                                                            @endif
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="custom-btn-primary btn btn-primary" data-toggle="modal" data-target="#image_bill" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>
                                                        @if ($user->accept_image_bill)
                                                            <i style="color:green; padding-right:10px;" class="fa fa-check"></i>
                                                        @else
                                                            <i style="color:red; padding-right:20px;" class="ti-close"></i>
                                                        @endif
                                                        <div class="modal fade" id="image_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        @if ($user->image_bill)
                                                                        <div class="product-pic img-responsive "
                                                                            style="background: url('{{ $user->image_bill }}') center center;
                                                                                background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate', ['user' => $user->id])}}" method="post">
                                                                            <input type="hidden" name="type" value="image_bill" />
                                                                            <button type="submit" name="status" value="1" class="btn btn-orange custom-btn-warning btn-icon pull-left">تایید </button>
                                                                            <button type="submit" name="status" value="0" class="btn btn-secondary custom-btn-gainsboro btn-icon pull-left">رد</button>
                                                                            @else
                                                                                <div class="product-pic img-responsive "
                                                                                    style="background: url('/images/placeholder/placeholder.png') center center;
                                                                                        background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                                </div>
                                                                            @endif
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="custom-btn-primary btn btn-primary" data-toggle="modal" data-target="#image_selfie_national_code" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>
                                                        @if ($user->accept_image_selfie_national_code)
                                                            <i style="color:green; padding-right:10px;" class="fa fa-check"></i>
                                                        @else
                                                            <i style="color:red; padding-right:20px;" class="ti-close"></i>
                                                        @endif
                                                        <div class="modal fade" id="image_selfie_national_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        @if ($user->image_selfie_national_code)
                                                                        <div class="product-pic img-responsive "
                                                                            style="background: url('{{ $user->image_selfie_national_code }}') center center;
                                                                                background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate', ['user' => $user->id])}}" method="post">
                                                                            <input type="hidden" name="type" value="image_selfie_national_code" />
                                                                            <button type="submit" name="status" value="1" class="btn btn-orange custom-btn-warning btn-icon pull-left">تایید </button>
                                                                            <button type="submit" name="status" value="0" class="btn btn-secondary custom-btn-gainsboro btn-icon pull-left">رد</button>
                                                                            @else
                                                                                <div class="product-pic img-responsive "
                                                                                    style="background: url('/images/placeholder/placeholder.png') center center;
                                                                                        background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                                </div>
                                                                            @endif
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                            <thead style="margin-top:10px;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>نام بانک</th>
                                                    <th>شماره بانک</th>
                                                    <th>شماره شبا</th>
                                                    <th>تاریخ ثبت</th>
                                                    <th>تصویر کارت بانکی</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tbody>
                                                    @php $i = 0 @endphp
                                                    @foreach ($user->bankCard as $item)
                                                        <tr style="text-align: center;">
                                                            <td>{{ ++$i }}</td>
                                                            <td>{{ $item->bank_name }}</td>
                                                            <td>{{ $item->bank_card }}</td>
                                                            <td>{{ $item->code }}</td>
                                                            <td>
                                                                <p title="{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:i:s - %d %B %Y') }}">
                                                                    {{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="custom-btn-primary btn btn-primary" data-toggle="modal" data-target="#{{$item->id}}" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>
                                                                @if ($item->accept_image_bank_card)
                                                                    <i style="color:green; padding-right:10px;" class="fa fa-check"></i>
                                                                @else
                                                                    <i style="color:red; padding-right:20px;" class="ti-close"></i>
                                                                @endif
                                                                <div class="modal fade" id="{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                @if ($item->image_bank_card)
                                                                                <div class="product-pic img-responsive "
                                                                                    style="background: url('{{ $item->image_bank_card }}') center center;
                                                                                        background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                                </div>    
                                                                            </div>    
                                                                            <div class="modal-footer">
                                                                                <form action="{{route('accept_certificate_bank', ['bank_card' => $item->id])}}" method="post">
                                                                                    <input type="hidden" name="type" value="image_bank_card" />
                                                                                    <button type="submit" name="status" value="1" class="btn btn-orange custom-btn-warning btn-icon pull-left">تایید </button>
                                                                                    <button type="submit" name="status" value="0" class="btn btn-secondary custom-btn-gainsboro btn-icon pull-left">رد</button>
                                                                                    @else
                                                                                        <div class="product-pic img-responsive "
                                                                                            style="background: url('/images/placeholder/placeholder.png') center center;
                                                                                                background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                                        </div>
                                                                                    @endif
                                                                                    @method('put')
                                                                                    @csrf
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>	
                            </div>
                        </div>	
                    </div>	
                </div>
            </div>
        </div>
		<!-- /Product Row Four -->
		
	</div>
@endsection

@section('scripts')
	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		'dist/js/sweetalert-data.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Init JavaScript
		'dist/js/init.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach

	<script>
        // $('#myModal').on('shown.bs.modal', function () {
        //     $('#myInput').trigger('focus')
        // })
		$('.delete-item').on('click',function(){
			var title = $(this).parent().parent().next().find('h5').text();
			var id = $(this).attr('product');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن کاربر " + title + " مطمین هستید ؟",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#f83f37",   
				confirmButtonText: "بله",   
				cancelButtonText: "خیر",   
				closeOnConfirm: false,   
				closeOnCancel: false 
			}, function(isConfirm){   
				if (isConfirm) {
					form.submit();
				} else {     
					swal("لغو شد", "هیچ کاربری حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection