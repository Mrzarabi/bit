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
                            <input type="text" onkeyup="this.nextElementSibling.href = '/panel/{{ $type }}?query='+this.value" value="{{ request('query') }}" id="firstName" class="form-control" placeholder="مثلا : عنوان {{$label}}">
                            <a href="/panel/{{ $type }}" class="input-group-addon"><i class="ti-search"></i></a>
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
                                <form action="{{ route("{$type}.destroy", [$type => 0]) }}" method="POST">
                                    <button type="submit" @if( !auth()->user()->can("delete-{$type}") ) disabled @endif class="btn btn-danger custom-btn-danger pull-left mb-10" >حذف موارد انتخاب شده</button>
                                    {{$slot}}
                                    <table id="datable_2" class="table table-hover table-bordered display mb-30">
                                        <thead>
                                            <tr>
                                                <th width="50px"></th>
                                                <th style="font-weight:bold; font-size:20px;">#</th>
                                                @foreach ($fields as $item)
                                                    <th style="font-weight:bold; font-size:20px;">{{ $item['label'] }}</th>
                                                @endforeach
                                                <th style="font-weight:bold; font-size:20px;">تاریخ ثبت</th>
                                                <th style="font-weight:bold; font-size:20px;">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 0 @endphp
                                            @foreach ($data as $item)
                                                <tr style="text-align:center;"> 
                                                    <td><input name="selected[]" type="checkbox" class="checkbox" value="{{$item->id}}"></td>
                                                    <td>{{ ++$i }}</td>

                                                    @foreach ($fields as $field)
                                                        @isset( $field['resolver'] )
                                                            <td>{!! $field['resolver']( $item->{$field['field']} ) !!}</td>
                                                        @else
                                                            <td>{{ $item->{$field['field']} }}</td>
                                                        @endisset
                                                    @endforeach
                                                    
                                                    <td title="{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:i:s - %d %B %Y') }}">
                                                        {{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}
                                                    </td>
                                                    <td>
                                                        <div class="font-icon custom-style">
                                                            <div class="font-icon custom-style">
                                                                
                                                                {{-- we try to delete one item and use fetch and field type in controller at method index in CainController    --}}
                                                                <button name="f" title="حذف {{ $label }}" aria-id="{{ $item->id }}" @if( !auth()->user()->can("delete-{$type}") ) disabled @endif type="submit" class="delete-item btn btn-danger custom-btn-danger"><i class="icon ti-trash custom-icon" style="color: white !important;"> </i></button>
               
                                                                <a title= "ویرایش {{ $label }}" aria-id="{{ $item->id }}" @if( !auth()->user()->can("update-{$type}") ) disabled @endif style="padding: 6px 5px !important; margin-right: 19px; margin-left: 19px;" class="d-inline btn btn-xs btn-warning custom-btn-warning" @if( auth()->user()->can("update-{$type}") ) href="{{ route("{$type}.edit", [$type => $item->slug ? $item->slug : $item->id]) }}" @endif >
                                                                    <i class="icon ti-pencil custom-icon"></i>
                                                                </a>
                                                                @method('delete')
                                                                @csrf

                                                                @isset($more_action)    
                                                                    <a title= "دیدن اطلاعات {{$label}}" aria-id="{{ $item->id }}" @if( !auth()->user()->can("read-{$type}") ) disabled @endif style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-success btn-xs custom-btn-success" href="{{ route("{$type}.show", [$type => $item->slug ? $item->slug : $item->id]) }}">
                                                                        <i class="icon ti-eye custom-icon"></i>
                                                                    </a>
                                                                @endisset

                                                                @isset($reset_pass)
                                                                    <a title="{{$work}} {{$label}}" aria-id="{{ $item->id }}" @if( !auth()->user()->can("update-password") ) disabled @endif style="margin-right: 18px; padding: 6px 5px !important;" class="font-icon custom-style {{$class}}" href="{{route('editPass', [$type => $item->id])}}">
                                                                        <i class="{{$class_i}}"></i>
                                                                    </a>
                                                                @endisset

                                                                @isset($show_purchases)
                                                                    <a title="سوابق خرید"  style="margin-right: 18px; padding: 6px 5px !important;" class="font-icon custom-style btn btn-primary custom-btn-primary" href="{{route('show_purchases', [$type => $item->id])}}">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </a>
                                                                @endisset

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @csrf
                                    @method("delete")
                                </form>
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