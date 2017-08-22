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
			<div class="col-md-4">

				{{-- dd(Session::all()) --}}

				<ul>
					<li>
						<a href="#"><img class="img-responsive" width="80" height="80" src="http://localhost/srv/printing-amazone/public/assets/images/products/cs-3.png"> Square Stickers</a>
					</li>
					<li>Size : 20 x 20 mm</li>
					<li>Qty. : 200</li>
				</ul>

				<br/>

				<div id="artwork-prvw" style="display: none;">
					<img id="prvw-img" class="img-responsive img-rounded" id="artwork-prvw" width="400" src="#" onerror="showFileImg(this);" />
					<button id="rem-artwork" type="button" style="margin-top: 10px;display: none;" class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i> Remove</button>
				</div>
			</div>

			<div class="col-md-8">
				<h2>Upload your Artwork</h2>

				<div class="file-upload">
					<input type="file" class="filestyle" id="upload" tabindex="-1" data-buttonname="btn-info" placeholder="No file Chosen" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control " placeholder="" disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="upload" class="btn btn-primary "><span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> <span class="buttonText"> Choose file</span></label></span></div>
					
					<div class="field" id="op-progress" style="display: none;">
						<div id="output" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:00%">
      						0%
    					</div>
					</div>
					<div class="field" >
					</div>
					<br/>

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
	
	{{-- sweet alert --}}
	<script type="text/javascript" src="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.min.js' ) }}"></script>

	<script type="text/javascript" src="{{ asset('assets/frontend/js/uploadArtwork.js') }}"></script>

	<script type="text/javascript">
		function showFileImg(elem)
		{
			elem.src="{{ asset('assets/images/sample-file.png') }}";
		}
	</script>

@endpush