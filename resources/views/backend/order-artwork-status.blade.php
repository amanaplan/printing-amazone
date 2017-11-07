@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    manage & upload mock up
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
                    <h4 class="pull-left">Manage Artwork Approval</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ $back_url }}">Manage Order</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-card">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Mockups &amp; User's Reviews
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ $back_url }}" class="btn btn-info btn-rounded btn-xs">< Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-sm-3 date left">
                                <i class="fa fa-th-large"></i>
                                6:00 am
                                <br>
                                <small class="text-navy">2 hour ago</small>
                            </div>
                            <div class="col-sm-9 content no-top-border ">
                                <p class="m-b-xs"><strong>Mockup Uploaded</strong> <a href="{{ asset('assets/images/no-image.jpg') }}" target="_blank"><span class="label label-default">view large <i class="fa fa-external-link" aria-hidden="true"></i></span></a></p>
                                <p>
                                    <img src="{{ asset('assets/images/no-image.jpg') }}" width="300" class="img-responsive">
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-sm-3 date left">
                                <i class="fa fa-th-large"></i>
                                6:00 am
                                <br>
                                <small class="text-navy">2 hour ago</small>
                            </div>
                            <div class="col-sm-9 content no-top-border ">
                                <p class="m-b-xs text-info"><i class="fa fa-user" aria-hidden="true"></i> <strong>Sourav Rakshit</strong></p>

                                <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products.</p>

                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-sm-3 date left">
                                <i class="fa fa-th-large"></i>
                                6:00 am
                                <br>
                                <small class="text-navy">2 hour ago</small>
                            </div>
                            <div class="col-sm-9 content no-top-border ">
                                <p class="m-b-xs text-success bg-info"><strong>MOCK-UP APPROVED <i class="fa fa-check-square" aria-hidden="true"></i></strong></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- admin upload mockup section --}}
            @if(! $order_item->mockup_approved)
            <div class="panel panel-card">

                <div class="panel-heading">
                    Upload generated digital proof (mock up)
                    <br>
                    <small class="text-warning text-lowercase">**as soon as mock-up uploaded, the user will be notified via email</small>
                </div>
                <div class="panel-body">
                    
                    <form>
                        <div class="form-group">
                            <label for="mockup">Upload Mockup: </label>
                            <input id="mockup" type="file" class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>

                </div>
            </div>
            @endif

        </div>

        <div class="col-md-4">

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Artwork Provided By Customer
                </div>
                <div class="panel-body">

                    @if($order_item->artwork)
                        <img class="img-responsive" src="{{ asset('storage/'.$order_item->artwork) }}">
                        <a href="{{ asset('storage/'.$order_item->artwork) }}" target="_blank" class="btn btn-default btn-sm">view large image</a>
                    @else
                        <img class="img-responsive" src="{{ asset('assets/images/no-image.jpg') }}">
                    @endif
                    
                </div>

                <div class="panel panel-info">
                        <div class="panel-heading bg-info">
                            To update the user provided artwork change it in here
                            <br>
                            <small class="text-danger text-lowercase">**this will replace any previous artwork provided by user</small>
                        </div>
                        <div class="panel-body">
                            
                            <form action="{{ route('order.mod.default.artwork', ['order_id' => $order_id, 'order_item_id' => $item_id]) }}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="file" name="artwork" class="form-control" accept=".jpeg,.png,.bmp,.gif,.svg" />
                                </div>

                                <button type="submit" class="btn btn-info">Update Default Artwork</button>
                            </form>

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
