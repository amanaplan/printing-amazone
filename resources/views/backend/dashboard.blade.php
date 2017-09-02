@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    Dashboard
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



                    <h4 class="pull-left">Dashboard</h4>





                    <ol class="breadcrumb pull-right">

                        <li><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>

                        <li>Dashboard</li>

                    </ol>



                </div>

            </div>

        </div>

    </div>



    <div class="row">

        <div class="col-sm-3">

            <div class="card cyan white-text clearfix">



                <div class="clearfix">

                    <div class="row row-table">

                        <div class="col-xs-5 text-center bg-dark card-content-right"><i class="icon-layers background-icon"></i></div>

                        <div class="col-xs-7 text-center card-content-left">

                            <p class="card-stats-title right panel-title">Total Products</p>

                            <h4 class="right panel-middle margin-b-0">{{ $product }} @if($product < 100)&nbsp;&nbsp;@endif</h4>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                </div>



            </div>

        </div>



        <div class="col-sm-3">

            <div class="card orange white-text clearfix">

                <div class="clearfix">

                    <div class="row row-table">

                        <div class="col-xs-5 text-center bg-dark card-content-right"><i class="icon-user background-icon"></i></div>

                        <div class="col-xs-7 text-center card-content-left">

                            <p class="card-stats-title right panel-title">Customers</p>

                            <h4 class="right panel-middle margin-b-0">{{number_format($customers)}} @if($customers < 100)&nbsp;&nbsp;&nbsp;&nbsp;@endif</h4>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                </div>





            </div>

        </div>



        <div class="col-sm-3">

            <div class="card teal white-text clearfix">

                <div class="clearfix">

                    <div class="row row-table">

                        <div class="col-xs-5 text-center bg-dark card-content-right"><i class="icon-list background-icon"></i></div>

                        <div class="col-xs-7 text-center card-content-left">

                            <p class="card-stats-title right panel-title">Pending Orders</p>

                            <h4 class="right panel-middle margin-b-0">{{ $pending_order }}</h4>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                </div>





            </div>

        </div>



        <div class="col-sm-3">

            <div class="card green white-text clearfix">

                <div class="clearfix">

                    <div class="row row-table">

                        <div class="col-xs-5 text-center bg-dark card-content-right"><i class="icon-like  background-icon"></i></div>

                        <div class="col-xs-7 text-center card-content-left">

                            <p class="card-stats-title right panel-title">Active Reviews</p>

                            <h4 class="right panel-middle margin-b-0">{{ $total_reviews }}</h4>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                </div>





            </div>

        </div>

    </div>






</div>



@stop



{{-- page specific js --}}

@push('scripts')



@endpush
