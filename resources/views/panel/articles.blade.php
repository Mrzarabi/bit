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
				<h5 class="txt-dark">مقالات</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>مقالات</span></li>
					<li><a href="#"><span>فروشگاه</span></a></li>
					<li><a href="">داشبورد</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		
		<!-- Group Row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-dark">جستجو در مقالات</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  class="panel-wrapper collapse in">
						<div  class="panel-body">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="article_title" onkeyup="this.nextElementSibling.href = '/panel/article/search/'+this.value" @isset($query) value="{{$query}}" @endisset id="firstName" class="form-control" placeholder="مثلا : عنوان مقاله">
									<a href="/panel/article/search/" class="input-group-addon"><i class="ti-search"></i></a>
								</div>
							</div>
						</div>
					</div>

					<div class="panel-body">
						@include('errors.errors-show')
					</div>
				</div>
			</div>

		</div>
		<!-- Group Row -->

		<div class="seprator-block"></div>
		
		<div class="row">
			@empty($articles[0])
			<div class="alert alert-warning alert-dismissable">
				<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
				<p class="pull-right">هیچ محصولی یافت نشد !</p>
				<div class="clearfix"></div>
			</div>
			@else
				<div class="col-md-12">
					<div class="panel panel-default border-panel card-view">
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="table-wrap">
									<div class="table-responsive">
										{{-- <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button> --}}
										{{-- <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('panel/article/DeleteAll') }}">Delete All Selected</button> --}}
										<table id="datable_2" class="table table-hover table-bordered display mb-30">
											<thead>
												<tr>
													{{-- <th width="50px"><input type="checkbox" id="check_all"></th> --}}
													<th style="font-weight:bold; font-size:20px;">#</th>
													<th style="font-weight:bold; font-size:20px;">تصویر مقاله</th>
													<th style="font-weight:bold; font-size:20px;">عنوان مقاله</th>
													<th style="font-weight:bold; font-size:20px;">عنوان دسته بندی مقاله</th>
													<th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th>
													<th style="font-weight:bold; font-size:20px;">عملیات</th>
												</tr>
											</thead>
											<tbody>
												@php $i = 0 @endphp
												@foreach ($articles as $article)
													<tr style="text-align:center;">
														{{-- <td><input type="checkbox" class="checkbox" data-id="{{$article->id}}"></td> --}}
														{{-- <td>
																<input type="checkbox" name="article[]" value="{{$article['id']}}"
																	@isset($article) @if($article->contains($article->id))  checked=checked  @endisset @endif >
																		{{$article['title']}}<br>
														</td> --}}
														<td>{{ ++$i }}</td>
														<td>
															<div class="row" style="display: flex; justify-content: center;">
																<div class="col-md-8">
																	@if ($article->image)
																		<img src="{{ $article->image }}" style="background-size: cover; max-width: 80px; max-height: 60px; border-radius: 5px; width: 100%; height: 100%;" alt="تصویر">
																	@else
																		<img src="/images/placeholder/placeholder.png" style="background-size: cover; max-width: 80px; max-height: 60px; border-radius: 5px; height: 100%;" alt="تصویر">
																	@endif
																</div>
															</div>
														</td>
														<td>{{ $article->title }}</td>
														<td>{{ $article->subject->title }}</td>
														<td title="{{ \Morilog\Jalali\Jalalian::forge($article->created_at)->format('%H:i:s - %d %B %Y') }}">
															{{ \Morilog\Jalali\Jalalian::forge($article->created_at)->ago() }}
														</td>
														<td>
															<div class="font-icon custom-style">
																<div class="font-icon custom-style">
																	<form action="{{ route('article.destroy', ['article' => $article->slug]) }}" method="POST">
																		<button title= "حذف مقاله" type="submit" class="delete-item btn-xs btn btn-danger custom-btn-danger"><i class="icon ti-trash custom-icon"> </i></button>
																		<a title= "ویرایش مقاله" style="padding: 6px 5px !important; margin-right: 19px; margin-left: 19px;" class="d-inline btn btn-xs btn-warning custom-btn-warning" href="{{ route('article.edit', ['article' => $article->slug]) }}">
																			<i class="icon ti-pencil custom-icon"> </i></a>
																		@method('delete')
																		@csrf
																	</form>
																	<a title= "دیدن اطلاعات مقاله" style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-success btn-xs custom-btn-success" href="{{ route('article.show', ['article' => $article->slug]) }}"><i class="icon ti-eye custom-icon"></i></a>
																</div>
															</div>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>	
								{{$articles->links()}}
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
			$('#check_all').on('click', function(e) {
				if($(this).is(':checked',true))  
				{
					$(".checkbox").prop('checked', true);  
				} else {  
					$(".checkbox").prop('checked',false);  
				}  
			});

			$('.checkbox').on('click',function() {
				if($('.checkbox:checked').length == $('.checkbox').length)
				{
					$('#check_all').prop('checked',true);
				} else {
					$('#check_all').prop('checked',false);
				}
			});

			$('.delete-all').on('click', function(e) {
				var idsArr = [];  
				$(".checkbox:checked").each(function() {  
					idsArr.push($(this).attr('data-id'));
			});  

			if(idsArr.length <=0)  
			{  
				alert("لطفا گزینه های مورد نظر برای حذف شدن را انتخاب کنید . ");  
			}  else {  
				if(confirm("آیا برای حذف کردن مطمئن هستید؟"))
				{	
					var strIds = idsArr.join(","); 

					$.ajax({
					url: "{{ route('deleteMultiple') }}",
					type: 'DELETE',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: 'ids='+strIds,
						success: function (data) {
							if (data['status'] == true) {
								$(".checkbox:checked").each(function() {  
									$(this).parents("tr").remove();
								});
								alert('data['message']');
							} else {
								alert('ظاهرا مشکلی بوجود آمده !!');
							}
						},
						error: function (data) {
							alert(data.responseText);
						}
					});
				}  
			}  
		});

	$('[data-toggle=confirmation]').confirmation({
		rootSelector: '[data-toggle=confirmation]',
		onConfirm: function (event, element) {
			element.closest('form').submit();
		}
	});
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