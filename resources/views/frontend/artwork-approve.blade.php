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
	

@endpush

{{-- main page contents --}}
@section('contents')

<div class="feature custom">
	<div class="container">
		<h2 style="margin-bottom:30px;">Review Mockup</h2>
		<div class="row">
			<div class="bg-default col-sm-12 col-md-4 col-lg-4">

				<div class="row">
					<div class="col-sm-12">
						<p>
							<strong>Order ID:</strong>
							<span class="pull-right">123456789</span>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<p>
							<strong>Product:</strong>
							<span class="pull-right">
								<img class="img-rounded img-responsive pull-right" src="http://printingamazon.dev/assets/images/products/Square-Stickers.png">
								<br>
								<p>Square/Rectangle</p>
							</span>
						</p>
					</div>
				</div>

				<h4>Artwork Uploaded by You:</h4>
				<img class="img-responsive" src="{{ asset('storage/artworks/IlzYrzwDzivlphZ4W2oqDJMPqIYxETOfnN2b1tTK.jpeg') }}" />
			</div>

			<div class="col-sm-12 col-md-8 col-lg-8">

				<p class="text-center">
					<img class="img-responsive" src="{{ asset('storage/artworks/3UD5G2JndA7dfLYwTO7Zi7BCdge1fbEnoCTPjndr.png') }}" />
				</p>
				
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
</div>

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	

@endpush
