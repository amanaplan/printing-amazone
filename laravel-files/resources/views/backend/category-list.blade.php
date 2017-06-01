@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of added categories
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
                    <h4 class="pull-left">Manage List Categories</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>added categories</li>
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
                    All Categories
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/category/add') }}" class="btn btn-info btn-rounded btn-xs">Add Category</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Available Products</th>
                                    <th>Sort Product Appearance</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->prod_count }}</td>
                                    <td><a href="{{ ($category->prod_count > 0)? url('/admin/category/sort-products/'.$category->id) : '#' }}"><i class="fa fa-list-ol" aria-hidden="true"></i></a></td>
                                    <td><a href="{{ url('/admin/category/edit', ['id' => $category->id]) }}"><i class="fa fa-pencil-square-o"></i></a></td>
                                    <td><a href=""><i class="fa fa-trash"></i></a></td>
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