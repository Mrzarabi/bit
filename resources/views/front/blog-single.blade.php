@include('front.layout.loading')

@extends('front.layout.master')

@section('content')
    <!-- page-header -->
    <div class="post-pageheader">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="post-pagecaption">
                        <h1 class="text-white">{{$article->title}} </h1>
                        <div class="meta text-white">
                            <span class="meta-admin meta-divider"><a class="meta-link">{{ $article->user ? $article->user->first_name . ' ' . $article->user->last_name : 'کاربر حذف شده است'}} </a></span>
                            <span class="meta-date"  title="{{ \Morilog\Jalali\Jalalian::forge($article->created_at)->format('%H:i:s - %d %B %Y') }}"> 
                                {{ \Morilog\Jalali\Jalalian::forge($article->created_at)->ago() }}
                            </span>
                            {{-- <span class="meta-comments"> تعداد نظرات :
                                @if ($article->comments)
                                    @foreach ($article->comments as $comment)
                                        {{count($article->comments) + count($comment->replies)}}
                                    @endforeach
                                @else
                                    0
                                @endif
                            </span> --}}
                        </div>
                        <!-- page-header -->
                       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                           <ol class="custom-breadcrumb">
                               <li class="custom-breadcrumb-line"><a href="{{route('index')}}"><span>صفحه اصلی</span></a></li>
                               <li class="custom-breadcrumb-line"><a href="{{route('blog')}}"><span>وبلاگ</span></a></li>
                               <li class="active"><span> {{$article->title}} </span></li>
                           </ol>
                       </div>
                       <!-- /.page-header-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- blog-single-sidebar-section -->
    <div class="content">
        <div class="container">
            <div class="row text-right">
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
                    <!-- widget-search -->
                    {{-- <div class="widget widget-search">
                        <form role="search">
                            <input class="form-control" placeholder="Find Here" type="text">
                            <button class="" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div> --}}
                    <!-- /.widget-search -->
                    <!-- categories -->
                    <div class="widget widget-categories">
                        <h4 class="widget-title">دسته بندی</h4>
                        <ul class="list-unstyled">
                            @foreach ($subjects as $subject)
                                <li><a href="{{route('show.subject', ['subject' => $subject->id])}}">{{$subject->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.categories -->
                    <!-- recent-post -->
                    <div class="widget widget-recent-post">
                        <h3 class="widget-title">آخرین مقالات</h3>
                        <ul class="list-unstyled">
                            @foreach ($last_articles as $item)
                            <li>
                                <div class="recent-post">
                                    <div class="row">
                                        @if ($item->image)
                                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12"><a href="#" class="recent-pic"><img src="{{$item->image}}" alt="تصویر" class="rounded img-fluid mb10"></a></div>
                                        @else
                                            <img src="/images/placeholder/placeholder.png" class="img-fluid rounded" alt="تصویر">
                                        @endif
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
                                            <h5 class="recent-title"><a href="{{route('article.blog', ['article' => $item->slug])}}" class="title">{{$item->title}}</a></h5>
                                            <span class="meta-date"  title="{{ \Morilog\Jalali\Jalalian::forge($item->created_at)->format('%H:i:s - %d %B %Y') }}"> 
                                                {{ \Morilog\Jalali\Jalalian::forge($item->created_at)->ago() }}
                                            </span>
                                            <!-- /.post meta -->
                                        </div>
                                    </div>
                                </div>
                            </li>    
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.recent-post -->
                    <!-- widget-archievs -->
                    {{-- <div class="widget widget-archives">
                        <h4 class="widget-title">Archives</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">August (2019)</a></li>
                            <li><a href="#">July (2019)</a></li>
                            <li><a href="#">June (2019) </a></li>
                            <li><a href="#">May (2019)</a></li>
                        </ul>
                    </div> --}}
                    <!-- /.widget-archievs -->
                    <!-- widget-tags -->
                    <div class="widget widget-tags">
                        <h4 class="widget-title">برچسپ ها</h4>
                        @php
                            $tags = explode(",", $article->tagList);
                        @endphp
                        @foreach ($tags as $tag)
                            <a href="{{route('tagged', ['tag' => $tag])}}">{{$tag}}</a>
                        @endforeach
                        </div>
                        <!-- /.widget-tags -->
                    </div>
                <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="post-holder">
                                <!-- post block -->
                                <div class="mb60">
                                    <h2 class="mb20"> {{$article->title}} </h2>
                                    <div class="mb30 mt30">
                                        @if ($article->image)
                                            <img src="{{$article->image}}" class="pb-5 rounded custom-width-article" alt="تصویر">
                                        @else
                                            <img src="/images/placeholder/placeholder.png" class="pb-5 rounded custom-width-article" alt="تصویر">
                                        @endif
                                        <p class="mb20">{{$article->body}}
                                        </p>
                                    </div>
                                </div>
                                <!-- post navigation -->
                                {{-- <div class="post-navigation">
                                    <div class="nav-links">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="nav-previous">
                                                    <!-- nav previous -->
                                                    <h5 class="nav-previous-title"><a href="#" class="title">Responsive Wordpress Hosting Template</a></h5>
                                                    <a href="#" class="prev-link">Previous  Post</a>
                                                </div>
                                                <!-- /. nav previous -->
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="nav-next text-right">
                                                    <!-- nav next -->
                                                    <h5 class="nav-next-title"><a href="#" class="title">Bootstrap Wordpress Hosting Template</a></h5>
                                                    <a href="#" class="next-link">Next Post</a>
                                                </div>
                                                <!-- /.nav previous -->
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- /. post navigation -->
                                {{-- <div class="related-post-block">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12 col-12 mb30">
                                            <h3 class="related-post-title">Related Posts</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="related-post">
                                                <!-- related post -->
                                                <div class="related-img">
                                                    <a href="#" class="imghover"><img src="images/related_post_1.jpg" alt="" class="img-fluid"></a>
                                                </div>
                                                <div class="related-post-content">
                                                    <h4><a href="#" class="title">Bitcoin Website Templates</a></h4>
                                                    <div class="meta">in <a href="#" class="">"WordPress Templates"</a></div>
                                                </div>
                                            </div>
                                            <!-- /.related post -->
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="related-post">
                                                <!-- related post -->
                                                <div class="related-img">
                                                    <a href="#" class="imghover"><img src="images/related_post_2.jpg" alt="" class="img-fluid"></a>
                                                </div>
                                                <div class="related-post-content">
                                                    <h4><a href="#" class="title">Cryptocurrency Website Templates</a></h4>
                                                    <div class="meta">in <a href="#" class="">"Bootstrap Template"</a></div>
                                                </div>
                                            </div>
                                            <!-- /.related post -->
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- /.related post block -->
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="author-block">
                                            <!-- Post author -->
                                            <div class="author-content">
                                                <div class="text-left">
                                                </div>
                                                <div class="author-header row">
                                                    <div class="col-md-2">
                                                        @if ($article->user)
                                                            @if ($article->user->avatar)
                                                                <img src="{{$article->user->avatar}}" class="custom-style-img float-right pt-1 pl-0 pb-18" alt="تصویر">
                                                            @else
                                                                <img src="/images/placeholder/download.png" class="img-fluid pt-1 pl-0 pb-18" alt="تصویر">
                                                            @endif    
                                                        @else
                                                            <img src="/images/placeholder/download.png" class="img-fluid pt-1 pl-0 pb-18" alt="تصویر">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 pr-0">
                                                        <ul class="w-100 pr-0">
                                                            <li class="author-title text-right w-100 d-flex justify-content-between">
                                                                <span>
                                                                    {{ $article->user ? $article->user->first_name . ' ' . $article->user->last_name : 'کاربر حذف شده است'}} 
                                                                </span>
                                                                <span class="meta-date custom-font-size text-left" title="{{ \Morilog\Jalali\Jalalian::forge($article->created_at)->format('%H:i:s - %d %B %Y') }}"> 
                                                                    {{ \Morilog\Jalali\Jalalian::forge($article->created_at)->ago() }}
                                                                </span>
                                                            </li class="w-100">
                                                            <li class="author-title text-right">{{$article->user ? $article->user->email : "کاربر حذف شده است"}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.post author -->
                                        </div>
                                    </div>
                                </div>
                                <!--comments start-->
                                 {{-- <div class="comment-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div>
                                                <h4 class="comment-list-title widget-title">
                                                    <span class="meta-comments"> تعداد نظرات :
                                                        @foreach ($article->comments as $comment)
                                                            {{count($article->comments) + count($comment->replies)}}
                                                        @endforeach 
                                                    </span>    
                                                </h4>
                                                <ul class="comment-list list-unstyled">
                                                    @foreach ($article->comments as $comment)
                                                        @if ($comment->is_accept)
                                                            <li class="row">
                                                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                                                                    @if ($comment->user)
                                                                        @if ($comment->user->avatar)
                                                                            <img src="{{$comment->user->avatar}}" class="custom-style-img float-right pt-1 pl-0" alt="تصویر">
                                                                        @else
                                                                            <img src="/images/placeholder/download.png" class="img-fluid pt-1 pl-0" alt="تصویر">
                                                                        @endif
                                                                    @else
                                                                        <img src="/images/placeholder/download.png" class="img-fluid pt-1 pl-0" alt="تصویر">
                                                                    @endif
                                                                </div>
                                                                <div class=" col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 comment-info">
                                                                    <div class="comment-header">
                                                                        <h5 class="comment-title"> {{$comment->title}} </h5>
                                                                        <span class="meta-date custom-font-size text-left" title="{{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%H:i:s - %d %B %Y') }}"> 
                                                                            {{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->ago() }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="comment-content">
                                                                        <p> {{$comment->message}} </p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @foreach ($comment->replies as $reply)
                                                            <li class="row pr-5">
                                                                <div class="col-md-2">
                                                                    @if ($reply->user->avatar)
                                                                        <img src="{{$reply->user->avatar}}" class="custom-style-img float-right pt-1 pl-0 " alt="تصویر">
                                                                    @else
                                                                        <img src="/images/placeholder/download.png" class="img-fluid pt-1 pl-0"  alt="تصویر">
                                                                    @endif
                                                                </div>
                                                                <div class=" col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 comment-info">
                                                                    <div class="comment-header">
                                                                        <h5 class="comment-title"> {{$reply->title}} </h5>
                                                                        <span class="meta-date custom-font-size text-left" title="{{ \Morilog\Jalali\Jalalian::forge($reply->created_at)->format('%H:i:s - %d %B %Y') }}"> 
                                                                            {{ \Morilog\Jalali\Jalalian::forge($reply->created_at)->ago() }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="comment-content">
                                                                        <p> {{$reply->message}} </p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach    
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>  --}}
                                <!--comments close-->
                                {{-- @if (\auth::check())
                                    <div class="leave-comments">
                                        <h3 class="leave-comments-title">نظر خود را بنویسید</h3>
                                        <form action=" {{route('comment.store')}} " enctype="multipart/form-data" method="post">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group @if( $errors->has('title') ) has-error @endif">
                                                        <div class="form-group pt-5">
                                                            <label class="control-label sr-only"></label>عنوان پیام <span class="require">*</span>
                                                            <input type="text" name="title" class="form-control" placeholder="عنوان پیام " required>
                                                        </div>
                                                    </div>
                                                    @if( $errors->has('title') )
                                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group @if( $errors->has('message') ) has-error @endif">
                                                        <div class="form-group">
                                                            <label class="control-label sr-only"></label> پیام <span class="require">*</span>
                                                            <textarea class="form-control" name="message" rows="5" placeholder="متن پیام "></textarea>
                                                        </div>
                                                    </div>
                                                    @if( $errors->has('message') )
                                                        <span class="help-block">{{ $errors->first('message') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <button type="submit" class="btn btn-warning custom-btn-warning btn-icon right-icon mr-10 pull-left"><span>ارسال</span></button>
                                                    <input type="hidden" name="article_id" value="{{ $article->id }}" />
                                                </div>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.blog-single-section -->
@endsection