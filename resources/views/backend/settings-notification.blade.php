@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    notifications setting
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
                    <h4 class="pull-left">Notification setting</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
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
                    Enter Email Id(s) separated by comma (,)

                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/settings/notification/save') }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">New Order Notification</label>
                            <div class="col-sm-10">
                                <textarea name="order" class="form-control" spellcheck="false">{{ $order }}</textarea>

                                @if ($errors->has('order'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('review') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">New Review Posted</label>
                            <div class="col-sm-10">
                                <textarea name="review" class="form-control" spellcheck="false">{{ $review }}</textarea>

                                @if ($errors->has('review'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('review') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('contact') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Contact Page Form Submit</label>
                            <div class="col-sm-10">
                                <textarea name="contact" class="form-control" spellcheck="false">{{ $contact }}</textarea>

                                @if ($errors->has('contact'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save Settings</button>
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
