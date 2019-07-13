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

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">
					@isset($category) ویرایش گروه {{$category->title}} @else ثبت گروه جدید @endisset
				</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">
						<span>@isset($category) ویرایش گروه {{$category->title}} @else ثبت گروه جدید @endisset</span>
					</li>
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
								<form action="@isset($category) {{ route('category.update', ['category' => $category->id]) }} @else {{ route('category.store') }} @endisset" method="POST" enctype="multipart/form-data">
									<h6 class="txt-dark flex flex-middle capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات گروه</h6>
									<hr class="light-grey-hr"/>
									
									<div class="panel-body">
										@foreach ($errors -> all() as $message)
											<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{ $message }} 
											</div>
										@endforeach

										@if(session()->has('message'))
											<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{ session()->get('message') }}
											</div>
										@endif
									</div>
									
									<div class="row">
										<div class="col-md-9">
											<div class="@isset($category) col-md-12 @else col-md-6 @endisset">
												<div class="form-group">
													<label class="control-label mb-10">نام گروه</label>
													<div class="input-group">
														<input type="text" name="title" id="firstName" @isset($category) value="{{$category->title}}" @else value="{{old('title')}}" @endisset class="form-control" placeholder="مثلا : ارز دیجیتال">
														<div class="input-group-addon"><i class="ti-text"></i></div>
													</div>
												</div>
											</div>
	
											@if(!isset($category))
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">گروه مادر</label>
													<div class="input-group">
														<select name="parent" class="form-control select2 categories">
															@if (isset($category))
															<option value="{{$id}}">زیر مجموعه گروه {{ $category->title }}</option>
															@else
															<option value="">ثبت به عنوان گروه اصلی</option>
															@endif
	
															@foreach ($categories as $item)
															<option value="{{ $item->id}}">{{$item->title}}</option>
															@endforeach
														</select>
														<div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
													</div>
												</div>
											</div>
											@endif
											<!--/span-->
											
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label mb-10">توضیح کوتاه</label>
													<div class="input-group">
														<input type="text" name="description" id="firstName" 
															@isset($category) value="{{$category->description}}" @else value="{{old('description')}}" @endisset class="form-control" 
																	@if(isset($category) && empty($category->description))
																	placeholder="هیچ توضیحی برای گروه '{{$category->title}}' ثبت نشده است !"
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
											<input type="file" name="logo" id="category_avatar" class="dropify" data-show-remove="false" @isset($category) data-default-file="{{ $category->logo }}" @endisset />
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn @isset($category) btn-orange custom-btn-warning @else btn-primary custom-btn-primary @endisset btn  btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
											<span>@isset($category) ویرایش گروه @else ثبت گروه @endisset</span>
										</button>
										<div class="clearfix"></div>
									</div>

									@csrf
									
									@isset($category) @method('put') @endisset
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">لیست گروه ها</h5>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					@isset($breadcrumb)
						@if (!empty($breadcrumb[0]))
							@foreach ($breadcrumb as $item)
								<li>
									<a href="/panel/category/{{ $item->id }}">
										{{ $item->title }}
									</a>
								</li>
							@endforeach
						@endif
					@endisset
					<li><a href="/panel/category/">دسته های اصلی</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->
		<div class="row">
			@empty($categories->first())
				<div class="alert alert-warning alert-dismissable">
					<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
					@if (isset($category))
						<p class="pull-right">هیچ زیر مجموعه ای برای گروه "{{ $category->title }}" ثبت نشده است !</p>
					@else
						<p class="pull-right">هیچ گروهی تاکنون ثبت نشده است !</p>
					@endif
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="clearfix"></div>
				</div>
			@endempty
			<div class="col-md-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_2" class="table table-hover table-bordered display mb-30">
										<h2 style="margin:15px;">دسته بندی اصلی</h2>
										<thead>
											<tr>
											  <th style="font-weight:bold; font-size:20px;">#</th>
												<th style="font-weight:bold; font-size:20px;">تصویر دسته بندی</th>
												<th style="font-weight:bold; font-size:20px;">عنوان دسته بندی</th>
												<th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th>
											  <th style="font-weight:bold; font-size:20px;">عملیات</th>
											</tr>
										</thead>
										<tbody>
											@php $i = 0 @endphp
											@foreach ($categories as $category)
												<tr style="text-align:center;">
													<td>{{ ++$i }}</td>
													<td>
														<div class="row" style="display: flex; justify-content: center;">
															<div class="col-md-8">
																@if ($category->logo)
																	<img src="{{ $category->logo }}" style="background-size: cover; max-width: 50px; max-height: 50px; border-radius: 50%; height: 100%;" alt="تصویر">
																@else
																	<img src="/images/placeholder/placeholder.png" style="background-size: cover; max-width: 50px; max-height: 50px; border-radius: 50%; height: 100%;" alt="تصویر">
																@endif
																</div>
															</div>
														</div>
													</td>
													<td>{{ $category->title }}</td>
													<td title="{{ \Morilog\Jalali\Jalalian::forge($category->created_at)->format('%H:i:s - %d %B %Y')  }}">
														{{ \Morilog\Jalali\Jalalian::forge($category->created_at)->ago() }}
													</td>
													<td>
														<div class="font-icon custom-style">
															<div class="font-icon custom-style">
																<form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST">
																	<button title= "حذف دسته بندی" type="submit" itemid="{{ $category->id }}" class=" btn-xs btn btn-danger custom-btn-danger"><i class="icon ti-trash custom-icon"> </i></button>
																	<a title= "ویرایش دسته بندی" style="padding: 6px 5px !important; margin-right: 19px; margin-left: 19px;" class="d-inline btn btn-xs btn-warning custom-btn-warning" href="{{ route('category.edit', ['category' => $category->id]) }}">
																		<i class="icon ti-pencil custom-icon"> </i></a>
																	@method('delete')
																	@csrf
																</form>
																<a title= "دیدن اطلاعات دسته بندی" style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-success btn-xs custom-btn-success" href="{{ route('category.show', ['category' => $category->id]) }}"><i class="icon ti-plus custom-icon"></i></a>
															</div>
														</div>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
									{{-- {{$categories->links()}} --}}
								</div>
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
		// Init Add Product Page JavaScript
		'dist/js/group_ajax.js',
	]; ?>

	@foreach ($scripts as $script)
	<script src="{{ asset($script) }}"></script>
	@endforeach
	
	<script>
		$('#category_avatar').dropify();

		$('.delete-item').on('click',function(){
			var title = $(this).parent().parent().find('h6').text();
			var id = $(this).attr('group');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن گروه " + title + " مطمین هستید ؟",   
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
					swal("لغو شد", "هیچ گروهی حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection