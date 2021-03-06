@extends('layouts.frontend.main')


{{-- seo info --}}
@section( 'seo_data' )

	@component('component.seo-data')
		@slot('title')
			Shopping Cart - Printing Amazon
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
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/plugin/tooltipster/css/tooltipster.bundle.min.css' ) }}" media="all" type="text/css"/>
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/plugin/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css' ) }}" media="all" type="text/css"/>
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/plugin/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css' ) }}" media="all" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.css' ) }}" />

	{{-- calendar --}}
	<link rel="stylesheet" href="{{ asset( 'assets/frontend/plugin/calendar/zabuto_calendar.min.css' ) }}" />

@endpush

{{-- main page contents --}}
@section('contents')

@if(! $cart_empty)

<div class="cart">
	<div class="container">
		<div id="cart" class="padding">

			{{-- overlay component --}}
			<div id="loading-overlay">
			  	<div id="overlay-text">
			  		<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
			  	</div>
			</div>
			{{-- overlay component --}}

			<div class="col-sm-8">
				<div class="row">
					<h4 class="cart-head">Shopping cart</h4>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="uppercase">Product</th>
									<th class="uppercase">Description</th>
									<th class="uppercase">Quantity</th>
									<th class="uppercase">Price</th>
									<th class="uppercase"></th>
								</tr>
							</thead>
							<tbody id="cart-products-list">
								
								@foreach($cart_data as $item)
								<tr>
									<td>
										<a href="{{ url('/'.$item->product->category->category_slug.'/'.$item->product->product_slug) }}">
											<img src="{{ asset('assets/images/products/'.$item->product->logo) }}" alt="{{ $item->product->product_name }}" class="shopping-product crt-list-thumb">
											<h5>{{ $item->product->product_name }}</h5>
										</a>

										
										@if($item->artworks->count() > 0)
											<div id="added-artworks-preview">
											@foreach($item->artworks as $row)
												<div class="pinned-artwork" data-tooltip-content="#prod-artwork-{{$row->id}}">
													<img src="{{ asset('storage/'.$row->artwork) }}" onerror="showFileImg(this);" alt="Artwork" width="96" height="96">
													Artwork <i class="fa fa-paperclip"></i>
												</div>

												<div class="tooltip_templates" style="display: none;">
													<span id="prod-artwork-{{$row->id}}">
														<img width="200" src="{{ asset('storage/'.$row->artwork) }}" onerror="showFileImg(this);" alt="Artwork" />
													</span>
												</div>
											@endforeach
											</div>

										@endif

									</td>
									<td class="product-name">
										<p>{{ $item->paperstockopt->option }}</p>

										@if($item->sticker_type) 
										<h5>Sticker Type : <span>{{ $item->sticker_type }}</span> </h5> 
										@endif

										@if($item->laminating) 
										<h5>Laminating : <span>{{ \App\OptLamination::find($item->laminating)->option }}</span> </h5> 
										@endif

										@if($item->sticker_name) 
										<h5>Printing Name : <span>{{ $item->sticker_name }}</span> </h5> 
										@endif

										<h5>Size : <span>{{ $item->width }} mm x {{ $item->height }} mm</span> </h5>

										@if($item->instructions) 
										<br/>
										<h3 class="label label-default instructions" title="{{ $item->instructions }}">Instructions affixed</h3>
										@endif
									</td>

									<td>

										@php
											$map_field_qty_id = \App\MapFrmProd::where([['product_id', $item->product->id], ['form_field_id', 3]])->firstOrFail()->id;
											$map_qty_option = \App\MapProdFrmOpt::where('mapping_field_id', $map_field_qty_id)->select('option_id')->get();

											$options = [];
											foreach($map_qty_option as $row){
												$options[] = \App\OptQty::findOrFail($row->option_id)->option;
											}

											sort($options);
										@endphp

										<select class="form-control cart-qty" data-cart-id="{{ $item->id }}" style="width:100px;">
											@foreach($options as $row)
												<option value="{{ $row }}" {{ ($item->qty == $row)? 'selected' : '' }}>{{ $row }}</option>
											@endforeach
										</select>

										<div class="errtooltip" style="display: none;">
											<span class="arrow"></span>
											<span class="text">This field is required</span>
										</div>
									</td>
									
									<td class="price multiplied-price"><h5> <span class="current-price"><i class="fa fa-usd" aria-hidden="true"></i> {{ number_format($item->price) }}</span></h5></td>
									<td class="text-center text-danger"><span class="remove-item" data-cart-item="{{$item->id}}"><i class="fa fa-times-circle"></i></span></td>
								</tr>	
								@endforeach

							</tbody>
						</table>
					</div><!-- table-responsive -->
				</div><!-- row -->
				<div class="row" style="margin-top:20px;">
					<div class="col-sm-6">
						<a href="{{ url('/') }}" class="cnt-shopping">Continue Shopping</a>
					</div>
					<div class="col-sm-6 btn-right">
						<a href="#" class="clr-shopping">Clear Shopping Cart</a>
					</div>
					<div class="clearfix"></div>
				</div><!-- row -->
			</div>

			{{-- sidebar subtotal --}}
			<div class="col-sm-4">
				<div class="shop_measures">
					<h4 class="cart-head">cart totals</h4>
					<table class="table table-responsive">
						<tbody>
							<tr>
								<td>Subtotal</td>
								<td class="text-right"><h5 id="cart-subtotal"><i class="fa fa-usd" aria-hidden="true"></i> {{ number_format($subtotal) }}</h5></td>
							</tr>
							<tr class="happy-text">
								<td>Discount For Multiple Designs</td>
								<td class="text-right"><h5 id="cart-discount"><i class="fa fa-usd" aria-hidden="true"></i> {{ $discount_amount }}</h5></td>
							</tr>
							<tr>
								<td>Cart Total</td>
								<td class="text-right"><h5 class="price" id="tot-price"><i class="fa fa-usd" aria-hidden="true"></i> {{ number_format($payable) }}</h5></td>
							</tr>
							<tr><td></td><td></td></tr>
						</tbody>
					</table>
					<a href="{{ url('/checkout') }}" class="cnt-shopping process">Proceed to checkout</a>
				</div>

				<br><br>

				{{-- calendar --}}
				<h4 class="cart-head text-center">Estimated Date for Order Completion</h4>
				<div id="delivery-calendar"></div>

				<div class="turnaround_calendar_details">
					<div class="calendar_details_row">
						<div class="calendar_details_item">
							<div class="bullet calendar-grade-2"></div>
							<p>Order Date： <br> <span class="text-primary">{{ $delivery_dates['order_date'] }}</span></p>
						</div>
						<div class="calendar_details_item">
							<div class="bullet calendar-grade-3"></div>
							<p>Estimated Date for Printing Completion： <br> <span class="text-primary">{{ $delivery_dates['print'] }}  </span></p>
						</div>
					</div>
					<div class="calendar_details_row">
						<div class="calendar_details_item">
							<div class="bullet calendar-grade-4"></div>
							<p>Delivery Date： <br> <span class="text-primary">{{ $delivery_dates['delivery'] }}  </span></p>
						</div>
						<div class="calendar_details_item">
							<div class="bullet calendar-grade-1"></div>
							<p>Non-Business Day / Maintenance</p>
						</div>
					</div>
					<div class="turnaround_calendar_details_note">
						<p class="text-danger">**Printing and delivery estimates are based from final mockup approval</p>
					</div>
				</div>
			</div>

			<div class="clearfix"></div>
		</div><!-- cart -->
	</div><!-- container -->
</div>

@else

<div class="feature">
<div class="container">
	<div class="row" style="height: 400px">
		<h2>Your cart is empty</h2>
		<p class="subtitle">You may want to add some <a href="{{ url('/') }}">product</a> in your cart.</p>
	</div><!-- row -->
</div><!-- container -->
</div>

@endif

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

	<script type="text/javascript" src="{{ asset( 'assets/frontend/plugin/sweetalert/sweetalert.min.js' ) }}"></script>
	<script type="text/javascript" src="{{ asset( 'assets/frontend/js/cart.js' ) }}"></script>

	<script type="text/javascript" src="{{ asset( 'assets/frontend/plugin/tooltipster/js/tooltipster.bundle.min.js' ) }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.instructions').tooltipster({
				theme: 'tooltipster-shadow',
				side: 'right',
				maxWidth: 300
			});

			$('.pinned-artwork').tooltipster({
				side: 'top',
				maxWidth: 300,
			});
		});
	</script>

	<script type="text/javascript">
		function showFileImg(elem)
		{
			elem.src="{{ asset('assets/images/sample-file.png') }}";
		}
	</script>

	{{-- for calendar --}}
	<script type="text/javascript" src="{{ asset( 'assets/frontend/plugin/calendar/zabuto_calendar.min.js' ) }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#delivery-calendar").zabuto_calendar({
				show_previous: false,
				show_next: 1,
				today: true,
				nav_icon: {
					prev: '<i class="fa fa-chevron-circle-left"></i>',
					next: '<i class="fa fa-chevron-circle-right"></i>'
				},
				ajax: {
					url: "{{ route('order.calendar.time') }}"
				}
			});
		});
	</script>

@endpush
