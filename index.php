<html ng-app="loginApp">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="js/jquery.js"></script>
  <script src="js/lib/angular.min.js"></script>
  <script src='js/lib/firebase.js'></script>
  <script src='js/lib/angularfire.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.form.js"></script>
  <script src="js/register.js"></script>

  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/login-form.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <title>POP-Cart Login</title>
  
  <script>
  	var loginApp =angular.module('loginApp',['firebase']);
	loginApp.controller('LoginCtrl',['$scope','$firebase',function($scope,$firebase){
		$(".progress").hide();
		var displayError=function(errorMsg){
			$("#errorMsgBox").show();
			$("#errorMsgBox").empty();
			$("#errorMsgBox").append(errorMsg);
			setTimeout(function(){ 
				$("#errorMsgBox").hide();
			}, 1000);
		}
		
		
	}]);
  </script>

</head>

<body ng-controller="LoginCtrl">

<!--Facebook stuff-->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '906593039384747',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script>


  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
      console.log(response.authResponse.accessToken);
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    FB.api('/me', function(response) {
      console.log(response);
	  userObj=response;
      console.log('Successful login for: ' + response.name);
    });
  }
</script>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=653262148136076&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--Facebook stuff end-->
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="panel panel-default login-form-container">
        <div class="panel-body">
          <div class="row logo-container">
            <img src="img/PopCart.PNG" />
          </div>
          <div>
            <form class="form-horizontal" action="scripts/loginUser.php" enctype="multipart/form-data" method="post" id="loginForm" data-toggle="validator">
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="loginUser" id="username" placeholder="Username" required>
                </div>
              </div>
              <div class="form-group">
                <label for="loginPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="loginPw" id="loginPassword" placeholder="Password" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                 <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
				</fb:login-button>
                </div>
              </div>
			  
			<div id="errorLogin" class="alert alert-danger" style="display:none"role="alert"></div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                 <span> <button type="submit" class="btn btn-primary">Login</button>
				 <img class="spinner-logo" src="img/loading.gif"/>
				 </span>
                </div>
				<div class="col-sm-5">
				  <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#registerModal">Register</button>
				  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
        </div>
        <div class="modal-body">
          <form action="scripts/createUser.php" enctype="multipart/form-data" method="post" class="form-horizontal" id="registerForm" data-toggle="validator">
            <div class="form-group">
              <label for="registerName" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="registerName" name="userName" placeholder="Username" required>
              </div>
            </div>
            <div class="form-group">
              <label for="registerPw" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="registerPw" placeholder="Password"  name="password" required>
              </div>
            </div>

			<div class="form-group">
              <label for="registerConfirm" class="col-sm-2 control-label">Confirm</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="registerConfirm" placeholder="Confirm Password"  name="confirm" required>
              </div>
            </div>
			
			<div class="form-group">
              <label for="alias" class="col-sm-2 control-label">Alias</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="alias" placeholder="eg. John" name="alias" required>
              </div>
            </div>
			
			<div class="progress">
              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">0% Complete</span>
              </div>
            </div>
			
			<div id="errorMsgBox" class="alert alert-danger" style="display:none"role="alert"></div>
			<div id="successMsgBox" class="alert alert-success" style="display:none"role="alert"></div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success" name="submit">Register</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>