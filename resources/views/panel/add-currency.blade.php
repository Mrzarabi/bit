@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		// bootstrap-select CSS
		'vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css',
		//  Bootstrap Dropify CSS
		'vendors/bower_components/dropify/dist/css/dropify.min.css',
		// Bootstrap Dropzone CSS
		'/vendors/bower_components/dropzone/dist/dropzone.css',
		// Bootstrap Datetimepicker CSS
		'vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
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
				<h5 class="txt-dark">@isset($currency) ویرایش محصول @else ثبت محصول @endisset</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>@isset($currency) ویرایش محصول @else ثبت محصول @endisset</span></li>
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
								<form action="@isset($currency) {{ route('currency.update', ['currency' => $currency->slug]) }} @else {{ route('currency.store') }} @endisset" enctype="multipart/form-data" method="POST" id="product_form">
									@include('errors.errors-show')

									<div  class="pills-struct">
										<ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_11" style="float: right; margin-bottom: 20px;">
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#specifications" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-calendar-note ml-10"></i>اطلاعات فنی
												</a>
											</li>
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#currencies" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-card-membership ml-10"></i>قیمت و موجودی محصول
												</a>
											</li>
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#advantages" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-swap ml-10"></i>معایب و مزایا
												</a>
											</li>
											<li role="presentation" class="">
												<a  data-toggle="tab" id="profile_tab_11" role="tab" href="#description" aria-expanded="false">
													<i class="font-20 txt-grey zmdi zmdi-comment-text ml-10"></i>توضیح محصول
												</a>
											</li>
											<li class="active" role="presentation">
												<a aria-expanded="true"  data-toggle="tab" role="tab" id="home_tab_11" href="#info">
													<i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>اطلاعات محصول
												</a>
											</li>											
										</ul>
										<div class="tab-content" id="myTabContent_11">
											<div  id="info" class="tab-pane fade active in" role="tabpanel">
												<div class="row">
													<!--/span-->
													<div class="col-md-8">
														<div class="form-group @if( $errors->has('title') ) has-error @endif">
															<label class="control-label mb-10">نام محصول</label>
															<div class="input-group">
																<input type="text" name="title" @isset($currency) value="{{$currency->title}}" @else value="{{old('title')}}" @endisset id="firstName" class="form-control" placeholder="مثلا : 'گوشی موبایل سامسونگGalaxy S7'">
																<div class="input-group-addon"><i class="ti-text"></i></div>
															</div>
															@if( $errors->has('title') )
																<span class="help-block">{{ $errors->first('title') }}</span>
															@endif
														</div>
													</div>
													<div class="col-md-4 pull-left">
														<div class="panel panel-default card-view" style="padding-top:0px;">
															<div class="panel-wrapper collapse in">
																<div class="panel-body">
																	<div class="col-md-12 images-gallery">
																		<div class="mt-20">
																			<input type="file" name="photo" id="input-file-now" class="dropify" @isset($currency) data-default-file="{{ $currency->photo }}" @endisset/>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-8">
														<div class="form-group @if( $errors->has('code') ) has-error @endif">
															<label class="control-label mb-10">شناسه محصول</label>
															<div class="input-group">
																<input type="text" name="code" @isset($currency) value="{{$currency->code}}" @else value="{{old('code')}}" @endisset id="firstName" class="form-control" placeholder="شناسه محصول در فروشگاه شما ، مثلا : B43E7">
																<div class="input-group-addon"><i class="ti-id-badge"></i></div>
															</div>
															@if( $errors->has('code') )
																<span class="help-block">{{ $errors->first('code') }}</span>
															@endif
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group @if( $errors->has('short_description') ) has-error @endif">
															<label class="control-label mb-10">توضیح کوتاه</label>
															<div class="input-group">
																<textarea class="form-control" id="short_description" name="short_description" style="resize:none;" placeholder="یک توضیح یک خطی درباره محصول" rows="5">@isset($currency){{$currency->short_description}}@else{{old('short_description')}}@endisset</textarea>
																<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
															</div>
															@if( $errors->has('short_description') )
																<span class="help-block">{{ $errors->first('short_description') }}</span>
															@endif
														</div>
													</div>
													<!--/span-->
												</div>
												<!-- Row -->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group @if( $errors->has('category_id') ) has-error @endif">
															<label class="control-label mb-10">گروه</label>
															<div class="input-group">
																<select name="parent" class="form-control select2 categories">
																	<option value="">دسته بندی نشده</option>
																	@foreach ($groups as $group)
																		<option value="{{$group['id']}}"
																			@if( isset($currency) && $currency->category_id === $group['id']) selected @endif>
																			{{$group['title']}}
																		</option>
																	@endforeach
																</select>
																<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
															</div>
															@if( $errors->has('category_id') )
																<span class="help-block">{{ $errors->first('category_id') }}</span>
															@endif
														</div>
													</div>
													<!--/span-->			
													<div class="col-md-3">
														<div class="form-group @if( $errors->has('status') ) has-error @endif">
															<label class="control-label mb-10">وضعیت</label>
															<div class="radio-list">
																<div class="radio-inline">
																	<div class="radio radio-info">
																		<input type="radio" @if(isset($currency) && $currency->status == 0) checked="checked" @elseif(old('status') == 0) checked @endif name="status" id="radio2" value="0">
																		<label for="radio2">پیش نویس</label>
																	</div>
																</div>
																<div class="radio-inline pl-0">
																	<div class="radio radio-info">
																		<input type="radio" @if(isset($currency) && $currency->status == 1) checked="checked" @elseif(old('status') == 1) checked @endif  @if(!isset($currency)) checked="checked" @endisset name="status" id="radio1" value="1">
																		<label for="radio1">ثبت محصول</label>
																	</div>
																</div>
															</div>
														</div>
														@if( $errors->has('status') )
															<span class="help-block">{{ $errors->first('status') }}</span>
														@endif
													</div>
												</div>
												<hr class="light-grey-hr"/>
												<!-- Row -->
											</div>
						
											<div  id="description" class="tab-pane fade" role="tabpanel">
												<div class="row">
													{{-- <div class="col-md-12">
														<div class="form-group @if( $errors->has('keywords') ) has-error @endif" class="remove-outline">
															<label class="control-label mb-10">کلمات کلیدی</label>
															<input type="text" @isset($product) value="{{$product->keywords}}" @else value="{{old('keywords')}}" @endisset name="keywords" data-role="tagsinput" placeholder="افزودن کلمه کلیدی"/>
															@if( $errors->has('keywords') )
																<span class="help-block">{{ $errors->first('keywords') }}</span>
															@endif
														</div>
													</div> --}}
													<div class="col-md-12">
														<div class="form-group @if( $errors->has('note') ) has-error @endif">
															<label class="control-label mb-10">یادداشت</label>
															<div class="input-group">
																<textarea class="form-control" id="note" name="note" style="resize:none;" placeholder="یادداشت شما برای این محصول که به مشتری نمایش داده نمیشود !" rows="5">@isset($currency){{$currency->note}}@else{{old('note')}}@endisset</textarea>
																<div class="input-group-addon"><i class="ti-comment-alt"></i></div>
															</div>
															@if( $errors->has('note') )
																<span class="help-block">{{ $errors->first('note') }}</span>
															@endif
														</div>
													</div>
												</div>
												<hr class="light-grey-hr"/>
											</div>

											{{-- <div id="pictures" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-sm-12">
														<div class="panel panel-default border-panel card-view">
															<div class="panel-wrapper collapse in">
																<div class="panel-body">
																	<div class="col-md-12 images-gallery">
																		<div class="col-md-3 mt-20">
																			<input type="file" name="photo" id="input-file-now" class="dropify" @isset($currency) data-default-file="{{ $currency->photo }}" @endisset/>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div> --}}
											<div id="specifications" class="tab-pane fade" role="tabpanel">
												<div class="container">
													<div class="specs-table row">
														@if(isset($currency) && !empty($currency->spec))

															@foreach ($currency->spec->toArray()['spec_headers'] as $spec_header)
																<div class="row">
																	<div class="col-md-12">
																		<div class="col-md-2">
																			<h5 class="mb-10 col-md-12 border-bottom">
																				<i class="ti-angle-double-left" style="font-size: 15px; color:darkgray; margin-left: 5px;"></i>
																				<b>{{ $spec_header['title'] }}</b><br/>
																				<span class="help-block" style="font-size:12px">{{ $spec_header['description'] }}</span>
																			</h5>
																		</div>
																		
																		<div class="col-md-10">
																			@foreach ($spec_header['spec_rows'] as $spec_rows)
																				<div class="col-md-6">
																					<div class="form-group @if( $errors->has('price') ) has-error @endif">
																						<label class="control-label mb-10">{{ $spec_rows['title'] }}</label>
																						<input type="hidden" name="specs[{{ $spec_rows['id'] }}][id]" value="{{ $spec_rows['spec_data']['id'] }}" />
																						
																						@if($spec_rows['values'])
																							
																							@isset($spec_rows['label'])
																							<div class="input-group">
																							@endisset
																								<select @if($spec_rows['multiple']) class="select2 select2-multiple" multiple="multiple" data-placeholder="انتخاب کنید ..." @else class="selectpicker" @endif name="specs[{{ $spec_rows['id'] }}][data][]" data-style="form-control btn-default btn-outline">
																									@if(!$spec_rows['multiple'])
																									<option value="">یک گزینه را انتخاب کنید</option>
																									@endif

																									@foreach ($spec_rows['values'] as $key => $item)
																										<option value="{{$key}}"
																											@isset( $spec_rows['spec_data']['data'] )
																												@if(strpos($spec_rows['spec_data']['data'], ','))
																													<?php $temp = explode(',', $spec_rows['spec_data']['data']) ?>
																													@if ( in_array($key, $temp) ) selected="selected" @endif
																												@elseif($spec_rows['spec_data']['data'] == $key) selected="selected" @endif
																											@endisset >
																											{{ $item }}
																										</option>
																									@endforeach
																								</select>
																							@isset($spec_rows['label'])
																								<div class="input-group-addon">{{ $spec_rows['label'] }}</div>
																							</div>
																							<span class="help-block">{{ $spec_rows['help'] }}</span>
																							@endisset

																						@else
																							
																							@isset($spec_rows['label'])
																							<div class="input-group">
																							@endisset
																								<input type="text" @if($spec_rows['spec_data']) placeholder="{{ $spec_rows['multiple'] }}" value="{{$spec_rows['spec_data']['data']}}" @endif @if($spec_rows['multiple']) data-role="tagsinput" @endif name="specs[{{ $spec_rows['id'] }}][data]" class="form-control" />
																							@isset($spec_rows['label'])
																								<div class="input-group-addon">{{ $spec_rows['label'] }}</div>
																							</div>
																							<span class="help-block">{{ $spec_rows['help'] }}</span>
																							@endisset

																						@endif

																						@if( $errors->has('price') )
																							<span class="help-block">{{ $errors->first('price') }}</span>
																						@endif
																					</div>
																				</div>
																			@endforeach
																		</div>
																	</div>
																</div>
																<div class="seprator-block"></div>
																<hr class="light-grey-hr"/>
																<div class="seprator-block"></div>
															@endforeach
														@else
														<div class="alert alert-warning alert-dismissable col-md-12">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
															هنوز گروهی انتخاب نکرده اید یا گروه مورد نظر شما دارای جدول اطلاعات فنی نیست 
														</div>
														@endif
													</div>
												</div>
											</div>
											<div id="advantages" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group advantages @if( $errors->has('advantages') ) has-error @endif">
															<input type="text" name="advantages" @isset($currency) value="{{$currency->advantages}}" @else value="{{old('advantages')}}" @endisset data-role="tagsinput" class="form-control" placeholder="مزیت محصول">
															@if( $errors->has('advantages') )
																<span class="help-block">{{ $errors->first('advantages') }}</span>
															@endif
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group disadvantages @if( $errors->has('disadvantages') ) has-error @endif">
															<input type="text" name="disadvantages" @isset($currency) value="{{$currency->disadvantages}}" @else value="{{old('disadvantages')}}"  @endisset data-role="tagsinput" class="form-control" placeholder="عیب محصول">
															@if( $errors->has('disadvantages') )
																<span class="help-block">{{ $errors->first('disadvantages') }}</span>
															@endif
														</div>
													</div>
												</div>
											</div>
											<div id="currencies" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4">
															<div class="form-group @if( $errors->has('price') ) has-error @endif">
																<label class="control-label mb-10">قیمت</label>
																<div class="input-group">
																	<input type="number" min="0" @isset($currency) value="{{$currency->price}}" @else value="{{old("price")}}"  @endisset name="price" class="form-control" id="exampleInputuname" placeholder="مثلا : 1550000">
																	<div class="input-group-addon"><i class="ti-money"></i></div>
																</div>
																@if( $errors->has('price') )
																	<span class="help-block">{{ $errors->first('price') }}</span>
																@endif
															</div>
														</div>
														<!--/span-->
														<div class="col-md-3">
															<div class="form-group @if( $errors->has('inventory') ) has-error @endif">
																<label class="control-label mb-10">تعداد موجود در انبار</label>
																<div class="input-group">
																	<input type="number" name="inventory" min="0" @isset($currency) value="{{$currency->inventory}}" @else value="{{old("inventory")}}" @endisset id="firstName" class="form-control" placeholder="موجودی این محصول در انبار شما">
																	<div class="input-group-addon"><i class="ti-layout-grid4-alt"></i></div>
																</div>
																@if( $errors->has('stock_inventory') )
																	<span class="help-block">{{ $errors->first('inventory') }}</span>
																@endif
															</div>
														</div>
													</div>
												</div>
												<hr class="light-grey-hr"/>
											</div>
										</div>
									</div>	
									<div class="form-actions">
										<button class="btn btn-orange custom-btn-warning btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>ذخیره</span></button>
										<a href="/panel/currency" class="btn btn-default btn-secondary custom-btn-gainsboro pull-left">لغو</a>
										<div class="clearfix"></div>
									</div>

									@isset($currency) @method('put') @endisset
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
		// Moment JavaScript
		'vendors/bower_components/moment/min/moment-with-locales.min.js',
		// Bootstrap Datetimepicker JavaScript
		'vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
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
		// Bootstrap Select JavaScript
		'vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js',
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
		'dist/js/group_ajax.js',
		// JS Validation
		// 'vendor/jsvalidation/js/jsvalidation.js'
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>	
	@endforeach
@endsection