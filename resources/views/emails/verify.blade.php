<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Hi {{ $firstname }},</p>

<div>
    <p>
        Thanks for creating an account with us at Remindr!
    </p>
    <p>
        We just need you to confirm your email address for us, it's dead simple - just click <a href="{{ url('register/verify/' . $confirmation_code) }}">here</a>.
    </p>
    <p>
        Thanks,
        <br/>
        Your Friendly Mail Remindr Robot
        <br>
        <a href="http://remindr.bannister.me">http://remindr.bannister.me</a>
    </p>
</div>
</body>
</html>