@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    manage footer page links appearance
@stop

{{-- page specific css --}}
@push('styles')
    
    {{-- css switch --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/switch.css') }}">

@endpush

{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Manage Footer Links</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li><a href="{{ url('/admin/cms/list-pages') }}"> manage pages</a></li>
                        <li>Footer Links</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Set Page Appearance
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/cms/add-page') }}" class="btn btn-info btn-rounded btn-xs">Add Page</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <form action="{{ url('/admin/cms/set-footer-links') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea class="form-control" name="links" rows="10" placeholder="page name <page link>, ...">{{ $links }}</textarea>
                            </div>
                            <input type="submit" value="Save Changes" class="btn btn-success" />
                        </form>
                    </div>

                </div>
            </div><!-- End .panel --> 


        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')

@endpush
