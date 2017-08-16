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
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/plugin/snackbar/snackbar.css' ) }}" type="text/css"/>

@endpush

{{-- main page contents --}}
@section('contents')

	<div class="feature custom">
		<div class="container">
			<div class="row">
				<h2>{{ $product->product_name }}</h2>
				
				@if($avgrate)

				<div class="review">

					<span class="avg-rating">{!! genRatedStar($avgrate) !!}</span>

					<span>{{ number_format($totgiven) }} review{{ ($totgiven > 1)? 's' : '' }}</span>
				</div>

				@endif

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
					
					{{-- the sidebar form --}}

						<div class="col-sm-4 col-lg-4 custom-size">
							<div class="custom-form">
								<div class="field">
									<label>Sticker Type</label>
									<select>
										<option>5x5mm</option>
										<option>7x7mm</option>
										<option>9x9mm</option>
										<option>12x12mm</option>
										<option>15x15mm</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-12" style="padding-left: 0;">
								<div class="field">
									<label>Size</label>
									<select>
										<option>5x5mm</option>
										<option>7x7mm</option>
										<option>9x9mm</option>
										<option>12x12mm</option>
										<option>15x15mm</option>
									</select>
								</div>
								</div>
								<div class="col-md-6 col-sm-12" style="padding-right: 0;">
								<div class="field">
									<label>Paperstock</label>
									<select>
										<option>artboard</option>
										<option>$ 4</option>
										<option>$ 10</option>
										<option>$ 17</option>
										<option>$ 33</option>
										<option>$ 69</option>
									</select>
								</div>
								</div>
								<div class="clearfix"></div>
								<div class="field">
									<label>Laminating</label>
									<select>
										<option>Select Quantity</option>
										<option>$ 4</option>
										<option>$ 10</option>
										<option>$ 17</option>
										<option>$ 33</option>
										<option>$ 69</option>
									</select>
								</div>
								<div class="field">
									<label>Printing Name</label><input type="text" placeholder="Enter Printing Name">
								</div>
								<div class="field">
									<label>Select a Quantity</label>
									<ul>
										<li><input id="100" type="radio" name="qty" value="2" checked=""> <label for="100">100</label><span id="priceof-100">$ 4</span></li>
										<li><input id="200" type="radio" name="qty" value="3"> <label for="200">200</label><span id="priceof-200">$ 10</span></li>
										<li><input id="300" type="radio" name="qty" value="5"> <label for="300">300</label><span id="priceof-300">$ 17</span></li>
										<li><input id="500" type="radio" name="qty" value="4"> <label for="500">500</label><span id="priceof-500">$ 33</span></li>
										<li><input id="1000" type="radio" name="qty" value="1"> <label for="1000">1000</label><span id="priceof-1000">$ 69</span></li>
										
										<li><input id="custom-qty" type="radio" name="qty" value="custom"> <label for="custom-qty">Custom Quantity</label>
											<div class="custom-qty-input" style="display: none;">
												<input type="text" placeholder="Enter quantity" name="quantity" style="border: 1px none;"> <button class="btn btn-sm btn-warning check-price" type="button"><i class="fa fa-check"></i></button><span id="qty-price" style="margin-left: 10px;"><i class="fa fa-spinner fa-pulse fa-lg text-success"></i></span>
												<span id="qty-err" class="text-danger" style="width: 100%;display: none;"></span>
											</div>
										</li>

									</ul>
									
								</div>
								
								<div class="field">
									<button type="button" class="continue">Continue</button>
									<span class="next-up">Next : Upload Artwork <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
								</div>
							</div>
						</div>

					{{-- sidebar form --}}

					<div class="clearfix"></div>
				</div><!-- feature-dtls -->
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- feature -->
	
	<div class="review-sec">
	    <div class="container">
		    <div class="row">
			    <h2>Reviews for {{ $product->product_name }}</h2>

			    @if($avgrate)
				<div class="rating-summary">
				    <ul>
					   <li>
					       <div class="col-sm-4 col-md-offset-2">
						       <h2>{{ $avgrate }} / 5</h2>
							   	<div class="review">
					            	<span class="avg-rating">{!! genRatedStar($avgrate) !!}</span>
				            	</div>
						   </div>
					   </li>
					   <li>
					       <div class="col-sm-4">
						     <h2>{{ number_format($totgiven) }}</h2>
							 <span>Total review{{ ($totgiven > 1)? 's' : '' }}</span>
						   </div>
					   </li>
					   <div class="clearfix"></div>
					</ul>
				</div>
				@endif

				<div class="review-list" id="app">

					<input id="photo" type="hidden" value="{{ getLoggedinCustomerPic() }}">
					<input id="customerName" type="hidden" value="{{ (Auth::guard('web')->check())? Auth::user()->name : '' }}">
					<input id="product" type="hidden" value="{{ Request::segment(2) }}">

					@if(Auth::guard('web')->check())

						<transition name="fade">
							<div class="row post-review" v-show="showform" {!! (!empty($unpubreview))? 'style="display:none;"' : '' !!}>
								
								<div class="col-md-8 col-md-offset-2 col-sm-12">
									<img class="img-circle img-thumbnail img-responsive" width="80" src="{{ getLoggedinCustomerPic() }}">

									<form @submit.prevent="postReview">

										<div class="form-group" v-bind:class="{'has-error' : formobj.hasError('heading')}">
									      <div style="display: flex;"><input class="form-control" name="heading" type="text" placeholder="Enter your review hedaing, max 60 character" maxlength="60" v-model="heading" value="{{ (!empty($unpubreview))? $unpubreview->title : '' }}"> <span v-cloak>@{{ heading.length }}/60</span></div>
									    	<span v-cloak class="help-block text-danger" v-if="formobj.hasError('heading')">@{{ formobj.getError('heading') }}</span>
									    </div>

										<div class="form-group" v-bind:class="{'has-error' : formobj.hasError('review')}">
									      <textarea class="form-control" name="review" rows="3" placeholder="Type your review text here..." v-model="review">{{ (!empty($unpubreview))? $unpubreview->description : '' }}</textarea>
									    	<span v-cloak class="help-block text-danger" v-if="formobj.hasError('review')">@{{ formobj.getError('review') }}</span>
									    </div>

									    <div class="col-md-6 col-sm-12">
									    	<input type="text" value="{{ (!empty($unpubreview))? $unpubreview->rating : 0 }}" class="rating rating-loading" data-size="xs" title="">
									    	<span v-cloak class="help-block text-danger" v-if="formobj.hasError('rating')">@{{ formobj.getError('rating') }}</span>
									    </div>

									    <div class="col-md-6 col-sm-12">
									    	<button type="submit" class="btn btn-primary pull-right" :disabled="disableForm">Post Review</button>
									    </div>
								    </form>

								</div>
							</div>
						</transition>

					@else
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-sm-12" id="not-loggedIn-postReview">
								<a href="javascript:void();" class="continue" onclick="document.querySelector('a.cd-signin').click();">Post Your Review</a>
							</div>
						</div>
						<div class="clearfix"></div>
					@endif
					

					<template v-if="givenReview">
						<div class="col-md-6 col-md-offset-1 col-sm-12" v-html="errMsg"></div>
						<div class="clearfix"></div>

						<reviewitem photo="{{ getLoggedinCustomerPic() }}" :heading="heading" customer="{{ (Auth::guard('web')->check())? (Auth::user()->name) : '' }}" :review="review" :rating="genRatedStar(rating)" @editreview="showform = true; givenReview = false; disableForm = false"></reviewitem>
					</template>


					{{-- unpublished review of the logged in user --}}
					@if( !empty($unpubreview))

						<div class="review-short">
						   <div class="avatar">
		                        <img alt="" class="img-circle img-thumbnail" src="{{ getLoggedinCustomerPic() }}" />
		                    </div>
							<div class="body">
		                        <span class="rating-stars rating-5">
									{!! genRatedStar($unpubreview->rating) !!}
		                        </span>

		                        <strong class="title">{{ $unpubreview->title }}</strong> <span class="label label-warning">pending</span> <button type="button" onclick="letEdit(this);" class="btn btn-default"><i class="fa fa-edit"></i> Edit</button>

		                        <div class="details">
			                        <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
			                         	<strong itemprop="name">{{ Auth::user()->name }}</strong>
			                        </span>

		                        	<time class="date relative-time">{{ \Carbon\Carbon::parse($unpubreview->created_at)->diffForHumans() }}</time>
		                        	<meta itemprop="datePublished">
		                        </div>

		                        <p itemprop="description">
		                           {{ $unpubreview->description }}
		                        </p>  
		                    </div>
							   <div class="clearfix"></div>
						</div>

					@endif
					
					{{-- published reviews --}}
					<div id="published-reviews">
						@foreach($pubreviews as $review)

							@if($loop->iteration < 3)
							<div class="review-short">
							   <div class="avatar">
		                          <img alt="" class="img-circle img-thumbnail" src="{{ getTheCustomerPic($review->user->id) }}" />
		                       </div>
							   <div class="body">
		                        <span class="rating-stars rating-5">
		                         {!! genRatedStar($review->rating) !!}
		                        </span>

		                        <strong class="title">{{ $review->title }}</strong>

		                        <div class="details">
		                        <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
		                         <strong itemprop="name">{{ $review->user->name }}</strong>
		                        </span>

		                        <time class="date relative-time">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</time>
		                        <meta itemprop="datePublished">
		                        </div>

		                        <p itemprop="description">
		                           {{ $review->description }}

		                        </p>  </div>

							   <div class="clearfix"></div>
							</div>
							@endif

						@endforeach
					</div>


					@if($loadmore)
						<div class="see_all">
							<input type="hidden" v-model="offset" value="2">
						  	<button type="button" v-on:click="loadReviews" :disabled="lockLoadBtn" v-if="showLoadBtn" v-html="LoadBtnText">Load more reviews</button>
						</div>
					@endif

				</div><!-- review-list -->
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- review-sec -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

	<script>
	    function letEdit(elem)
		{
			$('.post-review').show();
			$("input[name='heading']").focus();
			$(elem).closest(".review-short").remove();
		}
	</script>

	{{-- calculation form --}}
	<script type="text/javascript" src="{{ asset( 'assets/frontend/js/calculation.js' ) }}"></script>

	{{-- review --}}
	<script type="text/javascript" src="{{ asset( mix('assets/frontend/js/review.js') ) }}"></script>

@endpush
