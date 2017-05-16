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

                            <p class="card-stats-title right panel-title">Projects</p>

                            <h4 class="right panel-middle margin-b-0">3100</h4>

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

                            <p class="card-stats-title right panel-title">All Users</p>

                            <h4 class="right panel-middle margin-b-0">6,782</h4>

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

                            <p class="card-stats-title right panel-title">Total TODO</p>

                            <h4 class="right panel-middle margin-b-0">6,782</h4>

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

                            <p class="card-stats-title right panel-title">Todo Completed</p>

                            <h4 class="right panel-middle margin-b-0">1782</h4>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                </div>





            </div>

        </div>

    </div>



    <div class="row">

        <div class="col-sm-6">

            <div class="panel panel-card recent-activites">

                <!-- Start .panel -->

                <div class="panel-heading">

                    All Tasks

                    <div class="pull-right">

                        <div class="btn-group">

                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>

                            <ul class="dropdown-menu panel-dropdown" role="menu">

                                <li><a href="#">Action</a></li>

                                <li><a href="#">Another action</a></li>

                                <li><a href="#">Something else here</a></li>

                                <li class="divider"></li>

                                <li><a href="#">Separated link</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="panel-body text-center">

                    <div id="piechart"></div>

                </div>

            </div><!-- End .panel --> 

        </div>

        <div class="col-sm-6">

            <div class="panel panel-card recent-activites">

                <!-- Start .panel -->

                <div class="panel-heading">

                    All Projects

                    <div class="pull-right">

                        <div class="btn-group">

                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>

                            <ul class="dropdown-menu panel-dropdown" role="menu">

                                <li><a href="#">Action</a></li>

                                <li><a href="#">Another action</a></li>

                                <li><a href="#">Something else here</a></li>

                                <li class="divider"></li>

                                <li><a href="#">Separated link</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="panel-body text-center">

                    <div id="columnchart_material" ></div>

                </div>

            </div><!-- End .panel --> 

        </div>

    </div>



</div>



@stop



{{-- page specific js --}}

@push('scripts')



@endpush