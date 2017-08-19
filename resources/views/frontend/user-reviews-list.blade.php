@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>My Reviews | {{ config('app.name') }}</title>

@stop

{{-- page specific styles --}}
@push( 'styles' )
	@include('layouts.frontend.userpanel-styles')

@endpush

{{-- main page contents --}}
@section('contents')

<div class="dashboard-area">
		<div class="container">
			<div class="row dasboard">
			
			<div class="col-lg-3 col-sm-4 left-part">
				@include('layouts.frontend.user-sidebar')
			</div>

			<div class="col-lg-9 col-sm-8 right-part">
				
		
    @if(session('flashtype'))
    <div class="alert alert-{{ session('flashtype') }}">{{ session('flashmsg') }}</div>
    @endif

    <div class="white-box profile-form">
		<div class="col-md-6"><h2>Given Reviews</h2></div>
		<div class="col-md-6"><div class="well well-sm"><code>Published: {{ $published }},  Pending: {{ $pending }}</code></div></div>
		<div class="col-md-4 col-md-offset-8"><a href="{{ url('/user/review/share') }}" class="btn btn-primary pull-right">Give a Review</a></div>
		<div class="clearfix"></div>

		<div class="my-reviews">
			@if($reviews->count() == 0)

				<div class="row">
					<div class="col-md-1 col-md-offset-2">
						<img src="{{ asset('assets/images/sad.png') }}" width="50">
					</div>
					<div class="col-md-5"><h1>You have not posted any review yet</h1></div>
				</div>

			@else

				@foreach($reviews as $review)

					<div class="my-review-item">
						<div class="title">
							<div class="heading">{{ $review->title }}</div>
							@if($review->publish == 0)
								&nbsp; 
								<span class="label label-warning">pending</span> 
								<a href="{{ url('/user/review/edit/'.$review->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a>
							@endif
						</div>
							@if($review->publish == 1)
								<span class="text-success" data-toggle="tooltip" data-placement="top" title="published">&nbsp; <i class="fa fa-check-circle"></i></span>

								@if($review->product->category->category_slug == 'uncategorized')

									<a href="{{ url('/'.$review->product->product_slug) }}" target="_blank"> &nbsp; <i class="fa fa-external-link"></i></a> 

								@else

									<a href="{{ url('/'.$review->product->category->category_slug.'/'.$review->product->product_slug) }}" target="_blank"> &nbsp; <i class="fa fa-external-link"></i></a> 

								@endif
							@endif
						<br>
						<span class="rating-stars rating-5">
							
							{!! genRatedStar($review->rating) !!}

						</span>
						<span> &nbsp; {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
						<div class="review-text">
							{{ $review->description }}
						</div>
					</div>

				@endforeach

				<div class="row">
					{{ $reviews->links() }}
				</div>

			@endif
			
		</div>

	</div>

					
			</div>
			<div class="clearfix"></div>
		</div>
		</div><!-- container -->
	</div><!-- dashboard-area -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

@endpush
