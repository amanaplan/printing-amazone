@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    available general presets for {{ $product_name }}
@stop

{{-- page specific css --}}
@push('styles')

<link href="{{ asset('assets/backend/plugins/tablesaw/tablesaw.css') }}" rel="stylesheet">

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
                        <table class="tablesaw" data-tablesaw-sortable data-tablesaw-sortable-switch>
                            <thead>
                                <tr>
                                    <th scope="col">#No.</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Paperstock</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Dimension (mm<sup>2</sup> range)</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Value/mm<sup>2</sup></th>

                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Profit %</th>
                                    <th scope="col">Base Preset Group</th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Fixed Base Price</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>

                            <!-- <thead>

                                <tr>
                                    <th>#No.</th>
                                    <th>Paperstock</th>
                                    <th>Dimension (mm<sup>2</sup> range)</th>
                                    <th>Value/mm<sup>2</sup></th>
                                    <th>Profit %</th>
                                    <th>Min. (mm)</th>
                                    <th>Max. (mm)</th>
                                    <th>Base Preset Group</th>
                                    <th>Fixed Base Price</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead> -->
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
                                        <td>{{ $preset->from }} - {{ $preset->to }}</td>
                                        <td>{{ ($preset->val_per_mmsq)? '$ '.$preset->val_per_mmsq : 'NA' }}</td>
                                        <td>{{ ($preset->profit_percent)? $preset->profit_percent.' %' : 'NA' }}</td>
                                        <td>{!! ($preset->is_base)? '<i class="fa fa-check fa-lg text-success"></i>' : '<i class="fa fa-times-circle-o fa-lg"></i>' !!}</td>
                                        <td>{{ ($preset->is_base)? '$ '.$preset->base_price.' /1000 qty.' : 'NA' }}</td>
                                        <td><a href="{{ url('/admin/product/presets/general/edit/'.$preset->id.'/'.$product_id) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a></td>
                                        <td><a href="javascript:void();" onclick="remPreset({{$preset->id}}, this);" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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
    <script src="{{ asset('assets/backend/plugins/data-tables/dataTables.responsive.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/backend/js/custom.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/tablesaw/tablesaw.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/tablesaw/tablesaw-init.js') }}"></script>
    <script src="{{ asset('assets/backend/js/tablesaw-custom.js') }}"></script>

    <script>
        function remPreset(id, elem)
        {
            let conf = confirm('sure to remove this preset data? this process is irreversible');
            if(conf)
            {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: "{{ url('/admin/product/presets/general/remove') }}",
                    type: "DELETE",
                    data: {id: id, type: 'general'},
                    success: function(result){
                    $(elem).prop('disabled',false);
                       Command: toastr["success"]("Preset Deleted Successfully", "Successfully Done. .");
                       $(elem).closest('tr').fadeOut();
                    },
                    error: function(xhr,status,error){
                       Command: toastr["error"](error, "Error Occurred. .");
                    }
                });
                $.ajax();
            }
        }

    </script>

@endpush
