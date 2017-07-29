@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    update qty rule group 2 preset
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
                    <h4 class="pull-left">Quantity rules group- 2  <code>% discount rate applies every extra {qty} from {qty} to {qty}</code></h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ url('/admin/product/manage') }}"></a>Manage products</li>
                        <li>quantity group 2 preset</li>
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
                    Update Preset Details</span>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/presets/qty-rule-sec/list/'.$product_id) }}" class="btn btn-info btn-rounded btn-xs">Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/product/presets/qty-rule-sec/edit-rq/'.$preset_id.'/'.$product_id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Paperstock Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="readonly" value="{{ $option }}">
                            </div>
                        </div>

                        <label class="col-sm-2 control-label">From Order Qty.</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('from') ? ' has-error' : '' }}">
                            <input type="number" name="from" min="1" class="form-control" value="{{ $preset->from }}"> 

                            @if ($errors->has('from'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('from') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label class="col-sm-2 control-label">To Order Qty.</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('to') ? ' has-error' : '' }}">
                            <input type="number" name="to" min="1" class="form-control" value="{{ $preset->to }}"> 

                            @if ($errors->has('to'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('to') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label class="col-sm-2 control-label">Every Extra Order Qty.</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('extra') ? ' has-error' : '' }}">
                            <input type="number" name="extra" min="1" class="form-control" value="{{ $preset->every_extra_qty }}"> 

                            @if ($errors->has('extra'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('extra') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label class="col-sm-2 control-label">Discount Rate</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('discount') ? ' has-error' : '' }}">
                            <span class="input-group-addon">%</span> 
                            <input type="text" name="discount" placeholder="e.x- 00.50" class="form-control" value="{{ $preset->disc_rate }}"> 

                            @if ($errors->has('discount'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/product/presets/qty-rule-sec/list/'.$product_id) }}" class="btn btn-white">Cancel</a>
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

    <script>
        $(document).ready(function(){
            $("input:radio").change(function(){
                if($("input:radio:checked").val() == 1){
                    $("#base_price").show();
                }
                else{
                    $("#base_price").hide();
                }
            });    
        });
    </script>

@endpush