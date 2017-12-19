@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of added products
@stop

{{-- page specific css --}}
@push('styles')
    
    {{-- css switch --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/switch.css') }}">

@endpush

{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Manage List Products</h4>
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
                    All Products
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/add') }}" class="btn btn-info btn-rounded btn-xs">Add Product</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Logo/Img</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Applicable Form Fields</th>
                                    <th>Total Reviews</th>
                                    <th>Set Pricing</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($products as $product)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('assets/images/products/'.$product->logo) }}" width="80"></td>
                                    <td>{{ $product->product_name }} 
                                        @if($product->category->category_slug == 'uncategorized')

                                        <a href="{{ url('/'.$product->product_slug) }}" target="_blank">
                                            <i class="fa fa-external-link" aria-hidden="true"></i>
                                        </a>

                                        @else
                                            <a href="{{ url('/'.$product->category->category_slug.'/'.$product->product_slug) }}" target="_blank">
                                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td><span class="label label-primary">{{ \App\Category::where('id', $product->category_id)->first()->category_name }}</span></td>
                                    <td>
                                        @if($product->formfields()->count() > 0)
                                            @foreach($product->formfields as $field)
                                                <a href="{{ url('/admin/form/editoption/'.$product->id.'/'.$field->pivot->form_field_id.'/'.$field->pivot->id) }}" target="_blank"><span class="label label-success">{{ $field->name }}<span class="badge">{{ \App\MapProdFrmOpt::where('mapping_field_id',$field->pivot->id)->count() }}</span></span></a>
                                            @endforeach

                                        @else
                                            <span class="label label-danger">Not Defined</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->review()->count() }}</td>
                                    <td>
                                        @if($product->product_slug == 'name-stickers' || $product->product_slug == 'photo-stickers')
                                            <a href="{{ url('/admin/product/name-photo-sticker/preset', $product->id) }}" class="btn btn-default"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                                        @elseif($product->formfields()->count() > 0)
                                             @php
                                                $fieldTypes = [];
                                            @endphp
                                            @foreach($product->formfields as $field)
                                                @php
                                                    $fieldTypes[] = $field->id;
                                                @endphp
                                            @endforeach

                                            @if(in_array(1, $fieldTypes))
                                                <a href="{{ url('/admin/product/presets/'.$product->id) }}" class="btn btn-default"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                                            @else
                                                <span class="label label-danger">Not applicable</span>
                                            @endif

                                        @else
                                            <span class="label label-danger">Not applicable</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ url('/admin/product/edit/'.$product->id) }}"><i class="fa fa-edit"></i></a></td>
                                    <td><button type="button" onclick="remProd({{$product->id}}, this)" class="btn btn-warning"><i class="fa fa-trash"></i></button></td>
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
    
    <script type="text/javascript">

        function remProd(prod, elem)
        {
            let conf = confirm('sure to remove the product completely!');

            if(conf)
            {
                var xhttp = new XMLHttpRequest();
                
                xhttp.open("DELETE", "{{ url('/admin/product/delete') }}", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                let data = '_token={{ csrf_token() }}';
                data += '&product='+prod;

                xhttp.send(data);

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if(this.status == 200)
                        {
                            Command: toastr["success"]("product removed successfully", "Successfully Done. .");
                            $(elem).closest('tr').fadeOut();
                        }
                        else
                        {
                            Command: toastr["error"]("Upss! some error occurred", "Error. .");
                        }
                    }
                };
            }
        }
    </script>

@endpush
