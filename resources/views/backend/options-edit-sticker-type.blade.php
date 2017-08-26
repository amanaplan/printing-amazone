@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    edit name sticker predefined artworks
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
                    <h4 class="pull-left">Update Name Sticker Artwork</h4>
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
                    <form action="{{ url('/admin/form/update/sticker-type/'.$option->id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group {{ $errors->has('sticker_type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Artwork Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="sticker_type" class="form-control" value="{{ $option->name }}">

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
                                <input type="text" id="the_img_fld-1" class="form-control" value="{{ $option->image }}" name="image" placeholder="image from category folder" value="{{ old('image') }}">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-primary pull-left fileSelector" elem-id="1" type="button">select file</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="row text-center">
                                    <img id="picture_prvw-1" src="{{ asset('assets/images/products/'.$option->image) }}" width="150" src="" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
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
