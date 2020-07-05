@extends('template') 
@section('content') <!--link with yield-->
<div class="col-md-8">

	<h1 class="my-4">
		<small>All Categories</small>
	</h1>

	<!-- Blog Post -->
	<div>
		<table class="table table-hover">
			<thead>
				<th>Category ID</th>
				<th>Category Name</th>
				<th colspan="2">Action</th>
			</thead>

			<tbody>
				@foreach($categories as $category)
				<tr>
					<input type="hidden" name="categoryid" value="{{$category->id}}">
					<td>{{$category->id}}</td>
					<td>{{$category->name}}</td>
					<td>
						<a href="{{route('category.edit', $category->id)}}" class="btn btn-warning">Edit</a>
					</td>
					<td>
						<form method="post" action="{{route('category.destroy', $category->id)}}">
							@csrf
							@method('DELETE')
							<input type="submit" name="" class="btn btn-danger" value="Delete">
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection