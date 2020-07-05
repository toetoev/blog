@extends('template')
@section('content')
<div class="col-md-8">

	<h1 class="my-4">
		<small>Post Form</small>
	</h1>
	
	<!-- Action -> Call route name form route list -->
	<form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-row">
			<div class="form-group col-md-12 {{ $errors->has('email') ? ' has-error' : '' }}">

				@if ($errors->has('email'))
                <li class="text-danger">{{$errors}}</li>
                @endif
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" placeholder="Title" name="title">
			</div>

			<div class="form-group col-md-12">
				<label for="photo">Photo</label>
				<input type="file" class="form-control-file" id="photo" name="photo">
			</div>

			<div class="form-group col-md-12">
				<label for="category">Category</label>
				<select id="category" name="category" class="custom-select mr-sm-2">
					<option selected>Choose Category</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}">
							{{$category->name}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-12">
				<label for="summernote">Body</label>
    			<textarea class="form-control" id="summernote" rows="3" name="body"></textarea>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Save</button>
	</form>
</div>
@endsection