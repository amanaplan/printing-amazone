@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Update profile | Printing Amazone</title>

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

  <h2>update your profile details</h2>

  <form class="form-horizontal" action="{{ url( 'user/request/update-profile' ) }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <input type="hidden" name="_method" value="PUT">

    <div class="form-group {{ $errors->has('profile_pic') ? ' has-error' : '' }}">
      <label class="control-label col-sm-2">Profile Picture</label>
      <div class="col-sm-10">
        <input class="form-control" name="profile_pic" type="file" accept=".jpg,.png,.gif,.jpeg">

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