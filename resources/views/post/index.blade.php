@extends('template') 
@section('content') <!--link with yield-->
<div class="col-md-8">

	<h1 class="my-4">
		<small>All Posts</small>
	</h1>

	<!-- Blog Post -->
	@foreach($posts as $post)
	<div class="card mb-4">
		<!-- Set asset cause of file path -->
		
		<div class="card-body">
			<h2 class="card-title">{{$post->title}}</h2>
			<p class="card-text">{!!$post->body!!}</p> <!-- !!run HTML tag when using text editer -->
			<!-- post.show route name, {} par loz id set-->
			<a href="{{route('post.show', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
		</div>
		<div class="card-footer text-muted">
			Posted on January 1, 2017 by
			<a href="#">{{$post->user_id}}</a>
			<a href="#" class="float-right">{{$post->category->name}}</a>
		</div>
	</div>
	@endforeach

	<!-- Pagination -->
	<ul class="pagination justify-content-center mb-4">
		<li class="page-item">
			<a class="page-link" href="#">&larr; Older</a>
		</li>
		<li class="page-item disabled">
			<a class="page-link" href="#">Newer &rarr;</a>
		</li>
	</ul>

</div>
@endsection