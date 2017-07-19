@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of published product reviews
@stop

{{-- page specific css --}}
@push('styles')
    
    {{-- css switch --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/switch.css') }}">

@endpush

{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Manage Published Reviews</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>reviews</li>
                        <li>published</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Published Reviews <code>Total:{{ $reviews->total() }}</code>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/product/reviews/unpublished') }}" class="btn btn-info btn-rounded btn-xs">check pending</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Details</th>
                                    <th>Product</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Rating</th>
                                    <th>Posted On</th>
                                    <th>Publish / Unpublish</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($reviews as $review)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <p><img src="{{ getTheCustomerPic($review->user->id) }}" width="80"></p>
                                        <p><i class="fa fa-user"></i> {{ $review->user->name }}</p>
                                        <p><i class="fa fa-envelope"></i> {{ $review->user->email }}</p>
                                    </td>
                                    <td><span class="label label-primary">{{ $review->product->product_name }}</span> <a href="{{ url('/'.$review->product->category->category_slug.'/'.$review->product->product_slug) }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                                    <td>{{ $review->title }}</td>
                                    <td>{{ $review->description }}</td>
                                    <td>{!! genRatedStar($review->rating) !!}</td>
                                    <td>{{ \Carbon\Carbon::parse($review->created_at)->toDayDateTimeString() }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" onchange="toggleReview({{$review->id}}, this)" checked>
                                            <div class="slider round"></div>
                                        </label>
                                    </td>
                                    <td><a href="{{ url('/admin/product/review/update/'.$review->id) }}"><i class="fa fa-pencil"></i></a></td>
                                    <td><button type="button" class="btn btn-default" onclick="DeleteReview({{$review->id}}, this);"><i class="fa fa-trash"></i></button></td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-8 col-md-offset-4">
                        {{ $reviews->links() }}
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div><!-- End .panel --> 


        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')
    
    <script>
        function toggleReview(id, elem){
            $(elem).prop('disabled',true);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('/admin/product/review/toggle-publish') }}",
                type: "PUT",
                data: {id:id},
                success: function(result){
                    $(elem).prop('disabled',false);
                    Command: toastr["success"]("Action Performed Successfully", "Successfully Done. .");
                    $(elem).closest("tr").fadeOut();
                },
                error: function(xhr,status,error){
                    Command: toastr["error"](error, "Error Occurred. .");
                }
            });

            $.ajax();
        }

        function DeleteReview(id, elem){
            let conf = confirm('Sure! this review will be removed');
            if(conf == true)
            {
                $(elem).prop('disabled',true);
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: "{{ url('/admin/product/review/delete') }}",
                    type: "DELETE",
                    data: {id:id},
                    success: function(result){
                        $(elem).prop('disabled',false);
                        Command: toastr["success"]("Review Removed Successfully", "Successfully Done. .");
                        $(elem).closest("tr").fadeOut();
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