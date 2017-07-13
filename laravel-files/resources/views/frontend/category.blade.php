@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			{{ $category->title }}
		@endslot

		@slot('meta_desc')
			{{ $category->meta_desc }}
		@endslot

		@slot('og_image')
			{{ asset('assets/images/category/'.$category->og_img) }}
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
			<h2>{{ $category->category_name }}</h2>
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

				{{-- the products --}}
				@foreach ($category->products->chunk(3) as $chunk)

				    <div class="row">
				        @foreach ($chunk as $product)
				        	<a href="{{ url('/'.$category->category_slug.'/'.$product->product_slug) }}">
					            <div class="col-sm-4 col-lg-4 dtls-box">
					            	<img src="{{ asset('assets/images/products/'.$product->logo) }}" />
					            	<h2>{{ $product->product_name }}</h2>
					            </div>
					        </a>
				        @endforeach
				    </div>
				    <div class="clearfix"></div>

				@endforeach

				
			</div><!-- feature-dtls -->
			<br/>
		</div><!-- row -->
	</div><!-- container -->
</div><!-- feature -->

<div class="review-sec">
    <div class="container">
	    <div class="row">
		    <h2>Reviews for {{ $category->category_name }}</h2>
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