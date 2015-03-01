<html ng-app="cartApp">
<head>
  <script src="js/jquery.js"></script>
  <script src="js/lib/angular.min.js"></script>
  <script src='js/lib/firebase.js'></script>
  <script src='js/lib/angularfire.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
    <script>
	<?php
		$seller=$_GET['u'];
	?>
    var cartApp = angular.module('cartApp', ['firebase']);
    cartApp.controller('WidgetCtrl', ['$scope', '$firebase',
      function($scope, $firebase) {
		var widgetRef=new Firebase("https://popcart.firebaseio.com/widgets/<?php echo $seller;?>");
		
		//Load options
		var widgetOptions=$firebase(widgetRef).$asObject();
		widgetOptions.$bindTo($scope, "widgetOptions");
		//Load Options end
		
        $scope.widgetHeader = "block";
		
		widgetRef.on('value',function(snapshot){
			console.log(snapshot.val().showHeader);
			
		})
		
		//get Products
        var ref = new Firebase("https://popcart.firebaseio.com/products/<?php echo $seller;?>");
        $scope.products = $firebase(ref).$asArray();
		//get Products end
		
		$scope.viewCart=function(){
				$('#viewCart', window.parent.document).show();
		};
		

		$scope.addToCart=function(username){
			var productID=$("#productSlider").find('.active').index();
			//change to appropriate user and need change url as well
			$.post( "scripts/addToCart.php", { buyer: "benjamin", seller: "<?php echo $seller;?>",productID:productID })
			  .done(function( data ) {
				console.log(data);
			  });
		};
      }
    ]);
  </script>
  
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/widget.css" rel="stylesheet">
   <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body ng-controller="WidgetCtrl">

<div ng-style="{width:widgetOptions.widgetWidth+'px',height:widgetOptions.widgetHeight+'px'}" class="panel panel-default">
              <div class="panel-heading" style="display:{{widgetOptions.showHeader}};">Panel heading</div>
              <div class="panel-body">
                <div id="productCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators 
                  <ol class="carousel-indicators">
                    <li ng-repeat="(id,product) in products" data-target="#carousel-example-generic" data-slide-to="{{product.ID}}" class="active" ng-if="id==0"></li>
                    <li ng-repeat="(id,product) in products" data-target="#carousel-example-generic" data-slide-to="{{product.ID}}" ng-if="id!=0"></li>
                  </ol>
				  -->
				

                  <!-- Wrapper for slides -->
                  <div id="productSlider" class="carousel-inner" role="listbox">

                    <div ng-repeat="(id,product) in products" ng-if="id==0" class="item active">
                      <img src="{{product.image}}" ng-style="{'width': ((widgetOptions.widgetWidth*0.75)+'px'),'height':((widgetOptions.widgetHeight*0.75)+'px')}">
                      <div class="carousel-caption">
                        {{product.name}}
                      </div>
                    </div>

                    <div ng-repeat="(id,product) in products" ng-if="id!=0" class="item">
                      <img class="responsive" src="{{product.image}}" ng-style="{'width': ((widgetOptions.widgetWidth*0.75)+'px'),'height':((widgetOptions.widgetHeight*0.75)+'px')}">
                      <div class="carousel-caption">
                        {{product.name}}
                      </div>
                    </div>
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#productCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#productCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
				  <div class="add-cart-btn-container"><button ng-click="addToCart()" class="btn btn-lg btn-primary add-cart-btn">Add to Cart</button>
				  
				  <button class="btn btn-lg btn-primary add-cart-btn" ng-click="viewCart()">View Cart</button>
				  </div>
                </div>
              </div>
			
            </div>
			
</body>
</html>