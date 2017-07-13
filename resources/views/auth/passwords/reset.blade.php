@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Reset Password | {{ config('app.name') }}</title>

@stop

{{-- page specific styles --}}
@push( 'styles' )
    @include('layouts.frontend.userpanel-styles')
    <style type="text/css">
        #passwordreset{margin-top:50px}
        #reset-msg{border-top: 1px solid#888; padding-top:15px; font-size:85%}
        .panel-info>.panel-heading {
            color: #ffffff;
            background-color: #eaa000;
            border-color: #e18e00;
        }
        .panel-title{font-size: 18px;}

    </style>
@endpush

{{-- main page contents --}}
@section('contents')

<div class="dashboard-area">
    <div class="container">
        <div class="row dasboard">
            
            <div class="col-md-12 col-sm-12">
                <div id="passwordreset" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info" style="margin-bottom: 20%;">
                        <div class="panel-heading">
                            <div class="panel-title">Password Reset</div>
                        </div>  
                        <div class="panel-body">

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-3 control-label">Registered email</label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" class="form-control" placeholder="Please input your email used to register with us" name="email" value="{{ $email or old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-3 control-label">New password</label>

                                    <div class="col-md-9">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="create your new password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>
                                    <div class="col-md-9">
                                        <input id="password-confirm" type="password" class="form-control" placeholder="confirm your new password" name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-success">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="clearfix"></div>
        </div>
    </div><!-- container -->
</div><!-- dashboard-area -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

@endpush