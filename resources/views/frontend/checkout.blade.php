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
	<link href="{{ asset('assets/frontend/plugin/jquery.validator/theme-default.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.css' ) }}" />

@endpush

{{-- main page contents --}}
@section('contents')

<div class="feature custom checkout-page">
	<div class="container">

		<div class="row">
			<h2 class="checkout-head">
				Checkout
			</h2>
		</div>

		<div class="row">
			<div class="col-md-7">

				<form action="{{ route('checkout.post') }}" id="checkout-form" method="post">

					{{ csrf_field() }}

					<div class="form-group">
						<label>Full Name</label>
						@if(Auth::guard('web')->check())
						<input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly="readonly" />
						@else
						<input type="text" class="form-control" data-validation="length" data-validation-length="min5" name="name" placeholder="Enter Full Name" />
						@endif
				    </div>

				    <div class="form-group col-sm-6 col-xs-12 res-right" style="padding-left: 0;">
						<label>Email ID</label>
						@if(Auth::guard('web')->check())
						<input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly="readonly" />
						@else
						<input type="email" name="email" data-validation="email" class="form-control" />
						@endif
				    </div>

				    <div class="form-group col-sm-6 col-xs-12 res" style="padding-right: 0;">
						<label>Phone</label>
						<input name="phone" data-validation="custom" data-validation-regexp="^(\+{1})?\d+$" type="text" class="form-control" />
				    </div>
				    <div class="clearfix"></div>

				    <div class="form-group col-sm-6 col-xs-12 res-right" style="padding-left: 0;">
						<label>Country</label>
						<input type="text" value="Australia" class="form-control" readonly="readonly" />
				    </div>

				    <div class="form-group col-sm-6 col-xs-12 res" style="padding-right: 0;">
						<label>State</label>
						<input name="state" data-validation="required" type="text" class="form-control" />
				    </div>
				    <div class="clearfix"></div>

				    <div class="form-group col-sm-6 col-xs-12 res-right" style="padding-left: 0;">
						<label>Suburb</label>
						<input name="city" data-validation="required" type="text" class="form-control" />
				    </div>

				    <div class="form-group col-sm-6 col-xs-12 res" style="padding-right: 0;">
						<label>Post Code</label>
						<input name="zipcode" data-validation="required" type="text" class="form-control" />
				    </div>
				    <div class="clearfix"></div>

				    <div class="form-group">
						<label>Street Address</label>
						<textarea name="street" data-validation="required" class="form-control"></textarea>
				    </div>

				    <div class="form-group">
						<label>Company (optional)</label>
						<input type="text" name="company" class="form-control" />
				    </div>

				    <!-- <input type="hidden" name="payment_method_nonce" id="#nonce" /> -->

				    {{-- braintree dropin ui --}}
				    <div id="bt-dropin"></div>

				    <br>
				    <div class="form-group">
						<input type="checkbox" checked="checked" disabled="disabled" />
						<span>I agree with the <a href="#">Terms &amp; Conditions</a></span>
				    </div>
				    <div class="form-group">
						<input type="checkbox" checked="checked" disabled="disabled" />
						<span>I agree with the <a href="#">Estimated Delivery Time Policy</a></span>
				    </div>
				    <br>

    				<button type="submit" id="place-order" class="btn btn-info btn-lg">Place Order</button>
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
										@foreach($cart_items as $prod)
										<li><span>{{ $prod->product->product_name }}</span> x {{ $prod->qty }} qty.</li>
										@endforeach
									</ol>
								</td>

								<td class="summary-price">
									<ul>
										@foreach($cart_items as $prod)
										<li><h5><i class="fa fa-usd" aria-hidden="true"></i> {{ number_format($prod->price) }}</h5></li>
										@endforeach
									</ul>
									
								</td>
							</tr>

							<tr class="happy-text">
								<td>Discount For Multiple Designs</td>
								<td class="text-right"><h5 id="cart-discount"><i class="fa fa-usd" aria-hidden="true"></i> {{ session('discount') }}</h5></td>
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
	<script type="text/javascript" src="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.min.js' ) }}"></script>
	<script type="text/javascript" src="{{ asset('assets/frontend/js/payment.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/frontend/plugin/jquery.validator/jquery.form-validator.min.js') }}"></script>
	<script type="text/javascript">
		$.validate({
		  form : '#checkout-form'
		});
	</script>

@endpush
