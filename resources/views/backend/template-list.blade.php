@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of added templates
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
                    <h4 class="pull-left">Manage List Templates</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>added templates</li>
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
                    All Templates
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/template/add') }}" class="btn btn-info btn-rounded btn-xs">Add Template</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Total Templates</th>
                                    <th>Available Templates</th>
                                    <th>Sort Size Appearance</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $product)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($product->category->category_slug == 'uncategorized')
                                            <a href="{{ url('/', $product->product_slug) }}" target="_blank">
                                        @else
                                            <a href="{{ url('/', [$product->category->category_slug , $product->product_slug]) }}" target="_blank">
                                        @endif

                                            <img width="100" src="{{ asset('assets/images/products/'.$product->logo) }}" />
                                            {{ $product->product_name }}
                                        </a>
                                    </td>

                                    <td><p><strong>{{ $product->variations_count }}</strong></p></td>

                                    <td>
                                        <ul>
                                        @foreach($product->variations as $variation)
                                            
                                            <li style="padding-top: 5px;">{{ $variation->variation }} 
                                                <a href="{{ asset('storage/'.$variation->template_file) }}" download="{{ $product->product_name.'-'.$variation->variation }}" class="label label-success">download <i class="fa fa-download" aria-hidden="true"></i></a>
                                                <a href="{{ url('/admin/template/edit', $variation->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="#" onclick="deleteTemplate({{ $variation->id }});" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                                            </li>
                                            
                                        @endforeach
                                        </ul>
                                    </td>

                                    <td><a href="{{ url('/admin/template/sort', $product->id) }}" class="btn btn-info"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i></a></td>                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                        {{-- template delete form --}}
                        <form action="{{ url('/admin/request/template/remove') }}" method="POST" id="template-delete">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="templateid" value="0" />
                        </form>
                        

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
        function deleteTemplate(id) {
            let conf = confirm('sure to delete this template!');
            if(conf == true)
            {
                $("input[name='templateid']").val(id);
                $("form#template-delete").submit();
            }
        }
    </script>

@endpush
