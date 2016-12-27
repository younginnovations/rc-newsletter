<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscription Email</title>
</head>
<body>

<table style="font-family: arial;width: 100%;margin: 0 auto;color:#333;border-collapse:collapse;border:0">
	<tr>
		<td style="border:0;padding:0;">
			<div style="background: #555;padding: 35px;color:#fff;">
				<h2 style="margin: 0;">Resource Contracts</h2>
			</div>
		</td>
	</tr>
	<tr>
		<td style="border:0;padding:0;">
			<div style="font-size:14px;padding: 25px;background: #f2f2f2;color:#333;">
        		<p style="font-size:18px;max-width: 650px;margin: 0 auto 15px auto;">Published contracts</p>

				@foreach($published_contracts as $published_contract)
				<table style="padding: 25px;background: #fff;border: 1px solid #e5e5e5;border-radius: 4px;max-width: 650px;margin: 0 auto;">
					<tbody style="padding: 25px 25px 10px 25px;background: #fff;">
						<tr>
							<td colspan="2">
								<p style="margin-top:0;margin-bottom:25px;"><b>{{$published_contract["metadata"]["contract_name"]}}</b></p>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<p><b>Country:</b> {{ $published_contract["metadata"]["country"]["name"] }}</p>
							</td>
							<td width="50%">
								<p><b>Resource:</b> {{join(',', $published_contract["metadata"]["resource"])}}</p>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<p><b>Corporate Group:</b>
									@if(empty($published_contract["metadata"]["company"][0]["parent_company"]))
										Doesn't belong to any corporate group.
									@else
										{{ $published_contract["metadata"]["company"][0]["parent_company"] }}
									@endif
								</p>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="http://www.resourcecontracts.org/contract/{{$published_contract["metadata"]["open_contracting_id"]}}" target="_blank" style="color:#03A9F4;text-decoration:none; margin-right:15px;padding:10px 15px;background:#646464;color:#fff;border-radius:4px;">View Contract<i> &#x2192;</i></a>
								<a href='{{$published_contract["metadata"]["file_url"]}}' target="_blank" style="color:#03A9F4;text-decoration:none;padding:10px 15px;background:#646464;color:#fff;border-radius:4px;">View PDF<i> &#x2192;</i></a>
							</td>
						</tr>
					</tbody>
				</table>
				@endforeach
				<div style="text-align:center;padding: 15px 0px 0px 15px;font-size:13px;color:#888;">
					<p style="margin-bottom:5px;">sent by: Resource Contracts</p>
					<a href="{{route('setting', [ 'email' => $email, 'token' => $token])}}" style="color:#888;margin-right: 7px;">settings</a>
					<a href="{{route('confirm-unsubscribe', [ 'email' => $email, 'token' => $token])}}" style="color:#888;">unsubscribe</a>
				</div>
			</div>
		</td>
	</tr>
</table>

</body>
</html>