@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    edit size option
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
                    <h4 class="pull-left">Update Field Option</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>size options</li>
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
                    Edit Size Option
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/form/update/size/'.$option->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group {{ ($errors->has('option'))? 'has-error' : '' }}">
                                <label>Option Display Name</label>
                                <input type="text" name="option" value="{{ $option->display_value }}" placeholder="option display name" class="form-control">
                                @if ($errors->has('option'))
                                    <span class="help-block">
                                        {{ $errors->first('option') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ ($errors->has('width'))? 'has-error' : '' }}">
                                <label>Width Dimension (in mm)</label>
                                <input type="text" name="width" value="{{ $option->width }}" placeholder="width in mm" class="form-control">
                                @if ($errors->has('width'))
                                    <span class="help-block">
                                        {{ $errors->first('width') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ ($errors->has('height'))? 'has-error' : '' }}">
                                <label>Height Dimension (in mm)</label>
                                <input type="text" name="height" value="{{ $option->height }}" placeholder="height in mm" class="form-control">
                                @if ($errors->has('height'))
                                    <span class="help-block">
                                        {{ $errors->first('height') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Save Changes</button>
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