<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.head')
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('includes.nav')
				
				@yield('content')
				
			</div>	
		</div>



	</div>
	@include('includes.footer')
</body>

</html>