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

						@if(preg_match("/\*+/",$product->sample_image))

							{{-- carousal sample slider images --}}

							@php
								$slides = explode('*', $product->sample_image);
							@endphp
							<div id="myCarousel" class="carousel slide" data-ride="carousel">
							    <!-- Indicators -->
							    <ol class="carousel-indicators">
							    	@foreach($slides as $slide)
							    		<li data-target="#myCarousel" data-slide-to="{{ $loop->index }}" {{ ($loop->first)? 'class="active"' : '' }}></li>
							    	@endforeach
							    </ol>

							    <!-- Wrapper for slides -->
							    <div class="carousel-inner">

							    	@foreach($slides as $slide)
							    		<div class="item {{ ($loop->first)? 'active' : '' }}">
									        <img src="{{ asset( 'assets/images/products/'.$slide ) }}" style="width:100%;">
									     </div>
							    	@endforeach

							    </div>

							    <!-- Left and right controls -->
							    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
							      <span class="glyphicon glyphicon-chevron-left"></span>
							      <span class="sr-only">Previous</span>
							    </a>
							    <a class="right carousel-control" href="#myCarousel" data-slide="next">
							      <span class="glyphicon glyphicon-chevron-right"></span>
							      <span class="sr-only">Next</span>
							    </a>
							</div>

						@else

							<img src="{{ asset( 'assets/images/products/'.$product->sample_image ) }}" class="img-responsive" />

						@endif

					</div>
					<div class="col-sm-1 col-lg-1"></div>
					
					{{-- the sidebar selection form --}}
					@if($has_fields)

						<div class="col-sm-4 col-lg-4 custom-size">
							<form action="" method="post">

								{{ csrf_field() }}

								@if(array_key_exists(1,$fields))
								<div class="paperstock">
									<h2>Select a Paperstock</h2>
									<ul>
										@foreach($fields[1] as $key => $val)
											<li><input id="{{ $val }}" type="radio" name="paperstock" value="{{ $key }}" {{ ($loop->index === 0)? 'checked' : '' }}> <label for="{{ $val }}">{{ $val }}</label></li>
										@endforeach
									</ul>
								</div>
								@endif

								@if(array_key_exists(2,$fields))
								<div class="paperstock">
									<h2>Select a Size</h2>
									<ul>
										@foreach($fields[2] as $key => $val)
											<li><input id="{{ $val }}" type="radio" name="size" value="{{ $key }}" {{ ($loop->index === 0)? 'checked' : '' }}> <label for="{{ $val }}">{{ $val }}</label><span>$56</span></li>
										@endforeach
										
										<li><input id="custom" type="radio" name="size" value="custom"> <label for="custom">Custom Size</label>
											<div class="custom-input" style="display: none;">
												<input type="text" placeholder="Width"> x <input type="text" placeholder="height">
											</div>
										</li>
									</ul>
								</div>
								@endif

								@if(array_key_exists(3,$fields))
								<div class="quantity">
									<h2>Select a Quantity</h2>
									<ul>
										@foreach($fields[3] as $key => $val)
											<li><input id="{{ $val }}" type="radio" name="qty" value="{{ $key }}" {{ ($loop->index === 0)? 'checked' : '' }}> <label for="{{ $val }}">{{ $val }}</label></li>
										@endforeach
									</ul>
								</div>
								@endif

								<a href="#" class="continue">Continue</a>
								<a href="#" class="next-up">Next : Upload Artwork <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</form>
						</div>

					@endif
					{{-- sidebar form --}}

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
				<div class="review-list" id="app">

					@if(Auth::guard('web')->check())

						<div class="row post-review">
							<div class="col-md-8 col-md-offset-2 col-sm-12">
								<form @submit.prevent="postReview">
									<div class="form-group" v-bind:class="{'has-error' : showHeadingErr}">
								      <input class="form-control" type="text" placeholder="Enter your review hedaing" v-model="heading">
								    	<span class="help-block text-danger" v-if="showHeadingErr">@{{ headingErr }}</span>
								    </div>

									<div class="form-group" v-bind:class="{'has-error' : showReviewMsgErr}">
								      <textarea class="form-control" rows="3" placeholder="Type your review text here..." v-model="review"></textarea>
								    	<span class="help-block text-danger" v-if="showReviewMsgErr">@{{ reviewErr }}</span>
								    </div>

								    <div class="col-md-6 col-sm-12">
								    	<input type="text" value="0" class="rating rating-loading" data-size="xs" title="">
								    	<span class="help-block text-danger" v-if="showRatingMsgErr">@{{ ratingErr }}</span>
								    </div>

								    <div class="col-md-6 col-sm-12">
								    	<button type="submit" class="btn btn-primary pull-right">Post Review</button>
								    </div>
							    </form>

							</div>
						</div>

					@else
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-sm-12">
								<a href="javascript:void();" class="continue" onclick="document.querySelector('a.cd-signin').click();">Post Your Review</a>
							</div>
						</div>
						<div class="clearfix"></div>
					@endif

					<template v-if="givenReview">
						<div v-html="givenReviewText"></div>
					</template>

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

                        <strong class="title">Crisp fresh printing and high quality</strong> <a href="#" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>

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
	            //console.log('Rating selected: ' + $(this).val());
	            $(this).attr('value', $(this).val());
	        });
	    });

	    $(document).ready(function(){
	    	$("input[name='size']").change(function(){
	    		if($(this).val() == 'custom')
	    		{
	    			$("div.custom-input").show();
	    		}
	    		else{
	    			$("div.custom-input").hide();
	    		}
	    	});
	    });
	</script>

	<script>

		new Vue({
			el: '#app',
			data: {
				heading: '',
				review: '',
				rating: 0,
				showReviewMsgErr: false,
				showRatingMsgErr : false,
				showHeadingErr: false,
				reviewErr: '',
				ratingErr : '',
				headingErr: '',
				givenReview: false,
				givenReviewText: '',
				customer: '{{ Auth::user()->name }}'
			},
			methods: {
				postReview: function()
				{
					this.rating = $('.rating').val();
					this.review = this.review.trim();
					this.heading = this.heading.trim();

					if(this.heading.length < 8)
					{
						this.headingErr = `review heading is too small`;
						this.showHeadingErr = true;
						this.showReviewMsgErr = false;
						this.showRatingMsgErr = false;
					}
					else if(this.review.length < 10)
					{
						this.reviewErr = `review message is too small`;
						this.showReviewMsgErr = true;
						this.showRatingMsgErr = false;
						this.showHeadingErr = false;
					}
					else if(this.rating <= 0)
					{
						this.ratingErr = `please provide your rating`;
						this.showRatingMsgErr = true;
						this.showReviewMsgErr = false;
						this.showHeadingErr = false;
					}
					else
					{
						this.showReviewMsgErr = this.showRatingMsgErr = this.showHeadingErr = false;
						$('.post-review').fadeOut(function(){
							$('.post-review').remove();
						});
						//ajax here

						this.givenReview = true;
						this.givenReviewText = 
						`
							<div class="review-short">
							<div class="avatar"><img alt="" src="http://localhost/srv/printing-amazone/assets/images/user.png" class="img-circle img-thumbnail"></div> 
							<div class="body">
								<span class="rating-stars rating-5">
									<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
								</span> 
							<strong class="title">

								${this.heading}

							</strong> 
							<div class="details">
							<span itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
							<strong itemprop="name">${this.customer}</strong></span> <time class="date relative-time">14 hours ago</time> 
							<meta itemprop="datePublished" content="2017-05-25"></div> <p itemprop="description">

	                           ${this.review}

	                        </p></div> <div class="clearfix"></div></div>
						`
					}					
				}
			}
		})
	</script>

@endpush