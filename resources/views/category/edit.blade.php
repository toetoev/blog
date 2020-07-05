@extends('template')
@section('content')
<div class="col-md-8">

	<h1 class="my-4">
		<small>Category Form</small>
	</h1>
	@foreach($errors->all() as $error)
		<li class="text-danger">{{$error}}</li>
	@endforeach

	<form method="post" action="{{route('category.update', $category->id)}}">
		@csrf
		@method('PUT')
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" value="{{$category->name}}" name="name">
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Save</button>
	</form>
</div>
@endsection