<div class="prf-block">
	<div class="prf-img"><img id="content_imgdp" src="{{ getLoggedinCustomerPic() }}"></div>
	<span>{{ Auth::user()->name }}</span>
</div>

<span class="dividr1"></span>
<span class="dividr1"></span>
<div class="clearfix"></div>


<div class="db-menu">
	<ul>
		<li {!! ($page == 'dashboard')? 'class="current"' : '' !!} >
			<a href="{{ route('user.dashboard') }}" rel="nofollow">
				<div class="icon"><i class="fa fa-dashboard"></i></div>
				<div class="txt">My Dashboard</div>
				<div class="nf"></div>
			</a>
		</li>

		<li {!! ($page == 'profile')? 'class="current"' : '' !!} >
			<a href="{{ url('/user/profile') }}">
				<div class="icon"><i class="fa fa-user"></i></div>
				<div class="txt">Update Profile Info</div>
			</a>
		</li>

		@if(session('init_signup'))
			<li {!! ($page == 'init_password')? 'class="current"' : '' !!} ><a href="{{ url('/user/set-password') }}"><div class="icon"><i class="fa fa-key"></i></div><div class="txt">Set Password</div></a></li>
		@else
			<li {!! ($page == 'change_password')? 'class="current"' : '' !!} ><a href="{{ url('/user/change-password') }}"><div class="icon"><i class="fa fa-key"></i></div><div class="txt">Change Password</div></a></li>
		@endif

		<li {!! ($page == 'reviews')? 'class="current"' : '' !!}>
			<a href="{{ url('/user/my-reviews') }}">
				<div class="icon"><i class="fa fa-comments"></i></div>
				<div class="txt">My Reviews</div>
				<div class="nf"></div>
			</a>
		</li>
		
		<li><a href="#"><div class="icon"><i class="fa fa-th-list"></i></div><div class="txt">My Orders</div><div class="nf"></div></a></li>
		
		<li><a id="content_LinkButton1" href="javascript:void();" onclick="LogoffUser();"><div class="icon"><img title="" alt="" src="{{ asset( 'assets/images/icon8.png' ) }}" width="22" height="22"></div><div class="txt">Logout</div></a></li>
	</ul>			
</div>