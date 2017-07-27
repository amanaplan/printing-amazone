@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    available general presets for {{ $product_name }}
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
                    <h4 class="pull-left">Manage General Presets</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ url('/admin/product/manage') }}"></a>manage products</li>
                        <li>added general presets</li>
                    </ol>

                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    available general presets for <span class="label label-warning">{{ $product_name }}</span>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/presets/general/'.$product_id) }}" class="btn btn-success btn-rounded btn-xs">Add New Preset</a>
                        </div>
                    </div>
                </div>
                
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#No.</th>
                                    <th>Paperstock Option</th>
                                    <th>Limited Dimension (mm<sup>2</sup> range)</th>
                                    <th>Value/mm<sup>2</sup></th>
                                    <th>Profit %</th>
                                    <th>Min. (mm)</th>
                                    <th>Max. (mm)</th>
                                    <th>Base Preset Group</th>
                                    <th>Fixed Base Price</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($presets as $preset)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @php
                                                $opt_id = \App\MapProdFrmOpt::find($preset->map_prod_form_option)->option_id;
                                            @endphp

                                            <span class="label label-info">{{ \App\OptPaperstock::find($opt_id)->option }}</span>
                                        </td>
                                        <td>{{ $preset->from }} to {{ $preset->to }}</td>
                                        <td>{{ ($preset->val_per_mmsq)? '$ '.$preset->val_per_mmsq : 'NA' }}</td>
                                        <td>{{ ($preset->profit_percent)? $preset->profit_percent.' %' : 'NA' }}</td>
                                        <td>{{ $preset->min_size }}</td>
                                        <td>{{ $preset->max_size }}</td>
                                        <td>{!! ($preset->is_base)? '<i class="fa fa-check fa-lg text-success"></i>' : '<i class="fa fa-times-circle-o fa-lg"></i>' !!}</td>
                                        <td>{{ ($preset->is_base)? '$ '.$preset->base_price : 'NA' }}</td>
                                        <td><a href="#" class="btn btn-default"><i class="fa fa-pencil"></i></a></td>
                                        <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End .panel --> 


        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')
    

@endpush