@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			{{ $page->title }}
		@endslot

		@slot('meta_desc')
			{{ $page->meta_desc }}
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
		<div class="">
		<h2 style="margin-bottom:30px;">{{ $page->page_name }}</h2>
			<div class="row">
				<div class="col-md-12 col-sm-12 content">
					
					{!! $page->contents !!}


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
