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

	<style type="text/css">
	#container {position: relative;}
	.middle {transition: .5s ease;opacity: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%)}
	.loadtext {font-size: 30px;padding: 16px 32px;font-weight: bold;}
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

						<div id="container">
						<img id="sticker-preview" src="{{ asset( 'assets/images/products/'.$sticker_types->first()->image ) }}" class="img-responsive" />

						<div class="middle">
						    <div class="loadtext"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></div>
						</div>
						</div>

					</div>
					<div class="col-sm-1 col-lg-1"></div>
					
					{{-- the sidebar form --}}

						<div class="col-sm-4 col-lg-4 custom-size">
							<div class="custom-form">

								<form action="{{ url('/place-order/proceed') }}" method="post">

									{{ csrf_field() }}

									<input type="hidden" name="product" id="prodName" value="{{ $product->product_slug }}">

									<div class="field">
										<label>Sticker Type</label>
										<select name="type">
											@foreach($sticker_types as $row)

											<option value="{{ $row->name }}">{{ $row->name }}</option>

											@endforeach
										</select>
									</div>
									<div class="field">
										<label>Paperstock</label>
										<select name="paperstock" class="paperstock-opt">
											@if(array_key_exists(1,$fields))

												@foreach($fields[1] as $key => $val)
													<option value="{{ $key }}">{{ $val }}</option>
												@endforeach

											@endif
										</select>
									</div>
									<div class="field">
										<label>Laminating</label>
										<select name="laminating">
											@foreach($laminations as $lamination)
												<option value="{{ $lamination->id }}">{{ $lamination->option }}</option>
											@endforeach
										</select>
									</div>
									<div class="field">
										<label style="padding-bottom: 10px;">Printing Name</label>
										<input type="text" name="sticker_name" value="{{ old('sticker_name') }}" placeholder="Enter Printing Name">
									</div>
									<div class="field">
										<label>Select a Size</label>
										<ul>
											@foreach($fields[2] as $key => $val)
												<li><input id="{{ $val }}" class="size-opt" type="radio" name="size" value="{{ $key }}" {{ ($loop->index === 0)? 'checked' : '' }}> <label for="{{ $val }}">{{ $val }}</label></li>
											@endforeach
											
											<li><input id="custom" type="radio" name="size" value="custom"> <label for="custom">Custom Size</label>
												<div class="custom-input" style="display: none;">
													<input type="text" placeholder="Width" name="size_w"> x <input type="text" placeholder="height" name="size_h"> <button class="btn btn-sm btn-warning check-price" type="button"><i class="fa fa-check"></i></button>
													<span id="size-err" class="text-danger" style="width: 100%;display: none;">some validation error</span>
												</div>
											</li>
										</ul>
										
									</div>
									<div class="field">
										<label>Select Quantity <strong class="text-danger">GST &amp; Delivery inclusive</strong></label>
										<ul>
											@if(array_key_exists(3,$fields))

												@foreach($fields[3] as $key => $val)
													<li><input id="{{ $val }}" type="radio" name="qty" value="{{ $key }}" {{ ($loop->index === 0)? 'checked' : '' }}> <label for="{{ $val }}">{{ number_format($val) }}</label><span id="priceof-{{ $val }}">$ __</span></li>
												@endforeach

											@endif

											<li>&nbsp;</li>

											<li>
												<strong>**for quantiry more than 20,000 please <a href="{{ url('/contact') }}">contact</a></strong>
											</li>
										</ul>
										
									</div>
									
									<div class="field">
										<button type="submit" class="continue">Continue</button>
										<span class="next-up">Next : Upload Artwork <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
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

	{{-- sticker type preview section --}}
	<script type="text/javascript" src="{{ asset( 'assets/frontend/js/nameStickerPreview.js' ) }}"></script>

	@if(session('formError'))
		<link rel="stylesheet" type="text/css" href="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.css' ) }}" />
		<script type="text/javascript" src="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.min.js' ) }}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				swal("Error!", "{{ session('formError') }}", "error");
			});
		</script>
	@endif

	{{-- calculation form --}}
	<script type="text/javascript" src="{{ asset( 'assets/frontend/js/calculation.js' ) }}"></script>

	{{-- review --}}
	<script type="text/javascript" src="{{ asset( mix('assets/frontend/js/review.js') ) }}"></script>

@endpush
