@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Download Stickers Template - Printing Amazon
		@endslot

		@slot('meta_desc')
			
		@endslot

		@slot('og_image')
			
		@endslot
	@endcomponent

@stop

{{-- page specific styles --}}
@push( 'styles' )
	
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/css/inner.css' ) }}" media="all" type="text/css"/>

@endpush

{{-- main page contents --}}
@section('contents')

<div class="feature custom" style="margin-top: 40px;">
	<div class="container">
		<div class="">
		<h2 style="margin-bottom:30px;">Our Sticker Templates</h2>
			<div class="row">
				<div class="col-md-12 col-sm-12 content">
					
					<div id="react-zone"></div>

				</div>
			</div><!-- row -->
			<div class="clearfix"></div>
		</div><!-- contact-dtls -->
	</div>
</div><!-- feature -->

@stop

@include ('layouts.frontend.phpvartojs')


{{-- page specific scripts --}}
@push( 'scripts' )
	
	<script type="text/javascript" src="{{ asset('assets/frontend/js/template.js') }}"></script>

@endpush
