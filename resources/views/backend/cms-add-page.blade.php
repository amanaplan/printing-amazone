@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    add new page
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
                    <h4 class="pull-left">Add new CMS Page</h4>
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
                    Enter details of category
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/cms/list-pages') }}" class="btn btn-info btn-rounded btn-xs">Manage Pages</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('page_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="page_name" class="form-control" value="{{ old('page_name') }}">

                                @if ($errors->has('page_name'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('page_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('page_desc') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Contents</label>
                            <div class="col-sm-10">
                                <textarea id="editor1" name="page_desc" class="form-control">{{ old('page_desc') }}</textarea>

                                @if ($errors->has('page_desc'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('page_desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group {{ $errors->has('page_title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <textarea name="page_title" class="form-control">{{ old('page_title') }}</textarea>

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
                                <textarea name="meta_desc" class="form-control">{{ old('meta_desc') }}</textarea>

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
                                <input type="text" id="the_img_fld-1" class="form-control" name="og_image" placeholder="image from the pages folder" value="{{ old('og_image') }}">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-primary pull-left fileSelector" elem-id="1" type="button">select file</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="row text-center">
                                    <img id="picture_prvw-1" width="150" src="" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/cms/list-pages') }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Add Page</button>
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

    <script type="text/javascript" src="{{ asset('assets/frontend/plugin/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        

        CKEDITOR.replace('editor1', {
            customConfig: "{{ asset('assets/frontend/plugin/ckeditor/custom-config.js') }}",
            filebrowserBrowseUrl : "{{ route('elfinder-ckeditor') }}",
        });
    </script>

@endpush
