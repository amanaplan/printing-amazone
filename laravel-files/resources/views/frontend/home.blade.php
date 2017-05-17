@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Printing Amazone</title>

@stop

{{-- page specific styles --}}
@push( 'styles' )

@endpush

{{-- main page contents --}}
@section('contents')

<div id="one_color_blue_carousel" class="carousel one_color_blue_carousel_fade animate_text one_color_blue_carousel_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">
		
	<!-- ========= Wrapper for slides  =========-->
	<div class="carousel-inner" role="listbox">

		<!--========= First slide =========-->
		<div class="item active">
			<img src="{{ asset( 'assets/images/one_color_slider.png' ) }}" alt="slider 01" />
			<div class="carousel-caption one_color_blue_carousel_caption">
				<img src="{{ asset( 'assets/images/banner-img1.png' ) }}" alt="slider 01"  data-animation="animated fadeInUp" class="img-responsive" />
				<div class="one_color_blue_carousel_caption_text">
					<h1>Make your own<br> Custom <span>Stickers</span></h1>
					<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit<br> amet, consectetur, adipisci velit</p>
					<a href="#" class="pink">Get Samples</a><a href="#" class="green">Shop Now</a>
				</div>						
			</div>
		</div>

		<!--========= Second slide =========-->
		<div class="item">
			<img src="{{ asset( 'assets/images/one_color_slider.png' ) }}" alt="slider 02" />
			<div class="carousel-caption one_color_blue_carousel_caption">
				<img src="{{ asset( 'assets/images/banner-img2.png' ) }}" alt="slider 01"  data-animation="animated fadeInUp" class="img-responsive" />
				<div class="one_color_blue_carousel_caption_text">
					<h1>Make your own<br> Custom <span>Stickers</span></h1>
					<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit<br> amet, consectetur, adipisci velit</p>
					<a href="#" class="pink">Get Samples</a><a href="#" class="green">Shop Now</a>
				</div>						
			</div>
		</div>

	</div>

	<!--======= Navigation Buttons =========-->

	<!--======= Left Button =========-->
	<a class="left carousel-control one_color_blue_carousel_control_left" href="#one_color_blue_carousel" role="button" data-slide="prev">
		<span class="fa fa-angle-left one_color_blue_carousel_control_icons" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>

	<!--======= Right Button =========-->
	<a class="right carousel-control one_color_blue_carousel_control_right" href="#one_color_blue_carousel" role="button" data-slide="next">
		<span class="fa fa-angle-right one_color_blue_carousel_control_icons" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>

</div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
		
<div class="feature">
	<div class="container">
		<div class="row">
			<h2>Printing Amazone Features</h2>
			<div class="feature-dtls">
				<a href="custom-sticker.html"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f1.png' ) }}" />
					<h2>Custom Stickers</h2>
				</div></a>
				<a href="#"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f2.png' ) }}" />
					<h2>Business Cards</h2>
				</div></a>
				<a href="#"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f3.png' ) }}" />
					<h2>Postcards</h2>
				</div></a>
				<div class="clearfix"></div>
				<a href="#"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f4.png' ) }}" />
					<h2>Decal Stickers</h2>
				</div></a>
				<a href="#"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f5.png' ) }}" />
					<h2>Label</h2>
				</div></a>
				<a href="#"><div class="col-sm-4 col-lg-4 dtls-box">
					<img src="{{ asset( 'assets/images/f6.png' ) }}" />
					<h2>Graphic Design</h2>
				</div></a>
				<div class="clearfix"></div>
			</div><!-- feature-dtls -->
		</div><!-- row -->
	</div><!-- container -->
</div><!-- feature -->
	
<div class="testimonial">
	<div class="container">
        <div class="row">
			<h2>Testimonials</h2>
            <div class="col-md-12">
                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
					<!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0"><img class="img-responsive " src="https://s3.amazonaws.com/uifaces/faces/twitter/mantia/128.jpg" alt="">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="1"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/adhamdannaway/128.jpg" alt="">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="2"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg" alt="">
                        </li>
						<li data-target="#quote-carousel" data-slide-to="3" class="active"><img class="img-responsive " src="https://s3.amazonaws.com/uifaces/faces/twitter/mantia/128.jpg" alt="">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="4"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/adhamdannaway/128.jpg" alt="">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="5"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg" alt="">
                        </li>
                    </ol>
                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner text-center">
                        <!-- Quote 1 -->
                        <div class="item">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
										<small><span>Alice Anderson,</span> 99designs.com</small>
                                        <p>We’re all about making sure you have a great experience with our software. Our real, live customer support team will go out of their way to help you—by phone or by email. For free. We also have free video tutorials, forums, training webinars, whitepapers, and a great knowledgebase you can access 24/7.</p>
                                      </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- Quote 2 -->
                        <div class="item">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
										<small><span>John Smith,</span> 99designs.com</small>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. !</p>
                                       </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- Quote 3 -->
                        <div class="item">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
										<small><span>Someone famous,</span> 99designs.com</small>
                                        <p>We’re all about making sure you have a great experience with our software. Our real, live customer support team will go out of their way to help you—by phone or by email. For free. We also have free video tutorials, forums, training webinars, whitepapers, and a great knowledgebase you can access 24/7.</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
						<!-- Quote 1 -->
                        <div class="item active">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
										<small><span>Alice Anderson,</span> 99designs.com</small>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. !</p>
                                      </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- Quote 2 -->
                        <div class="item">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
										<small><span>Alice Anderson,</span> 99designs.com</small>
                                        <p>We’re all about making sure you have a great experience with our software. Our real, live customer support team will go out of their way to help you—by phone or by email. For free. We also have free video tutorials, forums, training webinars, whitepapers, and a great knowledgebase you can access 24/7.</p>
                                       </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- Quote 3 -->
                        <div class="item">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
										<small><span>Alice Anderson,</span> 99designs.com</small>
                                        <p>We’re all about making sure you have a great experience with our software. Our real, live customer support team will go out of their way to help you—by phone or by email. For free. We also have free video tutorials, forums, training webinars, whitepapers, and a great knowledgebase you can access 24/7.</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                    
                    <!-- Carousel Buttons Next/Prev -->
                    <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                    <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- testimonial -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

@endpush