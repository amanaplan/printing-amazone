@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			About Us - Printing Amazon
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
		<div class="">
		<h2 style="margin-bottom:30px;">About Us</h2>
			<div class="row">
				<div class="col-md-12 col-sm-12 content">
					
					<p>We exist to provide our clients with <b>GREAT BENEFITS, BEST QUALITY</b> print outcomes and deliver to them at the appropriate time. We create great design and believe it can work wonders for every business. That’s why we make it simple to create beautiful, expertly crafted business stationery and promotional materials that’ll help you start conversations, open doors and strengthen relationships.</p>

					<strong>Our innovations for your success.</strong>

					<p>Modern consumers expect to be able to create and order their personalized photo and print products not only via the web or a desktop application but also via tablets and smartphones. This creates the challenge of providing powerful solutions not only for multiple device types but also for different and even upcoming operating systems.</p>

					<p>We’re dedicated to bringing you Custom stickers, business cards, postcards and print quality that helps you stand out. After all, helping your business look good on paper is what inspired us from the start!</p>

					<strong>At Printing Amazon, we know the value of your TIME!</strong>

					<p>TIME cannot be bought or get refunded. Giving our client bad experiences means that we wasted their most valuable and unreturnable resources, TIME! Printing Amazon always strives to step towards 0% defects and 200% pleasant experiences for all our clients.</p>

					<strong>Free shipping</strong>

					<p>Do you dislike surprise shipping fees during checkout? Printing Amazon offers free shipping on all Australia orders.</p>

					<strong>Print your ideas from anywhere, anytime!</strong>

					<p>You can have easy access to our fantastic web via your mobile and tablet and on your PC. Our page is surprisingly mobile friendly and always ready to print your ideas anytime.</p>

					<strong>Guaranteed Quality</strong>

					<p>If you have had bad experiences with printing something in the past, simply dump your bad memories into the trash bin. We always check your final printed outcome through our Quality Control team before the shipping process. If you get any bad experiences or changes you need with our outcome, simply take a photo with your mobile, upload the image and let us know why you are not happy. We respect all our clients’ valuable feedbacks and we will fix the problem REAL FAST.</p>

					<strong>Product & Service development</strong>

					<p>Printing Amazon will continuously develop new products and services for all our clients. We keep research market trend and strive to seek any valuable new products and services that can help and amaze our clients.</p>


				</div>
			</div><!-- row -->
			<div class="clearfix"></div>
		</div><!-- contact-dtls -->
	</div>
</div><!-- feature -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	

@endpush
