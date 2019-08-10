
<!-- Title -->
<div class="row heading-bg">
        <!-- Breadcrumb -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">{{$label}}</h5>
        </div>
        
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active"><span>{{$label}}</span></li>
                <li><a href="#"><span>{{$header_label}}</span></a></li>
                <li><a href="">داشبورد</a></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->
    
    <!-- Group Row -->
    @php
        // dd(/panel);
    @endphp
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-right">
                        <h6 class="panel-title txt-dark">جستجو در {{$label}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div  class="panel-wrapper collapse in">
                    <div  class="panel-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" onkeyup="this.nextElementSibling.href = '/panel/client?query='+this.value" value="{{ request('query') }}" id="firstName" class="form-control"placeholder="مثلا : عنوان {{$label}}">
                                <a href="/panel/client" class="input-group-addon"><i class="ti-search"></i></a>
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
        @if( $data->isEmpty() )
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
                                        <thead>
                                            <tr>
                                                <th style="font-weight:bold; font-size:20px;">#</th>
                                                @foreach ($fields as $item)
                                                    <th style="font-weight:bold; font-size:20px;">{{ $item['label'] }}</th>
                                                @endforeach
                                                <th style="font-weight:bold; font-size:20px;">عملیات</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php $i = 0 @endphp
                                            @foreach ($data as $item)
                                                <tr style="text-align:center;"> 
                                                    <td>{{ ++$i }}</td>

                                                    @foreach ($fields as $field)
                                                        @isset( $field['resolver'] )
                                                            <td>{!! $field['resolver']( $item->{$field['field']} ) !!}</td>
                                                        @else
                                                            <td>{{ $item->{$field['field']} }}</td>
                                                        @endisset
                                                    @endforeach
                                                    <td>
                                                        <div class="font-icon custom-style">
                                                            <div class="font-icon custom-style">
                                                                @if (\auth::user()->can_buy)
                                                                    <button title="اتصال به درگاه پرداخت " aria-id="{{ $item->id }}" type="submit" class="delete-item btn btn-primary custom-btn-primary"> اتصال به درگاه بانکی </button>
                                                                @else
                                                                    <p>بدون درگاه پرداخت</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                {{ $data->links() }}
                            </div>	
                        </div>	
                    </div>	
                </div>	
            </div>
        @endif
    </div>