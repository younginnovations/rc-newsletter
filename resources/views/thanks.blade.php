<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscribe</title>
	<link href="{{url('css/style.css')}}" rel="stylesheet"/>
</head>
<body>
	<div class="msg thanks">
		<div class="msg__title">
			<h1><span>&#9786;</span>Thank you for subscribing!!!</h1>
		</div>
		<div class="msg__body">
			<p>Please check your email for confirmation.</p>
		</div>
		<div class="msg__footer">
			@if(!empty(env($subscriber->source)))
				<a href="{{env($subscriber->source)}}"><i class="fa fa-angle-left"></i>Return back</a>
			@else
				<a href="http://resourcecontracts.org"><i class="fa fa-angle-left"></i>Return back</a>
			@endif
		</div>
	</div>
</body>
</html>