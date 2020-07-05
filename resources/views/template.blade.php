<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Blog Home - Start Bootstrap Template</title>

	<!-- Bootstrap core CSS -->
	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="{{ asset('css/blog-home.css')}}" rel="stylesheet">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Start Bootstrap</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">

					@guest
					<li class="nav-item">
						<a class="nav-link" href="{{route('login')}}">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('register')}}">Register</a>
					</li>
					@else
					@if(Auth::check() && Auth::user()->role == 'author')
					<li class="nav-item">
						<a class="nav-link" href="{{route('post.create')}}">Upload Post</a>
					</li>
					@elseif(Auth::check() && Auth::user()->role == 'admin')
					<li class="nav-item">
						<a class="nav-link" href="{{route('category.index')}}">Category</a>
					</li>
					@endif

					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
							</a>
						
							<a href="{{route('profile.index')}}" class="dropdown-item">Profile</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>

<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<!--yield taking a balnk space/ content(name)-->
		@yield('content')  
		<!-- Sidebar Widgets Column -->
		<div class="col-md-4">

			<!-- Search Widget -->
			<div class="card my-4">
				<h5 class="card-header">Search</h5>
				<div class="card-body">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-secondary" type="button">Go!</button>
						</span>
					</div>
				</div>
			</div>

			<!-- Categories Widget -->
			<div class="card my-4">
				<h5 class="card-header">Categories</h5>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6">
							<ul class="list-unstyled mb-0">
								@foreach($categories as $category)
								<li>
									<a href="/post?category_id={{$category->id}}">{{$category->name}}</a>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Side Widget -->
			<div class="card my-4">
				<h5 class="card-header">Side Widget</h5>
				<div class="card-body">
					You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
				</div>
			</div>

		</div>

	</div>
	<!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
	<div class="container">
		<p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
	</div>
	<!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!--summmer note-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>


<script>
	$('#summernote').summernote({
		placeholder: 'Hello bootstrap 4',
		tabsize: 2,
		height: 100
	});
</script>

@yield('script')
</body>

</html>
