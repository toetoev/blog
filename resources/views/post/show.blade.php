@extends('template')
@section('content')
<div class="col-lg-8">

	<!-- Title -->
	<h1 class="mt-4">{{$post->title}}</h1>

	<!-- Author -->
	<p class="lead">
		by
		<a href="#">{{$post->user->name}}</a>
	</p>

	<hr>

	<!-- Date/Time -->
	<p>Posted on {{$post->created_at->toDayDateTimeString()}}</p>

	@if(Auth::check() && Auth::user()->role == $post->user_id)
	<a href="{{route('post.edit', $post->id)}}" class="btn btn-warning d-inline-block float-left">Edit</a>
	<form method="post" action="{{route('post.destroy', $post->id)}}">
		@csrf
		@method('DELETE')
		<input type="submit" name="" class="btn btn-danger mx-2" value="Delete">
	</form>
	@endif
	<hr>

	<!-- Preview Image -->
	<img class="img-fluid rounded" src="{{asset($post->image)}}" alt="">
	<hr>

	<p>{!!$post->body!!}</p>

	<hr>

	<!-- Comments Form -->
	<div class="card my-4">
		<h5 class="card-header">Leave a Comment:</h5>
		<div class="card-body">
			<!-- @foreach($errors->all() as $error)
			<li class="text-danger">{{$error}}</li>
			@endforeach -->
			{{-- <form method="post" action="{{route('comment.store')}}">
				@csrf

				<div class="form-group">
					<textarea class="form-control" rows="3" name="comments"></textarea>
					<input type="hidden" name="postid" value="{{$post->id}}">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form> --}}
			
			<!-- comment upload by using ajax no page loading-->
			<div class="form-group">
				<input type="hidden" name="post_id" value="{{$post->id}}" id="post_id">

				<textarea class="form-control" rows="3" name="comment" id="comment"></textarea>

				<button type="button" class="btn btn-success mt-3" id="submit">Submit</button>
			</div>
		</div>
	</div>

	<!-- Comments with php-->
	{{--@foreach($post->comment as $comment)
		<div class="media mb-4">
			<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
			<div class="media-body">
				<h5 class="mt-0">
					{{$comment->user_id}}
				</h5>

				{{$comment->body}}
			</div>
		</div>
		@endforeach--}}

		<div id="showcomments">

		</div>
	</div>
	@endsection

	@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			//alert('ok');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			var post_id = $('#post_id').val();
			getComments(post_id);

			$('#submit').click(function(){

				var comment = $('#comment').val();

				$.post("{{route('comment.store')}}", {postid:post_id, comment:comment}, function(response){
					//alert('success');
					$('#comment').val('');
					getComments(post_id);
				})
			})

			function getComments(post_id){
				$.post("{{route('getcomments')}}",{post_id:post_id}, function(response){
					console.log(response);

					var html='';
					$.each(response, function(i,v){
						var body = v.body;
						var user_id = v.user_id;
						var username = v.name;
						var avatar = v.avatar;
						
						html += 
						'<div class="media mb-4">'+
							'<img class="d-flex mr-3 rounded-circle" src="'+avatar+'" alt="" width="70" height="70">'+
							'<div class="media-body">'+
								'<h5 class="mt-0">'+username+
								'</h5>'+body+
							'</div>'+
						'</div>';
					})
					$('#showcomments').html(html);
				})
			}
		})
	</script>
	@endsection