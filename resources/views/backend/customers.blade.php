@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    Manage Customers
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

                        <h4 class="pull-left">Manage Customers

                        </h4>


                        <ol class="breadcrumb pull-right">
                            <li><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                            <li>Customer List</li>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="input-order-id">Search Customer</label>
                                    <input type="text" name="customer" value="{{ (Request::has('customer'))? Request::input('customer') : '' }}" placeholder="customer name or email or mobile" id="input-order-id" class="form-control">
                                </div>
                                @if(Request::has('customer'))
                                <a href="{{ route('manage.customers') }}" class="btn btn-primary"><i class="fa fa-times"></i> Clear search</a>
                                @endif
                                <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </form>
                            
                    </div>
                </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            
                            <td class="text-center">                    Photo
                            </td>
                            <td class="text-right">                     Name &amp; Birthday
                            </td>
                            <td class="text-center">                    Contact Details
                            </td>
                            <td class="text-right">                    Total Purchase
                            </td>
                            <td class="text-right">                    Order Count
                            </td>
                            <td class="text-right">                    Published Reviews
                            </td>
                            <td class="text-right">                    Account created on
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td class="text-center">
                                <img width="80" src="{{ getTheCustomerPic($customer->id) }}">
                            </td>
                            <td class="text-left">
                                <ul class="list-group">
                                    <li class="list-group-item">{{ $customer->name }}</li>  
                                    @if($customer->birthday)
                                    <li class="list-group-item"><i class="fa fa-birthday-cake" aria-hidden="true"></i> 
                                        @php
                                            $dt = Carbon\Carbon::parse($customer->birthday);
                                        @endphp
                                        {{ $dt->formatLocalized('%A %d %B %Y') }}
                                    </li>
                                    @endif
                                </ul> 
                            </td>
                            <td class="text-center">
                                <ul class="list-group">
                                    <li class="list-group-item"><i class="fa fa-envelope"></i> {{ $customer->email }}</li>
                                    <li class="list-group-item"><i class="fa fa-phone"></i> {{ ($customer->mobile)?? 'NA' }}</li>
                                </ul>
                                
                                
                            </td>
                            <td class="text-right">$ {{ number_format(\App\Order::where([['user_id', $customer->id],['status', 5]])->sum('price')) }}</td>
                            <td class="text-right">{{ \App\Order::where('user_id', $customer->id)->count() }}</td>
                            <td class="text-right">
                                {{ $customer->reviews_count }}
                            </td>
                            <td class="text-right">
                                {{ $customer->created_at }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            </div>

        </div>

        <div class="row">
            <div class="col-sm-6 text-left">
                @if(Request::has('customer'))
                {{ $customers->appends(['customer' => Request::input('customer')])->links() }}
                @else
                {{ $customers->links() }}
                @endif
            </div>
            
        </div>

        <div class="clearfix"></div>
    </div>

@stop
{{-- page specific js --}}
@push('scripts')

@endpush
