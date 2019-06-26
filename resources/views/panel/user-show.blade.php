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
				<h5 class="txt-dark">کاربران</h5>
			</div>
			
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>کاربران</span></li>
					<li><a href="#"><span>کاربران</span></a></li>
					<li><a href="index.html">داشبورد</a></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		<div class="seprator-block"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default border-panel card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <div class="product-pic img-responsive "
                                        style="background: url('{{ $user->avatar }}') center center;
                                            background-size: cover; margin: 50px; max-width: 300px; border-radius: 7px;">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                                <thead>
                                                    <tr>
                                                        <th>نام</th>
                                                        <th>نام خانوادگی</th>
                                                        <th>کد ملی</th>
                                                        <th>شماره تماس</th>
                                                        <th>تاریخ تولد</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->last_name }}</td>
                                                        <td>{{ $user->national_code }}</td>
                                                        <td>{{ $user->phone_number }}</td>
                                                        <td>{{ $user->birthday }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                                <thead style="margin-top:10px;">
                                                    <tr>
                                                        <th>آدرس</th>
                                                        <th>ایمیل</th>
                                                        <th>تاریخ ثبت</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $user->address }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                                <thead style="margin-top:10px;">
                                                    <tr>
                                                        <th>تصویر کد ملی</th>
                                                        <th>تصویر شناسنامه</th>
                                                        <th>تصویر قبض</th>
                                                        <th>تصویر سلفی با کارت ملی</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>

                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="product-pic img-responsive "
                                                                        style="background: url('{{ $user->image_national_code }}') center center;
                                                                            background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate', ['user' => $user->id])}}" method="post" enctype="multipart/form-data">
                                                                            <button type="button" class="btn btn-secondary">رد</button>
                                                                            <a href="{{route('accept_certificate', ['user' => $user->id])}}">
                                                                                <button type="button" class="btn btn-primary"><i class="fa fa-check"></i><span> تایید </span></button></a>
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>

                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="product-pic img-responsive "
                                                                        style="background: url('{{ $user->identify_certificate }}') center center;
                                                                            background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate')}}" method="post">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">رد</button>
                                                                            <button type="button" class="btn btn-primary">تایید </button>
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>

                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="product-pic img-responsive "
                                                                        style="background: url('{{ $user->image_bill }}') center center;
                                                                            background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate')}}" method="post">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">رد</button>
                                                                            <button type="button" class="btn btn-primary">تایید </button>
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>

                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="product-pic img-responsive "
                                                                        style="background: url('{{ $user->image_selfie_national_code }}') center center;
                                                                            background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{route('accept_certificate')}}" method="post">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">رد</button>
                                                                            <button type="button" class="btn btn-primary">تایید </button>
                                                                            @method('put')
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </td> --}}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table id="datable_2" class="table table-hover table-bordered display mb-30" >
                                                <thead style="margin-top:10px;">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>نام بانک</th>
                                                        <th>شماره بانک</th>
                                                        <th>شماره شبا</th>
                                                        <th>تاریخ ثبت</th>
                                                        <th>تصویر کارت بانکی</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tbody>
                                                        @php $i = 0 @endphp
                                                        @foreach ($user->bankCard as $item)
                                                            <tr>
                                                                <td>{{ ++$i }}</td>
                                                                <td>{{ $item->bank_name }}</td>
                                                                <td>{{ $item->bank_card }}</td>
                                                                <td>{{ $item->code }}</td>
                                                                <td>{{ $item->created_at }}</td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="border-radius: 7px;">باز کردن تصویر</button>

                                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">تصویر کارت بانکی</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="product-pic img-responsive "
                                                                                style="background: url('{{ $item->image_benk_card }}') center center;
                                                                                    background-size: cover; margin: 50px; max-width: 500px; border-radius: 7px;">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form action="{{route('accept_certificate')}}" method="post">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">رد</button>
                                                                                    <button type="button" class="btn btn-primary">تایید </button>
                                                                                    @method('put')
                                                                                    @csrf
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>	
                                </div>
                            </div>	
                        </div>	
                    </div>
                </div>
            </div>
		<!-- /Product Row Four -->
		
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
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
		$('.delete-item').on('click',function(){
			var title = $(this).parent().parent().next().find('h5').text();
			var id = $(this).attr('product');
			var form = $(this).parent();

			swal({   
				title: "مطمین هستید ؟",   
				text: "برای پاک کردن کاربر " + title + " مطمین هستید ؟",   
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
					swal("لغو شد", "هیچ کاربری حذف نشد :)", "error");   
				} 
			});
			return false;
		});
	</script>
@endsection