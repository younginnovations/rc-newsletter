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
			<div style="font-size:14px;padding: 25px;background: #f2f2f2;">

				<p style="font-size:18px;margin-bottom: 10px;">Published contracts</p>
				@foreach($published_contracts as $published_contract)
					<div style="padding: 25px 25px 10px 25px;background: #fff;border: 1px solid #e5e5e5;border-radius: 3px;max-width: 650px;margin: 0 auto;">
						<p style="margin-top: 0;"><b>Contract Name:</b>
							{{$published_contract["metadata"]["contract_name"]}}</p>
						<p><b>Country:</b> {{ $published_contract["metadata"]["country"]["name"] }}</p>
						<p><b>Corporate Group:</b>
							@if(empty($published_contract["metadata"]["company"][0]["parent_company"]))
								Doesn't belong to any corporate group.
							@else
								{{ $published_contract["metadata"]["company"][0]["parent_company"] }}
							@endif
						</p>
						<p><b>Resource:</b> {{join(',', $published_contract["metadata"]["resource"])}}</p>
						<p><b>PDF URL:</b> {{$published_contract["metadata"]["file_url"]}}</p>
					</div>
				@endforeach
				<div style="text-align:center;padding: 15px 0px 0px 15px;font-size:13px;color:#888;">
					<p style="margin-bottom:5px;">sent by: Resource Contracts</p>
					<a href="#" style="color:#888;margin-right: 7px;">settings</a>
					<a href="#" style="color:#888;">unsubscribe</a>
				</div>
			</div>
		</td>
	</tr>
</table>

</body>
</html>