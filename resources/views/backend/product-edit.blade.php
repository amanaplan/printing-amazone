@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    edit product
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
                    <h4 class="pull-left">update product</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>Manage products</li>
                        <li>edit product</li>
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
                    Enter details of product
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Go To <span class="caret"></span></button>
                            <ul class="dropdown-menu panel-dropdown" role="menu">
                                <li><a href="{{ url('/admin/product/manage') }}">Manage Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/request/product/edit/'.$product->id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Select Category</label>
                            <div class="col-sm-10">
                                <select name="category_id" class="form-control">
                                    <option value="">--select the category of this product--</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ ($product->category_id == $category->id)? 'selected' : '' }} > {{ $category->category_name }} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}">

                                @if ($errors->has('product_name'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('product_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Logo/Image</label>
                            <div class="col-sm-4">
                                <input type="text" id="the_img_fld-2" class="form-control" placeholder="image from products folder" name="logo" value="{{ $product->logo }}">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-primary pull-left fileSelector" elem-id="2" type="button">select file</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="row text-center">
                                    <img id="picture_prvw-2" width="150" src="{{ asset( 'assets/images/products/'.$product->logo ) }}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control">{{ $product->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('sample_img') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Relevant Sample Image</label>
                            <div class="col-sm-4">
                                <input type="text" id="the_img_fld-3" class="form-control" name="sample_img" placeholder="image from products folder" value="{{ $product->sample_image }}">
                                <span class="help-block m-b-none text-info">
                                    if you want a slider then enter images separated by * otherwise just the image name
                                </span>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-primary pull-left fileSelector" elem-id="3" type="button">select file</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Applicable form fields</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline"> <input type="checkbox" name="fields[]" value="1" {{ (in_array(1, $applicable_flds))? 'checked' : '' }}> Paperstock </label> 
                                <label class="checkbox-inline"><input type="checkbox" name="fields[]" value="2" {{ (in_array(2, $applicable_flds))? 'checked' : '' }}> Size (mm<sup>2</sup>) </label> 
                                <label class="checkbox-inline"><input type="checkbox" name="fields[]" value="3" {{ (in_array(3, $applicable_flds))? 'checked' : '' }}> Quantity </label>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('min_size') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Minimum allowed size (mm)</label>
                            <div class="col-sm-10">
                                <input type="text" name="min_size" class="form-control" value="{{ $product->min_size }}">

                                @if ($errors->has('min_size'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('min_size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('max_size') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Maximum allowed size (mm)</label>
                            <div class="col-sm-10">
                                <input type="text" name="max_size" class="form-control" value="{{ $product->max_size }}">

                                @if ($errors->has('max_size'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('max_size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Allow custom size selection option</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline"> 
                                    <input type="checkbox" name="custom_size" value="1" {{ ($product->allow_custom_size)? 'checked="checked"' : '' }}> Enable </label> 
                                    
                                    @if ($errors->has('custom_size'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('custom_size') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('page_title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <textarea name="page_title" class="form-control">{{ $product->title }}</textarea>

                                @if ($errors->has('page_title'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('meta_desc') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Meta Description</label>
                            <div class="col-sm-10">
                                <textarea name="meta_desc" class="form-control">{{ $product->meta_desc }}</textarea>

                                @if ($errors->has('meta_desc'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('meta_desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('og_image') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">OG Image</label>
                            <div class="col-sm-4">
                                <input type="text" id="the_img_fld-1" class="form-control" placeholder="image from products folder" name="og_image" value="{{ $product->og_img }}">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-primary pull-left fileSelector" elem-id="1" type="button">select file</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="row text-center">
                                    <img id="picture_prvw-1" width="150" src="{{ asset( 'assets/images/products/'.$product->og_img ) }}" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/product/manage') }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Update Item</button>
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
