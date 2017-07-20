@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Change account password | {{ config('app.name') }}</title>

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

	<h2>update your account's password</h2>

  <form class="form-horizontal" action="{{ url( 'user/request/change-password' ) }}" method="POST">

  	{{ csrf_field() }}

  	<input type="hidden" name="_method" value="PUT">

    <div class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Current Password:</label>
      <div class="col-sm-10">
        <input class="form-control" name="current-password" type="password">

        @if ($errors->has('current-password'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('current-password') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('new-password') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">New Password:</label>
      <div class="col-sm-10">
        <input class="form-control" name="new-password" placeholder="minimum 5 character" type="password">

        @if ($errors->has('new-password'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('new-password') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('retype-password') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Re-type Password:</label>
      <div class="col-sm-10"> 
        <input class="form-control" name="retype-password" placeholder="confirm new password" type="password">

        @if ($errors->has('retype-password'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('retype-password') }}</strong>
            </span>
        @endif

      </div>
    </div>

    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-info">Save</button>
      </div>
    </div>

  </form>

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