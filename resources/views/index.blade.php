<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscribe</title>
	<link href="{{url('css/style.css')}}" rel="stylesheet"/>
</head>
<body>
<form class="form form--subscription" role="form" action="{{route('login.post')}}" method="post">
	<div class="form__heading">
		<span>Subscription Details</span>
	</div>
	<div class="form__body">
		<div class="form__group">
			<label class="form__label form__label block">Email</label>
			<input type="text" class="form__field form__field block no-border" placeholder="Enter your email address"/>
		</div>
		<div class="form__group">
			<label class="form__label form__label block">Subscribe to</label>
			<select class="form__field block no-border" >
				@foreach ($countries as $key => $value)
					<option value="{{$key}}"> {{$value}}</option>
				@endforeach
			<select>
		</div>
		<div class="form__group no-margin-bottom">
			<label class="form__label form__label block">Subscribe to</label>
			<select class="form__field block no-border" >
				@foreach ($corporate_groups as $corporate_group)
					<option value="{{$corporate_group}}"> {{$corporate_group}}</option>
				@endforeach
			<select>
		</div>
	</div>
	<div class="form__footer text-center">
		<button class="form__btn btn-default no-border">SUBSCRIBE</button>
	</div>
</form>
</body>
</html>