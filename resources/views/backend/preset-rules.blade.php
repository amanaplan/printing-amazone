@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    set pricing preset for the product
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
                    <h4 class="pull-left">Presets</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ url('/admin/product/manage') }}">added products</a></li>
                        <li>priding presets</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-card">
                <!-- Start .panel -->
                <div class="panel-heading">
                   Set Pricing for <span class="label label-warning">{{ $product_name }}</span>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/manage') }}" class="btn btn-info btn-rounded btn-xs">Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <svg version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="20px" viewBox="0 0 21 20" enable-background="new 0 0 21 20" xml:space="preserve">
                                <path fill="#FFFFFF" d="M19.998,6.766l-5.759-0.544c-0.362-0.032-0.676-0.264-0.822-0.61l-2.064-4.999
                                      c-0.329-0.825-1.5-0.825-1.83,0L7.476,5.611c-0.132,0.346-0.462,0.578-0.824,0.61L0.894,6.766C0.035,6.848-0.312,7.921,0.333,8.499
                                      l4.338,3.811c0.279,0.246,0.395,0.609,0.314,0.975l-1.304,5.345c-0.199,0.842,0.708,1.534,1.468,1.089l4.801-2.822
                                      c0.313-0.181,0.695-0.181,1.006,0l4.803,2.822c0.759,0.445,1.666-0.23,1.468-1.089l-1.288-5.345
                                      c-0.081-0.365,0.035-0.729,0.313-0.975l4.34-3.811C21.219,7.921,20.855,6.848,19.998,6.766z"></path>
                                </svg>

                            </div>
                            <div class="timeline-content">
                                <h2>General Price Settings</h2>
                                <p>
                                    Set val/mm<sup>2</sup>, minimum & max allowed dimenssion, profit % etc.
                                </p>
                                <a href="{{ url('/admin/product/presets/general/'.$product_id) }}" class="btn btn-success btn-block">Set Pricing</a>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="20px" viewBox="0 0 21 20" enable-background="new 0 0 21 20" xml:space="preserve">
                                <g>
                                <path fill="#FFFFFF" d="M19.998,6.766l-5.759-0.544c-0.362-0.032-0.676-0.264-0.822-0.61l-2.064-4.999
                                  c-0.329-0.825-1.5-0.825-1.83,0L7.476,5.611c-0.132,0.346-0.462,0.578-0.824,0.61L0.894,6.766C0.035,6.848-0.312,7.921,0.333,8.499
                                  l4.338,3.811c0.279,0.246,0.395,0.609,0.314,0.975l-1.304,5.345c-0.199,0.842,0.708,1.534,1.468,1.089l4.801-2.822
                                  c0.313-0.181,0.695-0.181,1.006,0l4.803,2.822c0.759,0.445,1.666-0.23,1.468-1.089l-1.288-5.345
                                  c-0.081-0.365,0.035-0.729,0.313-0.975l4.34-3.811C21.219,7.921,20.855,6.848,19.998,6.766z"></path>
                                </g>
                                </svg>

                            </div>
                            <div class="timeline-content right">
                                <h2>#1 Preset for order quantity</h2>
                                <p>
                                    preset discount values for order quantity 100, 200 .. etc
                                </p>
                                <a href="#" class="btn btn-info btn-block">Set Discount</a>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="20px" viewBox="0 0 21 20" enable-background="new 0 0 21 20" xml:space="preserve">
                                <path fill="#FFFFFF" d="M19.998,6.766l-5.759-0.544c-0.362-0.032-0.676-0.264-0.822-0.61l-2.064-4.999
                                      c-0.329-0.825-1.5-0.825-1.83,0L7.476,5.611c-0.132,0.346-0.462,0.578-0.824,0.61L0.894,6.766C0.035,6.848-0.312,7.921,0.333,8.499
                                      l4.338,3.811c0.279,0.246,0.395,0.609,0.314,0.975l-1.304,5.345c-0.199,0.842,0.708,1.534,1.468,1.089l4.801-2.822
                                      c0.313-0.181,0.695-0.181,1.006,0l4.803,2.822c0.759,0.445,1.666-0.23,1.468-1.089l-1.288-5.345
                                      c-0.081-0.365,0.035-0.729,0.313-0.975l4.34-3.811C21.219,7.921,20.855,6.848,19.998,6.766z"></path>
                                </svg>

                            </div>
                            <div class="timeline-content">
                                <h2>#2 Preset for order quantity</h2>
                                <p>
                                    preset discount values for higner order quantity like 1000, 2000 ...
                                </p>
                                <a href="#" class="btn btn-warning btn-block">Set Discount</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')
    

@endpush