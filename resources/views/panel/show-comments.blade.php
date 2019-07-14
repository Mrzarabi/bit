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
		//css style
		'css/style.css',
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
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">مقالات</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">داشبورد</a></li>
					<li><a href="#"><span>فروشگاه</span></a></li>
					<li class="active"><span>مقالات</span></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="about-author d-flex p-4 bg-light" style="padding-top:20px;">
							<div class="bio">
								<div class="row" style="padding-bottom: 10px;">
									<div class="col-md-2"></div>
									<div class="col-md-3">
										@if ($article->image)
											<img src="{{$article->image}}" alt="تصویر مقاله" class="img-fluid mb-4">
										@else
											<img src="/images/placeholder/placeholder.png" alt="تصویر مقاله" class="img-fluid mb-4">
										@endif
									</div>
									<div class="col-md-6">
										<a href="{{route('article.index')}}"><button title="بازگشت به صفحه اصلی مقالات" class="btn btn-xs btn-purple pull-left custom-btn-purple custom-pama-btn"><i class="ti-back-left"></i></button></a>
										<h3 style="padding-top: 10px;"> {{$article->title}} </h3>
										@if ($article->description)
											<p style="text-align: justify;"> {{$article->description}} </p>	
										@else
											<p> این مقاله توضیحات ندارد ... </p>
										@endif
									</div>
								</div>
								{{-- @php dd($article->comments) @endphp --}}
								<hr class="light-grey-hr"/>
								@empty($article->comments)
									<div class="alert alert-warning alert-dismissable">
										<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
										<p class="pull-right">هیچ کامنتی یافت نشد !</p>
										<div class="clearfix"></div>
									</div>
								@else
								<div class="row">
									<div class="col-lg-1"></div>
										<div class="col-lg-10">
											<div class="pt-5 mt-5">
												<ul class="comment-list">
													@foreach ($article->comments as $comment)
														<li class="comment" style="border-bottom: 1px solid #eee;">
															<div class="vcard bio">
																@if ($comment->user->avatar)
																	<img src="{{$comment->user->avatar}}" alt="تصویر مقاله" class="img-fluid mb-4">
																@else
																	<img src="/images/placeholder/download.png" alt="تصویر مقاله" class="img-fluid mb-4">
																@endif
															</div>
															<div class="comment-body">
																<h3>{{$comment->user->first_name . ' ' . $comment->user->last_name }}</h3>
																<div class="meta" title="{{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%H:i:s - %d %B %Y') }}">
																	{{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->ago() }}
																</div>
																<p>{{$comment->message}}</p>
																<div class="custom-style-com">
																	<form action="{{route('is_accept', ['comment' =>$comment->id])}}" method="POST">
																		@if (!$comment->is_accept)
																			<button title= "تایید کامنت" type="submit" class="btn-xs btn btn-success custom-btn-success pull-left custom-pama-btn">
																				<i class="icon fa fa-check custom-icon"> </i></button>
																		@endif
																		@method('put')
																		@csrf
																	</form>
																	<form action="{{route('comment.destroy', ['comment' =>$comment->id])}}" method="POST">
																		<button title= "حذف کامنت" type="submit" itemid="{{ $comment->id }}" class="btn-xs btn btn-danger custom-btn-danger pull-left custom-pama-btn"><i class="icon ti-trash custom-icon"> </i></button>
																		@method('delete')
																		@csrf
																	</form>
																	<button type="button" title="نوشتن کامنت" class="btn-xs btn btn-primary custom-btn-primary custom-pama-btn cus-style-hei" data-toggle="modal" data-target="#reply_parent" data-whatever="@getbootstrap">
																		<i class="icon ti-pencil"></i></button>
																	<div class="modal fade" id="reply_parent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<div class="modal-footer">
																					<form action="{{route('replie_comment', ['comment' => $comment->id])}}" method="post">
																						<div class="col-md-12">
																							<div class="form-group @if( $errors->has('message') ) has-error @endif">
																								<label class="control-label mb-10">نوشتن کامنت</label>
																								<div class="row">
																										<div class="col-md-12 input-group">
																											<textarea class="form-control" id="description" name="message" style="resize:none;" placeholder="متن پیام خود را وارد کنید" rows="5"></textarea>
																											<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
																										</div>
																									<div class="col-md-12">
																										@if( $errors->has('message') )
																											<span class="help-block">{{ $errors->first('message') }}</span>
																										@endif
																									</div>
																								</div>
																							</div>
																						</div>
																						<button type="submit" value="reply" class="btn btn-primary custom-btn-primary pull-left mar-right">ارسال</button>
																						<input type="hidden" name="parent_id" value="{{$comment->id}}" />
																						<a href="/panel/article.show" class="btn custom-btn-gainsboro btn-default pull-left">لغو</a>
																						@method('put')
																						@csrf
																					</form>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</li>
														@foreach ($comment->replies as $reply)
															<li class="comment" style="padding-right: 100px;">
																<div class="vcard bio">
																	@if ($reply->user->avatar)
																		<img src="{{$reply->user->avatar}}" alt="تصویر مقاله" class="img-fluid mb-4">
																	@else
																		<img src="/images/placeholder/download.png" alt="تصویر مقاله" class="img-fluid mb-4">
																	@endif
																</div>
																<div class="comment-body">
																	<h3>{{$reply->user->first_name. ' ' .$reply->user->last_name }}</h3>
																	<div class="meta" title="{{ \Morilog\Jalali\Jalalian::forge($reply->created_at)->format('%H:i:s - %d %B %Y') }}">
																		{{ \Morilog\Jalali\Jalalian::forge($reply->created_at)->ago() }}
																	</div>
																	<p>{{$reply->message}}</p>
																	<div class="custom-style-com">
																		<form action="{{route('is_accept', ['comment' =>$reply->id])}}" method="POST">
																			@if (!$reply->is_accept)
																				<button title= "تایید کامنت" type="submit" class="btn-xs btn btn-success custom-btn-success pull-left custom-pama-btn"><i class="icon fa fa-check custom-icon"></i></button>
																			@endif
																			@method('put')
																			@csrf
																		</form>
																		<form action="{{route('comment.destroy', ['comment' =>$reply->id])}}" method="POST">
																			<button title= "حذف کامنت" type="submit" itemid="{{ $reply->id }}" class="btn-xs btn btn-danger custom-btn-danger pull-left custom-pama-btn">
																				<i class="icon ti-trash custom-icon"> </i></button>
																			@method('delete')
																			@csrf
																		</form>
																		<button type="button" title="نوشتن کامنت" class="btn-xs btn btn-primary custom-btn-primary custom-pama-btn cus-style-hei" data-toggle="modal" data-target="#reply" data-reply="{{$reply->id}}" data-whatever="@getbootstrap">
																			<i class="icon ti-pencil"></i></button>
																		<div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content">
																					<div class="modal-footer">
																						<form action="{{route('replie_comment', ['comment' => $comment->id, 'reply' => $reply->id ])}}" method="post">
																							{{-- @include('replie_comment', ['reply' => $reply->id]) --}}
																							<div class="row">
																								@php
																									// dd($reply)
																								@endphp
																								<div class="col-md-12">
																									<div class="form-group @if( $errors->has('message') ) has-error @endif">
																										<label class="control-label mb-10">نوشتن کامنت</label>
																										<div class="col-md-12 input-group">
																											<textarea class="form-control" id="description" name="message" style="resize:none;" placeholder="متن پیام خود را وارد کنید" rows="5"></textarea>
																											<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
																										</div>
																										<div class="col-md-12">
																											@if( $errors->has('message') )
																												<span class="help-block">{{ $errors->first('message') }}</span>
																											@endif
																										</div>
																									</div>
																								</div>
																							</div>
																							<button type="submit" value="reply" class="btn btn-primary custom-btn-primary pull-left mar-right">ارسال</button>
																							<input type="hidden" name="parent_id" value="{{$comment->id}}" />
																							{{-- <input type="hidden" name="reply" value="{{$reply->id}}" /> --}}
																							<a href="/panel/article.show" class="btn custom-btn-gainsboro btn-default pull-left">لغو</a>
																							@method('put')
																							@csrf
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
														@endforeach
													@endforeach
												</ul>
											</div>
										</div>
									<div class="col-lg-1"></div>
								</div>
								@endempty
							</div>
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
				text: "برای پاک کردن مقاله " + title + " مطمین هستید ؟",   
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
					swal("لغو شد", "هیچ مقاله ای حذف نشد :)", "error");   
				} 
			});
			return false;
		});

		$('#reply').on('replie_comment', function(e) {
		var link     = e.relatedTarget(),
			modal    = $(this),
			reply    = link.data("reply"),

		modal.find("#reply").val(reply->id);
	});
	</script>
@endsection