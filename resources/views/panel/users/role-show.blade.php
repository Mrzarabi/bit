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
				<h5 class="txt-dark">نقش ها</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>نقش ها</span></li>
					<li><a href="#"><span>دسترسی</span></a></li>
					<li><a href="">داشبورد</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->

		<div class="seprator-block"></div>
		
		<div class="row">
			@empty($roles[0])
			<div class="alert alert-warning alert-dismissable">
				<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
				<p class="pull-right">هیچ کاربری با این نقش یافت نشد !</p>
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
                                        {{-- <a href="{{route('role.create')}}" class="btn btn-primary custom-btn-primary pull-left" style="margin-bottom: 10px !important;" >ایجاد نقش</a> --}}
										<table id="datable_2" class="table table-hover table-bordered display mb-30">
											<thead>
												<tr>
													{{-- <th width="50px"><input type="checkbox" id="master"></th> --}}
													<th style="font-weight:bold; font-size:20px;">#</th>
													<th style="font-weight:bold; font-size:20px;">تصویر کاربر</th>
													<th style="font-weight:bold; font-size:20px;">نام و نام خانوادگی</th>
													{{-- <th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th> --}}
													<th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th>
													{{-- <th style="font-weight:bold; font-size:20px;">عملیات</th> --}}
												</tr>
											</thead>
											<tbody>
												@php $i = 0 @endphp
												@foreach ($users as $user)
													<tr style="text-align:center;">
														{{-- <td><input type="checkbox" class="sub_chk" data-id="{{$article->id}}"></td> --}}
														<td>{{ ++$i }}</td>
														<td>{{ $user->avatar }}</td>
														<td>{{ $user->first_name.' '. $role->user->last_name }}</td>
														<td title="{{ \Morilog\Jalali\Jalalian::forge($user->created_at)->format('%H:i:s - %d %B %Y') }}">
															{{ \Morilog\Jalali\Jalalian::forge($user->created_at)->ago() }}
														</td>
														{{-- <td>
															<div class="font-icon custom-style">
																<div class="font-icon custom-style">
																	<form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST">
																		<button title= "حذف مقاله" type="submit" itemid="{{ $role->id }}" class=" btn-xs btn btn-danger custom-btn-danger"><i class="icon ti-trash custom-icon"> </i></button>
																		<a title= "ویرایش مقاله" style="padding: 6px 5px !important; margin-right: 19px; margin-left: 19px;" class="d-inline btn btn-xs btn-warning custom-btn-warning" href="{{ route('role.edit', ['role' => $role->id]) }}">
																			<i class="icon ti-pencil custom-icon"> </i></a>
																		@method('delete')
																		@csrf
																	</form>
																	<a title= "دیدن اطلاعات مقاله" style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-success btn-xs custom-btn-success" href="{{ route('article.show', ['article' => $article->slug]) }}"><i class="icon ti-eye custom-icon"></i></a>
																</div>
															</div>
														</td> --}}
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
			@endempty
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

		$(document).ready(function () {
	
			fetch('{{ url('panel/article/DeleteAll') }}', {
				method: 'delete',
				data: [139]
			})
			.then(
				function(response) {
					return console.log( response )
				}
			)
			.catch(function(err) {
				console.log('Fetch Error :-S', err);
			});
	
			$('#master').on('click', function(e) {
			 if($(this).is(':checked',true))
			 {
				$(".sub_chk").prop('checked', true);
			 } else {
				$(".sub_chk").prop('checked',false);
			 }
			});
	
			var allVals = [];
			function updateChecked() {
				allVals = [];
				$(".sub_chk:checked").each(function() {
					allVals.push($(this).attr('data-id'));
				});
			} 
	
			$('.sub_chk').click(function() {
				updateChecked();
			});


			$('.delete_all').on('click', function(e) {

				console.log(allVals)
	
				if(allVals.length <=0)
				{
					alert("لطفا سطر های مورد نظر خود را انتخاب کنید .");
				}  else {
	
	
					var check = confirm("ایا برای حذف کردن این سطر ها مطمئن هستید؟");
					if(check == true){

						var join_selected_values = allVals.join(",");

						console.log( $(this).data('url') , allVals )
											
						$.ajax({
							url: $(this).data('url'),
							type: 'DELETE',
							cache: false,
							data: allVals,
							success: function (data) {
								if (data['success']) {
									$(".sub_chk:checked").each(function() {
										$(this).parents("tr").remove();
									});
									alert(data['success']);
								} else if (data['error']) {
									alert(data['error']);
								} else {
									alert('ظاهرا مشکلی بوجود آمده است');
								}
							},
							error: function (data) {
								alert(data.responseText);
							}
						});
	
	
					  $.each(allVals, function( index, value ) {
						  $('table tr').filter("[data-row-id='" + value + "']").remove();
					  });
					}
				}
			});
	
	
			$('[data-toggle=confirmation]').confirmation({
				rootSelector: '[data-toggle=confirmation]',
				onConfirm: function (event, element) {
					element.trigger('confirm');
				}
			});
	
	
			$(document).on('confirm', function (e) {
				var ele = e.target;
				e.preventDefault();
	
	
				$.ajax({
					url: ele.href,
					type: 'DELETE',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function (data) {
						if (data['success']) {
							$("#" + data['tr']).slideUp("slow");
							alert(data['success']);
						} else if (data['error']) {
							alert(data['error']);
						} else {
							alert('Whoops Something went wrong!!');
						}
					},
					error: function (data) {
						alert(data.responseText);
					}
				});
	
	
				return false;
			});
		});
	</script>
	{{-- <script type="text/javascript">
		$(document).ready(function () {
	
	
			$('#master').on('click', function(e) {
			 if($(this).is(':checked',true))  
			 {
				$(".sub_chk").prop('checked', true);  
			 } else {  
				$(".sub_chk").prop('checked',false);  
			 }  
			});
	
	
			$('.delete_all').on('click', function(e) {
	
	
				var allVals = [];  
				$(".sub_chk:checked").each(function() {  
					allVals.push($(this).attr('data-id'));
				});  
	
	
				if(allVals.length <=0)  
				{  
					alert("لطفا سطر های مورد نظر خود را انتخاب کنید");  
				}  else {  
	
	
					var check = confirm("ایا برای حذف کردن این سطرها مطمئن هستید؟");  
					if(check == true){  
	
	
						var join_selected_values = allVals.join(","); 
	
	
						$.ajax({
							url: $(this).data('url'),
							type: 'DELETE',
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'ids='+join_selected_values,
							success: function (data) {
								if (data['success']) {
									$(".sub_chk:checked").each(function() {  
										$(this).parents("tr").remove();
									});
									alert(data['با موفقیت انجام شد']);
								} else if (data['error']) {
									alert(data['error']);
								} else {
									alert('ظاهرا مشکلی پیش آمده');
								}
							},
							error: function (data) {
								alert(data.responseText);
							}
						});
	
	
					  $.each(allVals, function( index, value ) {
						  $('table tr').filter("[data-row-id='" + value + "']").remove();
					  });
					}  
				}  
			});
	
	
			$('[data-toggle=confirmation]').confirmation({
				rootSelector: '[data-toggle=confirmation]',
				onConfirm: function (event, element) {
					element.trigger('confirm');
				}
			});
	
	
			$(document).on('confirm', function (e) {
				var ele = e.target;
				e.preventDefault();
	
	
				$.ajax({
					url: ele.href,
					type: 'DELETE',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function (data) {
						if (data['success']) {
							$("#" + data['tr']).slideUp("slow");
							alert(data['success']);
						} else if (data['error']) {
							alert(data['error']);
						} else {
							alert('Whoops Something went wrong!!');
						}
					},
					error: function (data) {
						alert(data.responseText);
					}
				});
	
	
				return false;
			});
		});
	</script> --}}
@endsection 