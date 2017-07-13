const SERVER_ADDR = 'http://localhost/srv/printing-amazone/public/';

/** google oauth2.0 **/

var googleUser = {};
var startApp = function() {
	gapi.load('auth2', function(){
	  	// Retrieve the singleton for the GoogleAuth library and set up the client.
		auth2 = gapi.auth2.init({
			client_id: '38890949573-8sjuit3hpgfjoadjfe62312va55m8pdc.apps.googleusercontent.com',
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

/** user login via email password **/
$("button#signin-button").click(function(){
    var elem = $(this);
    var mailfld = $("input#signin-email");
    var passwfld = $("input#signin-password");

    var mailId = $.trim(mailfld.val());
    var passWord = $.trim(passwfld.val());
    var rem = $("#remember-me").is(':checked') ? 1 : 0;
    
    if(mailId === '')
    {
        mailfld.css('border', '1px solid #ff0000');
        passwfld.css('border', '1px solid #d2d8d8');
    }
    else if(passWord === ''){
        passwfld.css('border', '1px solid #ff0000');
        mailfld.css('border', '1px solid #d2d8d8');
    }
    else
    {
        mailfld.css('border', '1px solid #d2d8d8');
        passwfld.css('border', '1px solid #d2d8d8');

        elem.prop('disabled',true);
        elem.html('<i class="fa fa-refresh fa-spin fa-fw"></i> Please wait. . .');

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: SERVER_ADDR+"attempt/user-login",
            type: "POST",
            dataType: 'json',
            data: {email:mailId, password:passWord, rem:rem},
            success: function(result){
                if(result['error'] == 1)
                {
                    $("#login-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>'+result['msg']+'</strong>').css('display','block');
                    passwfld.val('');
                }
                else
                {
                    $("#login-msg").removeClass('alert-danger').addClass('alert-success').html('<strong>'+result['msg']+'</strong>').css('display','block');
                    mailfld.val('');
                    passwfld.val('');
                    document.location.reload();
                }
                
                elem.prop('disabled',false);
                elem.html('Sign In');
            },
            error: function(xhr,status,error){
                $("#login-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>Upss! some server error occurred try again</strong>').css('display','block');
                elem.prop('disabled',false);
                elem.html('Sign In');
            }
         });

        $.ajax();
    }

});

$("form#login-form").submit(function(ev){
    ev.preventDefault();
    if($("button#signin-button").prop('disabled') != true)
    {
        $("button#signin-button").click();
    }
});

/** user signup via email **/
$("button#signup-button").click(function(){
	var elem = $(this);
	var mailfld = $("input#signup-email");
    var mailId = $.trim(mailfld.val());
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(mailId === '')
    {
    	mailfld.css('border', '1px solid #ff0000');
    }
    else if(mailId != '')
    {
    	if(re.test(mailfld.val()) == true)
    	{
    		mailfld.css('border', '1px solid #d2d8d8');
    		elem.prop('disabled',true);
    		elem.html('<i class="fa fa-refresh fa-spin fa-fw"></i> Please wait. . .');

    		$.ajaxSetup({
		        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		        url: SERVER_ADDR+"attempt/signup-via-email",
		        type: "POST",
		        dataType: 'json',
		        data: {mail:mailfld.val()},
		        success: function(result){
		        	if(result['error'] == 1)
		        	{
		        		$("#signup-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>'+result['msg']+'</strong>').css('display','block');
		        	}
		        	else
		        	{
		        		$("#signup-msg").removeClass('alert-danger').addClass('alert-success').html('<strong>'+result['msg']+'</strong>').css('display','block');
		        		mailfld.val('');
		        	}
		        	
		        	elem.prop('disabled',false);
		        	elem.html('Create Account');
		        },
		        error: function(xhr,status,error){
		          	$("#signup-msg").removeClass('alert-success').addClass('alert-danger').html('<strong>Upss! some server error occurred try again</strong>').css('display','block');
		        	elem.prop('disabled',false);
		        	elem.html('Create Account');
		        }
		     });

		    $.ajax();
    	}
    	else
    	{
    		mailfld.css('border', '1px solid #ff0000');
    	}
    }
});

$("form#signup-form").submit(function(ev){
    	ev.preventDefault();
    	if($("button#signup-btn").prop('disabled') != true)
    	{
    		$("button#signup-btn").click();
    	}
    });