@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    update category
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
                    <h4 class="pull-left">Edit category</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>Manage category</li>
                        <li>edit category</li>
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
                    Enter details of category
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu panel-dropdown" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/request/category/edit/'.$category->id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group {{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Category name</label>
                            <div class="col-sm-10">
                                <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">

                                @if ($errors->has('category_name'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('category_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('page_title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <textarea name="page_title" class="form-control">{{ $category->title }}</textarea>

                                @if ($errors->has('page_title'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('meta_desc') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Meta Description</label>
                            <div class="col-sm-10">
                                <textarea name="meta_desc" class="form-control">{{ $category->meta_desc }}</textarea>

                                @if ($errors->has('meta_desc'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('meta_desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('og_image') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">OG Image</label>
                            <div class="col-sm-4">
                                <input type="text" id="the_img_fld-1" class="form-control" name="og_image" value="{{ $category->og_img }}">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-primary pull-left fileSelector" elem-id="1" type="button">select file</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="row text-center">
                                    <img id="picture_prvw-1" class="img-circle" width="150" src="{{ asset( 'assets/images/category/' ) }}/{{ ($category->og_img)? $category->og_img : '' }}" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/category/manage') }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Update Category</button>
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