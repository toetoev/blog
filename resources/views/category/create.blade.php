@extends('template')
@section('content')
<div class="col-md-8">

	<h1 class="my-4">
		<small>Category Form</small>
	</h1>
	@foreach($errors->all() as $error)
		<li class="text-danger">{{$error}}</li>
	@endforeach
	<!-- Action -> Call route name form route list -->
	<form action="{{route('category.store')}}" method="post">
		@csrf
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" placeholder="Name" name="name">
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Save</button>
	</form>
</div>
@endsection