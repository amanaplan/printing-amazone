@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			{{ $category->title }}
		@endslot

		@slot('meta_desc')
			{{ $category->meta_desc }}
		@endslot

		@slot('og_image')
			{{ asset('assets/images/category/'.$category->og_img) }}
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
			<h2>{{ $category->category_name }}</h2>

			@if($avgrate)

			<div class="review">

				<span class="avg-rating">{!! genRatedStar($avgrate) !!}</span>

				<span>{{ number_format($totgiven) }} review{{ ($totgiven > 1)? 's' : '' }}</span>
			</div>

			@endif

			<div class="feature-dtls">

				{{-- the products --}}
				@foreach ($category->products->chunk(3) as $chunk)

				    <div class="row">
				        @foreach ($chunk as $product)
				        	<a href="{{ url('/'.$category->category_slug.'/'.$product->product_slug) }}">
					            <div class="col-sm-4 col-lg-4 dtls-box">
					            	<img src="{{ asset('assets/images/products/'.$product->logo) }}" />
					            	<h2>{{ $product->product_name }}</h2>
					            </div>
					        </a>
				        @endforeach
				    </div>
				    <div class="clearfix"></div>

				@endforeach

				
			</div><!-- feature-dtls -->
			<br/>
		</div><!-- row -->
	</div><!-- container -->
</div><!-- feature -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	

@endpush
