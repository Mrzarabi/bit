<div class="row" style="display: flex; justify-content: center;">
	<div class="col-sm-3">
		<img src="/images/download.jpg" alt="تصویر" style="min-width: 220px; max-height: 200px; border-radius:7px">
	</div>
	<div class="col-sm-3" style="text-align: center;">
		<h3>{{$article->title}}</h3>
		<p style="margin-top:10px; text-align: justify;">{{ $article->description }}</p>
	</div>
</div>
<hr class="light-grey-hr"/>
<div class="row" style="display: flex; justify-content: center;">
	<div class="col-md-12" style="width: 100%">
		<ul>
			@foreach ($article->comments as $comment)
				<li style="margin-top:10px;">
					<div class="row">
						<div class="col-2">
							<img src="/images/download.jpg" alt="تصویر" style="max-width: 50px; border-radius: 50%; ">
							<span style="float:left; padding:top:-20px;"> {{$comment->user->first_name}} {{ $comment->user->last_name }}  </span>
						</div>

						
						<div class="col-7">
							<p>{{$comment->message}}</p>														
						</div>

						<div class="pull-left col-3" style="margin-top:-50px;">
							{{-- <div class="btn btn-xs btn-class"> --}}
							<form action="{{route('comment.destroy', ['comment' =>$comment->id])}}" method="POST">
								<a href="" class="font-18 txt-grey mr-10 pull-left"><i class="icon ti-pencil"></i></a>
								<a href="" class="font-18 txt-grey mr-10 pull-left"><i class="icon ti-plus"></i></a>
								<button type="submit" itemid="{{ $comment->id }}" class="font-18 txt-grey pull-left delete-item"><i class="icon ti-close"></i></button>
								@method('delete')
								@csrf
							</form>
								{{-- <button type="submit" class="btn btn-danger">
										<i class="far fa-trash-alt"></i></button> --}}
							{{-- </div> --}}
							{{$comment->created_at}}
						</div>
					</div>
				</li>
					<div class="row p-4">
						<div class="col-md-10">
							<ul>
								@foreach ($comment->replies as $reply)
									<li style="margin-top:10px;">
										<div class="row">
											<div class="col-md-1">
												<img src="/images/download.jpg" alt="تصویر" style="max-width: 50px; border-radius: 50%;">
											</div>
											<span style=""> {{$reply->user->first_name}} {{ $reply->user->last_name }}  </span>
										</div>
										<div class="col-md-8">
											<p>{{$reply->message}}</p>														
										</div>
									</li>
									@if (! $loop->last)
										<hr class="light-grey-hr"/>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
				
				@if (! $loop->last)
					<hr class="light-grey-hr"/>
				@endif
			@endforeach
		</ul>
	</div>
</div>