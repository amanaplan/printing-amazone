@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>My Dashboard | Printing Amazone</title>

@stop

{{-- page specific styles --}}
@push( 'styles' )
<link href="{{ asset( 'assets/frontend/css/dashboard.css' ) }}" rel="stylesheet">
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
				
		
    @if(session('flashtype'))
    <div class="alert alert-{{ session('flashtype') }}">{{ session('flashmsg') }}</div>
    @endif

    <div class="white-box profile-form">

    	<h4>Here is your dashboard</h4>

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