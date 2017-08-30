@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    Manage Orders
@stop

{{-- page specific css --}}
@push('styles')

<style type="text/css">
    button.savestatus{margin-top: 10px;}
</style>

@endpush

{{-- main page content --}}
@section('contents')

    <div class="content-wrapper container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
                    <div class="row">

                        <h4 class="pull-left">{{ $page_title }} 
                            @if(Request::has('page'))
                                <br><br>
                                <small class="text-info">Showing page: {{ $orders->currentPage() }}, among total: {{ $orders->total() }} page(s)</small>
                            @endif
                        </h4>


                        <ol class="breadcrumb pull-right">
                            <li><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                            <li>Orders List</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div><!-- end .page title-->

        <div class="row">
            <div class="col-sm-12">

                <div class="well">
                    <div class="row">
                        <form action="" method="get">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-order-id">Order ID</label>
                                    <input type="text" name="order_id" value="" placeholder="Order ID" id="input-order-id" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-customer">Customer</label>
                                    <input type="text" name="customer" value="" placeholder="Customer" id="input-customer" class="form-control" autocomplete="off"><ul class="dropdown-menu"></ul>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-order-id">Transaction ID</label>
                                    <input type="text" name="trans_id" value="" placeholder="Transaction ID" id="input-order-id" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-date-added">Date Added</label>
                                    <div class="input-group date">
                                        <input type="text" name="date_added" value="" placeholder="YYYY-MM-DD" id="input-date-added" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                        </span></div>
                                </div>
                                <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <td class="text-right">                    Order ID
                                    </td>
                                    <td class="text-right">                    Transaction ID
                                    </td>
                                    <td class="text-center">                    Customer
                                    </td>
                                    <td class="text-right">                    Total Price
                                    </td>
                                    <td class="text-left">                    Order Placed On
                                    </td>
                                    <td class="text-left">                    Status
                                    </td>
                                    <td class="text-left">                    View Order
                                    </td>
                                    <td class="text-right">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td class="text-right"><code>{{ $order->order_token }}</code></td>
                                    <td class="text-right"><code>{{ $order->transaction_id }}</code></td>
                                    <td class="text-center" style="width: 20%;">
                                        @if($order->user)
                                            <img style="width: 40%;" src="{{ getTheCustomerPic($order->user->id) }}" />
                                            <p><i class="fa fa-user"></i> {{$order->user->name}}</p>
                                            <p><i class="fa fa-envelope"></i> {{$order->user->email}}</p>
                                        @else
                                            <span class="label label-warning">Guest</span>
                                            <p><i class="fa fa-user"></i> {{$order->billing->name}}</p>
                                            <p><i class="fa fa-envelope"></i> {{$order->billing->email}}</p>
                                        @endif
                                    </td>
                                    <td class="text-right"><span class="label label-success">$ {{ $order->price }}</span></td>
                                    <td class="text-left">{{ $order->created_at }}</td>
                                    <td class="text-left">
                                         <select class="form-control" onchange="showSaveBtn(this);">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}" {{ ($order->orderStatus->id == $status->id)? 'selected' : '' }}>{{ $status->status_text }}</option>
                                            @endforeach
                                        </select>

                                        <button style="display: none;" type="button" class="btn btn-success btn-sm savestatus"><i class="fa fa-check"></i> save</button>
                                    </td>
                                    <td class="text-left">

                                        <a href="#" class="btn btn-info">view order</a>
                                    </td>
                                    <td class="text-right">
                                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>



            </div> 
        </div>
        <div class="row">
            <div class="col-sm-6 text-left">
                {{ $orders->links() }}
            </div>
            
        </div>

        <div class="clearfix"></div>
    </div>

@stop
{{-- page specific js --}}
@push('scripts')

    <script type="text/javascript">
        function showSaveBtn(elem)
        {
            $(elem).closest('tr').find('button.savestatus').show();
        }
    </script>

@endpush
