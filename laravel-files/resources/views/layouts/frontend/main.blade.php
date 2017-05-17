<!DOCTYPE html>

	<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]><html class="lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]> <html class="lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> 
	
<html lang="{{ config('app.locale') }}">
 
	<!--<![endif]-->
	<!--======= Head =========-->
	<head>

		<meta charset="utf-8">
		{{-- on page seo data --}}
		@yield( 'seo_data' )

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="{{ asset( 'assets/images/fabicon.png' ) }}">

		<!--======= Google Web Fonts =========-->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Arimo|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!--======= Awesome Font StyleSheet =========-->
		<link href="{{ asset( 'assets/frontend/font-awesome-4.7.0/css/font-awesome.min.css' ) }}" rel="stylesheet"> 

		<!--======= Helping Plug-in StyleSheets =========-->
		<!--<link href="css/bootstrap.min.css" rel="stylesheet" media="all">-->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ asset( 'assets/frontend/css/animate.min.css' ) }}" rel="stylesheet">
		<link href="{{ asset( 'assets/frontend/css/style.css' ) }}" rel="stylesheet" media="all">
		<link href="{{ asset( 'assets/frontend/css/responsive.css' ) }}" rel="stylesheet" media="all">
		<link href="{{ asset( 'assets/frontend/css/hover.css' ) }}" rel="stylesheet" media="all">

		<!--======= Responsive Bootstrap Carousel StyleSheet =========-->
		<link href="{{ asset( 'assets/frontend/css/responsive_bootstrap_carousel_mega_min.css' ) }}" rel="stylesheet" media="all">
		<link href="{{ asset( 'assets/frontend/css/theme.css' ) }}" rel="stylesheet" media="all">
		<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/reset.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

		<meta name="csrf-token" content="{{ csrf_token() }}">

		{{-- page specific styles --}}
		@stack( 'styles' )

	</head>

<body>

	<header class="main-header">
		<div class="container">
			<div class="row">
				<div class="top-header">
					<div class="logo">
						<a href="#"><img src="{{ asset( 'assets/images/logo.png' ) }}" class="img-responsive" /></a>
						<div class="top-menu">
							<nav class="main-nav">
								<ol>
									<!-- inser more links here -->
									<li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
									<li><a class="cd-signin" href="#0"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
									<li><a class="cd-signup" href="#0"><i class="fa fa-lock" aria-hidden="true"></i> Sign Up</a></li>
								</ol>
							</nav>
						</div><!-- top-menu -->
					</div><!-- logo -->
				</div><!-- top-header -->
				<div class="menu">
					<nav role="navigation">
			            <!-- Brand and toggle get grouped for better mobile display -->
			            <div class="navbar-header">
			                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
			                    <span class="sr-only">Toggle navigation</span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                </button>
			                <a href="#" class="navbar-brand sr-only">Menu</a>
			            </div>
			            <!-- Collection of nav links and other content for toggling -->
			            <div id="navbarCollapse" class="collapse navbar-collapse">
			                <ol class="nav navbar-nav">
								<li class="active hvr-underline-from-center"><a href="#" class="">Stickers</a></li>
								<li class="hvr-underline-from-center"><a href="javascript:void(0)">Business Cards</a></li>
								<li class="hvr-underline-from-center"><a href="javascript:void(0)">Brochures/Flyers</a></li>
								<li class="hvr-underline-from-center"><a href="javascript:void(0)">Postcards</a></li>
								<li class="hvr-underline-from-center"><a href="javascript:void(0)">Labels</a></li>
								<li class="hvr-underline-from-center"><a href="javascript:void(0)">Graphic designs</a></li>
			                </ol>
			            </div><!-- collapse navbar-collapse -->
			        </nav>
				</div><!-- menu -->
			</div>
		</div>
	</header><!-- header -->
		
	{{-- page contents --}}

	@yield( 'contents' )
	
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-menu col-sm-8 col-lg-8">
					<ul>
						<li><a href="#">About</a> /</li>
						<li><a href="#">Blog</a> /</li>
						<li><a href="#">Uses</a> /</li>
						<li><a href="#">Templates</a> /</li>
						<li><a href="#">FAQs</a> /</li>
						<li><a href="#">Returns &amp; Refund</a> /</li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div><!-- footer-menu -->
				<div class="social col-sm-4 col-lg-4">
					<ul>
						<li><a href="#" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="yt"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
					</ul>
				</div><!-- social -->
				<div class="clearfix"></div>
				<p class="copyright">Copyright {{ date( 'Y', time() ) }} - All Rights Reserved &copy; printingamazon.com</p>
			</div>
		</div>
	</div><!-- footer -->
	
	  <div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#0">Sign in</a></li>
				<li><a href="#0">New account</a></li>
			</ul>

			<div id="cd-login"> <!-- log in form -->
				<form class="cd-form">
					<p class="fieldset">
					  <span>Login via</span>

					  <div class="social-buttons">
						 <a href="#" class="btn btn-g"><i class="fa fa-google-plus"></i> Google+</a>

					  </div>

				   </p>
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" id="signin-password" type="text"  placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input type="checkbox" id="remember-me" checked>
						<label for="remember-me">Remember me</label>
					</p>

					<p class="fieldset">
						<input class="full-width" type="submit" value="Sign In">
					</p>
				</form>
				
				<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->

			<div id="cd-signup"> <!-- sign up form -->
				<form class="cd-form">
					<p class="fieldset">
					  <span>Login via</span>

					  <div class="social-buttons">
						 <a href="#" class="btn btn-g"><i class="fa fa-google-plus"></i> Google+</a>

					  </div>

				   </p>
					<p class="fieldset">
						<label class="image-replace cd-username" for="signup-username">Username</label>
						<input class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Username">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-email" for="signup-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signup-password">Password</label>
						<input class="full-width has-padding has-border" id="signup-password" type="text"  placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input type="checkbox" id="accept-terms">
						<label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Create account">
					</p>
				</form>

				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup -->

			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Reset password">
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
			</div> <!-- cd-reset-password -->
			<a href="#0" class="cd-close-form">Close</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->


	<!--======= JavaScript =========-->

	<!--======= jQuery =========-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!--======= Bootstrap =========-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="{{ asset( 'assets/frontend/js/main.js' ) }}"></script>

	<!--======= Touch Swipe =========-->
	<script src="{{ asset( 'assets/frontend/js/jquery.touchSwipe.min.js' ) }}"></script>

	<!--======= Customize =========-->
	<script src="{{ asset( 'assets/frontend/js/responsive_bootstrap_carousel.js' ) }}"></script>

	{{-- page specific scripts --}}
	@stack( 'scripts' )

</body>


</html>