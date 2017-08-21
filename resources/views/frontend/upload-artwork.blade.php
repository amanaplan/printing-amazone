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
	
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/css/star-rating.css' ) }}" media="all" type="text/css"/>

@endpush

{{-- main page contents --}}
@section('contents')

<div class="artwork">
	<div class="container">
		
		<div class="row">
			<div class="col-md-4">

				{{ dd(Session::all()) }}

				<ul>
					<li>
						<a href="#"><img class="img-responsive" width="80" height="80" src="http://localhost/srv/printing-amazone/public/assets/images/products/cs-3.png"> Square Stickers</a>
					</li>
					<li>Size : 20 x 20 mm</li>
					<li>Qty. : 200</li>
				</ul>
			</div>

			<div class="col-md-8">
				<h2>Upload your Artwork</h2>

				<div class="file-upload">
					<input type="file" class="filestyle" data-buttonname="btn-primary" placeholder="No file Chosen" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control " placeholder="" disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" class="btn btn-primary "><span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> <span class="buttonText">Choose file</span></label></span></div>
					<div class="field">
						<label for="instruction">Instruction (Optional)</label>
						<textarea row="8" placeholder="Let us know if you have any instructions to prepare your proof"></textarea>
					</div>
				</div>
				<p id="skip-step">
				  or,
				  <button class="skip-upload-button">skip this step &amp; email artwork later.</button>
				</p>
			</div><!-- row -->
		</div>
	</div><!-- container -->
</div>

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	

@endpush
