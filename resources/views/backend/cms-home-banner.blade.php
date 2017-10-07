@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    manage banner contents
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
                    <h4 class="pull-left">Manage Contents</h4>
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
                    Enter details of Banner
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/cms/home/banner') }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('text_line_1') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Banner Text Line 1</label>
                            <div class="col-sm-10">
                                <input type="text" name="text_line_1" class="form-control" value="{{ $text1 }}">

                                @if ($errors->has('text_line_1'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('text_line_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('text_line_2') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Banner Text Line 2</label>
                            <div class="col-sm-10">
                                <textarea name="text_line_2" class="form-control">{{ $text2 }}</textarea>

                                @if ($errors->has('text_line_2'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('text_line_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('button1_text') || $errors->has('button1_url') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Button 1 Contents</label>
                            <div class="col-sm-3">
                                <input type="text" name="button1_text" placeholder="button text" class="form-control" value="{{ $btn1 }}">

                                @if ($errors->has('button1_text'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('button1_text') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-7">
                                <input type="text" name="button1_url" placeholder="button target url" class="form-control" value="{{ $url1 }}">

                                @if ($errors->has('button1_url'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('button1_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('button2_text') || $errors->has('button2_url') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Button 2 Contents</label>
                            <div class="col-sm-3">
                                <input type="text" name="button2_text" placeholder="button text" class="form-control" value="{{ $btn2 }}">

                                @if ($errors->has('button2_text'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('button2_text') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-7">
                                <input type="text" name="button2_url" placeholder="button target url" class="form-control" value="{{ $url2 }}">

                                @if ($errors->has('button2_url'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('button2_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
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
