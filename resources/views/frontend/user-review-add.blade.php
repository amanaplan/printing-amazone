@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Post a Review | {{ config('app.name') }}</title>

@stop

{{-- page specific styles --}}
@push( 'styles' )

  @include('layouts.frontend.userpanel-styles')

  <link rel="stylesheet" href="{{ asset( 'assets/frontend/css/star-rating.css' ) }}" media="all" type="text/css"/>

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

	<h2>Post a Review</h2>

  <form class="form-horizontal" action="{{ url( 'user/request/review-add' ) }}" method="POST">

  	{{ csrf_field() }}

    <div class="form-group {{ $errors->has('product') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Product:</label>
      <div class="col-sm-10">
        <select class="form-control" name="product" required="required">
          <option value=""> --Select one product to review-- </option>
          @foreach($products as $product)
            <option value="{{ $product->id }}" {{ (old('product'))? ($product->id == old('product'))? 'selected' : '' : '' }}> {{ $product->product_name }} </option>
          @endforeach
        </select>

        @if ($errors->has('product'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('product') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Review Title:</label>
      <div class="col-sm-10">
        <input class="form-control" name="title" placeholder="Enter your review hedaing, max 60 character" maxlength="60" type="text" value="{{ old('title') }}">

        @if ($errors->has('title'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Review Message:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="description" placeholder="Type your review text here..." rows="5">{{ old('description') }}</textarea>

        @if ($errors->has('description'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('rating') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Rate</label>
      <div class="col-sm-10">
        <input type="text" name="rating" value="{{ old('rating') }}" class="rating rating-loading" data-size="xs" title="">

        @if ($errors->has('rating'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('rating') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
        <a href="{{ url('/user/my-reviews') }}" class="btn btn-default">Cancel</a> <button type="submit" class="btn btn-info">Post Review</button>
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

  <script type="text/javascript" src="{{ asset('assets/frontend/js/star-rating.js') }}"></script>

@endpush