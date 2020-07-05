@extends('template')
@section('content')
<div class="col-md-8">

	<h1 class="my-4">
		<small>Post Form</small>
	</h1>
	@foreach($errors->all() as $error)
		<li class="text-danger">{{$error}}</li>
	@endforeach

	<form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" value="{{$post->title}}" name="title">
			</div>

			<div class="form-group col-md-12">
				<label for="photo">Photo</label>
				<input type="file" class="form-control-file" id="photo" name="photo">
				<img src="{{asset($post->image)}}" width="150" height="100" class="img-fluid mt-3">
				<input type="hidden" name="oldimg" value="{{asset($post->image)}}">
			</div>

			<div class="form-group col-md-12">
				<label for="category">Category</label>
				<select id="category" name="category" class="custom-select mr-sm-2">
					@foreach($categories as $category)
						<option value="{{$category->id}}" 
							<?php if ($post->category_id == $category->id): ?>
							selected
							<?php endif; ?>>
							{{$category->name}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-12">
				<label for="summernote">Body</label>
    			<textarea class="form-control" id="summernote" rows="3" name="body">{{$post->body}}</textarea>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Save</button>
	</form>
</div>
@endsection