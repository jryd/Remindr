<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Hi James,</p>

<div>
    <p>
        I just wanted you to know that your remindr was set up correctly.
    </p>
    <p>
        To confirm your details:
    </p>
    <ul>
        <li>Title: {{ $title }}</li>
        <li>Date/Time: {{ $date->format('F d, Y h:ia') }}</li>
    </ul>
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