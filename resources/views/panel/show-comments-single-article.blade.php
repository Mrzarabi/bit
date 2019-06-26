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
		'css/bootstrap.min.css'
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
		{{-- <div class="row" style="display: flex; justify-content: center;">
			<div class="col-sm-3">
				<img src="/images/download.jpg" alt="تصویر" style="min-width: 220px; max-height: 200px; border-radius:7px">
			</div>
			<div class="col-sm-3" style="text-align: center;">
				<h3>{{$article->title}}</h3>
				<p style="margin-top:10px; text-align: justify;">{{ $article->description }}</p>
			</div>
		</div> --}}
		<div class="about-author d-flex p-4 bg-light" style="margin-top:400px;">
			<div class="bio align-self-md-center mr-4">
				<img src="/images/download.jpg" alt="Image placeholder" class="img-fluid mb-4">
			</div>
			<div class="desc align-self-md-center">
				<h3>Lance Smith</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
			</div>
		</div>
				{{-- <hr class="light-grey-hr"/> --}}
		<div class="row" style="display: flex; justify-content: center;">
			<div class="col-lg-12" style="width: 100%">

							
							<div class="pt-5 mt-5">
								<h3 class="mb-5" style="margin-top:300px;">6 Comments</h3>
								<ul class="comment-list">
									<li class="comment">
									<div class="vcard bio">
										<img src="/images/download.jpg" alt="Image placeholder">
									</div>
									<div class="comment-body">
										<h3>John Doe</h3>
										<div class="meta">June 28, 2018 at 2:21pm</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
										<p><a href="#" class="reply">Reply</a></p>
									</div>
									</li>
								</ul>
							</div>
								

						{{-- <ul> --}}

							{{-- @if ($article->comments) --}}
								{{-- @foreach ($article->comments as $comment)
									<li style="margin-top:10px; background:#fff;">
										<div class="row">
											<div class="col-lg-2">
												<img src="/images/download.jpg" alt="تصویر" style="max-width: 50px; border-radius: 50%; padding-right:20px;">
												<span style="float:left; padding:top:-20px;"> {{$comment->user->first_name}} {{ $comment->user->last_name }}  </span>
											</div>
					
											
											<div class="col-lg-7">
												<p>{{$comment->message}}</p>														
											</div>
					
											<div class="pull-left col-lg-3" style="margin-top:-50px;"> --}}
												{{-- <div class="btn btn-xs btn-class"> --}}
												{{-- <form action="{{route('comment.destroy', ['comment' =>$comment->id])}}" method="POST">
													<a href="" class="font-18 txt-grey mr-10 pull-left"><i class="icon ti-pencil"></i></a>
													<a href="" class="font-18 txt-grey mr-10 pull-left"><i class="icon ti-plus"></i></a>
													<button type="submit" itemid="{{ $comment->id }}" class="font-18 txt-grey pull-left delete-item"><i class="icon ti-close"></i></button>
													@method('delete')
													@csrf
												</form> --}}
													{{-- <button type="submit" class="btn btn-danger">
															<i class="far fa-trash-alt"></i></button> --}}
												{{-- </div> --}}
												{{-- {{$comment->created_at}}
											</div>
										</div>
									</li> --}}
								{{-- <div class="row p-4">
									<div class="col-md-10">
										<ul>
											@foreach ($comment->replies as $reply)
												<li style="margin-top:10px;">
													<div class="row">
														<div class="col-md-1">
															<img src="/images/download.jpg" alt="تصویر" style="max-width: 50px; border-radius: 50%;">
														</div>
														<span style=""> {{$reply->user->first_name}} {{ $reply->user->last_name }}  </span>
													</div>
													<div class="col-md-8">
														<p>{{$reply->message}}</p>														
													</div>
												</li>
												@if (! $loop->last)
													<hr class="light-grey-hr"/>
												@endif
											@endforeach
										</ul>
									</div>
								</div>
							
								@if (! $loop->last)
									<hr class="light-grey-hr"/>
								@endif --}}
								{{-- @endforeach --}}
							{{-- @else --}}
								{{-- <p class="text-center">هنوز هیچ کامنتی ثبت نشده :(</p> --}}
							{{-- @endif --}}
						{{-- </ul> --}}
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
	</script>
@endsection