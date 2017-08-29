@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Order Confirmed - Printing Amazon
		@endslot

		@slot('meta_desc')
			
		@endslot

		@slot('og_image')
			
		@endslot
	@endcomponent

@stop

{{-- page specific styles --}}
@push( 'styles' )
	
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/css/star-rating.css' ) }}" media="all" type="text/css"/>

@endpush

{{-- main page contents --}}
@section('contents')

<div class="feature custom">
	<div class="container">

		<div class="row">

			<div class="col-md-6 col-md-offset-3 col-sm-12">

				<div class="panel panel-primary">
					<div class="panel-heading">YOUR ORDER PLACED SUCCESSFULLY</div>
					<div class="panel-body">
						<p>Your Order ID: <strong>{{ session('order_id') }}</strong></p>
						<p>Transaction ID: <strong>{{ session('transaction_id') }}</strong></p>
						<br>
						<p>You'll soon receive an confirmation email containing order information.</p>
						<br>
						<p>Thank you for purchasing from PrintingAmazon.</p>
					</div>
			    </div>

		   </div>

	    </div>

	</div>
</div><!-- feature -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	

@endpush
