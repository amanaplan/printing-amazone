@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Approve Mock-Up - Printing Amazon
		@endslot

		@slot('meta_desc')
			
		@endslot

		@slot('og_image')
			
		@endslot
	@endcomponent

@stop

{{-- page specific styles --}}
@push( 'styles' )
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/artwork-review.css') }}" />

@endpush

{{-- main page contents --}}
@section('contents')

<div class="feature custom">
	<div class="container">
		<h2 style="margin-bottom:30px;">Review Mockup</h2>
		<div class="row">
			<div class="bg-default col-sm-12 col-md-4 col-lg-4">

				<div class="art-card">
					<div class="row cart-dtls">
						<div class="col-sm-12">
							<p>
								<strong>Order ID:</strong>
								<span class="pull-right text-info">123456789</span>
							</p>
						</div>
					</div>

					<div class="row cart-dtls">
						<div class="col-sm-12 col-md-6">
							<div class="pull-left">
								<a href="#">
									<img class="img-rounded img-responsive pull-right" src="http://printingamazon.dev/assets/images/products/Square-Stickers.png">
									<br/>
									<p>Square/Rectangle</p>
								</a>
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="pull-right text-left order-spec">
								<p>50 x 50 mm</p>
								<p>Glossy Paper</p>
							</div>
						</div>
					</div>

					<div class="uploaded-artwork">
						<h4>Artwork Uploaded by You:</h4>
						<img class="img-responsive" src="{{ asset('storage/artworks/IlzYrzwDzivlphZ4W2oqDJMPqIYxETOfnN2b1tTK.jpeg') }}" />
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-8 col-lg-8">

				<div class="art-card">

					<h3 id="mockup-ready">GENERATED MOCKUP</h3>

					<div class="mockup">
						<p class="text-center">
							<img class="img-responsive" src="{{ asset('storage/artworks/3UD5G2JndA7dfLYwTO7Zi7BCdge1fbEnoCTPjndr.png') }}" />
						</p>
					</div>

					<div class="adjustment-form">
						
					</div>
				</div>
				
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
</div>

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	

@endpush
