@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    set qty rule group 1 preset values
@stop

{{-- page specific css --}}
@push('styles')
    <link href="{{ asset('assets/backend/plugins/select/select.css') }}" type="text/css" rel="stylesheet">

@endpush

{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Quantity rules group- 1</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ url('/admin/product/manage') }}"></a>Manage products</li>
                        <li>quantity group 1 preset</li>
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
                            <a href="{{ url('/admin/product/presets/qty-rule-first/list/'.$product_id) }}" class="btn btn-info btn-rounded btn-xs">Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/product/presets/qty-rule-first/post/'.$product_id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('paperstock_option') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Select Paperstock Type</label>
                            <div class="col-sm-10">
                                <select name="paperstock_option" class="fancy-select form-control">
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

                        <label class="col-sm-2 control-label">Order Quantity</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('qty') ? ' has-error' : '' }}">
                            <input type="number" name="qty" min="1" class="form-control" value="{{ old('qty') }}"> 

                            @if ($errors->has('qty'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('qty') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label class="col-sm-2 control-label">Discount Rate</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('discount') ? ' has-error' : '' }}">
                            <span class="input-group-addon">%</span> 
                            <input type="text" name="discount" placeholder="e.x- 00.50" class="form-control" value="{{ old('discount') }}"> 

                            @if ($errors->has('discount'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/product/presets/qty-rule-first/list/'.$product_id) }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-success" type="submit">Save Changes</button>
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
    <script src="{{ asset('assets/backend/plugins/select/fancySelect.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom-advanced-form.js') }}"></script>

@endpush