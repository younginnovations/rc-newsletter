<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribe</title>
    <link href="{{url('css/style.css')}}" rel="stylesheet"/>
</head>
<body>
<div class="msg thanks">
    <div class="msg__title msg__title--invalid">
       <h1><span>&#x2716;</span>Invalid Token!!!</h1>
    </div>
    <div class="msg__body">
        <p>Confirmation token is invalid or email is already confirmed or you are un-subscribed.</p>
    </div>
    <div class="msg__footer">
        <a href="{{env("APP_URL")}}">Goto <span> {{env("APP_URL")}} <i> &#x2192;</i></span></a>
    </div>
</div>
</body>
</html>