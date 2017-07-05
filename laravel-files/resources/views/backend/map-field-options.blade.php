@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    set field option
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
                    <h4 class="pull-left">Set Field Options For {{ $product }} - {{ $fieldname }}</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ url('/admin/product/manage') }}">Manage Products</a></li>
                        <li>set form options</li>
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
                    Check the applicable {{ $fieldname }} Options
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/form/set/options/'.$mapid) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <div class="col-sm-12 col-md-9 col-md-offset-3">

                                @foreach($options as $option)
                                    <div><label> <input type="checkbox" name="options[]" value="{{ ($option->id) }}" {{ (in_array($option->id,$curropt))? 'checked' : '' }}> {{ ($fieldtype == 2)? $option->display_value : $option->option }} </label></div>
                                @endforeach
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3 col-sm-12">
                                <button class="btn btn-success" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Set Options Appearance Order
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#No.</th>
                                    <th>Option Name</th>
                                    <th>Sort Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selected as $option)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($fieldtype == 2)
                                                {{ DB::table($table)->where('id', $option->option_id)->first()->display_value }}
                                            @else
                                                {{ DB::table($table)->where('id', $option->option_id)->first()->option }}
                                            @endif
                                        </td>
                                        <td><input type="number" name="" min="1" step="1" value="{{ $option->sort }}" onchange="changeOptSort({{ $option->id }}, this.value);"></td>
                                    </tr>
                                                                    
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>


        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')
    
    <script>
        function changeOptSort(id, order) {
            //ajax
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('/admin/form/sort/fieldoption') }}",
                type: "PUT",
                data: {id:id, sort:order},
                success: function(result){
                    Command: toastr["success"]("order updated successfully", "Successfully Done. .");
                },
                error: function(xhr,status,error){
                    Command: toastr["error"](error, "some error occurred");
                }
            });

            $.ajax();
            //ajax
        }
    </script>

@endpush