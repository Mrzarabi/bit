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
				<h5 class="txt-dark">@isset($user) ویرایش پروفایل @endisset</h5>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active"><span>@isset($user) ویرایش پروفایل @endisset</span></li>
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

                                {{-- show field for change profile --}}
                                <form action="@isset($user) {{ route('updateProfile', ['user' => $user->id]) }} @endisset" method="POST"  enctype="multipart/form-data">
                                    <div class="panel-body">
                                        @include('errors.errors-show')
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="mt-30">
                                                    <input type="file" name="avatar" id="input-file-now" class="dropify" data-default-file="{{ $user->avatar }}"/>
                                                </div>	
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('first_name') ) has-error @endif">
                                                            <label class="control-label mb-10"> نام :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="first_name" @if(isset($user) && !empty($user->first_name)) value="{{$user->first_name}}" @else value="{{old('first_name')}}" @endif id="title" class="form-control" placeholder="نام ">
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
                                                                <input type="text" name="last_name" @if(isset($user) && !empty($user->last_name)) value="{{$user->last_name}}" @else value="{{old('last_name')}}" @endif id="title" class="form-control" placeholder="نام خانوادگی ">
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
                                                                <input type="text" name="national_code" @if(isset($user) && !empty($user->national_code)) value="{{$user->national_code}}" @else value="{{old('national_code')}}" @endif id="title" class="form-control" placeholder="شماره کارت ملی ">
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
                                                                <input type="text" name="phone_number" @if(isset($user) && !empty($user->phone_number)) value="{{$user->phone_number}}" @else value="{{old('phone_number')}}" @endif id="title" class="form-control" placeholder="تلفن ">
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
                                                        <div class="form-group @if( $errors->has('birthday') ) has-error @endif">
                                                            <label class="control-label mb-10">متولد سال :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="birthday" @if(isset($user) && !empty($user->birthday)) value="{{$user->birthday}}" @else value="{{old('birthday')}}" @endif id="title" class="form-control" placeholder="متولد سال ">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('birthday') )
                                                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group @if( $errors->has('email') ) has-error @endif">
                                                            <label class="control-label mb-10">ایمیل :</label>
                                                            <div class="input-group">
                                                                <input type="text" name="email" @if(isset($user) && !empty($user->email)) value="{{$user->email}}" @else value="{{old('email')}}" @endif id="title" class="form-control" placeholder="ایمیل ">
                                                                <div class="input-group-addon"><i class="ti-text"></i></div>
                                                            </div>
                                                            @if( $errors->has('email') )
                                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group @if( $errors->has('address') ) has-error @endif">
                                                    <label class="control-label mb-10">آدرس :</label>
                                                    <div class="input-group">
                                                        <input type="text" name="address" @if(isset($user) && !empty($user->address)) value="{{$user->address}}" @else value="{{old('address')}}" @endif id="title" class="form-control" placeholder="آدرس ">
                                                        <div class="input-group-addon"><i class="ti-text"></i></div>
                                                    </div>
                                                    @if( $errors->has('address') )
                                                        <span class="help-block">{{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- btn --}}
                                    <div class="row">
                                        <div class="col-sm-12">                                                
                                            <div class="form-actions pt-5">
                                                <button class="btn btn-orange custom-btn-warning btn-icon right-icon mr-10 pull-left" > <i class="fa fa-check"></i> <span>ذخیره</span></button>
                                                @if (\auth::user()->hasRole('owner'))
                                                    <a href="{{route('user.index')}}" class="btn btn-default custom-btn-gainsboro pull-left" style="border-radius: 7px;">لغو</a>
                                                @else
                                                    <a href="{{route('client.index')}}" class="btn btn-default custom-btn-gainsboro pull-left" style="border-radius: 7px;">لغو</a>
                                                @endif
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                        {{-- end --}}
                                    @isset($user) @method('put') @endisset
                                    @csrf
                                </form>
                                <hr style="border-top: 1px solid #eee; margin-top: 20px;">
                                {{-- end --}}
                                {{-- show upload some images --}}
                                @if (!$user->hasRole('owner'))
                                    <div class="row pb-5">
                                        <div class="col-md-12">
                                            <form action="@isset($user) {{ route('updateImageProfile', ['user' => $user->id]) }} @endisset" method="POST"  enctype="multipart/form-data">
                                                <div class="col-md-3">
                                                    <h3 style="font-weight: bold; font-size: 24px; text-align: center;">تصویر کد ملی</h3>
                                                    <div class="mt-30">
                                                        @if ($user->accept_image_national_code)
                                                            <div class="product-pic img-responsive "
                                                                style="background: url('{{ $user->image_national_code }}') center center;
                                                                    background-size: cover; max-width: 300px; width: 270px; height: 200px; border-radius: 7px;">
                                                            </div>
                                                            <P class="text-center mt-5"><span class="label bg-success">تایید شده</span></P>
                                                        @else
                                                            <input type="file" name="image_national_code" id="input-file-now" class="dropify" data-default-file="{{ $user->image_national_code }}"/>
                                                            <button class="btn btn-success custom-btn-success btn-icon btn-group-justified btn-icon right-icon mt-5" > <span>ذخیره تصویر کد ملی</span></button>
                                                            <input type="hidden" name="type" value="image_national_code">
                                                        @endif
                                                    </div>	
                                                </div>
                                                @isset($user) @method('put') @endisset
                                                @csrf
                                            </form>

                                            <form action="@isset($user) {{ route('updateImageProfile', ['user' => $user->id]) }} @endisset" method="POST"  enctype="multipart/form-data">
                                                <div class="col-md-3">
                                                    <h3 style="font-weight: bold; font-size: 24px; text-align: center;">تصویر شناسنامه</h3>
                                                    <div class="mt-30">
                                                        @if ($user->accept_identify_certificate)
                                                            <div class="product-pic img-responsive "
                                                                style="background: url('{{ $user->identify_certificate }}') center center;
                                                                    background-size: cover; max-width: 300px; width: 270px; height: 200px; border-radius: 7px;">
                                                            </div>
                                                            <P class="text-center mt-5"><span class="label bg-success">تایید شده</span></P>
                                                        @else
                                                            <input type="file" name="identify_certificate" id="input-file-now" class="dropify" data-default-file="{{ $user->identify_certificate }}"/>
                                                            <button class="btn btn-success custom-btn-success btn-icon btn-group-justified btn-icon right-icon mt-5" > <span>ذخیره تصویر شناسنامه</span></button>
                                                            <input type="hidden" name="type" value="identify_certificate">
                                                        @endif
                                                    </div>	
                                                </div>
                                                
                                                @isset($user) @method('put') @endisset
                                                @csrf
                                            </form>

                                            <form action="@isset($user) {{ route('updateImageProfile', ['user' => $user->id]) }} @endisset" method="POST"  enctype="multipart/form-data">
                                                <div class="col-md-3">
                                                    <h3 style="font-weight: bold; font-size: 24px; text-align: center;">تصویر قبض</h3>
                                                    <div class="mt-30">
                                                        @if ($user->accept_image_bill)
                                                            <div class="product-pic img-responsive "
                                                                style="background: url('{{ $user->image_bill }}') center center;
                                                                    background-size: cover; max-width: 300px; width: 270px; height: 200px; border-radius: 7px;">
                                                            </div>
                                                            <P class="text-center mt-5"><span class="label bg-success">تایید شده</span></P>
                                                        @else
                                                            <input type="file" name="image_bill" id="input-file-now" class="dropify" data-default-file="{{ $user->image_bill }}"/>
                                                            <button class="btn btn-success custom-btn-success btn-icon btn-group-justified btn-icon right-icon mt-5" > <span>ذخیره تصویر قبض</span></button>
                                                            <input type="hidden" name="type" value="image_bill">
                                                        @endif
                                                    </div>	
                                                </div>
                                                
                                                @isset($user) @method('put') @endisset
                                                @csrf
                                            </form>

                                            <form action="@isset($user) {{ route('updateImageProfile', ['user' => $user->id]) }} @endisset" method="POST"  enctype="multipart/form-data">
                                                <div class="col-md-3">
                                                    <h3 style="font-weight: bold; font-size: 24px; text-align: center;">تصویر سلفی با کارت ملی</h3>
                                                    <div class="mt-30">
                                                        @if ($user->accept_image_selfie_national_code)
                                                            <div class="product-pic img-responsive "
                                                                style="background: url('{{ $user->image_selfie_national_code }}') center center;
                                                                    background-size: cover; max-width: 300px; width: 270px; height: 200px; border-radius: 7px;">
                                                            </div>
                                                            <P class="text-center mt-5"><span class="label bg-success">تایید شده</span></P>
                                                        @else
                                                            <input type="file" name="image_selfie_national_code" id="input-file-now" class="dropify" data-default-file="{{ $user->image_selfie_national_code }}"/>
                                                            <button class="btn btn-success custom-btn-success btn-icon btn-group-justified right-icon mt-5" > <span>ذخیره تصویر سلفی با کارت ملی</span></button>
                                                            <input type="hidden" name="type" value="image_selfie_national_code">
                                                        @endif
                                                    </div>	
                                                </div>
                                                
                                                @isset($user) @method('put') @endisset
                                                @csrf
                                            </form>    
                                        </div>	
                                    </div>
                                @endif
                                {{-- end --}}
                                {{-- show bank cards --}}
                                @if (!$user->hasRole('owner'))
                                    <hr style="border-top: 1px solid #eee; margin-top: 20px;">
                                    <div class="row">
                                        <button type="button" class="btn btn-xs btn-primary custom-pama-btn custom-btn-primary pull-left rounded" data-toggle="modal" data-target="#create" data-whatever="@getbootstrap" style="border-radius: 7px; margin-left: 15px;">ثبت کارت بانکی</button>
                                                
                                        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <form action="{{ route('storeBankCard') }}" enctype="multipart/form-data" method="POST">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="mt-30">
                                                                                <input type="file" style="max-width: 350px;" name="image_bank_card" id="input-file-now" class="dropify"/>
                                                                            </div>	
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="form-group @if( $errors->has('bank_name') ) has-error @endif">
                                                                                <label class="control-label mb-10"> نام بانک  </label>
                                                                                <div class="input-group">
                                                                                    <input type="text" name="bank_name" id="title" class="form-control" placeholder="نام بانک  ">
                                                                                    <div class="input-group-addon"><i class="ti-text"></i></div>
                                                                                </div>
                                                                                @if( $errors->has('bank_name') )
                                                                                    <span class="help-block">{{ $errors->first('bank_name') }}</span>
                                                                                @endif
                                                                            </div> 	
                                                                            <div class="form-group @if( $errors->has('bank_card') ) has-error @endif">
                                                                                <label class="control-label mb-10"> شماره کارت  </label>
                                                                                <div class="input-group">
                                                                                    <input type="text" name="bank_card" id="title" class="form-control" placeholder="شماره کارت  ">
                                                                                    <div class="input-group-addon"><i class="ti-text"></i></div>
                                                                                </div>
                                                                                @if( $errors->has('bank_card') )
                                                                                    <span class="help-block">{{ $errors->first('bank_card') }}</span>
                                                                                @endif
                                                                            </div> 	
                                                                            <div class="form-group @if( $errors->has('code') ) has-error @endif">
                                                                                <label class="control-label mb-10"> شماره شبا  </label>
                                                                                <div class="input-group">
                                                                                    <input type="text" name="code" id="title" class="form-control" placeholder="شماره شبا ">
                                                                                    <div class="input-group-addon"><i class="ti-text"></i></div>
                                                                                </div>
                                                                                @if( $errors->has('code') )
                                                                                    <span class="help-block">{{ $errors->first('code') }}</span>
                                                                                @endif
                                                                            </div> 
                                                                        </div>
                                                                        <div class="col-md-3 dropdown">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12">
                                                                    <div class="form-actions">
                                                                        <button type="submit" class="btn btn-orange custom-btn-warning btn-icon right-icon mr-10 pull-left"> <span>ساختن</span></button>
                                                                    </div>
                                                                </div>
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if( !$bank_cards )
                                            <div class="alert alert-warning alert-dismissable">
                                                <i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
                                                <p class="pull-right">هیچ داده ای یافت نشد !</p>
                                                <div class="clearfix"></div>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <div class="panel panel-default border-panel card-view">
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body">
                                                            <div class="table-wrap">
                                                                <div class="table-responsive">
                                                                <table id="datable_2" class="table table-hover table-bordered display mb-30">
                                                                    <h2 style="margin:15px;">کارت بانکی</h2>
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="font-weight:bold; font-size:20px;">#</th>
                                                                            <th style="font-weight:bold; font-size:20px;">تصویر کارت بانکی</th>
                                                                            <th style="font-weight:bold; font-size:20px;">نام بانک</th>
                                                                            <th style="font-weight:bold; font-size:20px;">شماره کارت</th>
                                                                            <th style="font-weight:bold; font-size:20px;">شماره شبا</th>
                                                                            <th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th>
                                                                            <th style="font-weight:bold; font-size:20px;">عملیات</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php $i = 0 @endphp
                                                                        @foreach ($bank_cards as $item)
                                                                            @if (!$item->is_close)
                                                                                <tr style="text-align:center;">
                                                                                    <td>{{ ++$i }}</td>
                                                                                    <td>
                                                                                        <div class="product-pic img-responsive "
                                                                                            style="background: url('{{ $item->image_bank_card }}') center center;
                                                                                                background-size: cover; display: -webkit-inline-box; width: 90px; height: 60px; max-width: 100px; border-radius: 7px;">
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>{{ $item->bank_name }}</td>
                                                                                    <td>{{ $item->bank_card }}</td>
                                                                                    <td>{{ $item->code }}</td>
                                                                                    <td title="{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:i:s - %d %B %Y')  }}">
                                                                                        {{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}
                                                                                    </td>
                                                                                    <td>
                                                                                        @if ($item->accept_image_bank_card)
                                                                                            <P><span class="label bg-success">تایید شده</span></P>
                                                                                        @else
                                                                                            <div class="font-icon custom-style">
                                                                                                <button type="button" class="btn btn-xs btn-warning custom-pama-btn custom-btn-warning" data-toggle="modal" data-target="#{{$item->id}}" data-whatever="@getbootstrap" style="border-radius: 7px;">تعویض تصویر کارت بانکی</button>
                                                                                                
                                                                                                <div class="modal fade" id="{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                    <div class="modal-dialog" role="document">
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-footer">
                                                                                                                <div class="row">
                                                                                                                    <form action="{{ route('updateImageBankCard', ['bank_card' => $item->id]) }}" enctype="multipart/form-data" method="POST">
                                                                                                                        <div class="col-md-12">
                                                                                                                            <div class="mt-30">
                                                                                                                                <input type="file" style="max-width: 350px;" name="image_bank_card" id="input-file-now" class="dropify"/>
                                                                                                                            </div>	
                                                                                                                        </div>
                                                                                                                        <div class="col-md-12">
                                                                                                                            <div class="form-actions">
                                                                                                                                <button type="submit" class="btn btn-orange custom-btn-warning btn-icon right-icon mr-10 pull-left pt-5"> <span>به روز رسانی</span></button>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        @method('put')
                                                                                                                        @csrf
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif	
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>	
                                                    </div>	
                                                </div>	
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                {{-- end  --}}

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