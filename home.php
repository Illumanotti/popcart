<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POP-Cart</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59574467-2', 'auto');
  ga('send', 'pageview');
</script>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">POP-Cart Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                 <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                    </li>
					
					 <li>
                        <a  href="products.html"><i class="fa fa-fw fa-shopping-cart"></i> Products</a>
                    </li>
					<li>
                        <a href="widget.html"><i class="fa fa-fw fa-gears"></i>Widget Management</a>
                    </li>
							  <li>
            <a href="feedback.html"><i class="fa fa-fw fa-gears"></i>Feedback</a>
          </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Getting Started: <small>COPY.PASTE.SELL</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Getting Started
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                   <div class="col-lg-4">
				  
				   <div class="panel panel-danger">
				  <!-- Default panel contents -->
				  <div class="panel-heading"> <h4>Step 1 : Add Products</h4></div>
				  <div class="panel-body">
					<p>Start adding products by clicking on <a href="products.html" target="_blank">Products</a> at the panel on the left</p>
				  </div>
				   </div>
				   </div>
				   <div class="col-lg-4">
				    <div class="panel panel-info">
				  <!-- Default panel contents -->
				  <div class="panel-heading"> <h4>Step 2 : Copy Code Snippet</h4></div>
				  <div class="panel-body">
					<p>Head over to <a href='widget.html' target="_blank">Widget Management</a> and copy the code snippet given</p>
				  </div>
				   </div>
				   </div>
				   <div class="col-lg-4">
				   <div class="panel panel-success">
				  <!-- Default panel contents -->
				  <div class="panel-heading"> <h4>Step 3 : Paste in any HTML file </h4></div>
				  <div class="panel-body">
					<p>Paste the snippet in any HTML file. Don't have one yet? Try this <a href="http://www.w3schools.com/html/tryit.asp?filename=tryhtml_default">HTML editor</a> and paste the snippet on the left panel and click "See Result"</p>
				  </div>
				   </div>
				   </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
