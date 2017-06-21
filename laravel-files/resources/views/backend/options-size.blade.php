@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of options of Size
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
                    <h4 class="pull-left">Manage Size Options</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>added products</li>
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
                    Add New Option
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="{{ url('/admin/form/insert/size') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-8">
                            <div class="form-group {{ ($errors->has('option'))? 'has-error' : '' }}">
                                <label class="sr-only">Option Display Name</label>
                                <input type="text" style="width: 300px;" name="option" value="{{ old('option') }}" placeholder="option display name" class="form-control">
                                @if ($errors->has('option'))
                                    <span class="help-block">
                                        {{ $errors->first('option') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ ($errors->has('width'))? 'has-error' : '' }}">
                                <label class="sr-only">Width Dimension</label>
                                <input type="text" style="width: 150px;" name="width" value="{{ old('width') }}" placeholder="width in cm" class="form-control">
                                @if ($errors->has('width'))
                                    <span class="help-block">
                                        {{ $errors->first('width') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ ($errors->has('height'))? 'has-error' : '' }}">
                                <label class="sr-only">Height Dimension</label>
                                <input type="text" style="width: 150px;" name="height" value="{{ old('height') }}" placeholder="height in cm" class="form-control">
                                @if ($errors->has('height'))
                                    <span class="help-block">
                                        {{ $errors->first('height') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Add Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    All Options
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#No.</th>
                                    <th>Size Display Name</th>
                                    <th>Width (in cm)</th>
                                    <th>Height (in cm)</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($options as $option)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $option->display_value }}</td>
                                        <td>{{ $option->width }}</td>
                                        <td>{{ $option->height }}</td>
                                        <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                        <td><a href="#"><i class="fa fa-trash"></i></a></td>
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