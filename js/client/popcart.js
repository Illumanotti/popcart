$(document).ready(function() {

	// Localize jQuery variable
	var jQuery;

	/******** Load jQuery if not present *********/
	if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.11.1') {
		var script_tag = document.createElement('script');
		script_tag.setAttribute("type", "text/javascript");
		script_tag.setAttribute("src",
			"https://code.jquery.com/jquery-2.1.3.js");
		if (script_tag.readyState) {
			script_tag.onreadystatechange = function() { // For old versions of IE
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

	function loadPopCart() {

		//var modal=jQuery('#popcartCtrl').append('<div id="viewCart" class="view-cart-overlay"><div class="modal-dialog"><div  class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">View Cart</h4><div class=" btn-group"><button ng-click="showLogin()" id="loginBtn" type="button" class=" btn btn-primary dropdown-toggle">Please Login<span class="caret"></span></button><ul id="loginForm" class="dropdown-menu"><li>Hello</li></ul></div></div><div class="modal-body"><div id="cartPage"><table class="table table-striped"><tr><th>Image</th><th>Product Name</th><th>Quantity</th><th>Price</th><th></th></tr><tr ng-repeat="(id,item) in orderItems"><td class="vert-align"><img class="cart-item-image" src="{{item.product.image}}"></td><td >{{item.product.productName}}</td><td>{{item.quantity}}</td><td>${{item.product.price}}</td><td><button type="button" ng-click="removeItem(id)" class="btn btn-danger">Remove</button></a></td></tr><tr><td></td><td></td><td></td><td><strong>Total:</strong></td><td>${{calculateTotal()}}</td></tr></table></div><div id="checkoutPage" style="display:none;"><form class="form-horizontal" action="scripts/checkout.php" method="POST" id="braintree-payment-form"><div class="form-group"><label class="col-sm-2 control-label" for="cardNum">Card Number</label><div class="col-sm-10"><input id="cardNum" class="form-control" type="text" size="20" autocomplete="off" data-encrypted-name="number" placeholder="eg. 4111111111111111" /></div></div><div class="form-group"><label class="col-sm-2 control-label" for="cvv">CVV</label><div class="col-sm-5"><input id="cvv" class="form-control " type="text" size="4" autocomplete="off" data-encrypted-name="cvv" placeholder="eg. 111" /></div></div><div class="form-group"><label for="expiration" class="col-sm-2 control-label">Expiration (MM/YYYY)</label><div class="col-sm-10"><span><input id="expiration" class="form-control" type="text" size="2" name="month" placeholder="eg. 11"/> / <input class="form-control" type="text" size="4" name="year" placeholder="eg. 2015"/></span></div></div><input type="hidden" data-encrypted-name="totalAmount" value="{{calculateTotal()}}"/><input type="hidden" name="buyer" value="{{buyer}}"/><input type="hidden" name="seller" value="{{seller}}"/><div id="errorMsg" style="display:none;" class="alert alert-danger"></div><span><input class="btn btn-success" type="submit" id="submitInfo"/><img id="spinner" style="display:none;" src="https://popcart.herokuapp.com/img/loading.gif"/></span></form></div><div style="display:none;" id="endPage"><div id="success" class="alert alert-success" role="alert">Well done! Payment has been made. Your goods will be sent to you soon.</div></div></div><div class="modal-footer"><button id="closeModal" type="button" class="btn btn-default">Close</button><button id="checkoutBtn" type="submit" class="btn btn-primary" ng-click="moveToCheckOut()">Check Out</button></div></div></div></div>');

		//var cart=jQuery('#popcartCtrl').append('<div ng-style="{width:widgetOptions.widgetWidth+\'px\',height:widgetOptions.widgetHeight+\'px\'}" class="panel panel-default"><div class="panel-heading" style="display:{{widgetOptions.showHeader}};">Panel heading</div><div class="panel-body"><div id="productCarousel" class="carousel slide" data-ride="carousel"><div id="productSlider" class="carousel-inner" role="listbox"><div id={{id}} ng-repeat="(id,product) in products" ng-if="id==0" class="item active"><img src="{{product.image}}" ng-style="{\'width\': ((widgetOptions.widgetWidth*0.75)+\'px\'),\'height\':((widgetOptions.widgetHeight*0.75)+\'px\')}"><div class="carousel-caption">{{product.name}}</div></div><div id={{id}} ng-repeat="(id,product) in products" ng-if="id!=0" class="item"><img class="responsive" src="{{product.image}}" ng-style="{\'width\': ((widgetOptions.widgetWidth*0.75)+\'px\'),\'height\':((widgetOptions.widgetHeight*0.75)+\'px\')}"><div class="carousel-caption">{{product.name}}</div></div></div><a class="left carousel-control" href="#productCarousel" role="button" data-slide="prev" ng-click="slideLeft()"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#productCarousel" role="button" data-slide="next" ng-click="slideRight()"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a><div class="add-cart-btn-container"><button ng-click="addToCart()" class="btn btn-md btn-primary add-cart-btn">Add to Cart</button><button class="btn btn-md btn-primary add-cart-btn" ng-click="viewCart()">View Cart</button></div></div></div></div>');

		//Change transaction.php to popcart's absolute path
	}

	/******** Load Angular JS********/
	function loadAngular() {
		if (typeof angular !== 'undefined') {
			console.log("Angular Found");
		} else {
			var script_tag = document.createElement('script');
			script_tag.setAttribute("type", "text/javascript");
			script_tag.setAttribute("src",
				"https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js");
			// Try to find the head, otherwise default to the documentElement
			(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
		}

		loadFireBase();
	}

	function loadBraintree() {
		var found = false;
		var url = 'braintree'
		for (var i = 0; i < document.scripts.length; i++) {
			if (document.scripts[i].src.indexOf(url) > -1) {
				found = true;
				break;
			}
		}

		if (!found) {
			var script_tag = document.createElement('script');
			script_tag.setAttribute("type", "text/javascript");
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
	function loadAngularFire() {
		var found = false;
		var url = 'angularfire'
		for (var i = 0; i < document.scripts.length; i++) {
			if (document.scripts[i].src.indexOf(url) > -1) {
				found = true;
				break;
			}
		}

		if (!found) {
			var script_tag = document.createElement('script');
			script_tag.setAttribute("type", "text/javascript");
			script_tag.setAttribute("src",
				"https://popcart.herokuapp.com/js/lib/angularfire.min.js");
			// Try to find the head, otherwise default to the documentElement
			(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
		}
	}

	/******** Load Firebase********/
	function loadFireBase() {
		var found = false;
		var url = 'firebase'
		for (var i = 0; i < document.scripts.length; i++) {
			if (document.scripts[i].src.indexOf(url) > -1) {
				found = true;
				break;
			}
		}

		if (!found) {
			var script_tag = document.createElement('script');
			script_tag.setAttribute("type", "text/javascript");
			script_tag.setAttribute("src",
				"https://popcart.herokuapp.com/js/lib/firebase.js");
			if (script_tag.readyState) {
				script_tag.onreadystatechange = function() { // For old versions of IE
					if (this.readyState == 'complete' || this.readyState == 'loaded') {
						//AngularJS Methods here
						loadAngularFire;
					}
				};
			} else { // Other browsers
				//script_tag.onload = scriptLoadHandler;
				//AngularJS Methods here
				script_tag.onload = loadAngularFire;
			}
			// Try to find the head, otherwise default to the documentElement
			(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
		}
	}

	/******** Check if Bootstrap css is available ********/
	function checkBootstrap() {
		var found = false;
		var url = 'bootstrap'
		for (var i = 0; i < document.styleSheets.length; i++) {
			if (document.styleSheets[i].href) {
				if (document.styleSheets[i].href.indexOf(url) > -1) {
					found = true;
					break;
				}
			}
		}
		if (!found) {
			var boostrap = jQuery('head').append(jQuery('<link rel="stylesheet" type="text/css" />').attr('href', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'));

		} else {
			console.log("Found");
		}
	}

	/******** Load WidgetCSS ********/

	function loadWidgetCss() {
		jQuery('head').append(jQuery('<link rel="stylesheet" type="text/css" />').attr('href', 'https://popcart.herokuapp.com/css/widget.css'));
		//remember to change this css/widget.css to the absolute URL once done
	}
	
	function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function deleteCookie(){
	document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
}

	/******** Our main function ********/
	function main() {
		jQuery(document).ready(function($) {
			loadPopCart();
			checkBootstrap();
			loadWidgetCss();
			jQuery("#popcart").ready(function($) {
				loadWidget();
			});
			var closeViewCart = function() {
				jQuery('#cartPage').show();
				jQuery('#checkoutBtn').show();
				jQuery('#checkoutPage').hide();
				jQuery("#viewCart").hide();
				jQuery('#endPage').hide();
			};
			jQuery('.close').click(
			closeViewCart);
			jQuery('#closeModal').click(closeViewCart);
		});


	}

	/******** Load Widget ********/
	function loadWidget() {
		var productID = 0;
		var cartApp = angular.module('cartApp', ['firebase']);
		var seller = jQuery('#popcart').data('s');

		//load Configurations

		cartApp.config(function($sceDelegateProvider) {
			$sceDelegateProvider.resourceUrlWhitelist([
			// Allow same origin resource loads.
			'self',
				'https://popcart.herokuapp.com/templates/**']);
		});


		cartApp.controller('WidgetCtrl', ['$scope', '$firebase',

		function($scope, $firebase) {
			var widgetRef = new Firebase("https://popcart.firebaseio.com/widgets/" + seller);

			console.log(jQuery("#productCarousel").html());
			//Load options
			var widgetOptions = $firebase(widgetRef).$asObject();
			widgetOptions.$bindTo($scope, "widgetOptions");


			//load buyer seller to scope, for now all the buyer is tom
			$scope.seller = seller;
			$scope.buyer=getCookie("username");
			
			
			//Load Options end

			$scope.widgetHeader = "block";

			$scope.showLogin = function() {
				jQuery("#loginContainer").slideToggle();
			}

			//get Products
			var ref = new Firebase("https://popcart.firebaseio.com/products/" + seller);
			$scope.products = $firebase(ref).$asArray();

			//get Products end
			//may use cookie to replace this, hardcoded as tom first
			//var data="tom";
			

			
			$scope.logOut=function(){
				deleteCookie();
				jQuery("#username-container").empty();
				jQuery("#username-container").append("Please login to view cart");
				jQuery("#logoutBtn").hide();
				$scope.buyer="";
				jQuery('#checkoutBtn').hide();
			}
			
			
			$scope.removeItem = function(id) {
					if(typeof $scope.orderItems !='undefined'){
						$scope.orderItems.$remove(id);
					}
					
				};

				$scope.calculateTotal = function() {
					var total = 0;
					if(typeof $scope.orderItems !='undefined'){
						for (var i = 0; i < $scope.orderItems.length; i++) {

							var item = $scope.orderItems[i];

							total += parseFloat(item.product.price);
						}
					}
					return total.toFixed(2);
				};
			
			
			$scope.loginUser=function(){
				
				jQuery("#spinnerContainer").show();
				var loginname=jQuery("#username").val();
				var password=jQuery("#password").val();
				
				if(loginname!="" && password!=""){
				jQuery.post("https://popcart.herokuapp.com//scripts/loginUser.php",
				{loginUser:loginname,loginPw:password},
				function(response){
					if(response=='1'){
						jQuery("#username-container").empty();
						jQuery("#username-container").append(loginname);
						jQuery("#logoutBtn").show();
						setCookie('username',loginname,1);
						$scope.buyer=loginname;
						console.log("username:"+$scope.buyer);
						$scope.$apply();
						$scope.showLogin();
						jQuery('#checkoutBtn').show();
					}else{
						console.log(response);
						jQuery("#errorLogin").empty();
						jQuery("#errorLogin").show();
						jQuery("#errorLogin").append(response);
						setTimeout(function(){jQuery("#errorLogin").hide();},3000);
					}
					
				jQuery("#spinnerContainer").hide();
				});
				}
			}
			
			$scope.$watch("buyer",function(newVal,oldVal){
				if (newVal != "" && newVal != "0") {
				var url = "https://popcart.firebaseio.com/carts/" + newVal;
				var cartRef = new Firebase(url);
				$scope.orderItems = $firebase(cartRef).$asArray();
			} else {
				$scope.orderItems=[];
				jQuery('#checkoutBtn').hide();
			}
				
			});
			
			$scope.moveToCheckOut = function() {

					jQuery('#cartPage').hide();
					jQuery('#checkoutBtn').hide();
					jQuery('#checkoutPage').fadeIn();
			};

			$scope.closeModal = function() {
				jQuery('#cartPage').show();
				jQuery('#checkoutBtn').show();
				jQuery('#checkoutPage').hide();
				jQuery("#viewCart").hide();
				jQuery('#endPage').hide();
			}
			
			
			$scope.viewCart = function() {
				jQuery('#viewCart').show();
			};

			$scope.addToCart = function(username) {
				//change to appropriate user and need change url as well
				jQuery.post("https://popcart.herokuapp.com/scripts/addToCart.php", {
					buyer: $scope.buyer,
					seller: seller,
					productID: productID
				}).done(function(data) {
					console.log(data);
				});
			};

			$scope.slideRight = function() {
				jQuery("#productSlider #" + productID).hide();
				jQuery("#productSlider #" + productID).removeClass("active");
				jQuery("#productSlider #" + productID).fadeOut();
				if (productID == ($scope.products.length - 1)) {
					productID = 0;
				} else {
					productID += 1;
				}
				jQuery("#productSlider #" + productID).addClass("active");
				jQuery("#productSlider #" + productID).fadeIn();

				console.log(productID);
			}

			$scope.slideLeft = function() {
				jQuery("#productSlider #" + productID).hide();
				jQuery("#productSlider #" + productID).removeClass("active");
				jQuery("#productSlider #" + productID).fadeOut();

				if (productID == (0)) {
					productID = ($scope.products.length - 1);
				} else {
					productID -= 1;
				}
				jQuery("#productSlider #" + productID).addClass("active");
				jQuery("#productSlider #" + productID).fadeIn();

				console.log(productID);
			}
		}]).directive('popHere', function() {
			return {
				restrict: 'E',
				scope: false,
				templateUrl: 'https://popcart.herokuapp.com/templates/cart.php',
				link: function(scope, elem, attrs) {
					console.log(scope.seller);
				},
				compile: function(element, attributes){
				 return {
					 pre: function(scope, element, attributes, controller, transcludeFn){
		 
					 },
					 post: function(scope, element, attributes, controller, transcludeFn){
						 
						if(getCookie('username')!=""){
							jQuery("#username-container").empty();
							jQuery("#username-container").append(getCookie('username'));
							jQuery("#logoutBtn").show();
						}
						 var braintree = Braintree.create("MIIBCgKCAQEAtLwN7/rYvKEYbaK6RRQsCXnsJg/d3jFwsUbCkHGduIrLakwqoaKfV2QOFOp6uXWrRbCepjyzY5k3GzuHPGrlfpVVdD9KgUXA0uQegkjKZM6tn2Nll3IpJoXVvZYIvoCHUAo8RwDC6eBoGAsH26j27naH0JB0uyPLYS8cFkvZnfi+DfvS1kDCjYP6rLvoYPdfXE7RNN6VcUnGfYQ+5MFF3O56oExFU9TWt57q/rO7y+EO5MYyGn7yqSM3V+DdR2FXFqqQFzcOAgQU/fV2LY45V18+54MEW1tc/ktCm3YMGX+3PfvLuXKC7ZavVmMdyBfk/Ujy73jBi+9Pj17WNMpvoQIDAQAB");
					
					var ajax_submit = function(e) {
					
					jQuery("#spinner").show();
					form = jQuery('#braintree');
					e.preventDefault();
					jQuery("#submitInfo").attr("disabled", "disabled");
					jQuery.post(form.attr('action'), form.serialize(), function(data) {
						if (data == "1") {
							jQuery("#submitInfo").removeAttr("disabled");
							jQuery("#checkoutPage").hide();
							jQuery("#endPage").fadeIn();
							jQuery("#spinner").hide();
						} else {
							//display error
							jQuery("#errorMsg").show();
							jQuery("#errorMsg").empty();
							jQuery("#errorMsg").append(data);
							setTimeout(function() {
								jQuery("#errorMsg").empty();
								jQuery("#errorMsg").fadeOut();
								jQuery("#submitInfo").removeAttr("disabled");
							}, 10000);
							jQuery("#spinner").hide();
						}

					});
				}
				braintree.onSubmitEncryptForm('braintree', ajax_submit);
					 }
				 }
				}
			};
		});
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