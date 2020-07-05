@extends('template')
@section('content')
<div class="col-md-8">

	<h1 class="my-4">
		<small>Update Profile</small>
	</h1>
	@foreach($errors->all() as $error)
	<li class="text-danger">{{$error}}</li>
	@endforeach

	<form method="post" action="{{route('profile.update', Auth::user()->id)}}" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" name="name">
			</div>

			<div class="form-group col-md-12">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}" name="email">
			</div>

			<div class="form-group col-md-12">
				<label for="photo">Photo</label>
				<input type="file" class="form-control-file" id="photo" name="photo">
				<img src="{{ Auth::user()->avatar }}" width="100" height="60" class="img-fluid mt-3">
				<input type="hidden" name="oldimg" value="{{ Auth::user()->avatar }}">
			</div>
			<div class="form-check col-md-12 mx-3">
				<input type="checkbox" class="form-check-input" id="checkpw">
				<input type="hidden" class="form-control" id="password" name="oldpassword" value="{{ Auth::user()->password }}" >

				<label for="checkpw" class="form-check-label">Change Password</label>	
			</div>
			<div id ="pw" class="form-group col-md-6">
				<label for="pw"  class="form-check-label">New Password</label>
				<input type="password" class="form-control" id="pw" name="password" >
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Save</button>
	</form>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$("#pw").hide();
		$('input[type="checkbox"]').click(function(){
                $("#pw").show();
        });   
	})
</script>
@endsection