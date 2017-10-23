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
		<div class="container">

		<!--========= First slide =========-->
		<div class="item active">
			<img src="{{ asset( 'assets/images/one_color_slider.png' ) }}" alt="slider 01" />
			<div class="carousel-caption one_color_blue_carousel_caption">
				<img src="{{ asset( 'assets/images/banner-img1.png' ) }}" alt="slider 01" class="img-responsive" />
				<div class="one_color_blue_carousel_caption_text">
					<h1>{!! $text1 !!}</h1>
					<p>{!! $text2 !!}</p>
					<a href="{{ $url1 }}" class="pink">{{ $btn1 }}</a><a href="{{ $url2 }}" class="green">{{ $btn2 }}</a>
				</div>						
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

				@if($prods)
					@foreach($prods->chunk(3) as $chunk)
						@foreach ($chunk as $prod)
								<a href="{{ url('/') .'/'. $prod->url }}">
								<div class="col-sm-4 col-lg-4 dtls-box">
									<img src="{{ asset( 'assets/images/products/'.$prod->logo ) }}" />
									<h2>{{ $prod->name }}</h2>
								</div>
							</a>
						@endforeach
						
						<div class="clearfix"></div>

					@endforeach
				@endif

				<div class="clearfix"></div>
			</div><!-- feature-dtls -->
		</div><!-- row -->
	</div><!-- container -->
</div><!-- feature -->
	

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

@endpush
