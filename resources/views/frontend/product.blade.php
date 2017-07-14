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
											<li><input id="{{ $val }}" type="radio" name="size" value="{{ $key }}" {{ ($loop->index === 0)? 'checked' : '' }}> <label for="{{ $val }}">{{ $val }}</label></li>
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
								<div class="paperstock">
									<h2>Select a Quantity</h2>
									<ul>
										@foreach($fields[3] as $key => $val)
											<li><input id="{{ $val }}" type="radio" name="qty" value="{{ $key }}" {{ ($loop->index === 0)? 'checked' : '' }}> <label for="{{ $val }}">{{ $val }}</label><span>$56</span></li>
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

					<input id="photo" type="hidden" value="{{ (Auth::guard('web')->check())? (Auth::user()->photo)? asset('assets/images/users').'/'.Auth::user()->photo : asset('assets/images/user.png') : '' }}">
					<input id="customerName" type="hidden" value="{{ (Auth::guard('web')->check())? Auth::user()->name : '' }}">
					<input id="product" type="hidden" value="{{ Request::segment(2) }}">

					@if(Auth::guard('web')->check())

						@if(empty($unpubreview))
							<transition name="fade">
								<div class="row post-review" v-show="showform">
									
									<div class="col-md-8 col-md-offset-2 col-sm-12">
										<img class="img-circle img-thumbnail img-responsive" width="80" src="{{ (Auth::user()->photo)? asset('assets/images/users').'/'.Auth::user()->photo : asset('assets/images/user.png') }}">

										<form @submit.prevent="postReview">

											<div class="form-group" v-bind:class="{'has-error' : formobj.hasError('heading')}">
										      <input class="form-control" type="text" placeholder="Enter your review hedaing, max 60 character" v-model="heading">
										    	<span v-cloak class="help-block text-danger" v-if="formobj.hasError('heading')">@{{ formobj.getError('heading') }}</span>
										    </div>

											<div class="form-group" v-bind:class="{'has-error' : formobj.hasError('review')}">
										      <textarea class="form-control" rows="3" placeholder="Type your review text here..." v-model="review"></textarea>
										    	<span v-cloak class="help-block text-danger" v-if="formobj.hasError('review')">@{{ formobj.getError('review') }}</span>
										    </div>

										    <div class="col-md-6 col-sm-12">
										    	<input type="text" value="0" class="rating rating-loading" data-size="xs" title="">
										    	<span v-cloak class="help-block text-danger" v-if="formobj.hasError('rating')">@{{ formobj.getError('rating') }}</span>
										    </div>

										    <div class="col-md-6 col-sm-12">
										    	<button type="submit" class="btn btn-primary pull-right" :disabled="disableForm">Post Review</button>
										    </div>
									    </form>

									</div>
								</div>
							</transition>
						@endif

					@else
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-sm-12">
								<a href="javascript:void();" class="continue" onclick="document.querySelector('a.cd-signin').click();">Post Your Review</a>
							</div>
						</div>
						<div class="clearfix"></div>
					@endif

					@if(empty($unpubreview))
						<template v-if="givenReview">
							<div class="col-md-6 col-sm-12" v-html="errMsg"></div>
							<div class="clearfix"></div>

							<reviewitem photo="{{ (Auth::guard('web')->check())? (Auth::user()->photo)? asset('assets/images/users').'/'.Auth::user()->photo : asset('assets/images/user.png') : '' }}" :heading="heading" customer="{{ (Auth::guard('web')->check())? (Auth::user()->name) : '' }}" :review="review" :rating="genRatedStar(rating)" @editreview="showform = true; givenReview = false; disableForm = false"></reviewitem>
						</template>
					@endif


					{{-- unpublished review of the logged in user --}}
					@if( !empty($unpubreview))

						<div class="review-short">
						   <div class="avatar">
		                        <img alt="" class="img-circle img-thumbnail" src="{{ (Auth::guard('web')->check())? (Auth::user()->photo)? asset('assets/images/users').'/'.Auth::user()->photo : asset('assets/images/user.png') : '' }}" />
		                    </div>
							<div class="body">
		                        <span class="rating-stars rating-5">
									{!! genRatedStar($unpubreview->rating) !!}
		                        </span>

		                        <strong class="title">{{ $unpubreview->title }}</strong> <button type="button" class="btn btn-default"><i class="fa fa-edit"></i> Edit</button>

		                        <div class="details">
			                        <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
			                         	<strong itemprop="name">{{ Auth::user()->name }}</strong>
			                        </span>

		                        	<time class="date relative-time">some days ago</time>
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
					@foreach($pubreviews as $review)

						<div class="review-short">
						   <div class="avatar">
	                          <img alt="" class="img-circle img-thumbnail" src="{{ ($review->user->photo)? asset('assets/images/users').'/'.$review->user->photo : asset('assets/images/user.png') }}" />
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

	                        <time class="date relative-time">some days ago</time>
	                        <meta itemprop="datePublished">
	                        </div>

	                        <p itemprop="description">
	                           {{ $review->description }}

	                        </p>  </div>

						   <div class="clearfix"></div>
						</div>

					@endforeach

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

	<script>

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

	<script type="text/javascript" src="{{ asset( mix('assets/frontend/js/review.js') ) }}"></script>

@endpush