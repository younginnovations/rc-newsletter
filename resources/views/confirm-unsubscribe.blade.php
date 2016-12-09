<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unsubscribe</title>
    <link href="{{url('css/style.css')}}" rel="stylesheet"/>
</head>
<body>
<div class="msg thanks">
    <div class="msg__title">
        <h1>Confirm un-subscription!</h1>
    </div>
    <div class="msg__body">
        <p>Are you sure you want to un-subscribe?</p>
        <div class="msg__actions">
            <a href="{{route('unsubscribe', [ 'email' => $email, 'token' => $token])}}" class="yes">Yes</a>
            <a href="http://resourcecontracts.org">No</a>
        </div>
    </div>
</div>
</body>
</html>