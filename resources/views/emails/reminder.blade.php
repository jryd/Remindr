<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Hi {{ $name }},</p>

<div>
    <p>
        Remember that time you set a remindr so that you wouldn't forget something?
    </p>
    <p>
        Well here it is!
    </p>
    <p>
        The details of your remindr:
    </p>
    <ul>
        <li>Title: {{ $title }}</li>
        <li>Date/Time: {{ (new Carbon\Carbon($date))->format('F d, Y h:ia') }}</li>
        @if ($description != "" || $description != null)
		<li>Description:</li>
		<p>{!! nl2br(e($description)) !!}</p>
		@endif
    </ul>
    <p>
        Thanks,
        <br/>
        Your Friendly Remindr Robot
        <br>
        <a href="http://remindr.bannister.me">Remindr.</a>
    </p>
</div>
</body>
</html>
