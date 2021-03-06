@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Data table CSS
		'vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
		// select2 CSS
		'vendors/bower_components/select2/dist/css/select2.min.css',
		//alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
	<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach
@endsection
	
@section('content')
	<div class="container">

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">
					@isset($header) ویرایش عناوین جدول مشخصات فنی @else ثبت عناوین جدول مشخصات فنی جدید @endisset
				</h5>
			</div>
		
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">
						<span>@isset($header) ویرایش عناوین جدول مشخصات فنی @else ثبت عناوین جدول مشخصات فنی جدید @endisset</span>
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
								<form action="@isset($header) {{ route('header.update', ['specification' => $specification->id, 'header' => $header->id]) }} @else {{ route('header.store', ['specification' => $specification->id]) }} @endisset" method="POST">
									<h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline ml-10"></i>مشخصات برند</h6>
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
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label mb-10" for="title">عنوان</label>
												<div class="input-group">
													<input type="text" name="title" id="title" @isset($header) value="{{$header->title}}" @else value="{{old('title')}}" @endisset class="form-control" placeholder="تیتر عنوان ، برای مثال : مشخصات صفحه نمایش" />
													<div class="input-group-addon"><i class="ti-text"></i></div>
												</div>
											</div>
										</div>

										<div class="col-md-9">
											<div class="form-group">
												<label class="control-label mb-10" for="description">توضیح کوتاه</label>
												<div class="input-group">
													<input type="text" name="description" id="description" @isset($header) value="{{$header->description}}" @else value="{{old('description')}}" @endisset class="form-control" placeholder="توضیح کوتاه یک خطی درباره این عنوان" />
													<div class="input-group-addon"><i class="ti-info-alt"></i></div>
												</div>
											</div>
										</div>
									</div>

									<hr class="light-grey-hr"/>
									
									<div class="form-actions">
										<button class="btn @isset($header) btn-warning custom-btn-warning @else btn-primary custom-btn-primary @endisset btn-icon right-icon mr-10 pull-left"> <i class="fa fa-check"></i>
											<span>@isset($header) ویرایش @else ثبت @endisset عنوان جدول مشخصات فنی</span>
										</button>
										<div class="clearfix"></div>
									</div>

									@csrf

									@isset($header) @method('put') @endisset
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
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h5 class="txt-dark">لیست عناوین جدول مشخصات فنی گروه <span class="badge badge-primary">{{ $specification->category->title }}</span></h5>
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<a href="{{ route('specification.index') }}" class="badge badge-warning pull-left">
					بازگشت به منوی جداول
					<i class="ti-arrow-left"></i>
				</a>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<!-- Row -->	
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_2" class="table table-hover table-bordered display mb-30" >
										<thead>
											<tr>
												<th style="font-weight:bold; font-size:20px;">#</th>
												<th style="font-weight:bold; font-size:20px;">عنوان</th>
												<th style="font-weight:bold; font-size:20px;">توضیح کوتاه</th>
												<th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th>
												<th style="font-weight:bold; font-size:20px;">تاریخ آخرین ویرایش</th>
												<th style="font-weight:bold; font-size:20px;">عملیات</th>
											</tr>
										</thead>
										<tbody>
											@php $i = 0 @endphp

											@foreach ($headers as $item)
											<tr style="text-align:center;">
												<td>{{ ++$i }}</td>
												<td>{{ $item->title }}</td>
												<td title="{{$item->description}}">{{ str_limit($item->description, 30 ) }}</td>
												<td title="{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:i:s - %d %B %Y') }}">
													{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}</td>
												<td title="{{ \Morilog\Jalali\Jalalian::forge($item->updated_at)->format('%H:i:s - %d %B %Y') }}">
													{{ \Morilog\Jalali\Jalalian::forge($item->updated_at)->ago() }}</td>
												<td>
													<form action="{{ route('header.destroy', ['specification' => $specification->id, 'header' => $item->id]) }}" method="POST">
														<a href="{{ route('row.index', ['header' => $item->id]) }}" class="btn btn-warning custom-btn-warning"><i class="icon ti-menu"></i> سطرها</a>
														<a href="{{ route('header.edit', ['specification' => $specification->id, 'header' => $item->id]) }}" class="btn btn-info custom-btn-info"><i class="icon ti-pencil"></i> ویرایش</a>
														<button type="submit" itemid="{{ $item->id }}" class="btn btn-danger custom-btn-danger delete-item"><i class="icon ti-close"></i> حذف</button>
														
														@method('delete')
														@csrf
													</form>	
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
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
		// Data table JavaScript
		'vendors/bower_components/datatables/media/js/jquery.dataTables.min.js',
		'dist/js/dataTables-data.js',
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
		$('.delete-item').on('click',function(event){
			event.preventDefault();
			var title = $(this).parent().parent().prev().prev().prev().text();
			var id = $(this).attr('itemid');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن برند " + title + " مطمین هستید ؟",   
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
					swal("لغو شد", "هیچ برندی حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection