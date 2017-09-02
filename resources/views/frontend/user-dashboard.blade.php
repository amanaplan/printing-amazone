@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>My Dashboard | {{ config('app.name') }}</title>

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
				
		
    @if(session('flashtype'))
    <div class="alert alert-{{ session('flashtype') }}">{{ session('flashmsg') }}</div>
    @endif

    <div class="white-box profile-form">
		<h2>Account details</h2>
		<table id="details" class="responsive" cellpadding="2" width="100%">

			<tbody>
			  <tr>
				<td>Display name</td>
				<td>{{ Auth::user()->name }}</td>
			  </tr>
			  <tr>
				<td>Email ID</td>
				<td>
					{{ Auth::user()->email }}
				</td>
			  </tr>
			  <tr>
				<td>Total Purchase</td>
				<td>
					$ {{ number_format($purchase) }}
				</td>
			  </tr>
			  <tr>
				<td>Reviews Given</td>
				<td>
					{{ $reviews }}
				</td>
			  </tr>
			</tbody>
		 </table>

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
