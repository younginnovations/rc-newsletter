@include('partials/head-admin')

<h3 class="content__title"> Settings</h3>
<section id="subscribed-user-list">
	<form class="form form--subscription" role="form" action="{{route('admin.settings.post')}}" method="post">
		<div class="form__body">
			@if(Session::has('success'))
				<div style="color: #4F8A10; background-color: #DFF2BF; padding: 20px;">
					{{ Session::get('success') }}
				</div>
			@endif
			<br/>
			@foreach($settings as $setting)
				<div class="form__group">
					<label class="form__label form__label block">{{ucfirst($setting->key)}}</label>
					<input type="text" name="{{$setting->key}}" class="form__field form__field block no-border" value="{{$setting->value}}"/>
				</div>
			@endforeach
		</div>
		<div class="form__footer text-center">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button class="form__btn btn-default no-border">SAVE</button>
		</div>
	</form>
</section>

@include('partials/footer')
