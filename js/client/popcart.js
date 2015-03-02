(function() {

// Localize jQuery variable
var jQuery;

/******** Load jQuery if not present *********/
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.11.1') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "https://popcart.herokuapp.com/js/jquery.js");
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else { // Other browsers
      script_tag.onload = scriptLoadHandler;
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
} else {
    // The jQuery version on the window is the one we want to use
    jQuery = window.jQuery;
    main();
}

/******** Called once jQuery has loaded ******/
function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
    jQuery = window.jQuery.noConflict(true);
	loadAngular();
	loadBraintree();
    // Call our main function
    main(); 
}

/******** Load popCart JS ********/

function loadPopCart(){
	console.log("LoadPopCart Modal First");
	var modal=jQuery('body').append('<div id="viewCart" class="view-cart-overlay"><div class="modal-dialog"><div ng-controller="ClientCtrl" class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">View Cart</h4></div><div class="modal-body"><div id="cartPage"><table class="table table-striped"><tr><th>Image</th><th>Product Name</th><th>Quantity</th><th>Price</th><th></th></tr><tr ng-repeat="(id,item) in orderItems"><td class="vert-align"><img class="cart-item-image" src="{{item.product.image}}"></td><td >{{item.product.productName}}</td><td>{{item.quantity}}</td><td>{{item.product.price}}</td><td><button type="button" ng-click="removeItem(id)" class="btn btn-danger">Remove</button></a></td></tr></table></div><div id="checkoutPage" style="display:none;"><form action="scripts/transaction.php" method="POST" id="braintree-payment-form"><div class="form-group"><label for="cardNum">Card Number</label><input id="cardNum" class="form-control" type="text" size="20" autocomplete="off" data-encrypted-name="number" /></div><div class="form-group"><label for="cvv">CVV</label><input id="cvv" class="form-control" type="text" size="4" autocomplete="off" data-encrypted-name="cvv" /></div><div class="form-group"><label for="expiration">Expiration (MM/YYYY)</label><input id="expiration" class="form-control" type="text" size="2" name="month" /> / <input class="form-control" type="text" size="4" name="year" /></div><input class="btn btn-success" type="submit" id="submit" /></form></div></div><div class="modal-footer"><button id="closeModal" type="button" class="btn btn-default">Close</button><button id="checkoutBtn" type="submit" class="btn btn-primary" ng-click="moveToCheckOut()">Check Out</button></div></div></div></div>');
	
	//Change transaction.php to popcart's absolute path
}

/******** Load Angular JS********/
function loadAngular(){
	 if(typeof angular !== 'undefined'){
		 console.log("Angular Found");
	 }else{
		 var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "https://popcart.herokuapp.com/js/lib/angular.min.js");
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
	 }
	
	loadFireBase();
}

function loadBraintree(){
	 var found = false;
	var url='braintree'
   for(var i = 0; i < document.scripts.length; i++){
      if(document.scripts[i].src.indexOf(url)> -1){
          found=true;
          break;
      }
   }
   
   if(!found){
	   var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "https://js.braintreegateway.com/v1/braintree.js");
	/*if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
				//AngularJS Methods here
				loadCart;
          }
      };
    } else { // Other browsers
      //script_tag.onload = scriptLoadHandler;
	  //AngularJS Methods here
	  script_tag.onload=loadCart;
    })*/
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
   }
}

/******** Load AngularFire********/
function loadAngularFire(){
		 var found = false;
	 var url='angularfire'
   for(var i = 0; i < document.scripts.length; i++){
      if(document.scripts[i].src.indexOf(url)> -1){
          found=true;
          break;
      }
   }
   
   if(!found){
	var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "https://popcart.herokuapp.com/js/lib/angularfire.min.js");
	/*if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
				//AngularJS Methods here
				loadCart;
          }
      };
    } else { // Other browsers
      //script_tag.onload = scriptLoadHandler;
	  //AngularJS Methods here
	  script_tag.onload=loadCart;
    })*/
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
   }
}

/******** Load Firebase********/
function loadFireBase(){
		 var found = false;
	 var url='firebase'
   for(var i = 0; i < document.scripts.length; i++){
      if(document.scripts[i].src.indexOf(url)> -1){
          found=true;
          break;
      }
   }
   
   if(!found){
	var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "https://popcart.herokuapp.com/js/lib/firebase.js");
	if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
				//AngularJS Methods here
				loadAngularFire;
          }
      };
    } else { // Other browsers
      //script_tag.onload = scriptLoadHandler;
	  //AngularJS Methods here
	  script_tag.onload=loadAngularFire;
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
   }
}

/******** Check if Bootstrap css is available ********/
function checkBootstrap(){
	 var found = false;
	 var url='bootstrap'
   for(var i = 0; i < document.styleSheets.length; i++){
      if(document.styleSheets[i].href){
		  if(document.styleSheets[i].href.indexOf(url)> -1){
          found=true;
          break;
		  }
      }
   }
   if(!found){
		var boostrap=jQuery('head').append( jQuery('<link rel="stylesheet" type="text/css" />').attr('href', 'https://popcart.herokuapp.com/css/bootstrap.css'));
		
   }else{
	   console.log("Found");
   }
}

/******** Load WidgetCSS ********/

function loadWidgetCss(){
	jQuery('head').append(jQuery('<link rel="stylesheet" type="text/css" />').attr('href', 'https://popcart.herokuapp.com/css/widget.css'));
	//remember to change this css/widget.css to the absolute URL once done
}

/******** Our main function ********/
function main() { 
    jQuery(document).ready(function($) { 
		loadPopCart();
		checkBootstrap();
		loadWidgetCss();
		jQuery("#viewCart").ready(function($){
		console.log("Entered");
		loadCart();
	});
		var closeViewCart=function(){
			jQuery('#cartPage').show();
			jQuery('#checkoutBtn').show();
			jQuery('#checkoutPage').hide();
			jQuery("#viewCart").hide();
			};
		jQuery('.close').click(
		closeViewCart
		);
		jQuery('#closeModal').click(closeViewCart);
    });
	
	
}
/******** load Cart data ********/
function loadCart(){
	//get User that is logged in

	//making a CORS request
	
	var url="https://popcart.herokuapp.com/scripts/userLoggedIn.php";
	var xhr=createCORSRequest('GET',url);
	if(!xhr){
		alert('Your browser does not support POPcart, please use FireFox or Google Chrome');
		return;
	}
	
	xhr.onload=function(){
		var data=xhr.responseText;
		if(data!=""){
				var clientCart=angular.module('clientCart',['firebase']);
				clientCart.controller('ClientCtrl',['$scope','$firebase',function($scope,$firebase){
					
					var url="https://popcart.firebaseio.com/carts/"+data;
					var cartRef=new Firebase(url);
					$scope.orderItems=$firebase(cartRef).$asArray();
					
					$scope.removeItem = function(id) {
					  $scope.orderItems.$remove(id);
					};
					
					$scope.moveToCheckOut=function(){
						console.log("Moving");
						jQuery('#cartPage').fadeOut();
						jQuery('#checkoutBtn').hide();
						jQuery('#checkoutPage').fadeIn();
					};
					
				}]);
				angular.element(document).ready(function() {
					  angular.bootstrap(document, ['clientCart']);
					});
				 var braintree = Braintree.create("MIIBCgKCAQEAtLwN7/rYvKEYbaK6RRQsCXnsJg/d3jFwsUbCkHGduIrLakwqoaKfV2QOFOp6uXWrRbCepjyzY5k3GzuHPGrlfpVVdD9KgUXA0uQegkjKZM6tn2Nll3IpJoXVvZYIvoCHUAo8RwDC6eBoGAsH26j27naH0JB0uyPLYS8cFkvZnfi+DfvS1kDCjYP6rLvoYPdfXE7RNN6VcUnGfYQ+5MFF3O56oExFU9TWt57q/rO7y+EO5MYyGn7yqSM3V+DdR2FXFqqQFzcOAgQU/fV2LY45V18+54MEW1tc/ktCm3YMGX+3PfvLuXKC7ZavVmMdyBfk/Ujy73jBi+9Pj17WNMpvoQIDAQAB");
				 braintree.onSubmitEncryptForm('braintree-payment-form');
				
			}else{
				console.log("No User Logged in");
				jQuery('#checkoutBtn').hide();
			}
	};
	
	xhr.onerror=function(){
		alert('Something went wrong with PopCart');
	};
	
	xhr.send();
	
	
}

/******** CORS for cross domain calls ********/
// Create the XHR object.
function createCORSRequest(method, url) {
  var xhr = new XMLHttpRequest();
  if ("withCredentials" in xhr) {
    // XHR for Chrome/Firefox/Opera/Safari.
    xhr.open(method, url, true);
  } else if (typeof XDomainRequest != "undefined") {
    // XDomainRequest for IE.
    xhr = new XDomainRequest();
    xhr.open(method, url);
  } else {
    // CORS not supported.
    xhr = null;
  }
  return xhr;
}



})(); // We call our anonymous function immediately

