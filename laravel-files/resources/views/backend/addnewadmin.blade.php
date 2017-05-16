@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    add a new admin
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
                    <h4 class="pull-left">Add new account</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>add account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-card margin-b-30">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Enter details of new admin
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu panel-dropdown" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('add.new.admin.request') }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Full name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email-Id</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                
                                @if ($errors->has('email'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('repassword') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Re-Enter Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="repassword">

                                @if ($errors->has('repassword'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('repassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('manage.admins') }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
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