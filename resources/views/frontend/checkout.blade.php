@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Checkout - Printing Amazon
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
			<div class="col-md-7">
				<form action="" id="checkout-form">
					<div class="form-group">
						<label>Full Name:</label>
						<input type="text" class="form-control" value="Sourav Rakshit" readonly="readonly">
				    </div>

				    <div class="form-group">
						<label>Email ID:</label>
						<input type="text" class="form-control" value="srv.nxr@gmail.com" readonly="readonly">
				    </div>

				    <div class="form-group">
						<label>Country:</label>
						<select class="form-control">
							<option>India</option>
						</select>
				    </div>

				    <div class="form-group">
						<label>Company:</label>
						<input type="text" class="form-control" >
				    </div>

				    <div class="form-group">
						<label>Street Address:</label>
						<textarea class="form-control"></textarea>
				    </div>

				    <div class="form-group">
						<label>City:</label>
						<input type="text" class="form-control" >
				    </div>

				    <div class="form-group">
						<label>State:</label>
						<input type="text" class="form-control" >
				    </div>

				    <div class="form-group">
						<label>Zipcode:</label>
						<input type="text" class="form-control" >
				    </div>

				    <div class="form-group">
						<label>Phone:</label>
						<input type="text" class="form-control" >
				    </div>

				    <input id="nonce" name="payment_method_nonce" type="hidden" />

				    {{-- braintree dropin ui --}}
				    <div id="bt-dropin"></div>

    				<button type="submit" class="btn btn-default">Submit</button>
  				</form>
			</div>

			<div class="col-md-5">
				<div class="checkout-summary">
					<h4 class="cart-head">Order Summary</h4>
					<table class="table table-responsive">
						<tbody>
							<tr>
								<td>
									<ol>
										<li>Die cut stickers x 500 qty.</li>
										<li>Free shaping stickers x 500 qty.</li>
									</ol>
								</td>

								<td class="summary-price">
									<ul>
										<li><h5><i class="fa fa-usd" aria-hidden="true"></i> 137</h5></li>
										<li><h5><i class="fa fa-usd" aria-hidden="true"></i> 137</h5></li>
									</ul>
									
								</td>
							</tr>

							<tr class="happy-text">
								<td>Discount For Multiple Designs</td>
								<td class="text-right"><h5 id="cart-discount"><i class="fa fa-usd" aria-hidden="true"></i> 95</h5></td>
							</tr>
							<tr>
								<td>Total</td>
								<td class="text-right"><h5 class="price" id="tot-price"><i class="fa fa-usd" aria-hidden="true"></i> {{ session('payable') }}</h5></td>
							</tr>
							<tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div><!-- feature -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	<script type="text/javascript" src="{{ asset('assets/frontend/js/payment.js') }}"></script>

@endpush
