@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    setup preset price
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
                    <h4 class="pull-left">Set Preset Pricing for <span class="label label-warning">{{ $product_name }}</span></h4>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-card margin-b-30">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Add New Preset
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('/admin/product/presets/name-photo-sticker', $id) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group {{ ($errors->has('sticker_type'))? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Sticker Type</label>

                            <div class="col-sm-10">
                                <select name="sticker_type" class="form-control">
                                    <option value="">--select one sticker type--</option>
                                    @foreach($sticker_types as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sticker_type'))
                                    <span class="help-block">
                                        {{ $errors->first('sticker_type') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('quantity_id'))? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Select Quantity</label>

                            <div class="col-sm-10">
                                <select name="quantity_id" class="form-control">
                                    <option value="">--select one quantity--</option>
                                    @foreach($qty_options as $row)
                                        @php
                                            $option = \App\OptQty::findOrFail($row->option_id);
                                        @endphp
                                        <option value="{{ $option->id }}">{{ $option->option }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('quantity_id'))
                                    <span class="help-block">
                                        {{ $errors->first('quantity_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('price'))? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Preset Price</label>

                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" />
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        {{ $errors->first('price') }}
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button class="btn btn-success" type="submit">Add Now</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Presets for <code>{{ $product_name }}</code>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#No.</th>
                                    <th>Sticker Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($presets as $preset)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $preset->stickertype->name }}</td>
                                        <td>{{ $preset->quantity->option }}</td>
                                        <td>$ {{ $preset->price }}</td>
                                        <td><a href="{{ url('/admin/product/name-photo-sticker/preset/edit', $preset->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                        <td>
                                            <form action="{{ url('/admin/product/presets/remove/name-photo-sticker') }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                
                                                <input type="hidden" name="preset_id" value="{{ $preset->id }}">
                                                <button onclick="return confirm('sure to remove this preset !');" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
