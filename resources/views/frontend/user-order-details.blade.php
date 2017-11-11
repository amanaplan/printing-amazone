@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Order Summary | {{ config('app.name') }}</title>

@stop

{{-- page specific styles --}}
@push( 'styles' )
	@include('layouts.frontend.userpanel-styles')
@endpush

{{-- main page contents --}}
@section('contents')

<div class="dashboard-area">
		<div class="container">
			<div class="row dasboard">
			
			<div class="col-lg-3 col-sm-4 left-part">
				@include('layouts.frontend.user-sidebar')
			</div>

			<div class="col-lg-9 col-sm-8 right-part">
				
				<div class="white-box profile-form">
					<h2>Order Summary #{{ $order->order_token }}</h2>
					<div class="table-responsive">
						<div class="clearfix"></div><table class="table">
							<thead>
								<tr>
									<td colspan="1"><strong>Product</strong></td>
									<td colspan="1"><strong>Details</strong></td>
									<td colspan="1"><strong>Mockup</strong></td>
									<td colspan="1"><strong>Size</strong></td>
									<td colspan="1"><strong>Qty.</strong></td>
									<td colspan="2" align="right"><strong>Price</strong></td>
								</tr>
							</thead>
							<tbody id="order-list">
												
								@foreach($order->orderItems as $item)						
									<tr>
										<td class="product-name">
											<a href="{{ url('/'.$item->product->category->category_slug.'/'.$item->product->product_slug) }}" target="_blank">
												<img width="80" src="{{ asset('assets/images/products/'.$item->product->logo) }}" style="margin-right: 10px; float: left; border: 1px solid #ddd;">
												<h5>{{ $item->product->product_name }}</h5>
											</a>
											<br>
										</td>
										<td class="product-name">
											<p><strong>Paperstock:</strong> {{ $item->paperstock }}</p>

											@if($item->sticker_type)
											<p><strong>Sticker Type:</strong> {{ $item->sticker_type }}</p>
											@endif

											@if($item->laminating)
											<p><strong>Laminating:</strong> {{ $item->laminatingOpt->option }}</p>
											@endif

											@if($item->sticker_name)
											<p><strong>Printing Name:</strong> {{ $item->sticker_name }}</p>
											@endif
										</td>	
										<td>
											<p>
												@if($item->mockup_approved || $order->orderStatus->status_text == "Completed")
													<a class="btn btn-info" href="#">View Mockup</a>
												@elseif($order->orderStatus->status_text == "Cancelled")
													NA
												@else
													<a class="btn btn-warning" href="{{ route('user.review.mockup', ['order_token' => $order->order_token, 'order_item_id' => $item->id]) }}">Review Mockup</a>
												@endif
											</p>
										</td>							
										<td class="price">
											<h5>{{ $item->width }} x {{ $item->height }} mm<sup>2</sup></h5>
										</td>
										<td class="price" style="border-right: 1px solid #ddd;">
											<h5>{{ $item->qty }}</h5>
										</td>
										<td class="price" align="right" style="border-right: 1px solid #ddd;"><h5><span style="color: #555;"></span> <i class="fa fa-usd" aria-hidden="true"></i> {{ number_format($item->price) }}</h5></td>
									</tr>
								@endforeach

								<tr>
								    <td rowspan="3" colspan="3"><div class="address">
										    <h2>Shipping Address :</h2>
											<p>{{ $order->billing->city }}, {{ $order->billing->country->country_name }}, {{ $order->billing->state }} - {{ $order->billing->zipcode }}</p><br>
											<p>{{ $order->billing->street }}</p>
										</div>
									</td>
									<td colspan="2"><div class="total"><span style="font-weight: 700;">Subtotal :</span></div></td>
									<td colspan="3"><div class="total"><h5><i class="fa fa-usd" aria-hidden="true"></i> {{ number_format($order->price + $order->discount) }}</h5></div></td>
								</tr>
								<tr>
									<td colspan="2"><div class="total"><span style="font-weight: 700;">Discount :</span></div></td>
									<td colspan="3"><div class="total"><h5><i class="fa fa-usd" aria-hidden="true"></i> {{ $order->discount }}</h5></div></td>
								</tr>
								<tr>
									<td colspan="2"><div class="total"><span style="font-weight: 700;">Total :</span></div></td>
									<td colspan="3"><div class="total"><h5><i class="fa fa-usd" aria-hidden="true"></i> {{ $order->price }}</h5></div></td>
								</tr>
							</tbody>
						</table>
						</div>

				</div>
					
			</div>
			<div class="clearfix"></div>
		</div>
		</div><!-- container -->
	</div><!-- dashboard-area -->

@stop


{{-- page specific scripts --}}
@push( 'scripts' )

@endpush
