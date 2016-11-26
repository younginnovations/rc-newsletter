<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscribe</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"> <!-- load bootstrap css -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
	<link href="{{url('css/style.css')}}" rel="stylesheet"/>
</head>
<body>
<form class="form form--subscription" role="form" action="{{route('subscribe')}}" method="post">
	<div class="form__heading">
		<span>Subscription Details</span>
	</div>
	<div class="form__body">
		@if(Session::has('message'))
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
				</button>
				{{ Session::get('message') }}
			</div>
		@endif
		<div class="form__group">
			<label class="form__label form__label block">Email</label>
			<input type="text" name="email" class="form__field form__field block no-border" placeholder="Enter your
			email
			address"/>
		</div>
		<div class="form__group">
			<label class="form__label form__label block">Subscribe to</label>
			<select class="form__field block no-border" name="country">
				@foreach ($countries as $key => $value)
					<option value="{{$key}}"> {{$value}}</option>
				@endforeach
			<select>
		</div>
		<div class="form__group no-margin-bottom">
			<label class="form__label form__label block">Subscribe to</label>
			<select class="form__field block no-border" name="corporate_group">
				@foreach ($corporate_groups as $corporate_group)
					<option value="{{$corporate_group}}"> {{$corporate_group}}</option>
				@endforeach
			<select>
		</div>
	</div>
	<div class="form__footer text-center">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button class="form__btn btn-default no-border">SUBSCRIBE</button>
	</div>
</form>
</body>
</html>