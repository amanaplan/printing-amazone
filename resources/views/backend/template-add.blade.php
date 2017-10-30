@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    add template
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
                    <h4 class="pull-left">Add new Template</h4>
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
                    <form action="{{ url('/admin/request/template/add') }}" method="post" class="form-horizontal" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Select Category</label>
                            <div class="col-sm-10">
                                <select name="category_id" class="form-control">
                                    <option value="">--select the category of this product--</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {{ $category->category_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Select Product</label>
                            <div class="col-sm-10">
                                <select name="product_id" class="form-control">
                                    
                                </select>

                                @if ($errors->has('product_id'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('variation_name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Enter Variation Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="variation_name" placeholder="e.g. 80 x 80 mm" class="form-control" value="{{ old('variation_name') }}">

                                @if ($errors->has('variation_name'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('variation_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('template') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Upload Template File</label>
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
                                <button class="btn btn-primary" type="submit">Add Item</button>
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
    
    <script type="text/javascript">
        $(document).ready(function() {
            $("select[name='category_id']").change(function(){
                let categoryId = $(this).val();
                if(categoryId != '')
                {
                    
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: "{{ url('/admin/template/get-categories') }}",
                        type: "GET",
                        data: {category: categoryId},
                        success: function(result){
                            $("select[name='product_id']").html(result.map((obj) => `<option value="${obj.id}">${obj.product_name}</option>`));
                        },
                        error: function(xhr,status,error){
                           Command: toastr["error"](error, "Error Occurred. .");
                        }
                    });
                    $.ajax();
                    
                }
                else
                {
                    $("select[name='product_id']").html('');
                }
            });
        });
    </script>

@endpush
