@include('partials/head-admin')
	<h3 class="content__title"> Subscribed Users</h3>
	<section id="subscribed-user-list">
		<table class="table table-bordered table-striped table-condensed">
			<thead>
			<tr>
				<th>Id</th>
				<th>Email</th>
				<th>Country</th>
				<th>Corporate Group</th>
				<th>Source</th>
				<th>Status</th>
				<th>Created Time</th>
				<th>Updated Time</th>
			</tr>
			</thead>
			<tbody>
			@foreach($subscribers as $subscriber)
				<tr>
					<td>{{$subscriber->id}}</td>
					<td>{{$subscriber->email}}</td>
					<td>{{join(',', $subscriber->country())}}</td>
					<td>{{join(',', $subscriber->group->corporate_group)}}</td>
					<td>{{$subscriber->source()}}</td>
					<td>{{$subscriber->status}}</td>
					<td>{{$subscriber->created_at->format('Y-m-d')}}</td>
					<td>{{$subscriber->updated_at->format('Y-m-d')}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</section>

@include('partials/footer')
