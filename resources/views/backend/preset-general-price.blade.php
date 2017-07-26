@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    set general preset values
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
                    <h4 class="pull-left">General Preset data</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ url('/admin/product/manage') }}"></a>Manage products</li>
                        <li>general preset</li>
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
                    Enter Preset Details For <span class="label label-warning">{{ $product_name }}</span>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/presets/'.$product_id) }}" class="btn btn-info btn-rounded btn-xs">Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('paperstock_option') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Select Paperstock Type</label>
                            <div class="col-sm-10">
                                <select name="paperstock_option" class="form-control">
                                    <option value="">--select the paperstock option of this product--</option>
                                    @foreach($options as $option)
                                    <option value="{{$option->id}}" {{ (old('paperstock_option'))? (old('paperstock_option') == $option->id)? 'selected' : '' : '' }} > {{ $option->option }} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('paperstock_option'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('paperstock_option') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('from') || $errors->has('to')) ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Dimenssion (mm<sup>2</sup>)</label>
                            <div class="col-sm-4">
                                <input type="text" name="from" class="form-control" placeholder="from dimenssion in mm2" value="{{ old('from') }}">

                                @if ($errors->has('from'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label class="col-sm-2 control-label">To Dimenssion</label>
                            <div class="col-sm-4">
                                <input type="text" name="to" class="form-control" placeholder="to dimenssion in mm2" value="{{ old('to') }}">

                                @if ($errors->has('to'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('to') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('page_title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <textarea name="page_title" class="form-control">{{ old('page_title') }}</textarea>

                                @if ($errors->has('page_title'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/product/presets/'.$product_id) }}" class="btn btn-white">Cancel</a>
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