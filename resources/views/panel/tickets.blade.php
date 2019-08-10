@php
	$user = \App\User::findOrFail($user);
@endphp
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
				<h5 class="txt-dark">تیکت ها</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>تیکت ها</span></li>
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
							<h6 class="panel-title txt-dark">جستجو در تیکت ها</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  class="panel-wrapper collapse in">
						<div  class="panel-body">
							<div class="form-group">
								<div class="input-group">
									<input type="text" onkeyup="this.nextElementSibling.href = '/panel/ticket?query='+this.value" value="{{ request('query') }}" id="firstName" class="form-control" placeholder="مثلا : عنوان تیکت">
									<a href="/panel/ticket" class="input-group-addon"><i class="ti-search"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>

		<div class="seprator-block"></div>
		<!-- Product Row One -->
		<div class="row">
			@if( $tickets->isEmpty() )
			<div class="alert alert-warning alert-dismissable">
				<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
				<p class="pull-right">هیچ داده ای یافت نشد !</p>
				<div class="clearfix"></div>
			</div>
			@else
				<div class="col-md-12">
					<div class="panel panel-default border-panel card-view">
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="table-wrap">
									<div class="table-responsive">
											<div class="panel-body">
												@include('errors.errors-show')
											</div>
										<table id="datable_2" class="table table-hover table-bordered display mb-30">
											<h2 style="margin:15px;">تیکت ها</h2>
											<thead>
												<tr>
												    <th style="font-weight:bold; font-size:20px;">#</th>
													<th style="font-weight:bold; font-size:20px;">تصویر کاربر</th>
													<th style="font-weight:bold; font-size:20px;">عنوان تیکت</th>
												    <th style="font-weight:bold; font-size:20px;">کد تیکت</th>
													<th style="font-weight:bold; font-size:20px;">وضعیت</th>
													<th style="font-weight:bold; font-size:20px;">نام و نام خانوادگی</th>
													<th style="font-weight:bold; font-size:20px;">تاریخ شروع</th>
												  <th style="font-weight:bold; font-size:20px;">عملیات</th>
												</tr>
											</thead>
											<tbody>
												@php $i = 0 @endphp
												@foreach ($tickets as $ticket)
													@if (!$ticket->is_close)
														<tr style="text-align:center;">
															<td>{{ ++$i }}</td>
															<td>
																<div class="row" style="display: flex; justify-content: center;">
																	<div class="col-md-8">
																		<div class="row" style="display: flex; justify-content: center;">
																			<div class="col-md-8">
																				<img src=" {{$ticket->user->avatar ? $ticket->user->avatar : '/images/placeholder/placeholder.png'}}" style="background-size: cover; max-width: 80px; max-height: 60px; border-radius: 5px; width: 100%; height: 100%;" alt="تصویر">
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>{{ $ticket->title }}</td>
															<td>{{ $ticket->id }}</td>
															<td>
																@php
																	switch ($ticket->status) {
																		case 0: $status = ['معمولی', 'success']; break;
																		case 1: $status = ['حیاتی', 'danger']; break;
																		case 2: $status = ['مهم', 'warning']; break; 
																		case 3: $status = ['کم اهمیت', 'primary']; break;
																	}
																@endphp
																<span class="label bg-{{$status[1]}}">{{$status[0]}}</span>
															</td>
															<td>{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</td>
															<td title="{{ \Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('%H:i:s - %d %B %Y')  }}">
																{{ \Morilog\Jalali\Jalalian::forge($ticket->created_at)->ago() }}
															</td>
															<td>
																<div class="font-icon custom-style">
																	<form action="{{ route('ticket.destroy', ['ticket' => $ticket->id]) }}" method="POST">
																		<button aria-id="{{ $ticket->id }}" @if( !auth()->user()->can("delete-ticket") ) disabled @endif title="حذف تیکت" type="submit" itemid="{{ $ticket->id }}" id="hadiii" class="delete-item btn-xs btn btn-danger custom-btn-danger" onclick="hadi()"><i class="icon ti-trash custom-icon"></i></button>
																		@method('delete')
																		@csrf
																	</form>
																	<form action="{{ route('ticket.is_close', ['ticket' => $ticket->id]) }}" method="post">
																		<button aria-id="{{ $ticket->id }}" @if( !auth()->user()->can("close-ticket") ) disabled @endif title= "بستن تیکت" type="submit" class="btn btn-xs btn-warning custom-btn-warning"><i class="icon ti-close custom-icon"></i></button>
																		@method('put')
																		@csrf
																	</form>
																	<a aria-id="{{ $ticket->id }}" @if( !auth()->user()->can("read-ticket") ) disabled @endif title= "ارسال تیکت" style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-success btn-xs custom-btn-success" href="{{ route('ticket.edit', ['ticket' => $ticket->id]) }}">
																		<i class="icon ti-eye custom-icon"></i></a>
																</div>
															</td>
														</tr>
													@endif	
												@endforeach
											</tbody>
										</table>

										<table id="datable_2" class="table table-hover table-bordered display mb-30">
											<h2 style="margin:15px;">تیکت های بسته شده</h2>
											<thead>
												<tr>
													<th style="font-weight:bold; font-size:20px;">#</th>
													<th style="font-weight:bold; font-size:20px;">تصویر کاربر</th>
													<th style="font-weight:bold; font-size:20px;">عنوان تیکت</th>
													<th style="font-weight:bold; font-size:20px;">کد  تیکت</th>
													<th style="font-weight:bold; font-size:20px;">نام و نام خانوادگی</th>
													<th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th>
													<th style="font-weight:bold; font-size:20px;">تاریخ بسته شدن </th>
													<th style="font-weight:bold; font-size:20px;">عملیات</th>
												</tr>
											</thead>
											<tbody>
												@php $i = 0 @endphp
												@foreach ($tickets_u as $ticket)
													@if ($ticket->is_close)
														<tr style="text-align:center;">
															<td>{{ ++$i }}</td>
															<td>
																<div class="row" style="display: flex; justify-content: center;">
																	<div class="col-md-8">
																		<div class="row" style="display: flex; justify-content: center;">
																			<div class="col-md-8">
																				<img src=" {{$ticket->user->avatar ? $ticket->user->avatar : '/images/placeholder/placeholder.png' }}" style="background-size: cover; max-width: 80px; max-height: 60px; border-radius: 5px; width: 100%; height: 100%;" alt="تصویر">
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>{{ $ticket->title }}</td>
															<td>{{ $ticket->id }}</td>
															<td>{{ $ticket->user->first_name .' '. $ticket->user->last_name }}</td>
															<td title="{{ \Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('%H:i:s - %d %B %Y')  }}">
																{{ \Morilog\Jalali\Jalalian::forge($ticket->created_at)->ago() }}
															</td>
															<td title="{{ \Morilog\Jalali\Jalalian::forge($ticket->updated_at)->format('%H:i:s - %d %B %Y')  }}">
																{{ \Morilog\Jalali\Jalalian::forge($ticket->updated_at)->ago() }}
															</td>
															<td>
																<div class="font-icon">
																	<form action="{{ route('ticket.destroy', ['ticket' => $ticket->id]) }}" method="POST">
																		<button aria-id="{{ $ticket->id }}" @if( !auth()->user()->can("delete-ticket") ) disabled @endif title="حذف تیکت" type="submit" class="btn btn-xs btn-danger delete-item custom-btn-danger"><i class="icon ti-trash custom-icon"></i></button>
																		@method('delete')
																		@csrf
																	</form>
																</div>
															</td>
														</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
									{{ $tickets->links() }}
								</div>	
							</div>	
						</div>	
					</div>	
				</div>
			@endif
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
		$('.delete-item').on('click',function(event) {

		event.preventDefault();
		event.stopPropagation();

		var id = $(this).attr('aria-id');
		var tr = $(this).parent().parent().parent().parent()

		swal({   
			title: "مطمین هستید ؟",   
			text: "برای پاک کردن داده مورد نظر مطمین هستید ؟",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#f83f37",   
			confirmButtonText: "بله",   
			cancelButtonText: "خیر", 
		}, function(isConfirm){   
			if (isConfirm) {

				fetch('/panel/{{ $ticket }}/' + id, {
					method: 'post',
					headers: {
						"Content-Type": "application/json",
						"Accept": "application/json",
						"X-Requested-With": "XMLHttpRequest",
						"X-CSRF-Token": "{{ csrf_token() }}"
					},
					body: JSON.stringify({
						_method: 'delete'
					})
				})
				.then(function(response) {

					tr.remove()
				})
			}
		});

		return false;
		});
	</script>
@endsection