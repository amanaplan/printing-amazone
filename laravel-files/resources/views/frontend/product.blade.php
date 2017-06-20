@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			{{ $product->title }}
		@endslot

		@slot('meta_desc')
			{{ $product->meta_desc }}
		@endslot

		@slot('og_image')
			{{ asset('assets/images/products/'.$product->og_img) }}
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
				<h2>{{ $product->product_name }}</h2>
				<div class="review">
					<ul>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
					</ul>
					<span>58,604 reviews</span>
				</div><!-- review -->
				<div class="feature-dtls">
					<div class="col-sm-7 col-lg-7 sp-dtls">
						<p class="sp-text">{{ $product->description }}</p>
						<img src="{{ asset( 'assets/images/products/'.$product->sample_image ) }}" class="img-responsive" />
					</div>
					<div class="col-sm-1 col-lg-1"></div>
					<div class="col-sm-4 col-lg-4 custom-size">
						<div class="paperstock">
							<h2>Select a Paperstock</h2>
							<ul>
								<li><input id="art" type="radio" name="paperstock" value="male"> <label for="art">Artboard</label></li>
								<li><input id="transparent" type="radio" name="paperstock" value="male"> <label for="transparent">Transparent</label></li>
								<li><input id="waterproof" type="radio" name="paperstock" value="male"> <label for="waterproof">Waterproof</label></li>
								<li><input id="kraft" type="radio" name="paperstock" value="male"> <label for="kraft">Kraft</label></li>
							</ul>
						</div>
						<div class="paperstock">
							<h2>Select a Size</h2>
							<ul>
								<li><input id="50" type="radio" name="size" value="50 x 50"> <label for="50">50 x 50 mm</label><span>$56</span></li>
								<li><input id="70" type="radio" name="size" value="70 x 70"> <label for="70">70 x 70 mm</label><span>$65</span><span class="saving">Saving 5%</span></li>
								<li><input id="90" type="radio" name="size" value="90 x 90"> <label for="90">90 x 90 mm</label><span>$80</span><span class="saving">Saving 5%</span></li>
								<li><input id="120" type="radio" name="size" value="120 x 120"> <label for="120">120 x 120 mm</label><span>$110</span><span class="saving">Saving 5%</span></li>
								<li><input id="150" type="radio" name="size" value="150 x 150"> <label for="150">150 x 150 mm</label><span>$130</span><span class="saving">Saving 5%</span></li>
								<li><input id="custom" type="radio" name="size" value="Custom Size" checked="checked"> <label for="custom">Custom Size</label>
									<div class="custom-input">
										<input type="text" placeholder="Width"> x <input type="text" placeholder="height">
									</div>
								</li>
							</ul>
						</div>
						<div class="quantity">
							<h2>Select a Quantity</h2>
							<ul>
								<li><input id="100" type="radio" name="price" value="100"> <label for="100">100</label></li>
								<li><input id="200" type="radio" name="price" value="200"> <label for="200">200</label></li>
								<li><input id="300" type="radio" name="price" value="300"> <label for="300">300</label></li>
								<li><input id="500" type="radio" name="price" value="500"> <label for="500">500</label></li>
								<li><input id="1000" type="radio" name="price" value="1000"> <label for="1000">1000</label></li>
								<li><input id="1500" type="radio" name="price" value="1500"> <label for="1500">1500</label></li>
								<li><input id="2000" type="radio" name="price" value="2000"> <label for="2000">2000</label></li>
							</ul>
						</div>
						<a href="#" class="continue">Continue</a>
						<a href="#" class="next-up">Next : Upload Artwork <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
					<div class="clearfix"></div>
				</div><!-- feature-dtls -->
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- feature -->
	
	<div class="review-sec">
	    <div class="container">
		    <div class="row">
			    <h2>Reviews for Free Shaping Stickers</h2>
				<div class="rating-summary">
				    <ul>
					   <li>
					       <div class="col-sm-4 col-md-offset-2">
						       <h2>4.9 / 5</h2>
							   <div class="review">
					            <ul>
						         <li><i class="fa fa-star" aria-hidden="true"></i></li>
						         <li><i class="fa fa-star" aria-hidden="true"></i></li>
						         <li><i class="fa fa-star" aria-hidden="true"></i></li>
						         <li><i class="fa fa-star" aria-hidden="true"></i></li>
						         <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            </ul>
				            </div>
						   </div>
					   </li>
					   <li>
					       <div class="col-sm-4">
						     <h2>7,020</h2>
							 <span>Total reviews</span>
						   </div>
					   </li>
					   <!--<li>
					       <div class="col-sm-4">
						     <h2>99%</h2>
							 <span>Would order again</span>   
						   </div>
					   </li>-->
					   <div class="clearfix"></div>
					</ul>
				</div><!-- rating-summary -->
				<div class="review-list">

					<div class="row post-review">
						<div class="col-md-8 col-md-offset-2 col-sm-12">
							<div class="form-group">
						      <textarea class="form-control" rows="3" placeholder="Type your review here..."></textarea>
						    </div>

						    <div class="col-md-6 col-sm-12">
						    	<input type="text" class="rating rating-loading" data-size="xs" title="">
						    </div>

						    <div class="col-md-6 col-sm-12">
						    	<button type="button" class="btn btn-primary pull-right">Post Review</button>
						    </div>

						</div>
					</div>

				    <div class="review-short">
					   <div class="avatar">
                          <img alt="" class="img-circle img-thumbnail" src="{{ asset('assets/images/user.png') }}" />
                       </div>
					   <div class="body">
                        <span class="rating-stars rating-5">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                        </span>

                        <strong class="title">Crisp fresh printing and high quality</strong>

                        <div class="details">
                        <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                         <strong itemprop="name"></strong>
                        </span>

                        <time class="date relative-time" datetime="2017-05-25">14 hours ago</time>
                        <meta itemprop="datePublished" content="2017-05-25">
                        </div><!-- details -->

                        <p itemprop="description">
                           These stickers are excellent quality and the print is bold and crisp. Not to mention they threw in a couple extra stickers with my order. Bonus! I'll be ordering a large batch again soon!

                        </p>  </div>
					   <div class="clearfix"></div>
					</div><!-- review-short -->
					
					<div class="review-short">
					   <div class="avatar">
                          <img alt="" class="img-circle img-thumbnail" src="{{ asset('assets/images/user.png') }}" />
                       </div>
					   <div class="body">
                        <span class="rating-stars rating-5">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                        </span>

                        <strong class="title">Crisp fresh printing and high quality</strong>

                        <div class="details">
                        <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                         <strong itemprop="name"></strong>
                        </span>

                        <time class="date relative-time" datetime="2017-05-25">14 hours ago</time>
                        <meta itemprop="datePublished" content="2017-05-25">
                        </div><!-- details -->

                        <p itemprop="description">
                           These stickers are excellent quality and the print is bold and crisp. Not to mention they threw in a couple extra stickers with my order. Bonus! I'll be ordering a large batch again soon!

                        </p>  </div>
					   <div class="clearfix"></div>
					</div><!-- review-short -->
					
					<div class="review-short">
					   <div class="avatar">
                          <img alt="" class="img-circle img-thumbnail" src="{{ asset('assets/images/user.png') }}" />
                       </div>
					   <div class="body">
                        <span class="rating-stars rating-5">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                        </span>

                        <strong class="title">Crisp fresh printing and high quality</strong>

                        <div class="details">
                        <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                         <strong itemprop="name"></strong>
                        </span>

                        <time class="date relative-time" datetime="2017-05-25">14 hours ago</time>
                        <meta itemprop="datePublished" content="2017-05-25">
                        </div><!-- details -->

                        <p itemprop="description">
                           These stickers are excellent quality and the print is bold and crisp. Not to mention they threw in a couple extra stickers with my order. Bonus! I'll be ordering a large batch again soon!

                        </p>  </div>
					   <div class="clearfix"></div>
					</div><!-- review-short -->
					
					<div class="review-short">
					   <div class="avatar">
                          <img alt="" class="img-circle img-thumbnail" src="{{ asset('assets/images/user.png') }}" />
                       </div>
					   <div class="body">
                        <span class="rating-stars rating-5">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                        </span>

                        <strong class="title">Crisp fresh printing and high quality</strong>

                        <div class="details">
                        <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                         <strong itemprop="name"></strong>
                        </span>

                        <time class="date relative-time" datetime="2017-05-25">14 hours ago</time>
                        <meta itemprop="datePublished" content="2017-05-25">
                        </div><!-- details -->

                        <p itemprop="description">
                           These stickers are excellent quality and the print is bold and crisp. Not to mention they threw in a couple extra stickers with my order. Bonus! I'll be ordering a large batch again soon!

                        </p>  </div>
					   <div class="clearfix"></div>
					</div><!-- review-short -->
					<div class="see_all">
					  <a href="#">See all reviews</a>
					</div>
				</div><!-- review-list -->
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- review-sec -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )
	
	<script src="{{ asset( 'assets/frontend/js/star-rating.js' ) }}" type="text/javascript"></script>

	<script>
	    $(document).on('ready', function () {
	        $('.rating').on('change', function () {
	            console.log('Rating selected: ' + $(this).val());
	        });
	    });
	</script>

@endpush