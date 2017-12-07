@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Upload Artwork - Printing Amazon
		@endslot

		@slot('meta_desc')
			
		@endslot

		@slot('og_image')
			
		@endslot
	@endcomponent

@stop

{{-- page specific styles --}}
@push( 'styles' )
	
	{{-- sweet alert --}}
	<link rel="stylesheet" type="text/css" href="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.css' ) }}" />

@endpush

{{-- main page contents --}}
@section('contents')

<div class="artwork">
	<div class="container">
		
		<div class="row">

			{{-- for react to take control --}}
			<div id="upload-artwork-app"></div>

		</div>
	</div><!-- container -->
</div>

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	
	@include('layouts.frontend.phpvartojs')

	{{-- sweet alert --}}
	<script type="text/javascript" src="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.min.js' ) }}"></script>

	<script type="text/javascript" src="{{ asset('assets/frontend/js/artwork-main.js') }}"></script>

@endpush
