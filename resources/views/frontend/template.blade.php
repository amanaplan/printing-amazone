@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Custom Stickers Template - Printing Amazon
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
					
					<ul class="nav nav-pills">
					  <li class="nav-item">
					    <a class="nav-link active" href="#">Stickers</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Magnets</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Badges</a>
					  </li>
					</ul>
					<div class="template-list">
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#" data-toggle="modal" data-target="#myModal">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Square stickers
							</a>
						</div>
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Rectangle stickers
							</a>
						</div>
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Circle stickers
							</a>
						</div>
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Oval stickers
							</a>
						</div>
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#" data-toggle="modal" data-target="#myModal">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Bumper stickers
							</a>
						</div>
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Die Cut stickers
							</a>
						</div>
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Rounded Corner stickers
							</a>
						</div>
						<div class="col-sm-3 col-xs-12 template-box">
							<a href="#">
								<img src="{{ asset('assets/images/products/Round-Corner.png') }}">
								Transfer stickers
							</a>
						</div>
						<div class="clearfix"></div>
					</div>

				</div>
			</div><!-- row -->
			<div class="clearfix"></div>
		</div><!-- contact-dtls -->
	</div>
</div><!-- feature -->

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <button type="submit" class="continue">Download all sizes (30 MB)</button>
          <table width="100%" border="1" cellpadding="10">
      <tbody><tr>
        <td class="size">1" x 1"  </td>
        <td class="download">
            <a href="#"><i class="fa fa-arrow-circle-o-down"></i></a>
        </td>
      </tr>
      <tr>
        <td class="size">2" x 2"  </td>
        <td class="download">
            <a href="#"><i class="fa fa-arrow-circle-o-down"></i></a>
        </td>
      </tr>
      <tr>
        <td class="size">3" x 3"  </td>
        <td class="download">
            <a href="#"><i class="fa fa-arrow-circle-o-down"></i></a>
        </td>
      </tr>
      <tr>
        <td class="size">4" x 4"  </td>
        <td class="download">
            <a href="#"><i class="fa fa-arrow-circle-o-down"></i></a>
        </td>
      </tr>
      <tr>
        <td class="size">5" x 5"  </td>
        <td class="download">
            <a href="#"><i class="fa fa-arrow-circle-o-down"></i></a>
        </td>
      </tr>
  </tbody></table>
        </div>
      </div>
      
    </div>
  </div>

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	

@endpush
