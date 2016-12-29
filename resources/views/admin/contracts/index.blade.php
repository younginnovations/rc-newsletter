@include('partials/head-admin')

	<h3 class="content__title">Contracts</h3>
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
			@foreach($contracts as $contract)
				<tr>
					<td>{{$contract->contract_id}}</td>
					<td>
						@if($contract->metadata->category[0] == "rc")
							<a href="http://www.resourcecontracts
							.org/contract/{{$contract->metadata->open_contracting_id}}">{{$contract->metadata
							->contract_name}}</a>
						@elseif($contract->metadata->category[0] == "olc")
							<a href="http://www.openlandcontracts
							.org/contract/{{$contract->metadata->open_contracting_id}}">{{$contract->metadata
							->contract_name}}</a>
						@else
							{{$contract->metadata->contract_name}}
						@endif
					</td>
					<td>{{$contract->metadata->country->name}}</td>
					<td>{{join(', ', $contract->metadata->resource)}}</td>
					<td>{{$contract->created_at->format('Y-m-d')}}</td>
					<td>
						@if(is_null($contract->sent_email_date))
							-
						@else
							{{$contract->sent_email_date}}
						@endif
					</td>
					<td>{!! $contract->sent_email() !!}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div class="pagination"> {{ $contracts->links() }} </div>
	</section>

@include('partials/footer')