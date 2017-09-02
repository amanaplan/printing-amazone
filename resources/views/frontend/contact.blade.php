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

	{{-- recaptcha --}}
	<script src='https://www.google.com/recaptcha/api.js'></script>

@endpush

{{-- main page contents --}}
@section('contents')

<div class="feature custom">
	<div class="container">

		{{-- overlay --}}
		<div id="loading-overlay">
		  	<div id="overlay-text">
		  		<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
		  	</div>
		</div>

		<div class="contact-dtls">

			@if(session('formError'))
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Oops!</strong> {{ session('formError') }}
				</div>
			@elseif(session('request_ok'))
				<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Thank you!</strong> your message was sent successfully, we'll get back to you soon
				</div>
			@endif

		<form action="{{ route('contact.request') }}" enctype="multipart/form-data" method="post" id="contact-form">

			{{ csrf_field() }}

			<h2 style="margin-bottom:30px;">Contact Us</h2>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="name" value="{{ old('name') }}" class="{{ ($errors->has('name'))? 'has-error' : '' }}" placeholder="Your Full Name*" required="required" />
						@if($errors->has('name'))
							<span class="text-danger">{{ $errors->first('name') }}</span>
						@endif
					</div>
					<div class="col-sm-6">
						<input type="email" name="email" value="{{ old('email') }}" class="{{ ($errors->has('email'))? 'has-error' : '' }}" placeholder="Your E-Mail ID*" required="required" />
						@if($errors->has('email'))
							<span class="text-danger">{{ $errors->first('email') }}</span>
						@endif
					</div>
				</div><!-- row -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="subject" value="{{ old('subject') }}" placeholder="Enter Subject">
					</div>
					<div class="col-sm-6">
						<input type="file" name="attachment" placeholder="No file chosen" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group" style="z-index: 1;"><input type="text" id="filename" class="form-control {{ ($errors->has('attachment'))? 'has-error' : '' }}" placeholder="No file chosen" disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" class="btn btn-primary "><span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> <span class="buttonText">Choose file</span></label></span></div>
						@if($errors->has('attachment'))
							<span class="text-danger">{{ $errors->first('attachment') }}</span>
						@endif
					</div>
				</div><!-- row -->
				<div class="clearfix"></div>
				
				<div class="row">
					<div class="col-sm-12">
						<textarea type="text" class="{{ ($errors->has('message'))? 'has-error' : '' }}" name="message" placeholder="Type your Message. . ." required="required">{{ old('message') }}</textarea>
						@if($errors->has('message'))
							<span class="text-danger">{{ $errors->first('message') }}</span>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="g-recaptcha" data-sitekey="6LcSHy8UAAAAAM4Sb3Y7xjZonfkKNRoWYq3JGxU-" data-theme="dark"></div>
					</div>
				</div>

				<div class="clearfix"></div>
				<div class="row">
					<div class="col-sm-12">
						<input type="submit" id="submit-btn" class="submit-contact" value="Send Now">
					</div>
				</div>
				<div class="clearfix"></div>

			</form>

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

			$("form#contact-form").submit(function(){
				$("input#submit-btn").prop('disabled', true);
				$("#loading-overlay").show();
			});
		});
	</script>

@endpush
