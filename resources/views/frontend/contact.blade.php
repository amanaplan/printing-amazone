@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Contact Us - Printing Amazon
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
		<div class="contact-dtls">
		<h2 style="margin-bottom:30px;">Contact Us</h2>
			<div class="row">
				<div class="col-sm-6">
					<input type="text" placeholder="Enter your Name" required="required">
				</div>
				<div class="col-sm-6">
					<input type="email" placeholder="Enter your Mail ID" required="required">
				</div>
			</div><!-- row -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-sm-6">
					<input type="text" placeholder="Enter your Subject">
				</div>
				<div class="col-sm-6">
					<input type="file" placeholder="No file chosen" accept=".jpg,.png,.gif,.psd,.bmp,.jpeg" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" id="filename" class="form-control" placeholder="No file chosen" disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" class="btn btn-primary "><span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> <span class="buttonText">Choose file</span></label></span></div>
				</div>
			</div><!-- row -->
			<div class="clearfix"></div>
			
			<div class="row">
				<div class="col-sm-12">
					<textarea type="text" placeholder="Type your Message"></textarea>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-sm-12">
					<input type="submit" class="submit-contact" value="Send Now">
				</div>
			</div>
			<div class="clearfix"></div>
		</div><!-- contact-dtls -->
	</div>
</div><!-- feature -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("input:file").change(function(e){
				let file = e.target.files[0].name;
				if(file != '')
				{
					$("input#filename").val(file);
				}
				else
				{
					$("input#filename").val('');
				}
			});
		});
	</script>

@endpush
