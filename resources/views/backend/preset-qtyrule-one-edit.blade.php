@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    update qty rule group 1 preset
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
                    Update Preset Details</span>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/presets/qty-rule-first/list/'.$product_id) }}" class="btn btn-info btn-rounded btn-xs">Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/product/presets/qty-rule-first/edit-rq/'.$preset_id.'/'.$product_id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Paperstock Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="readonly" value="{{ $option }}">
                            </div>
                        </div>

                        <label class="col-sm-2 control-label">Order Quantity</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('qty') ? ' has-error' : '' }}">
                            <span class="input-group-addon">$</span> 
                            <input type="number" name="qty" min="1" class="form-control" value="{{ $preset->order_qty }}"> 

                            @if ($errors->has('qty'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('qty') }}</strong>
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