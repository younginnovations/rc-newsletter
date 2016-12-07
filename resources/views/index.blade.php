<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscribe</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"> <!-- load bootstrap css -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
			<input type="text" name="email" class="form__field form__field block no-border" placeholder="Enter your email address"/>
		</div>
		<div class="form__group selectCountry">
			<label class="form__label form__label block">Subscribe to country</label>

			<select class="form__field block no-border custom_select" name="country[]" multiple>
				@foreach ($countries as $key => $value)
					<option value="{{$key}}"> {{$value}}</option>
				@endforeach
			</select>
			<div class="all">
				<span class="or">or</span>
				<label><input type="checkbox"> All</label>
			</div>
		</div>
		<div class="form__group no-margin-bottom">
			<label class="form__label form__label block">Subscribe to corporate group</label>
			<select class="form__field block no-border custom_select"  name="corporate_group[]" multiple>
				@foreach ($groups as $group)
					<option value="{{$group}}"> {{$group}}</option>
				@endforeach
			<select>
		</div>

	</div>
	<div class="form__footer text-center">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="source" value="rc">
		<button class="form__btn no-border">SUBSCRIBE</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('.custom_select').select2();

		$(".selectCountry select").on("change", function(){
			console.log($(this).val());
			if($(this).val().length > 0) {
				$(".selectCountry input[type='checkbox']").attr('disabled', true).trigger("change");
			}
			else{
				$(".selectCountry input[type='checkbox']").attr('disabled', false).trigger("change");
			}
		})

		$(".selectCountry input").on("click", function(){
			if($(this).is(":checked")){
				$(".selectCountry select").attr("disabled", true).trigger("change")
			}else{
				$(".selectCountry select").attr("disabled", false).trigger("change")
			}
		})
	});
</script>
</body>
</html>