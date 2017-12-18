@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    link product with sticker type
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
                    <h4 class="pull-left">Link Sticker Type Option With Product</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>form options</li>
                        <li>sticker type</li>
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
                    Select product(s)
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="{{ url('/admin/form/sticker-type/link-product', $option) }}" method="post">
                        {{ csrf_field() }}
                            <div class="form-group">
                                @foreach($products as $product)
                                <label class="checkbox-inline"> 
                                    <input type="checkbox" value="{{ $product->id }}" {{ in_array($product->id, $linked)? 'checked' : '' }} name="product[]"> {{ $product->product_name }} 
                                </label> 
                                @endforeach
                            <br>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save Changes</button>
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
