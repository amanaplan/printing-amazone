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
						<img class="artwork-img img-responsive" onclick="showLargeImage(this);" src="{{ asset('storage/artworks/IlzYrzwDzivlphZ4W2oqDJMPqIYxETOfnN2b1tTK.jpeg') }}" />
					</div>

					<div class="clearfix"></div>

					<div class="row">
						<div class="page-header">
							<h1 id="timeline">Conversations</h1>
						</div>
						<ul class="timeline">
							<li class="timeline-inverted">
								<div class="timeline-badge info"><i class="fa fa-commenting-o" aria-hidden="true"></i></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
									  	<h4 class="timeline-title">Wed, 10th Nov 17</h4>
									</div>
									<div class="timeline-body">
									  	<p>I want it little more colorful and glossy, & remove the border make it runded corner</p>
									</div>
								</div>
							</li>

							<li class="timeline-inverted">
								<div class="timeline-badge success"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
									  	<h4 class="timeline-title">Sat, 11th Nov 17</h4>
									</div>
									<div class="timeline-body">
									  	<img src="{{ asset('storage/Small-17.jpg') }}" onclick="showLargeImage(this);" class="artwork-img thumbnail img-responsive">
									</div>
								</div>
							</li>
						</ul>
					</div>

				</div>
			</div>

			<div class="col-sm-12 col-md-8 col-lg-8">

				<div class="art-card">

					<h3 id="mockup-ready">GENERATED MOCKUP</h3>

					<div class="row">
						<div class="mockup">
							<p class="text-center">
								<img class="artwork-img img-responsive" onclick="showLargeImage(this);" src="{{ asset('storage/temp.jpg') }}" />
							</p>
						</div>
					</div>

					<div class="adjustment-form">

						<!-- <div class="row">
							<input class="btn btn-success btn-pill d-flex ml-auto mr-auto" type="submit" value="Approve Mockup">
							<a href="#">or, Make an Adjustment</a>
						</div> -->

						<div class="row">
							<div class="col-sm-12 com-md-12">
								<div class="form-group">
									<textarea class="form-control review-msg" rows="10" placeholder="Enter your message..." name="message"></textarea>
								</div>
								<div class="btns pull-left">
									<button type="submit" class="btn btn-info btn-pill d-flex ml-auto mr-auto" type="submit">Send Your Message</button>
									<button type="button" class="btn btn-warning btn-pill d-flex ml-auto mr-auto" type="submit">Cancel &amp; Approve Mockup</button>
								</div>
							</div>
						</div>

					</div>

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


@endpush
