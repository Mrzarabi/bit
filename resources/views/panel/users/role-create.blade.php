@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Bootstrap Dropzone CSS
		'/vendors/bower_components/dropzone/dist/dropzone.css',
		// Custom CSS
		'dist/css/style.css'
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach
	
	<script src="/ckeditor/ckeditor.js"></script>

	<style>
		.project-gallery a {
			filter: grayscale(80%);
			box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
			-webkit-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.2);
			transition: box-shadow 300ms, filter 300ms, border 300ms;
		}

		.project-gallery a.selected {
			filter: grayscale(0%);
			border: 1px solid #f83f36;
			box-shadow: 0px 0px 20px -5px #f83f36 !important;
		}
		
		.project-gallery a:hover {
			box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
			-webkit-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
		}
		.photo-actions {
			width: 60px;
			position: absolute;
			top: 10px;
			left: 10px;
		}
		.photo-actions a, .photo-actions span {
			width: 20px;
			height: 20px;
			margin: 0px !important;
			padding: 4px;
			box-shadow: 0px 0px 0px 0px #000;
			transition: box-shadow 300ms;
		}

		.photo-actions a:hover, .photo-actions span:hover {
			box-shadow: 0px 0px 15px -5px #000;
		}
		
		
    </style>
@endsection

@section('content')
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">@isset($role) ویرایش نقش @else ثبت نقش @endisset</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>@isset($roel) ویرایش نقش @else ثبت نقش @endisset</span></li>
					<li>فروشگاه</li>
					<li>داشبورد</li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pt-0">
							<div class="form-wrap">
								<form action="@isset($role) {{ route('role.update', ['role' => $role->id]) }} @else {{ route('role.store') }} @endisset" enctype="multipart/form-data" method="POST">
									<div class="panel-body">
										@include('errors.errors-show')
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-group @if( $errors->has('name') ) has-error @endif">
													<label class="control-label mb-10">عنوان نقش</label>
													<div class="input-group">
														<input type="text" name="name" @if(isset($role) && !empty($role->name)) value="{{$role->name}}" @else value="{{old('name')}}" @endif id="title" class="form-control" placeholder="عنوان نقش مورد نظر">
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
													@if( $errors->has('name') )
														<span class="help-block">{{ $errors->first('name') }}</span>
													@endif
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group @if( $errors->has('display_name') ) has-error @endif">
													<label class="control-label mb-10">نمایش نام</label>
													<div class="input-group">
														<input type="text" name="display_name" @if(isset($role) && !empty($role->display_name)) value="{{$role->display_name}}" @else value="{{old('display_name')}}" @endif id="title" class="form-control" placeholder="عنوان نمایش نام مورد نظر">
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
													@if( $errors->has('display_name') )
														<span class="help-block">{{ $errors->first('display_name') }}</span>
													@endif
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group @if( $errors->has('description') ) has-error @endif">
													<label class="control-label mb-10">توضیحات</label>
													<div class="input-group">
														<input type="text" name="description" @if(isset($role) && !empty($role->description)) value="{{$role->description}}" @else value="{{old('description')}}" @endif id="title" class="form-control" placeholder="توضیحات نقش مورد نظر">
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
													@if( $errors->has('description') )
														<span class="help-block">{{ $errors->first('description') }}</span>
													@endif
												</div>
											</div>
											<div class="col-md-12">
												<h3>سطح دسترسی ها :</h3>
												<div>
													<div class="row">
														<div class="col-md-12" style="margin-bottom: 20px;">
															@foreach ($permissions as $permission)
																<div class="col-md-3">
																	<input type="checkbox" name="permission_id[]" value="{{$permission['id']}}"
																		@isset($role) @if($role->permissions->contains($permission->id))  checked=checked  @endisset @endif >
																			{{$permission['display_name']}}<br>
																</div>
															@endforeach
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-orange custom-btn-warning btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره</span></button>
										<a href="/panel/role" class="btn btn-default custom-btn-gainsboro pull-left">لغو</a>
										<div class="clearfix"></div>
									</div>

									@isset($role) @method('put') @endisset
									@csrf
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->
	</div>
@endsection
		
@section('scripts')

	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		'vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Tinymce JavaScript
		'vendors/bower_components/tinymce/tinymce.min.js',
		// Tinymce Wysuhtml5 Init JavaScript
		'dist/js/tinymce-data.js',
		// Gallery JavaScript
        'dist/js/isotope.js',
        'dist/js/lightgallery-all.js',
        'dist/js/froogaloop2.min.js',
		'dist/js/gallery-data.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',

		// Dropzone JavaScript
		'vendors/bower_components/dropzone/dist/dropzone.js',
		// Dropzone Init JavaScript
		'dist/js/dropzone-data.js',

		// Bootstrap Daterangepicker JavaScript
		'vendors/bower_components/dropify/dist/js/dropify.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Select2 JavaScript
		'vendors/bower_components/select2/dist/js/select2.full.min.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Bootstrap Tagsinput JavaScript
		'vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Init JavaScript
		'dist/js/init.js',
		// Init Add Product Page JavaScript
		'dist/js/init_add_product.js',
		// Get Groups by Ajax
		'dist/js/group_ajax.js'
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>	
	@endforeach

	<script>
		@isset($article)
			$(window).load(function () {
				var color = $('select.color-value').val();
				$('input.color-value').val(color);
				
				var li = $('li.select2-selection__choice').first();
				for (var i = 0; i < color.length; ++i) {
					li.css({background: color[i]});
					li = li.next();
				}
			});
		@endisset

		$("#dropzone").dropzone({ url: "/file/post" });
	</script>
@endsection