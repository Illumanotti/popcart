<?php
require '../scripts/firebaseLib.php';
session_start();
header('Access-Control-Allow-Origin: '.'*');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');

$path="/accessTokens";
$cookie_name='token';
$username='0';

if(isset($_SESSION[$cookie_name])) {
	$token=$_SESSION[$cookie_name];
	$username=json_decode($firebase->get($path.'/'.$token));
	if(empty($username)){
		$username='0';
	}
}else{
	$username= '0';
}
?>
<script>
var braintree = Braintree.create("MIIBCgKCAQEAtLwN7/rYvKEYbaK6RRQsCXnsJg/d3jFwsUbCkHGduIrLakwqoaKfV2QOFOp6uXWrRbCepjyzY5k3GzuHPGrlfpVVdD9KgUXA0uQegkjKZM6tn2Nll3IpJoXVvZYIvoCHUAo8RwDC6eBoGAsH26j27naH0JB0uyPLYS8cFkvZnfi+DfvS1kDCjYP6rLvoYPdfXE7RNN6VcUnGfYQ+5MFF3O56oExFU9TWt57q/rO7y+EO5MYyGn7yqSM3V+DdR2FXFqqQFzcOAgQU/fV2LY45V18+54MEW1tc/ktCm3YMGX+3PfvLuXKC7ZavVmMdyBfk/Ujy73jBi+9Pj17WNMpvoQIDAQAB");
braintree.onSubmitEncryptForm('braintree-payment-form',ajax_submit);

  var ajax_submit = function (e) {
					  jQuery("#spinner").show();
					  form = jQuery('#braintree-payment-form');
					  e.preventDefault();
					  jQuery("#submitInfo").attr("disabled", "disabled");
					  jQuery.post(form.attr('action'), form.serialize(), function (data) {
						if(data=="1"){
							jQuery("#submitInfo").removeAttr("disabled");
							jQuery("#checkoutPage").hide();
							jQuery("#endPage").fadeIn();
							jQuery("#spinner").hide();
						}else{
							//display error
							jQuery("#errorMsg").show();
							jQuery("#errorMsg").empty();
							jQuery("#errorMsg").append(data);
							setTimeout(function(){ 
							jQuery("#errorMsg").empty();
							jQuery("#errorMsg").fadeOut();
							jQuery("#submitInfo").removeAttr("disabled");
							}, 10000);
							jQuery("#spinner").hide();
						}
						
					  });
					}
</script>
<div ng-style="{width:widgetOptions.widgetWidth+'px',height:widgetOptions.widgetHeight+'px'}" class="panel panel-default">

<div id="userID" style="display:none"><?php echo $username;?></div>
    <div class="panel-heading" style="display:{{widgetOptions.showHeader}};">Panel heading</div>
    <div class="panel-body">
        <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <div id="productSlider" class="carousel-inner" role="listbox">
                <div id={{id}} ng-repeat="(id,product) in products" ng-if="id==0" class="item active">
                    <img src="{{product.image}}" ng-style="{'width': ((widgetOptions.widgetWidth*0.75)+'px'),'height':((widgetOptions.widgetHeight*0.75)+'px')}">
                        <div class="carousel-caption">{{product.name}}</div>
                    </div>
                    <div id={{id}} ng-repeat="(id,product) in products" ng-if="id!=0" class="item">
                        <img class="responsive" src="{{product.image}}" ng-style="{'width': ((widgetOptions.widgetWidth*0.75)+'px'),'height':((widgetOptions.widgetHeight*0.75)+'px')}">
                            <div class="carousel-caption">{{product.name}}</div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#productCarousel" role="button" data-slide="prev" ng-click="slideLeft()">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#productCarousel" role="button" data-slide="next" ng-click="slideRight()">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <div class="add-cart-btn-container">
                        <button ng-click="addToCart()" class="btn btn-md btn-primary add-cart-btn">Add to Cart</button>
                        <button class="btn btn-md btn-primary add-cart-btn" ng-click="viewCart()">View Cart</button>
                    </div>
                </div>
            </div>
        </div>
		
		<!--MODAL START-->
<div id="viewCart" class="view-cart-overlay">
    <div class="modal-dialog">
        <div  class="modal-content">
            <div class="modal-header">
                <button ng-click="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">View Cart</h4>
                <div class=" btn-group">
                    <button ng-click="showLogin()" id="loginBtn" type="button" class=" btn btn-primary dropdown-toggle">Please Login
                        <span class="caret"></span>
                    </button>
                    <ul id="loginForm" class="dropdown-menu">
                        <li>Hello</li>
                    </ul>
                </div>
            </div>
            <div class="modal-body">
                <div id="cartPage">
                    <table class="table table-striped">
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                        <tr ng-repeat="(id,item) in orderItems">
                            <td class="vert-align">
                                <img class="cart-item-image" src="{{item.product.image}}">
                                </td>
                                <td >{{item.product.productName}}</td>
                                <td>{{item.quantity}}</td>
                                <td>${{item.product.price}}</td>
                                <td>
                                    <button type="button" ng-click="removeItem(id)" class="btn btn-danger">Remove</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <strong>Total:</strong>
                            </td>
                            <td>${{calculateTotal()}}</td>
                        </tr>
                    </table>
                </div>
                <div id="checkoutPage" style="display:none;">
                    <form class="form-horizontal" action="scripts/checkout.php" method="POST" id="braintree-payment-form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="cardNum">Card Number</label>
                            <div class="col-sm-10">
                                <input id="cardNum" class="form-control" type="text" size="20" autocomplete="off" data-encrypted-name="number" placeholder="eg. 4111111111111111" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="cvv">CVV</label>
                            <div class="col-sm-5">
                                <input id="cvv" class="form-control " type="text" size="4" autocomplete="off" data-encrypted-name="cvv" placeholder="eg. 111" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expiration" class="col-sm-2 control-label">Expiration (MM/YYYY)</label>
                            <div class="col-sm-10">
                                <span>
                                    <input id="expiration" class="form-control" type="text" size="2" name="month" placeholder="eg. 11"/> / 
                                    <input class="form-control" type="text" size="4" name="year" placeholder="eg. 2015"/>
                                </span>
                            </div>
                        </div>
                        <input type="hidden" data-encrypted-name="totalAmount" value="{{calculateTotal()}}"/>
                        <input type="hidden" name="buyer" value="{{buyer}}"/>
                        <input type="hidden" name="seller" value="{{seller}}"/>
                        <div id="errorMsg" style="display:none;" class="alert alert-danger"></div>
                        <span>
                            <input class="btn btn-success" type="submit" id="submitInfo"/>
                            <img id="spinner" style="display:none;" src="https://popcart.herokuapp.com/img/loading.gif"/>
                        </span>
                    </form>
                </div>
                <div style="display:none;" id="endPage">
                    <div id="success" class="alert alert-success" role="alert">Well done! Payment has been made. Your goods will be sent to you soon.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button ng-click="closeModal()" id="closeModal" type="button" class="btn btn-default">Close</button>
                <button id="checkoutBtn" type="submit" class="btn btn-primary" ng-click="moveToCheckOut()">Check Out</button>
            </div>
        </div>
    </div>
</div>
		<!--MODAL END-->