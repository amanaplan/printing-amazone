@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    Manage Profile
@stop

{{-- page specific css --}}
@push('styles')
@endpush
{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Manage Profile Info</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-card margin-b-30">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Personal Information
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.profile.update') }}" method="post">

                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label> 
                            <input type="text" placeholder="Enter name" name="name" class="form-control" value="{{ Auth::user()->name }}">
                            
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email</label> 
                            <input type="email" placeholder="Enter email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Profile Picture</label> 
                                    <input type="text" id="the_img_fld-1" name="pic" placeholder="full file name" class="form-control" value="{{ Auth::user()->profile_pic }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-primary pull-left fileSelector" elem-id="1" type="button" style="margin-top: 30px;">select file</button>
                            </div>
                        </div>

                        <div class="row text-center">
                            <img id="picture_prvw-1" class="img-circle" width="150" src="{{ (Auth::user()->profile_pic)? asset('assets/images/profile').'/'.Auth::user()->profile_pic : asset('assets/images').'/user.png' }}" />
                        </div>
                        
                        <div>
                            <button class="btn btn-success pull-left" type="submit"><strong>Save Changes</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-card margin-b-30">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Change Password
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('admin.profile.password') }}" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT">

                        @if(session('err_curr_password'))
                            <div class="alert alert-warning text-center"><strong>incorrect current password provided</strong></div>
                        @endif

                        <div class="form-group {{ $errors->has('curr_password') ? ' has-error' : '' }}">
                            <label class="col-lg-2 control-label">Current Password</label>
                            <div class="col-lg-10">
                                <input type="password" name="curr_password" placeholder="********" class="form-control"> 

                                @if ($errors->has('curr_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('curr_password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('newpassword') ? ' has-error' : '' }}">
                            <label class="col-lg-2 control-label">New Password</label>
                            <div class="col-lg-10">
                                <input type="password" name="newpassword" placeholder="********" class="form-control"> 

                                @if ($errors->has('newpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('repassword') ? ' has-error' : '' }}">
                            <label class="col-lg-2 control-label">Re-Type Password</label>
                            <div class="col-lg-10">
                                <input type="password" name="repassword" placeholder="********" class="form-control"> 

                                @if ($errors->has('repassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('repassword') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-info" type="submit">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@stop
{{-- page specific js --}}
@push('scripts')
@endpush