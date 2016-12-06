@include('partials/head-admin')

	<h3 class="content__title">Published Contracts</h3>
	<section id="subscribed-user-list">
		<table class="table">
			<thead>
			<tr>
				<th>Id</th>
				<th>Contract Id</th>
				<th>Created Time</th>
				<th>Updated Time</th>
			</tr>
			</thead>
			<tbody>
			@foreach($published_contracts as $published_contract)
				<tr>
					<td>{{$published_contract->id}}</td>
					<td>{{$published_contract->contract_id}}</td>
					<td>{{$published_contract->created_at->format('Y-m-d')}}</td>
					<td>{{$published_contract->updated_at->format('Y-m-d')}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</section>

@include('partials/footer')