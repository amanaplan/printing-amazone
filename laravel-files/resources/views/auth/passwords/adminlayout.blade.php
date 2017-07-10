<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="{{ asset( 'assets/images/fabicon.png' ) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style type="text/css">
        #passwordreset{margin-top:50px}
        .switch-action{float:right; font-size: 85%; position: relative; top:-10px}
        #reset-msg{border-top: 1px solid#888; padding-top:15px; font-size:85%}
    </style>
</head>
<body>

 
@yield('contents')


</body>
</html>
