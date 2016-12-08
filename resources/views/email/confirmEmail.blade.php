<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscription Email</title>
</head>
<body>

<table style="font-family: arial;max-width: 650px;margin: 0 auto;color:#333;border-collapse:collapse;border:0">
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
				<div style="padding: 25px 25px 10px 25px;background: #fff;border: 1px solid #e5e5e5;border-radius: 3px;max-width: 650px;margin: 0 auto;">
					<p>Hi {{$email}},</p>
					<p>This is a confirmation email from subsite.</p>

					<a href="{{route('confirm', [ 'email' => $email, 'token' => $token])}}" target="" style="font-size:14px;color:#fff;background: #28a6ff;display:inline-block;padding: 10px 15px;text-decoration:none;border-radius:5px;margin-top: 7px;">Click to confirm your email.</a>
					<p>Please, do not reply!</p>
				</div>
				<div style="text-align:center;padding: 15px 0px 0px 15px;font-size:13px;color:#888;">
					<p style="margin-bottom:5px;">sent by: <a href="#" style="font-size:13px;color:#888;">Resource Contracts</a></p>
				</div>
			</div>
		</td>
	</tr>
</table>

</body>
</html>