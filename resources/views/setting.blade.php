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
<form class="form form--subscription" role="form" action="{{route('setting.post')}}" method="post">
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
		<div class="form__group selectWrapper">
			<label class="form__label form__label block">Subscribe to country</label>
			<select class="form__field block no-border custom_select" name="country[]" multiple>
				@foreach ($countries as $key => $value)
					<option value="{{$key}}"> {{$value}}</option>
				@endforeach
			<select>
			<div class="all">
				<span class="or">or</span>
				<label><input type="checkbox" name="all_country"> All</label>
			</div>
		</div>
		<div class="form__group selectWrapper no-margin-bottom">
			<label class="form__label form__label block">Subscribe to corporate group</label>
			<select class="form__field block no-border custom_select"  name="corporate_group[]" multiple>
				@foreach ($groups as $group)
					<option value="{{$group}}"> {{$group}}</option>
				@endforeach
			<select>
			<div class="all">
				<span class="or">or</span>
				<label><input type="checkbox" name="all_corporate_group"> All</label>
			</div>
		</div>

	</div>
	<div class="form__footer text-center">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="source" value="rc">
		<input type="hidden" name="email" value="{{$email}}"/>
		<input type="hidden" name="token" value="{{$token}}"/>
		<button class="form__btn btn-default no-border">SAVE</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('.custom_select').select2();

		$(".selectWrapper select").on("change", function(){
			console.log($(this).val());
			if($(this).val().length > 0) {
				$(this).parents(".selectWrapper").find("input[type='checkbox']").attr('disabled', true).trigger("change");
			}
			else{
				$(this).parents(".selectWrapper").find("input[type='checkbox']").attr('disabled', false).trigger("change");
			}
		})

		$(".selectWrapper input").on("click", function(){
			if($(this).is(":checked")){
				$(this).parents(".selectWrapper").find("select").attr("disabled", true).trigger("change")
			}else{
				$(this).parents(".selectWrapper").find("select").attr("disabled", false).trigger("change")
			}
		})
	});
</script>
</body>
</html>