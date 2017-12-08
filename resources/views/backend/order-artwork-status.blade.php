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
                            <a href="{{ $back_url }}" class="btn btn-info btn-rounded btn-xs">< Back to order details</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    @if($timeline)

                        @foreach($timeline as $item)

                            @php
                                $added = Carbon\Carbon::parse($item->created_at);
                                $moded = Carbon\Carbon::parse($item->updated_at);

                            @endphp

                            <div class="timeline-item">
                                <div class="row">
                                    <div class="col-sm-3 date left">
                                        <i class="fa fa-th-large"></i>
                                        {{ $added->format('jS M y, h:i: A') }}
                                        <br>
                                        <small class="text-navy">{{ $added->diffForHumans() }}</small>
                                    </div>
                                    <div class="col-sm-9 content no-top-border ">
                                        <p class="m-b-xs"><strong>Mockup Uploaded</strong> 
                                        <a href="{{ asset('storage/'.$item->mockup) }}" target="_blank"><span class="label label-default">view large <i class="fa fa-external-link" aria-hidden="true"></i></span></a></p>
                                        <p>
                                            <img src="{{ asset('storage/'.$item->mockup) }}" width="300" class="img-responsive">
                                        </p>

                                    </div>
                                </div>
                            </div>

                            @if($item->review_text)
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-sm-3 date left">
                                            <i class="fa fa-th-large"></i>
                                            {{ $moded->format('jS M y, h:i: A') }}
                                            <br>
                                            <small class="text-navy">{{ $moded->diffForHumans() }}</small>
                                        </div>
                                        <div class="col-sm-9 content no-top-border ">
                                            <p class="m-b-xs text-info">
                                                <i class="fa fa-user" aria-hidden="true"></i> 
                                                <strong>{{ $customer }}</strong>
                                            </p>

                                            <p>{{ $item->review_text }}</p>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($item->approved)
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-sm-3 date left">
                                            <i class="fa fa-th-large"></i>
                                            {{ $moded->format('jS M y, h:i: A') }}
                                            <br>
                                            <small class="text-navy">{{ $moded->diffForHumans() }}</small>
                                        </div>
                                        <div class="col-sm-9 content no-top-border ">
                                            <h5 class="well text-success bg-info" style="background: #7bff93;"><strong>MOCK-UP APPROVED <i class="fa fa-check-circle fa-lg" aria-hidden="true"></i></strong></h5>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach


                    @else

                        <div class="jumbotron">
                            <h3>No data yet. . .</h3>
                            <p>Upload mockup to notify user that digital proof is ready</p>
                        </div>

                    @endif

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
                    
                    <form action="{{ route('order.upload.digitalproof', ['order_id' => $order_id, 'order_item_id' => $item_id]) }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="mockup">Upload Mockup: </label>
                            <input type="file" required="required" name="mockup" class="form-control" accept=".jpg,.jpeg,.png,.bmp,.gif,.svg" />
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
                    Artwork(s) Provided By Customer
                </div>
                <div class="panel-body">

                    @if($order_item->orderartworks->count() > 0)
                        @foreach($order_item->orderartworks as $art)
                        <div style="position:relative;text-align: center;padding-bottom: 20px;">
                            <img class="img-responsive img-thumbnail" width="200" src="{{ asset('storage/'.$art->artwork) }}" onerror="showFileImg(this);">
                            <span style="position:absolute; top:0; roght:0;" onclick="removeDefaultArtwork({{$art->id}}, this);" data-toggle="tooltip" title="remove the artwork">
                                <a href="javascript:void();" class="text-danger"><i class="fa fa-times-circle fa-lg fa-2x"></i></a>
                            </span>
                        </div>
                        @endforeach
                    @else
                        <img class="img-responsive" src="{{ asset('assets/images/no-image.jpg') }}">
                    @endif
                    
                </div>

                <div class="panel panel-info">
                        <div class="panel-heading bg-info">
                            To update the user provided artwork(s) change it in here
                            <br>
                            <small class="text-danger text-lowercase">**remove / add artwork(s) on behalf of customer</small>
                        </div>
                        <div class="panel-body">
                            
                            <form action="{{ route('order.mod.default.artwork', ['order_id' => $order_id, 'order_item_id' => $item_id]) }}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="file" required="required" name="artwork[]" multiple="multiple" class="form-control" accept=".jpg,.jpeg,.png,.bmp,.gif,.svg" />
                                </div>

                                <button type="submit" class="btn btn-info">Update Default Artwork(s)</button>
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

    <script type="text/javascript">
        function showFileImg(elem){
            $(elem).attr('src', "{{asset('assets/images/sample-file.png')}}");
        }

        function removeDefaultArtwork(artwork_id, elem){
            const conf = confirm('sure to remove this artwork permanently!');
            if(conf === true){
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: "{{ route('order.remove.default.artwork') }}",
                    type: "DELETE",
                    data: {artwork_id:artwork_id},
                    success: function(result){
                        $(elem).closest('div').remove();
                        Command: toastr["success"]("Action Performed Successfully", "Successfully Done. .");
                    },
                    error: function(xhr,status,error){
                        Command: toastr["error"](error, "Error Occurred. .");
                    }
                });
                $.ajax();
            }
        }
    </script>

@endpush
