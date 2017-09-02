@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>My Orders | {{ config('app.name') }}</title>

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
					<h2>My Orders</h2>

					@if($orders)

					<div class="table-responsive">
						<div class="clearfix"></div><table class="table">
							<thead>
								<tr>
									<td><strong>Order ID</strong></td>
									<td><strong>Transaction ID</strong></td>
									<td><strong>Total Price</strong></td>
									<td><strong>Order Date</strong></td>
									<td><strong>Order Status</strong></td>
									<td><strong>View</strong></td>
								</tr>
							</thead>
							<tbody id="order-list">
								
									@foreach($orders as $order)									
									<tr>
										<td><div class="order-id">{{ $order->order_token }}</div></td>		
										<td><div class="trans-id">{{ $order->transaction_id }}</div></td>						
										<td class="order-price">
											<h5>
												<span style="color: #555;"></span> <i class="fa fa-usd" aria-hidden="true"></i> 
												{{ number_format($order->price) }}
											</h5>
										</td>
										<td class=""><span><i class="fa fa-clock-o"></i> {{ $order->created_at }}</span></td>
										<td>
											<div 

											@if($order->orderStatus->id == 5)
												class="label label-success"
											@elseif($order->orderStatus->id == 6)
												class="label label-default"
											@else
												class="label label-info"
											@endif

											>{{ $order->orderStatus->status_text }}</div>
										</td>

										<td><a href="{{ url('/user/my-order/'.$order->order_token) }}" class="btn btn-default">View Details</a></td>
									</tr>
									@endforeach
															
							</tbody>
						</table>

						{{ $orders->links('vendor.pagination.userpanel') }}


					</div>

					@else

						<div class="well well-lg">
							<h2>You have never purchased from us! try today</h2>
						</div>

					@endif

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
