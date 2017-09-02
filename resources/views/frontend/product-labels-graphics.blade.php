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

	<style>
		.frmfielderror{border: 1px solid #f92626 !important;}
	</style>

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

					@if(session('formError'))
						<div class="alert alert-danger alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Oops!</strong> {{ session('formError') }}
						</div>
					@elseif(session('request_ok'))
						<div class="alert alert-success alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Thank you!</strong> your request sent successfully
						</div>
					@endif

						<div class="custom-form">

							<form action="{{ route('product.request') }}" method="post" id="request-form">

								{{ csrf_field() }}
								<input type="hidden" name="product" value="{{ $product->product_slug }}">

								<h2>Name of the Company</h2>
								<div class="field">
									<input type="text" name="company" placeholder="Company Name" value="{{ old('company') }}">
								</div>
								<h2>Contact Details</h2>
								<div class="field">
									<input type="text" class="{{ ($errors->has('name'))? 'frmfielderror' : '' }}" name="name" placeholder="Full Name" value="{{ old('name') }}" required="required">
									@if($errors->has('name'))
										<span class="text-danger">{{ $errors->first('name') }}</span>
									@endif
								</div>
								<div class="field">
									<input type="email" class="{{ ($errors->has('email'))? 'frmfielderror' : '' }}" name="email" placeholder="Email ID" value="{{ old('email') }}" required="required">
									@if($errors->has('email'))
										<span class="text-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>
								<div class="field">
									<input type="tel" class="{{ ($errors->has('phone'))? 'frmfielderror' : '' }}" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required="required">
									@if($errors->has('phone'))
										<span class="text-danger">{{ $errors->first('phone') }}</span>
									@endif
								</div>
								<div class="field">
									<textarea type="text" class="{{ ($errors->has('address'))? 'frmfielderror' : '' }}" name="address" placeholder="Enter your Address" required="required">{{ old('address') }}</textarea>
									@if($errors->has('address'))
										<span class="text-danger">{{ $errors->first('address') }}</span>
									@endif
								</div>
								<h2>Short description of your requirment</h2>
								<div class="field">
									<textarea type="text" class="{{ ($errors->has('desc'))? 'frmfielderror' : '' }}" name="desc" placeholder="Brief description" required="required">{{ old('desc') }}</textarea>
									@if($errors->has('desc'))
										<span class="text-danger">{{ $errors->first('desc') }}</span>
									@endif
								</div>
								<div class="field">
									<input id="send-request" type="submit" value="Send Request" />
								</div>
							</form>

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
					<input id="product" type="hidden" value="{{ Request::segment(1) }}">

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

		$("form#request-form").submit(function(){
			$("input#send-request").prop('disabled', true);
		});
	</script>

	{{-- review --}}
	<script type="text/javascript" src="{{ asset( mix('assets/frontend/js/review.js') ) }}"></script>

@endpush
