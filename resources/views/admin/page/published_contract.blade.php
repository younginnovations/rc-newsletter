@include('partials/head-admin')

	<h3 class="content__title">Published Contracts</h3>
	<section id="subscribed-user-list">
		<table class="table table-bordered table-striped table-condensed">
			<thead>
			<tr>
				<th>Contract Id</th>
				<th>Contract Name</th>
				<th>Country</th>
				<th>Resources</th>
				<th>Published Date</th>
				<th>Email Sent Date</th>
				<th>Sent Email</th>
			</tr>
			</thead>
			<tbody>
			@foreach($published_contracts as $published_contract)
				<tr>
					<td>{{$published_contract->contract_id}}</td>
					<td>{{$published_contract->metadata->contract_name}}</td>
					<td>{{$published_contract->metadata->country->name}}</td>
					<td>{{join(', ', $published_contract->metadata->resource)}}</td>
					<td>{{$published_contract->created_at->format('Y-m-d')}}</td>
					<td>
						@if(is_null($published_contract->sent_email_date))
							-
						@else
							{{$published_contract->sent_email_date}}
						@endif
					</td>
					<td>{!! $published_contract->sent_email() !!}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</section>

@include('partials/footer')