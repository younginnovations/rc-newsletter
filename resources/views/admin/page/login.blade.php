<!-- views/login.ejs -->
<!doctype html>
<html>
<head>
	<title>Subscription System: Login</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"> <!-- load bootstrap css -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
	<link href="{{url('css/style.css')}}" rel="stylesheet"/>
	<style>
		body        { padding-top:80px; }
	</style>
</head>
<body>
<div class="container">

	<div class="col-sm-6 col-sm-offset-3">

		<h1><span class="fa fa-sign-in"></span> Login</h1>

		<form role="form" action="{{route('login.post')}}" method="post">
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password">
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button type="submit" class="btn btn-warning btn-lg">Login</button>
		</form>
	<hr>
	</div>

</div>
</body>
</html>