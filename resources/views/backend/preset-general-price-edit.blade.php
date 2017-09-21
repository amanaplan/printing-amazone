@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    update preset values
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
                    Update Preset Details</span>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/presets/general/list/'.$product_id) }}" class="btn btn-info btn-rounded btn-xs">Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/product/presets/general/edit-rq/'.$preset_id.'/'.$product_id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Paperstock Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="readonly" value="{{ $option }}">
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('from') || $errors->has('to')) ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Dimenssion (in mm<sup>2</sup>)</label>
                            <div class="col-sm-4">
                                <input type="text" name="from" class="form-control" placeholder="from dimenssion in mm2" value="{{ $preset->from }}">

                                @if ($errors->has('from'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label class="col-sm-2 control-label">To Dimenssion</label>
                            <div class="col-sm-4">
                                <input type="text" name="to" class="form-control" placeholder="to dimenssion in mm2" value="{{ $preset->to }}">

                                @if ($errors->has('to'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('to') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <label class="col-sm-2 control-label">Value / mm<sup>2</sup></label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('val_per_mm') ? ' has-error' : '' }}">
                            <span class="input-group-addon">$</span> 
                            <input type="text" name="val_per_mm" placeholder="e.x- 00.25" class="form-control" value="{{ $preset->val_per_mmsq }}"> 

                            @if ($errors->has('val_per_mm'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('val_per_mm') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label class="col-sm-2 control-label">Profit</label>
                        <div class="input-group m-b col-sm-10 {{ $errors->has('profit') ? ' has-error' : '' }}">
                            <span class="input-group-addon">%</span> 
                            <input type="text" name="profit" placeholder="e.x- 00.50" class="form-control" value="{{ $preset->profit_percent }}"> 

                            @if ($errors->has('profit'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('profit') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-4 control-label">It is the fixed price group preset</label>
                            <div class="col-sm-8">
                                <label class="checkbox-inline"> 
                                    <input type="radio" name="is_base" value="1" id="inlineCheckbox1" {{ $preset->is_base ? 'checked' : '' }}> Yes 
                                </label> 
                                <label class="checkbox-inline">
                                    <input type="radio" name="is_base" value="0" id="inlineCheckbox2" {{ !$preset->is_base ? 'checked' : '' }}> No 
                                </label> 

                                @if ($errors->has('is_base'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('is_base') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="base_price" {!! $preset->is_base ? 'style="display: block;"' : 'style="display: none;"' !!}>
                            <label class="col-sm-2 control-label">Fixed Price</label>
                            <div class="input-group m-b col-sm-10 {{ $errors->has('fixed_price') ? ' has-error' : '' }}">
                                <span class="input-group-addon">$</span> 
                                <input type="text" name="fixed_price" class="form-control" value="{{ $preset->base_price }}"> 
                                <span class="input-group-addon">per 1000 qty.</span>

                                @if ($errors->has('fixed_price'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('fixed_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/product/presets/general/list/'.$product_id) }}" class="btn btn-white">Cancel</a>
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
