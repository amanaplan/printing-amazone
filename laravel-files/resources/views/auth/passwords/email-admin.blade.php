@extends('auth.passwords.adminlayout')

@section('contents')

<div class="container">
    <div id="passwordreset" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Admin Password Reset</div>
                <div class="switch-action"><a id="signinlink" href="{{ url('/admin') }}">Back</a></div>
            </div>  
            <div class="panel-body">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="signupform" class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-3 control-label">Registered Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email address">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <!-- Button -->                                        
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-warning">Send Password Reset Link</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div id="reset-msg">
                                We'll send you an email with a link to reset your password.
                            </div>
                        </div>
                    </div>    
                    
                </form>
            </div>
        </div>
     </div> 
</div>

@stop
