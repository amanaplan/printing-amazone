@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    Manage Calendar Days
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
                    <h4 class="pull-left">Manage Calendar</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>Manage Orders</li>
                        <li>calendar</li>
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
                    Enter details of calendar
                    <div class="pull-right">
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/manage/calendar/save') }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('printing') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Time for printing completion (days)</label>
                            <div class="col-sm-10">
                                <input type="text" name="printing" placeholder="e.g. 4" class="form-control" value="{{ $printing }}">

                                @if ($errors->has('printing'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('printing') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('delivery') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Delivery Time span (days)</label>
                            <div class="col-sm-10">
                                <input type="text" name="delivery" placeholder="e.g. 5" class="form-control" value="{{ $delivery }}">

                                @if ($errors->has('delivery'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('delivery') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin') }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save Changes</button>
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
