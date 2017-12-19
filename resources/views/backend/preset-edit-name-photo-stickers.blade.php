@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    edit preset price
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
                    <h4 class="pull-left">Edit Preset Pricing for <span class="label label-warning">{{ $product_name }}</span></h4>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-card margin-b-30">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Update Preset Price
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('/admin/product/preset/name-photo-sticker/edit', $id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sticker Type</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{ $preset->stickertype->name }}" class="form-control" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Quantity</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{ $preset->quantity->option }}" class="form-control" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('price'))? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Preset Price</label>

                            <div class="col-sm-10">
                                <input type="text" name="price" value="{{ $preset->price }}" class="form-control" />
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        {{ $errors->first('price') }}
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button class="btn btn-success" type="submit">Update Price</button>
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
