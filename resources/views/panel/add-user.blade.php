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
				<h5 class="txt-dark">@isset($user) ویرایش کاربران @endisset</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>@isset($user) ویرایش کاربران @endisset</span></li>
					<li>کاربران</li>
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
                                <form action="@isset($user) {{ route('user.update', ['user' => $user->id]) }} @endisset" method="POST"  enctype="multipart/form-data">
                                    <div class="panel-body">
                                        @include('errors.errors-show')
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="mt-30">
                                                    <input type="file" name="avatar" id="input-file-now" class="dropify" @isset($user) data-default-file="{{ $user->avatar }}" @endisset/>
                                                </div>	
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('first_name') ) has-error @endif">
                                                            <label class="control-label mb-10"> نام :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="first_name" @if(isset($user) && !empty($user->first_name)) value="{{$user->first_name}}" @else value="{{old('first_name')}}" @endif id="title" class="form-control" placeholder="نام اول کاربر">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('first_name') )
                                                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('last_name') ) has-error @endif">
                                                            <label class="control-label mb-10">نام خانوادگی :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="last_name" @if(isset($user) && !empty($user->last_name)) value="{{$user->last_name}}" @else value="{{old('last_name')}}" @endif id="title" class="form-control" placeholder="نام خانوادگی کاربر">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('last_name') )
                                                                <span class="help-block">{{ $errors->first('last_name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('national_code') ) has-error @endif">
                                                            <label class="control-label mb-10">شماره کارت ملی :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="national_code" @if(isset($user) && !empty($user->national_code)) value="{{$user->national_code}}" @else value="{{old('social_link')}}" @endif id="title" class="form-control" placeholder="شماره کارت ملی کاربر">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('national_code') )
                                                                <span class="help-block">{{ $errors->first('national_code') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('phone_number') ) has-error @endif">
                                                            <label class="control-label mb-10">تلفن کاربر :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="phone_number" @if(isset($user) && !empty($user->phone_number)) value="{{$user->phone_number}}" @else value="{{old('phone_number')}}" @endif id="title" class="form-control" placeholder="تلفن کاربر">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('phone_number') )
                                                                <span class="help-block">{{ $errors->first('phone_number') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('created_at') ) has-error @endif">
                                                            <label class="control-label mb-10"> تاریخ ثبت نام :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="created_at" @if(isset($user) && !empty($user->created_at)) value="{{$user->created_at}}" @else value="{{old('created_at')}}" @endif id="title" class="form-control" placeholder="تاریخ ثبت نام کاربر">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('created_at') )
                                                                <span class="help-block">{{ $errors->first('created_at') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('birthday') ) has-error @endif">
                                                            <label class="control-label mb-10">تاریخ تولد کاربر :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="birthday" @if(isset($user) && !empty($user->birthday)) value="{{$user->birthday}}" @else value="{{old('birthday')}}" @endif id="title" class="form-control" placeholder="تاریخ تولد کاربر">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('birthday') )
                                                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-8">
                                                <div class="form-group @if( $errors->has('address') ) has-error @endif">
                                                    <label class="control-label mb-10">آدرس :</label>
                                                    <div class="input-group">
                                                        <input type="text" name="address" @if(isset($user) && !empty($user->address)) value="{{$user->address}}" @else value="{{old('address')}}" @endif id="title" class="form-control" placeholder="آدرس کاربر">
                                                        <div class="input-group-addon"><i class="ti-text"></i></div>
                                                    </div>
                                                    @if( $errors->has('address') )
                                                        <span class="help-block">{{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group @if( $errors->has('email') ) has-error @endif">
                                                    <label class="control-label mb-10">ایمیل :</label>
                                                    <div class="input-group">
                                                        <input type="text" name="email" @if(isset($user) && !empty($user->email)) value="{{$user->email}}" @else value="{{old('email')}}" @endif id="title" class="form-control" placeholder="ایمیل کاربر">
                                                        <div class="input-group-addon"><i class="ti-text"></i></div>
                                                    </div>
                                                    @if( $errors->has('email') )
                                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group @if( $errors->has('role_id') ) has-error @endif">
                                                    <label class="control-label mb-10">نقش</label>
                                                    <div class="input-group">
                                                        <select multiple name="roles[]" class="form-control select2">
                                                            @foreach ($roles as $role)
                                                                <option value="{{$role['id']}}"
                                                                    @if( isset($user) && $user->hasRole( $role->name ) ) selected @endif>
                                                                    {{$role['display_name']}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-addon"><i class="ti-layout-grid2-alt"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">                                                
                                            <div class="form-actions">
                                                <button class="btn btn-orange custom-btn-warning btn-icon right-icon mr-10 pull-left" > <i class="fa fa-check"></i> <span>ذخیره</span></button>
                                                <a href="{{route('user.index')}}" class="btn btn-default custom-btn-gainsboro pull-left" style="border-radius: 7px;">لغو</a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    @isset($user) @method('put') @endisset
                                    @csrf
                                </form>
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

$('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
		@isset($user)
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