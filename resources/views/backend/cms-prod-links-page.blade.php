@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    manage home page product links
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
                    <h4 class="pull-left">Manage Contents</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
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
                    Enter details of Banner
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/cms/product-links/save') }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product 1</label>
                            <div class="col-sm-10">
                                <select name="prod[]" class="form-control">
                                    <option value="">--select a product from dropdown--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($curr_prods)? ($curr_prods[0]->id == $product->id)? 'selected' : '' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product 2</label>
                            <div class="col-sm-10">
                                <select name="prod[]" class="form-control">
                                    <option value="">--select a product from dropdown--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($curr_prods)? ($curr_prods[1]->id == $product->id)? 'selected' : '' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product 3</label>
                            <div class="col-sm-10">
                                <select name="prod[]" class="form-control">
                                    <option value="">--select a product from dropdown--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($curr_prods)? ($curr_prods[2]->id == $product->id)? 'selected' : '' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product 4</label>
                            <div class="col-sm-10">
                                <select name="prod[]" class="form-control">
                                    <option value="">--select a product from dropdown--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($curr_prods)? ($curr_prods[3]->id == $product->id)? 'selected' : '' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product 5</label>
                            <div class="col-sm-10">
                                <select name="prod[]" class="form-control">
                                    <option value="">--select a product from dropdown--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($curr_prods)? ($curr_prods[4]->id == $product->id)? 'selected' : '' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product 6</label>
                            <div class="col-sm-10">
                                <select name="prod[]" class="form-control">
                                    <option value="">--select a product from dropdown--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($curr_prods)? ($curr_prods[5]->id == $product->id)? 'selected' : '' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
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
@endpush
