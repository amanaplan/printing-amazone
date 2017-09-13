@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    order details
@stop

{{-- page specific css --}}
@push('styles')
@endpush

{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Order Detail</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-sm-12">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-order" data-toggle="tab" aria-expanded="true">Order Details</a></li>
                <li class=""><a href="#tab-shipping" data-toggle="tab" aria-expanded="false">Shipping Details</a></li>
                <li class=""><a href="#tab-product" data-toggle="tab" aria-expanded="false">Products</a></li>
            </ul>
            <div class="tab-content white-bg">
                <div class="tab-pane active" id="tab-order">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>Order ID:</td>
                            <td>{{ $order->order_token }}</td>
                        </tr>
                        <tr>
                            <td>Transaction ID:</td>
                            <td>{{ $order->transaction_id }}</td>
                        </tr>
                        <tr>
                            <td>Total Purchase Amount:</td>
                            <td>$ {{ $order->price }}</td>
                        </tr>
                        <tr>
                            <td>Order Status:</td>
                            <td style="display: inline-flex;">
                                <form style="display: inline-flex;" action="{{ url('/admin/order/update-status') }}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('PUT')}}
                                    <input type="hidden" name="order" value="{{ $order->id }}">
                                    <select name="status" class="form-control">
                                        @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ ($order->status == $status->id)? 'selected' : '' }}>{{ $status->status_text }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-default">Save Change</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>Placed On:</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    </tbody></table>
                </div>
                <div class="tab-pane" id="tab-shipping">
                    <table class="table table-bordered">
                        <tbody><tr>
                            <td>Full Name:</td>
                            <td>{{ $order->billing->name }}</td>
                        </tr>
                        <tr>
                            <td>Email ID:</td>
                            <td>{{ $order->billing->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>{{ $order->billing->phone }}</td>
                        </tr>
                        <tr>
                            <td>Company:</td>
                            <td>{{ ($order->billing->company)?? 'NA' }}</td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>{{ \App\Country::where('cc_fips', $order->billing->country_fips)->first()->country_name }}</td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td>{{ $order->billing->city }}</td>
                        </tr>
                        <tr>
                            <td>Region / State:</td>
                            <td>{{ $order->billing->state }}</td>
                        </tr>
                        <tr>
                            <td>ZipCode:</td>
                            <td>{{ $order->billing->zipcode }}</td>
                        </tr>
                        <tr>
                            <td>Street Address:</td>
                            <td>{{ $order->billing->street }}</td>
                        </tr>
                        <tr>
                            <td>IP Address:</td>
                            <td>{{ $order->billing->ip_address  }}</td>
                        </tr>
                    </tbody></table>
                </div>
                <div class="tab-pane" id="tab-product">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="text-left">Product</td>
                                <td class="text-left">Size</td>
                                <td class="text-right">Quantity</td>
                                <td class="text-right">Artwork</td>
                                <td class="text-right">Price</td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($order->orderItems as $item)

                                @php
                                    $product = \App\Product::find($item->product_id);
                                @endphp
                            <tr>
                                <td class="text-left">
                                    <img width="50" src="{{ asset('assets/images/products/'.$product->logo) }}" />
                                    {{ $product->product_name }}
                                    <br>
                                    <strong>Paperstock:</strong> <span> {{ $item->paperstock }}</span>

                                    @if($item->sticker_type)
                                    <br>
                                    <strong>Sticker Type:</strong> <span> {{ $item->sticker_type }}</span>
                                    @endif

                                    @if($item->laminating)
                                    <br>
                                    <strong>Laminating:</strong> <span> {{ \App\OptLamination::find($item->laminating)->option }}</span>
                                    @endif

                                    @if($item->sticker_name)
                                    <br>
                                    <strong>Printing Name:</strong> <span> {{ $item->sticker_name }}</span>
                                    @endif
                                </td>
                                <td class="text-left">{{ $item->width }} x {{ $item->height }} mm<sup>2</sup></td>
                                <td class="text-right">{{ $item->qty }}</td>
                                <td class="text-right">
                                    @if($item->artwork)
                                    <form action="{{ route('download.artwork') }}" method="post" target="_blank">
                                        {{csrf_field()}}
                                        <input type="hidden" name="artwork" value="{{ $item->artwork }}" />
                                        <button type="submit" class="btn btn-success btn-sm">Download {{ formatSizeUnits(Storage::disk('public')->size($item->artwork)) }}</button>
                                    </form>
                                    @else
                                    <span class="label label-danger">Not Provided</span>
                                    @endif
                                </td>
                                <td class="text-right">$ {{ $item->price }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" class="text-right">Sub-Total:</td>
                                <td class="text-right">$ {{ $order->price + $order->discount }}.00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Multiple Order Discount:</td>
                                <td class="text-right">$ {{ $order->discount }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Total:</td>
                                <td class="text-right">$ {{ $order->price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')
@endpush
