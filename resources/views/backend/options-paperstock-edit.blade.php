@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    edit paperstock option
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
                        <li>paperstock options</li>
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
                    Edit Paperstock Option
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="{{ url('/admin/form/update/paperstock/'.$option->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="col-md-6">
                            <div class="form-group {{ ($errors->has('option'))? 'has-error' : '' }}">
                                <label class="sr-only">Option Name</label>
                                <input type="text" style="width: 500px;" name="option" value="{{ $option->option }}" placeholder="Enter paperstock option name" class="form-control">
                                
                                @if ($errors->has('option'))
                                    <span class="help-block">
                                        {{ $errors->first('option') }}
                                    </span>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save Changes</button>
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