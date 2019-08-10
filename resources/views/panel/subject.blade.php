@php
	$type = 'subject'
@endphp
@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		// Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',			
		//alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.group-card {
		height: 150px;
		overflow: hidden;
	}
	.col-md-3 {
		float: right;
	}
	.delete-item {
		background: none;
		border: none;
		color: #181818;
	}
	img {
		width: 100%;
	}
	</style>
@endsection
	
@section('content')
	<div class="container">

		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pt-0">
							<div class="form-wrap">
                                <form action="@isset($subject) {{ route('subject.update', ['subject' => $subject->id]) }} @else {{ route('subject.store')}} @endisset" method="POST" enctype="multipart/form-data">
									<h6 class="txt-dark flex flex-middle capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات گروه</h6>
									<hr class="light-grey-hr"/>
									<div class="row">
										<div class="col-md-9">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label mb-10">نام گروه</label>
													<div class="input-group">
														<input type="text" name="title" id="firstName" @isset($subject) value="{{$subject->title}}" @else value="{{old('title')}}" @endisset class="form-control" placeholder="مثلا : عنوان گروه">
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label mb-10">توضیح کوتاه</label>
													<div class="input-group">
														<input type="text" name="description" id="firstName" 
															@isset($subject) value="{{$subject->description}}" @else value="{{old('description')}}" @endisset class="form-control" 
																	@if(isset($subject) && empty($subject->description))
																	placeholder="هیچ توضیحی برای گروه '{{$subject->title}}' ثبت نشده است !"
																	@else 
																	placeholder="یک توضیح یک خطی درباره گروه"
																	@endif 
																>
														
														<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<input type="file" name="logo" id="category_avatar" class="dropify" @if ( isset($subject) && $subject->logo) data-default-file="{{ $subject->logo }}" @endif />
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn @isset($subject) btn-orange custom-btn-warning @else btn-primary custom-btn-primary @endisset btn  btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
											<span>@isset($subject) ویرایش گروه @else ثبت گروه @endisset</span>
										</button>
										<div class="clearfix"></div>
									</div>

									@csrf
									
									@isset($subject) @method('put') @endisset
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->
		@if (request()->method() != "PUT" && !isset($subject) )
			@component('panel.components.table', [
				'data' => $subjects,
				'label' => 'دسته بندی مقاله',
				'header_label'	=> 'فروشگاه',
				'type' => 'subject',
				'fields' => [
					[
						'field' => 'logo',
						'label' => 'تصویر دسته بندی',
						'resolver' => function($data) {
							$result = '<div class="row" style="display: flex; justify-content: center;"><div class="col-md-8">';

							$result .= '<img src="' . ( $data ? $data : '/images/placeholder/placeholder.png' );

							return $result .= '" style="background-size: cover; max-width: 80px; max-height: 60px; border-radius: 5px; width: 100%; height: 100%;" alt="تصویر"></div></div>';
						}
					],
					[
						'field' => 'title',
						'label' => 'عنوان دسته بندی',
					],
				]	
			])
			@endcomponent
		@endif
@endsection
		
		
@section('scripts')
	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Tinymce JavaScript
		'vendors/bower_components/tinymce/tinymce.min.js',
		// Tinymce Wysuhtml5 Init JavaScript
		'dist/js/tinymce-data.js',
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
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		// Init JavaScript
		'dist/js/init.js',
		'dist/js/init_add_product.js',
		// Init Add Product Page JavaScript
		'dist/js/group_ajax.js',
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach
	
	@include('panel.components.delete')
@endsection