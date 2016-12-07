<!-- views/login.ejs -->
<!doctype html>
<html>
<head>
	<title>Subscription System: Login</title>
	<link href="{{url('css/style.css')}}" rel="stylesheet"/>
</head>
<body>
<div class="container">

	<div class="login">

		<h3 class="login__title"> Login</h3>
		@if(Session::has('error'))
			<div class="alert alert-danger">

				{{ Session::get('error') }}
			</div>
		@endif
		<form role="form" class="login__form" action="{{route('login.post')}}" method="post">
			<div class="form__group">
				<label>Email</label>
				<input type="text" name="email">
			</div>
			<div class="form__group">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button type="submit">Login</button>
		</form>
	</div>

</div>
</body>
</html>