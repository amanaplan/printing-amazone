<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>admin login</title>

    <!-- WEB FONTS : use %7C instead of | (pipe) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="{{ asset('assets/backend/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/plugins/metis-menu/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/plugins/simple-line-icons-master/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/plugins/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/plugins/widget/widget.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/plugins/calendar/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/plugins/ui/jquery-ui.css') }}" rel="stylesheet">
    <!-- THEME CSS -->
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/theme/dark.css') }}" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
    <body class="account">
        <div class="container">
            <div class="row">
                <div class="account-col text-center">
                    <h1>Admin</h1>
                    <h3>Log into your account</h3>

                    @if(session('error'))
                    <div class="alert alert-danger"> <i class="fa fa-warning faa-flash animated"></i> Incorrect Email-Id / Password</div>
                    @endif

                    <form class="m-t" role="form" method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" spellcheck="false" placeholder="E-Mail Address" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="********" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group pull-left">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </div>

                        <button type="submit" class="btn btn-primary btn-block ">Login</button>
                        <a class="btn  btn-default btn-block" href="{{ route('password.request') }}">Forgot password?</a>

                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

</html>