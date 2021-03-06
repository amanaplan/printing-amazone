@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    edit template
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
                    <h4 class="pull-left">Edit Template</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>Manage Templates</li>
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
                    Enter details of template
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Go To <span class="caret"></span></button>
                            <ul class="dropdown-menu panel-dropdown" role="menu">
                                <li><a href="{{ url('/admin/template/manage') }}">Manage Templates</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/request/template/edit', $template->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Select Product</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="readonly" class="form-control" value="{{ $template->ofproduct->product_name }}" />
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('variation_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Enter Variation Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="variation_name" placeholder="e.g. 80 x 80 mm" class="form-control" value="{{ $template->variation }}">

                                @if ($errors->has('variation_name'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('variation_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('template') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Upload Template File (if you want to change the current file, else skip)</label>
                            <div class="col-sm-10">
                                <input type="file" name="template" class="form-control" />

                                @if ($errors->has('template'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('template') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/template/manage') }}" class="btn btn-white">Cancel</a>
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
