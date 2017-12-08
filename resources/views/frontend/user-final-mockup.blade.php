@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Final Mockup | {{ config('app.name') }}</title>

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
				
				<div class="white-box profile-form">
                    <h2>Final Approved Mockup</h2>
                    <div>
                        <span class="pull-left"><strong>Approved on:</strong> {{ Carbon\Carbon::parse($approved_on)->toDayDateTimeString() }}</span>
                        <a href="{{ url('/user/my-order/'.$order_token) }}" class="btn btn-info pull-right"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</a>
                    </div>
                    <div class="clearfix"></div>
                    
					<div class="table-responsive">
						<div class="clearfix"></div>
						@foreach($mockups as $mockupitem)
							<div class="col-md-4 col-sm-12">
								<img src="{{ asset('storage/'.$mockupitem->mockup) }}" width="200" class="img-responsive img-thumbnail" />
							</div>
						@endforeach
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
