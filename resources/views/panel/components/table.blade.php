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
                            <input type="text" onkeyup="this.nextElementSibling.href = '/panel/{{ $type }}?query='+this.value" value="{{ request('query') }}" id="firstName" class="form-control" placeholder="مثلا : عنوان مقاله">
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
                                <form action="{{ route("{$type}.destroy", [$type => 1]) }}" method="POST">
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
                                                                <form action="{{ route("{$type}.destroy", [$type => $item->id]) }}" method="POST">
                                                                    <button title="حذف {{ $label }}" aria-id="{{ $item->id }}" @if( !auth()->user()->can("delete-{$type}") ) disabled @endif type="submit" class="delete-item btn-xs btn btn-danger custom-btn-danger"><i class="icon ti-trash custom-icon"> </i></button>
                                                                    <a title= "ویرایش {{ $label }}" style="padding: 6px 5px !important; margin-right: 19px; margin-left: 19px;" class="d-inline btn btn-xs btn-warning custom-btn-warning" href="{{ route("{$type}.edit", [$type => $item->slug]) }}">
                                                                        <i class="icon ti-pencil custom-icon"> </i></a>
                                                                    @method('delete')
                                                                    @csrf
                                                                </form>
                                                                <a title= "دیدن اطلاعات {{ $label }}" style="padding: 6px 5px !important;" class="font-icon custom-style btn btn-success btn-xs custom-btn-success" href="{{ route("{$type}.show", [$type => $item->slug]) }}"><i class="icon ti-eye custom-icon"></i></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <button type="submit">حذف موارد انتخاب شده</button>

                                    @csrf
                                    @method("delete")
                                </form>
                            </div>
                        </div>	
                        {{ $data->links() }}
                    </div>	
                </div>	
            </div>	
        </div>
    @endif
</div>