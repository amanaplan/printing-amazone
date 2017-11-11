@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Review Mock-Up - Printing Amazon
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
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">

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
								<span class="pull-right text-info">{{ $order_token }}</span>
							</p>
						</div>
					</div>

					<div class="row cart-dtls">
						<div class="col-sm-12 col-md-6">
							<div class="pull-left">
								<a href="{{ $product['url'] }}" target="_blank">
									<img class="img-rounded img-responsive pull-right" src="{{ asset('assets/images/products/'. $product['logo']) }}">
									<br/>
									<p>{{ $product['name'] }}</p>
								</a>
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="pull-right text-left order-spec">
								<p>{{ $dimension }} mm<sup>2</sup></p>
								<p>{{ $paperstock }}</p>
							</div>
						</div>
					</div>

					<div class="uploaded-artwork">
						<h4>Artwork Uploaded by You:</h4>
						<img class="artwork-img img-responsive" onclick="showLargeImage(this);" src="{{ $user_artwork }}" />
					</div>

					<div class="clearfix"></div>

					<div class="row">
						<div class="page-header">
							<h1 id="timeline">Conversation History</h1>
						</div>
						<ul class="timeline">

							@if($user_desc)
							<li class="timeline-inverted">
								<div class="timeline-badge info"><i class="fa fa-commenting-o" aria-hidden="true"></i></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
									  	<h4 class="timeline-title">{{ $order_date }}</h4>
									</div>
									<div class="timeline-body">
									  	<p>{{ $user_desc }}</p>
									</div>
								</div>
							</li>
							@endif

							@foreach($mockups as $mockup)

								<li class="timeline-inverted">
									<div class="timeline-badge success"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
										  	<h4 class="timeline-title">{{ Carbon\Carbon::parse($mockup->created_at)->toFormattedDateString() }}</h4>
										</div>
										<div class="timeline-body">
										  	<img src="{{ asset('storage/'. $mockup->mockup) }}" onclick="showLargeImage(this);" class="artwork-img thumbnail img-responsive">
										</div>
									</div>
								</li>

								@if($mockup->review_text)
									<li class="timeline-inverted">
										<div class="timeline-badge info"><i class="fa fa-commenting-o" aria-hidden="true"></i></div>
										<div class="timeline-panel">
											<div class="timeline-heading">
											  	<h4 class="timeline-title">{{ Carbon\Carbon::parse($mockup->updated_at)->toFormattedDateString() }}</h4>
											</div>
											<div class="timeline-body">
											  	<p>{{ $mockup->review_text }}</p>
											</div>
										</div>
									</li>
								@endif

							@endforeach
							
						</ul>
					</div>

				</div>
			</div>

			<div class="col-sm-12 col-md-8 col-lg-8">

				<div class="art-card">

					<h3 id="mockup-ready">GENERATED MOCKUP</h3>

					@if(! $mockup_ready)
						<div class="jumbotron">
							<h3 style="font-size: 31px;">Your mockup is not ready yet, we are working on it</h3>
							<br/>
							<h4>We'll notify you via email once it is ready</h4>
						</div>

						<a class="btn btn-info" href="{{ url('/contact') }}">Feel free to contact us</a>
					@else
						<div class="row">
							<div class="mockup">
								<p class="text-center">
									<img class="artwork-img img-responsive" onclick="showLargeImage(this);" src="{{ asset('storage/'. $latest_mockup) }}" />
								</p>
							</div>
						</div>


						<div class="adjustment-form">

							<div id="react-zone"></div>

						</div>
					@endif

					
				</div>
				
			</div>
		</div>

		<!-- The Modal -->
		<div id="myModal" class="mymodal">
		  <span class="close">&times;</span>
		  <img class="mymodal-content" id="img01">
		  <div id="caption"></div>
		</div>

		<div class="clearfix"></div>
	</div>
</div>

@stop

{{-- page specific scripts --}}
@push( 'scripts' )

@include( 'layouts.frontend.phpvartojs' )
	
<script>
	function showLargeImage(img)
	{
		// Get the modal
		var modal = document.getElementById('myModal');
		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		modal.style.display = "block";
		modalImg.src = img.src;
		captionText.innerHTML = img.alt;

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
		    modal.style.display = "none";
		}
	}
</script>

<script type="text/javascript" src="{{ asset( 'assets/frontend/js/mockup-review.js' ) }}"></script>

@endpush
