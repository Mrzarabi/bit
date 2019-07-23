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
		
		<!-- Group Row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-dark">جستجو در کاربران</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  class="panel-wrapper collapse in">
						<div  class="panel-body">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="first_name" onkeyup="this.nextElementSibling.href = '/panel/user/search/'+this.value" @isset($query) value="{{$query}}" @endisset id="firstName" class="form-control" placeholder="مثلا : نام کاربر">
									<a href="/panel/article/search/" class="input-group-addon"><i class="ti-search"></i></a>
								</div>
							</div>
						</div>
					</div>

					<div class="panel-body">
						@include('errors.errors-show')
					</div>
				</div>
			</div>
		</div>

		<div class="seprator-block"></div>
	
		<!-- Product Row One -->
		<div class="row">
			@empty($users[0])
			<div class="alert alert-warning alert-dismissable">
				<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
				<p class="pull-right">هیچ کاربری یافت نشد !</p>
				<div class="clearfix"></div>
			</div>
			@endempty
			<div class="col-md-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive over" style="overflow-x: hidden !important;">
									<table id="datable_2" class="table table-hover table-bordered display mb-30">
										<h2 style="margin:15px;">کاربران</h2>
										<thead>
											<tr>
											<th style="font-weight:bold; font-size:20px;">#</th>
												<th style="font-weight:bold; font-size:20px;">تصویر کاربر</th>
												<th style="font-weight:bold; font-size:20px;">نام و نام خانوادگی</th>
												<th style="font-weight:bold; font-size:20px;">نقش</th>
												<th style="font-weight:bold; font-size:20px;">تلفن</th>
												<th style="font-weight:bold; font-size:20px;">کد ملی</th>
												<th style="font-weight:bold; font-size:20px;">تولد</th>
												<th style="font-weight:bold; font-size:20px;">تاریخ وررود</th>
												<th style="font-weight:bold; font-size:20px;">عملیات</th>
											</tr>
										</thead>
										<tbody>
											@php $i = 0 @endphp
											@foreach ($users as $user)
													<tr style="text-align:center;">
														<td>{{ ++$i }}</td>
														<td>
															<div class="row" style="display: flex; justify-content: center;">
																<div class="col-md-3"></div>
																<div class="col-md-8">
																	@if ($user->avatar)
																	<div class="product-pic img-responsive"
																		style="background: url('{{ $user->avatar }}') center center;
																			background-size: cover; max-width: 50px; max-height: 50px; border-radius: 50%;">
																	@else
																		<div class="product-pic img-responsive "
																			style="background: url('/images/placeholder/download.png') center center;
																				background-size: cover; max-width: 50px; max-height: 50px; border-radius: 50%;">
																		</div>
																	@endif
																	</div>
																</div>
															</div>
														</td>
														<td>{{ $user->first_name . ' ' . $user->last_name }}</td>
														<td>
															@if ($user->roles)
																@foreach ($user->roles as $role)
																
																	{{ $user->roles[0]['display_name'] }}	
																@endforeach
															@else
																<h5>کاربر معمولی</h5>
															@endif
														</td>
														<td>{{ $user->phone_number }}</td>
														<td>{{ $user->national_code }}</td>
														<td>{{ \Morilog\Jalali\Jalalian::forge($user->birthday)->format('%d %B %Y') }}</td>
														<td title="{{ \Morilog\Jalali\Jalalian::forge($user->created_at)->format('%H:i:s - %d %B %Y')  }}">
															{{ \Morilog\Jalali\Jalalian::forge($user->created_at)->ago() }}
														</td>
														<td>
															<div class="font-icon custom-style">
																<form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
																	<button title= "حذف کاربر" type="submit" itemid="{{ $user->id }}" class="delete-item btn-xs btn btn-danger custom-btn-danger"><i class="icon ti-trash custom-icon"> </i></button>
																	<a title= "ویرایش کاربر" style="padding: 6px 5px !important; margin-right: 8px;" class="d-inline btn btn-xs btn-warning custom-btn-warning" href="{{ route('user.edit', ['user' => $user->id]) }}"><i class="icon ti-pencil custom-icon"> </i></a>
																	@method('delete')
																	@csrf
																</form>
																<a title= "دیدن اطلاعات کاربر" style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-success btn-xs custom-btn-success" href="{{ route('user.show', ['user' => $user->id]) }}"><i class="icon ti-plus custom-icon"></i></a>
																<a title= "تغییر پسورد کاربر" style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-info btn-xs custom-btn-info" href="{{ route('editPass', ['user' => $user->id]) }}"><i class="ti-key custom-icon"></i></a>
															</div>
														</td>
													</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							{{$users->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>	
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