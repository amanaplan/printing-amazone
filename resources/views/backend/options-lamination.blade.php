@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of options of Laminations
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
                    <h4 class="pull-left">Manage Lamination Options</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>form options</li>
                        <li>lamination</li>
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
                    <form class="form-inline" action="{{ url('/admin/form/insert/lamination') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group {{ ($errors->has('option'))? 'has-error' : '' }}">
                                <label class="sr-only">Option Name</label>
                                <input type="text" style="width: 500px;" name="option" value="{{ old('option') }}" placeholder="Enter lamination option value" class="form-control">
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
                                    <th>Lamination Option</th>
                                    <th>Sort order</th>
                                    <th>Applicable Product</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($options as $option)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $option->option }}</td>
                                        <td><input type="number" value="{{ $option->sort }}" onchange="sortLamination({{ $option->id }}, this.value);"></td>
                                        <td><a href="{{ url('/admin/form/lamination/set-product', $option->id) }}" class="btn btn-default">Set</a></td>
                                        <td>
                                            <form action="{{ url('/admin/form/remove/lamination') }}" method="post">
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
    
    <script type="text/javascript">
        function sortLamination(id, sort)
        {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('/admin/form/sort/lamination') }}",
                type: "PUT",
                data: {option_id:id, sort:sort},
                success: function(result){
                    Command: toastr["success"]("order updated successfully", "Successfully Done. .");
                },
                error: function(xhr,status,error){
                    Command: toastr["error"](error, "some error occurred");
                }
            });

            $.ajax();
            //ajax
        }
    </script>

@endpush
