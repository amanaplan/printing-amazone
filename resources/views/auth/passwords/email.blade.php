@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Forgot Password | {{ config('app.name') }}</title>

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
        <div class="row">
            
            <div class="col-md-12 col-sm-12">
                <div id="passwordreset" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info" style="margin-bottom: 20%;">
                        <div class="panel-heading">
                            <div class="panel-title">Forgot Password</div>
                        </div>  
                        <div class="panel-body">

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form id="signupform" class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-3 control-label">Registered Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email address that you used to register" autofocus required>
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
                                        <button id="btn-signup" type="submit" class="btn btn-primary">Send Password Reset Link</button>
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
            
            <div class="clearfix"></div>
        </div>
    </div><!-- container -->
</div><!-- dashboard-area -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

@endpush
