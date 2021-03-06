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
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
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
				<h5 class="txt-dark">پیام تیکت </h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>تیکت ها</span></li>
					<li><a href="#"><span>تیکت</span></a></li>
					<li><a href="index.html">کاربران</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		
		<!-- Product Row One -->
		<div class="row">
			@empty($ticket)
			<div class="alert alert-warning alert-dismissable">
				<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
				<p class="pull-right">هیچ تیکتی یافت نشد !</p>
				<div class="clearfix"></div>
			</div>
			@else
			<div class="panel-body">
				@include('errors.errors-show')
			</div>
			<div class="col-md-12">
				<a href="{{route('ticket.index')}}"><button title="بازگشت به صفحه اصلی تیکت ها" class="btn btn-xs btn-purple pull-left custom-btn-purple custom-pama-btn" style="margin-left: 50px; margin-bottom: 10px !important;"><i class="ti-back-left"></i></button></a>
				
				<button aria-id="{{ $ticket->id }}" @if( !auth()->user()->can("answer-ticket_messages") ) disabled @endif title="پاسخ دادن به تیکت" type="button" class="btn btn-xs btn-primary custom-pama-btn custom-btn-primary pull-left" data-toggle="modal" data-target="#answer" data-whatever="@getbootstrap" style="border-radius: 7px; margin-left: 15px;"><i class="icon ti-plus custom-icon"></i></button>
                    
                    <div class="modal fade" id="answer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="max-width: 700px; width: 700px;">
                                <div class="modal-footer">
                                    <div class="row">
                                        <form action="{{ route('ticket.store') }}" enctype="multipart/form-data" method="POST">
                                            <div class="col-md-12">
												<div class="row">
													<div class="col-md-8">
														<div class="form-group @if( $errors->has('title') ) has-error @endif">
															<label class="control-label mb-10">عنوان تیکت </label>
															<div class="input-group">
																<input type="text" name="title" id="title" class="form-control" placeholder="عنوان تیکت ">
																<div class="input-group-addon"><i class="ti-text"></i></div>
															</div>
															@if( $errors->has('title') )
																<span class="help-block">{{ $errors->first('title') }}</span>
															@endif
														</div>
														<div class="form-group @if( $errors->has('message') ) has-error @endif">
															<label class="control-label mb-10">متن تیکت</label>
															<div class="input-group">
																<textarea class="form-control" id="description" name="message" style="resize:none;" placeholder="متن تیکت خود را وارد کنید" rows="5"></textarea>
																<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
															</div>
															@if( $errors->has('message') )
																<span class="help-block">{{ $errors->first('message') }}</span>
															@endif
														</div>
													</div>	
													<div class="col-md-4">
														<div class="mt-30">
															<input type="file" name="image" id="input-file-now" class="dropify" @if ( isset($ticket ) && $ticket->image) data-default-file="{{ $ticket->image }}" @endif/>
														</div>
													</div>
												</div>	
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-orange custom-btn-warning btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ارسال</span></button>
                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />
                                                </div>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-card">
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="table-wrap">
									<div class="table-responsive" style="overflow: unset !important;">
										@if (!$ticket->ticketmessages->isEmpty())
											@if (\auth::user()->hasRole('owner'))
												@foreach ($ticket->ticketmessages as $item)
													<div class="row" style="padding-bottom: 10px;">
														<div class="col-md-1"></div>
														<div class="col-lg-10 pull-right" style="background: #eee; padding: 15px; border-radius: 7px;">
															<h2 style="padding: 5px; font-size: 30px; font-weight: bold;"> {{$item->title}} </h2>
															<p style="padding: 25px; text-align: justify; ">{{$item->message}}</p>
															@if ( isset($item->image) )
																<button type="button" class="custom-btn-primary btn btn-primary pull-left" data-toggle="modal" data-target="#image" data-whatever="@getbootstrap" style="border-radius: 7px; margin-top: -116px;">باز کردن تصویر</button>
																<div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-body">
																				<div class="product-pic img-responsive "
																					style="background: url('{{ $item->image }}') center center;
																						background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															@endif
															<small style="float:left; font-size:10px; padding:25px;" title="{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:i:s - %d %B %Y') }}">
																{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}
															</small>
														</div>
														<div class="col-md-1"></div>
													</div>
												@endforeach
											@else
												@foreach ($ticket->ticketmessages as $item)
													<div class="row" style="padding-bottom: 10px;">
														<div class="col-md-1"></div>
														<div class="col-lg-10 pull-right" style="background: #dbf6f4cc; padding: 15px; border-radius: 7px;">
															<h2 style="padding: 5px; font-size: 30px; font-weight: bold;"> {{$item->title}} </h2>
															<p style="padding: 25px; text-align: justify; word-break: break-all;">{{$item->message}}</p>
															@if ( isset($item->image) )
																<button type="button" class="custom-btn-primary btn btn-primary pull-left" data-toggle="modal" data-target="#image" data-whatever="@getbootstrap" style="border-radius: 7px; margin-top: -116px;">باز کردن تصویر</button>
																<div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-body">
																				<div class="product-pic img-responsive "
																					style="background: url('{{ $item->image }}') center center;
																						background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															@endif
															<small style="float:left; font-size:10px; padding:25px;" title="{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:i:s - %d %B %Y') }}">
																{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}
															</small>
														</div>
														<div class="col-md-1"></div>
													</div>
												@endforeach
											@endif
										@else
											<h2 class="text-center font-32" style="font-weight: bold;">هنوز تیکتی برای نمایش وجود ندارد :(</h2>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endempty
		</div>
	</div>
@endsection

@section('scripts')
	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		// Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js',
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
		$('.dropify').dropify({
			messages: {
				'default': 'فایل مورد نظر را به اینجا بکشید یا کلیک کنید',
				'replace': 'برای جایگذاری فایل کلیک کنید یا فایل را در اینجا رها کنید',
				'remove':  'پاک کردن',
				'error':   'متاسفانه خطایی رخ داد !'
			},
			error: {
				'fileSize': 'حجم فایل نباید بیش از 512 کیلوبایت باشد .',
				'imageFormat': 'لطفا عکسی به صورت مربع<br/> (نسبت 1 به 1) انتخاب کنید'
			}
		});
	</script>
@endsection