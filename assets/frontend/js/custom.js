const SERVER_ADDR = 'http://localhost/srv/printing-amazone/';

/** google oauth2.0 **/

var googleUser = {};
var startApp = function() {
	gapi.load('auth2', function(){
	  	// Retrieve the singleton for the GoogleAuth library and set up the client.
		auth2 = gapi.auth2.init({
			client_id: '1093997638360-20eh43rvact2hetl1bbd5kt1f339g0nq.apps.googleusercontent.com',
			cookiepolicy: 'single_host_origin',
			// Request scopes in addition to 'profile' and 'email'
			scope: 'profile email'
		});

		attachSignin(document.getElementById('customLogin'));
		attachSignup(document.getElementById('customSignup'));
	});
};

function attachSignin(element) {
//console.log(element.id);
auth2.attachClickHandler(element, {},
    function(googleUser) {
    	var userEmail = googleUser.getBasicProfile().getEmail();
    	$("#login-processing-msg").html('Logging in. . . <i class="fa fa-refresh fa-spin fa-lg"></i>');
    	$("signin-button").prop('disabled', true);
    	$("#login-msg").css('display','none');

    	//ajax
    	$.ajaxSetup({
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	        url: SERVER_ADDR+"attempt/google-login",
	        type: "POST",
	        dataType: 'json',
	        data: {email:userEmail},
	        success: function(result){
	        	if(result['error'] == 1)
	        	{
	        		$("#login-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>'+result['msg']+'</strong>').css('display','block');
	        		$("#login-processing-msg").html('Login via');
	        		$("signin-button").prop('disabled', false);
	        	}
	        	else
	        	{
	        		$("#login-processing-msg").hide();
	        		$("#login-msg").removeClass('alert-danger').addClass('alert-success').html('<strong>'+result['msg']+'</strong>').css('display','block');
	        		document.location.reload();
	        	}
	        },
	        error: function(xhr,status,error){
	        	$("#login-processing-msg").html('Login via');
	          	$("#login-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>Upss! some server error occurred try again</strong>').css('display','block');
	        	$("signin-button").prop('disabled', false);
	        }
	    });

	    $.ajax();
    	//ajax
      /*document.getElementById('name').innerText = "Signed in: " +
         googleUser.getBasicProfile().getName() + "given namer: " + googleUser.getBasicProfile().getGivenName() + "image" + googleUser.getBasicProfile().getImageUrl() + "email-id" + googleUser.getBasicProfile().getEmail();*/
    }, function(error) {
      	console.log(JSON.stringify(error, undefined, 2));
    });
}

function attachSignup(element) {
//console.log(element.id);
auth2.attachClickHandler(element, {},
    function(googleUser) {
    	var userEmail = googleUser.getBasicProfile().getEmail();
    	var userFullName = googleUser.getBasicProfile().getName();

    	$("#signup-processing-msg").html('Creating account. . . <i class="fa fa-refresh fa-spin fa-lg"></i>');
    	$("signup-button").prop('disabled', true);
    	$("#signup-msg").css('display','none');

    	//ajax
    	$.ajaxSetup({
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	        url: SERVER_ADDR+"attempt/google-signup",
	        type: "POST",
	        dataType: 'json',
	        data: {email:userEmail, name:userFullName},
	        success: function(result){
	        	if(result['error'] == 1)
	        	{
	        		$("#signup-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>'+result['msg']+'</strong>').css('display','block');
	        		$("#signup-processing-msg").html('Signup via');
	        		$("signup-button").prop('disabled', false);
	        	}
	        	else
	        	{
	        		$("#signup-processing-msg").hide();
	        		$("#signup-msg").removeClass('alert-danger').addClass('alert-success').html('<strong>'+result['msg']+'</strong>').css('display','block');
	        		document.location.assign(SERVER_ADDR+"user/set-password");
	        	}
	        },
	        error: function(xhr,status,error){
	        	$("#signup-processing-msg").html('Signup via');
	          	$("#signup-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>Upss! some server error occurred try again</strong>').css('display','block');
	        	$("signup-button").prop('disabled', false);
	        }
	    });

	    $.ajax();
    	//ajax
    }, function(error) {
      console.log(JSON.stringify(error, undefined, 2));
    });
}

/** start the google oauth2.0 **/
startApp();

/** google oauth2.0 end **/

/** logging out user **/
function LogoffUser() {
	$.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: SERVER_ADDR+"user/logout",
        type: "POST",
        success: function(result){
        	var auth2 = gapi.auth2.getAuthInstance();
		    auth2.signOut().then(function () {
		      //console.log('User signed out.');
		    });
        	document.location.assign(SERVER_ADDR);
        },
        error: function(xhr,status,error){
        	alert('some server error occurred');
        }
    });

    $.ajax();
}

/* user dropdown menu */
$('nav.main-nav ol li.dropdown').hover(
	function() {	  
		$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();	
	}, 
	function() {
	 	$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(); 
	}
);