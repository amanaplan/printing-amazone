<div class="prf-block">
					<div class="prf-img"><img id="content_imgdp" src="https://www.jonscoupons.com/assets/images/demo.jpg">
					</div>
					<span>{{ Auth::user()->name }}</span>
				</div>
				<span class="dividr1"></span>
				<span class="dividr1"></span>
				<div class="clearfix"></div>

				<div class="db-menu">
					<ul>
	<li {!! ($page == 'dashboard')? 'class="current"' : '' !!} ><a href="{{ route('user.dashboard') }}" rel="nofollow"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon3.png' ) }}" width="22" height="22"></div><div class="txt">My Dashboard</div><div class="nf"></div></a></li>
	
	<li><a href="#"><div class="icon"><i class="fa fa-envelope"></i></div><div class="txt">Change Email-Id</div></a></li>

	<li><a href="#"><div class="icon"><i class="fa fa-user"></i></div><div class="txt">Update Profile Info</div></a></li>

	@if(session('init_signup'))
		<li {!! ($page == 'init_password')? 'class="current"' : '' !!} ><a href="{{ url('/user/set-password') }}"><div class="icon"><i class="fa fa-key"></i></div><div class="txt">Set Password</div></a></li>
	@else
		<li {!! ($page == 'change_password')? 'class="current"' : '' !!} ><a href="#"><div class="icon"><i class="fa fa-key"></i></div><div class="txt">Change Password</div></a></li>
	@endif

	<li><a href="#"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon4.png' ) }}" width="22" height="22"></div><div class="txt">Favorite Sticker</div><div class="nf"></div></a></li>
	
	<li><a href="#"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon4.png' ) }}" width="22" height="22"></div><div class="txt">Business Cards</div><div class="nf"></div></a></li>
	
	<li><a id="content_LinkButton1" href="javascript:void();" onclick="LogoffUser();"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon8.png' ) }}" width="22" height="22"></div><div class="txt">Logout</div></a></li>

</ul>				</div>