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
 <script src="js/lib/ngFacebook.js"></script>
 
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/login-form.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <title>POP-Cart Login</title>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59574467-2', 'auto');
  ga('send', 'pageview');

</script>
  <script>
  	var loginApp =angular.module('loginApp',['firebase','ngFacebook']);
	loginApp.config( function( $facebookProvider ) {
  $facebookProvider.setAppId('906593039384747');
}).run( function( $rootScope ) {
  // Load the facebook SDK asynchronously
  (function(){
     if (document.getElementById('facebook-jssdk')) {return;}
     var firstScriptElement = document.getElementsByTagName('script')[0];
     var facebookJS = document.createElement('script'); 
     facebookJS.id = 'facebook-jssdk';

     facebookJS.src = '//connect.facebook.net/en_US/all.js';
     firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
   }());
});
	loginApp.controller('LoginCtrl',['$scope','$firebase','$facebook',function($scope,$firebase,$facebook){
		$(".progress").hide();
		var displayError=function(errorMsg){
			$("#errorMsgBox").show();
			$("#errorMsgBox").empty();
			$("#errorMsgBox").append(errorMsg);
			setTimeout(function(){ 
				$("#errorMsgBox").hide();
			}, 1000);
		};
	$scope.isLoggedIn = false;
	$scope.loginWithFB = function() {
    $facebook.login().then(function() {
      refresh();
    });
  }
  function refresh() {
    $facebook.api("/me").then( 
      function(response) {
        console.log(response);
        $scope.isLoggedIn = true;
		var username=response.id;
		$('.spinner-logo').fadeIn();
		var ref=new Firebase("https://popcart.firebaseio.com/users/"+username);
		var userObj=$firebase(ref).$asObject();
		userObj.$loaded(function(){
			var dataExists = userObj.$value !== null;
			if(!dataExists){
			$.post("scripts/createUser.php",{userName:username,password:response.id,confirm:response.id,alias:response.name}, function( data ) {
			if(data=="1"){
				document.cookie="username="+username;
				window.location.replace('home.php');
			}
		});
			}else{
				document.cookie="username="+username;
				window.location.replace('home.php');
			}
		});
	
      },
      function(err) {
        $console.log("Please log in");
      });
  }
}]);
  </script>

</head>

<body ng-controller="LoginCtrl">

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
			  
			<div id="errorLogin" class="alert alert-danger" style="display:none"role="alert"></div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                 <span> <button type="submit" class="btn btn-primary">Login</button>
				 <img class="spinner-logo" src="img/loading.gif"/>
				 </span>
                </div>
				 <div class="col-sm-5">
				  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#registerModal">Register</a>
				  </div>
              </div>
			  <div class="col-sm-offset-2"><a href="" ng-click="loginWithFB()">Login with Facebook</a></div>
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
              <label for="alias" class="col-sm-2 control-label">Full Name</label>
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