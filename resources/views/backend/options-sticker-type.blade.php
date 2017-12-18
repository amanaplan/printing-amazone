@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    name sticker predefined artworks
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
                    <h4 class="pull-left">Add Name Sticker Artwork</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>form options</li>
                        <li>sticker type</li>
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
                    Enter details of artwork

                </div>

                <div class="panel-body">
                    <form action="{{ url('/admin/form/insert/sticker-type') }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('sticker_type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Artwork Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="sticker_type" class="form-control" value="{{ old('sticker_type') }}">

                                @if ($errors->has('sticker_type'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('sticker_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-4">
                                <input type="text" id="the_img_fld-1" class="form-control" name="image" placeholder="image from category folder" value="{{ old('image') }}">
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

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Add Artwork</button>
                            </div>
                        </div>
                    </form>
                </div>

                <br><br><br>

                <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    All Added Artworks (Name Sticker Types)
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#No.</th>
                                    <th>Image</th>
                                    <th>Sticker Type</th>
                                    <th>Sort order</th>
                                    <th>Applicable products</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($options as $option)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="width: 15%;"><img style="width: 100%;" src="{{ asset('assets/images/products/'.$option->image) }}" /></td>
                                        <td><strong>{{ $option->name }}</strong></td>
                                        <td><input type="number" value="{{ $option->sort }}" onchange="sortStickerType({{ $option->id }}, this.value);"></td>
                                        <td><a href="{{ url('/admin/form/sticker-type/set-product', $option->id) }}" class="btn btn-default">Set</a></td>
                                        <td><a href="{{ url('/admin/form/edit/sticker-type/'.$option->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a></td>
                                        <td>
                                            <form action="{{ url('/admin/form/remove/sticker_type') }}" method="post">
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

</div> 
@stop
{{-- page specific js --}}
@push('scripts')

    <script type="text/javascript">
        function sortStickerType(id, sort)
        {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('/admin/form/sort/sticker-type') }}",
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
