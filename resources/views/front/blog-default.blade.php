@extends('front.layout.master')

@section('content')

    <!-- page-header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-caption">
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="custom-breadcrumb">
                                <li class="custom-breadcrumb-line"><a href="{{route('index')}}"><span>صفحه اصلی</span></a></li>
                                @if (isset($subject))
                                    <li class="active"><span> {{$subject->title}} </span></li>
                                @else
                                    <li class="active"><span>مقالات</span></li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- blog -->
    @if ( $articles->isEmpty() )
        <p class="text-center p-5"> در حال حاضر هیچ مقاله ای ثبت نشده ): </p>
    @else
        <div class="content">
            <div class="container custom-dir">
                <div class="row">
                    <div class="offset-xl-1 col-xl-10 offset-lg-1 col-lg-10 col-md-12 col-sm-12 col-12">
                        @foreach ($articles as $article)
                            <div class="row d-flex">
                                {{-- <div class=""> --}}
                                    <!-- post block -->
                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 order-sm-2">
                                        <div class="post-img">
                                            <a href="#" class="imghover">
                                                @if ($article->image)
                                                    <img src="{{ $article->image }}" class="img-fluid rounded" alt="تصویر">
                                                @else
                                                    <img src="/images/placeholder/placeholder.png" class="img-fluid rounded" alt="تصویر">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 order-sm-1">
                                        <div class="post-block text-right">
                                            <div class="post-content">
                                                <h2 class="post-title"><a href="#" class="title">{{$article->title}}</a></h2>
                                                <div class="meta">
                                                    <span class="meta-admin meta-divider"><a class="meta-link">{{$article->user->first_name . ' ' . $article->user->last_name}} </a></span>
                                                    <span class="meta-date"  title="{{ \Morilog\Jalali\Jalalian::forge($article->created_at)->format('%H:i:s - %d %B %Y') }}"> 
                                                        {{ \Morilog\Jalali\Jalalian::forge($article->created_at)->ago() }}
                                                    </span>
                                                    {{-- <span class="meta-comments">  </span> --}}
                                                </div>
                                                @if ($article->description)
                                                    <p class="mb30"> {{$article->description}} </p>
                                                @else
                                                    <p>...این مقاله توضیحات ندارد</p>
                                                @endif
                                                <a href="{{route('article.blog', ['article' => $article->slug])}}" class="btn btn-default custom-btn-warning float-left">بیشتر</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- /.post block -->
                                {{-- </div> --}}
                            </div>
                            @if (!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                    <!-- pagination start -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt60">
                        <div class="st-pagination">
                            <ul class="pagination custom-style-paginate">
                                <li class="active">
                                    {{$articles->links()}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- pagination close -->
                </div>
            </div>
        </div>
    @endif
    <!-- /.blog -->
@endsection