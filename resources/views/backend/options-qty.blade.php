@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of options of Quantity
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
                    <h4 class="pull-left">Manage Quantity Options</h4>
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
                    <form class="form-inline" action="{{ url('/admin/form/insert/qty') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group {{ ($errors->has('option'))? 'has-error' : '' }}">
                                <label class="sr-only">Option Name</label>
                                <input type="text" style="width: 500px;" name="option" value="{{ old('option') }}" placeholder="Enter Quantity option value" class="form-control">
                                @if ($errors->has('option'))
                                    <span class="help-block">
                                        {{ $errors->first('option') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
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
                                    <th>Quantity value</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($options as $option)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $option->option }}</td>
                                        <td>
                                            <form action="{{ url('/admin/form/remove/qty') }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                
                                                <input type="hidden" name="option_id" value="{{ $option->id }}">
                                                <button onclick="return confirm('sure to remove this option !');" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
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
