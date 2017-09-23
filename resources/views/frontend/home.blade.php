@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Printing Amazon | Home
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

<div id="one_color_blue_carousel" class="carousel one_color_blue_carousel_fade animate_text one_color_blue_carousel_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">
		
	<!-- ========= Wrapper for slides  =========-->
	<div class="carousel-inner" role="listbox">

		<!--========= First slide =========-->
		<div class="item active">
			<img src="{{ asset( 'assets/images/one_color_slider.png' ) }}" alt="slider 01" />
			<div class="carousel-caption one_color_blue_carousel_caption">
				<img src="{{ asset( 'assets/images/banner-img1.png' ) }}" alt="slider 01" class="img-responsive" />
				<div class="one_color_blue_carousel_caption_text">
					<h1>Make your own<br> Custom <span>Stickers</span></h1>
					<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit<br> amet, consectetur, adipisci velit</p>
					<a href="{{ url('/contact') }}" class="pink">Contact Us</a><a href="{{ url('/preset-sized-stickers') }}" class="green">Shop Now</a>
				</div>						
			</div>
		</div>

	</div>

</div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
		
<div class="feature">
	<div class="container">
		<div class="row">
			<h2>Printing Amazon Features</h2>
			<div class="feature-dtls">
				<a href="{{ url('/sticker') }}"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f1.png' ) }}" />
					<h2>Custom Stickers</h2>
				</div></a>
				<a href="{{ url('/business-card') }}"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f2.png' ) }}" />
					<h2>Business Cards</h2>
				</div></a>
				<a href="{{ url('/postcards') }}"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f3.png' ) }}" />
					<h2>Postcards</h2>
				</div></a>
				<div class="clearfix"></div>
				<a href="{{ url('/brochuresflyers') }}"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f4.png' ) }}" />
					<h2>Decal Stickers</h2>
				</div></a>
				<a href="{{ url('/labels') }}"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f5.png' ) }}" />
					<h2>Label</h2>
				</div></a>
				<a href="{{ url('/graphic-designs') }}"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f6.png' ) }}" />
					<h2>Graphic Design</h2>
				</div></a>
				<div class="clearfix"></div>
			</div><!-- feature-dtls -->
		</div><!-- row -->
	</div><!-- container -->
</div><!-- feature -->
	

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

@endpush
