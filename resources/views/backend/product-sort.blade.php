@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    sort product order
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
                    <h4 class="pull-left">Manage Product Order</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>added products</li>
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
                    Available Products
                    <div class="pull-right">
                        <div class="btn-group">
                            <a class="btn btn-info btn-rounded btn-xs" href="{{ url('/admin/category/manage') }}">Manage Categories</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Sort</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset( 'assets/images/products/'.$product->logo ) }}" />
                                        <br/>
                                        {{ $product->product_name }}
                                    </td>
                                    <td><input type="number" value="{{ $product->sort }}" min="1" step="1" onchange="changeProdSort({{$product->id}}, this.value)"></td>
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
    
    <script>
        function changeProdSort(id, order) {
            //ajax
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('/admin/product/set-order') }}",
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