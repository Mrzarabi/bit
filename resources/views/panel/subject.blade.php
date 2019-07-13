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
					@isset($subject) ویرایش گروه {{$subject->title}} @else ثبت گروه جدید @endisset
				</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">
						<span>@isset($subject) ویرایش گروه {{$subject->title}} @else ثبت گروه جدید @endisset</span>
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
                                <form action="@isset($subject) {{ route('subject.update', ['subject' => $subject->id]) }} @else {{ route('subject.store')}} @endisset" method="POST" enctype="multipart/form-data">
									<h6 class="txt-dark flex flex-middle capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات گروه</h6>
									<hr class="light-grey-hr"/>
                                    @include('errors.errors-show')
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
											<input type="file" name="logo" id="category_avatar" class="dropify" data-show-remove="false" @isset($subject) data-default-file="{{ $subject->logo }}" @endisset />
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

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">لیست گروه ها</h5>
			</div>
		</div>
		<div class="row">
			@empty($subjects)
				<div class="alert alert-warning alert-dismissable">
					<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
					<p class="pull-right">هیچ گروهی تاکنون ثبت نشده است !</p>
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
											@foreach ($subjects as $subject)
												<tr style="text-align:center;">
													<td>{{ ++$i }}</td>
													<td>
														<div class="row" style="display: flex; justify-content: center;">
															<div class="col-md-8">
																@if ($subject->logo)
																	<img src="{{ $subject->logo }}" style="background-size: cover; max-width: 50px; max-height: 50px; border-radius: 50%; height: 100%;" alt="تصویر">
																@else
																	<img src="/images/placeholder/placeholder.png" style="background-size: cover; max-width: 50px; max-height: 50px; border-radius: 50%; height: 100%;" alt="تصویر">
																@endif
															</div>
														</div>
													</td>
													<td>{{ $subject->title }}</td>
													<td title="{{ \Morilog\Jalali\Jalalian::forge($subject->created_at)->format('%H:i:s - %d %B %Y')  }}">
														{{ \Morilog\Jalali\Jalalian::forge($subject->created_at)->ago() }}
													</td>
													<td>
														<div class="font-icon custom-style">
															<div class="font-icon custom-style">
																<form action="{{ route('subject.destroy', ['subject' => $subject->id]) }}" method="POST">
																	<button title= "حذف دسته بندی" type="submit" itemid="{{ $subject->id }}" class=" btn-xs btn btn-danger custom-btn-danger"><i class="icon ti-trash custom-icon"> </i></button>
																	<a title= "ویرایش دسته بندی" style="padding: 6px 5px !important; margin-right: 19px; margin-left: 19px;" class="d-inline btn btn-xs btn-warning custom-btn-warning" href="{{ route('subject.edit', ['subject' => $subject->id]) }}">
																		<i class="icon ti-pencil custom-icon"> </i></a>
																	@method('delete')
																	@csrf
																</form>
															</div>
														</div>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
									<div style="display: flex; justify-content: center;">
									{{-- {{$subjects->links()}} --}}
									</div>
								</div>
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