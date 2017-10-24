@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Update profile | {{ config('app.name') }}</title>

@stop

{{-- page specific styles --}}
@push( 'styles' )

  @include('layouts.frontend.userpanel-styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/plugin/datepicker/bootstrap-datepicker3.min.css') }}">

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

  <h2>update your profile details</h2>

  <form class="form-horizontal" action="{{ url( 'user/request/update-profile' ) }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <input type="hidden" name="_method" value="PUT">

    <div class="form-group {{ $errors->has('profile_pic') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Profile Picture</label>
      <div class="col-sm-10">
        <input class="form-control" name="profile_pic" type="file" accept=".jpg,.png,.gif,.jpeg"><em>[ 200 x 200 PX]</em>

        @if ($errors->has('profile_pic'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('profile_pic') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('full-name') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Full Name:</label>
      <div class="col-sm-10">
        <input class="form-control" name="full-name" value="{{ Auth::user()->name }}" placeholder="your full name" type="text">

        @if ($errors->has('full-name'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('full-name') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Mobile No.:</label>
      <div class="col-sm-10">
        <input class="form-control" name="mobile" value="{{ Auth::user()->mobile }}" placeholder="your mobile phone no." type="text">

        @if ($errors->has('mobile'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('mobile') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Birthday:</label>
      <div class="col-sm-10 date" data-provide="datepicker" data-date-end-date="0d" data-date-format="yyyy-mm-dd">
        <input class="form-control" name="birthday" value="{{ Auth::user()->birthday }}" placeholder="yyyy-mm-dd" type="text">
        <div class="input-group-addon" style="display: none;">
        </div>

        @if ($errors->has('birthday'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('birthday') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">State:</label>
      <div class="col-sm-10">
        <input class="form-control" name="state" value="{{ Auth::user()->state }}" type="text">

        @if ($errors->has('state'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('suburb') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Suburb:</label>
      <div class="col-sm-10">
        <input class="form-control" name="suburb" value="{{ Auth::user()->suburb }}" type="text">

        @if ($errors->has('suburb'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('suburb') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('post_code') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Post Code:</label>
      <div class="col-sm-10">
        <input class="form-control" name="post_code" value="{{ Auth::user()->post_code }}" type="text">

        @if ($errors->has('post_code'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('post_code') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('street') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Street Address:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="street">{{ Auth::user()->street }}</textarea>

        @if ($errors->has('street'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('street') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group {{ $errors->has('company') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Company:</label>
      <div class="col-sm-10">
        <input class="form-control" name="company" value="{{ Auth::user()->company }}" type="text">

        @if ($errors->has('company'))
            <span class="help-block m-b-none">
                <strong>{{ $errors->first('company') }}</strong>
            </span>
        @endif

       </div>
    </div>

    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-info">Save Changes</button>
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

  <script type="text/javascript" src="{{ asset('assets/frontend/plugin/datepicker/bootstrap-datepicker.min.js') }}"></script>

  <script type="text/javascript">
    $('.datepicker').datepicker();
  </script>

@endpush
