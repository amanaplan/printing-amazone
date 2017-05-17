@extends('layouts/frontend/main')


{{-- seo info --}}
@section( 'seo_data' )

<title>Set your profile password | Printing Amazone</title>

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
				<div class="prf-block">
					<div class="prf-img"><img id="content_imgdp" src="https://www.jonscoupons.com/assets/images/demo.jpg">
					</div>
					<span>webuttam91@gmail.com</span>
				</div>
				<span class="dividr1"></span>
				<span class="dividr1"></span>
				<div class="clearfix"></div>

				<div class="db-menu">
					<ul>
	<li><a href="#" rel="nofollow"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon3.png' ) }}" width="22" height="22"></div><div class="txt">My Dashboard</div><div class="nf"></div></a></li>
	
	<li><a href="#"><div class="icon"><i class="fa fa-envelope"></i></div><div class="txt">Change Email-Id</div></a></li>

	<li><a href="#"><div class="icon"><i class="fa fa-user"></i></div><div class="txt">Update Profile Info</div></a></li>

			<li class="current"><a href="#"><div class="icon"><i class="fa fa-key"></i></div><div class="txt">Set Password</div></a></li>
		
	<li><a href="#"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon4.png' ) }}" width="22" height="22"></div><div class="txt">Favorite Sticker</div><div class="nf">
			</div></a></li>
	
	<li><a href="#"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon4.png' ) }}" width="22" height="22"></div><div class="txt">Business Cards</div><div class="nf">
			</div></a></li>
	
	<li><a id="content_LinkButton1" href="#"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon8.png' ) }}" width="22" height="22"></div><div class="txt">Logout</div></a></li>
</ul>				</div>

			</div>
			<div class="col-lg-9 col-sm-8 right-part">
				
					
<h1>Welcome, Uttam Biswas</h1>
<div class="white-box profile-form">

	<h2>Edit your password</h2>

  <form class="form-horizontal" action="" method="POST">

  	<input name="_token" value="AH4ZKO7Bljoarph5JNAiBehUeWvmSUDXdRSi1xaU" type="hidden">

    <div class="form-group ">
      <label class="control-label col-sm-2">New Password:</label>
      <div class="col-sm-10">
        <input class="form-control" name="newpassword" placeholder="***********" type="password">
        	      </div>
    </div>

    <div class="form-group ">
      <label class="control-label col-sm-2">Re-type Password:</label>
      <div class="col-sm-10"> 
        <input class="form-control" name="repassword" placeholder="***********" type="password">
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