<?php 
    session_start();
    header("Access-Control-Allow-Origin: *");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User-Sicht</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../SB-Admin2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../SB-Admin2/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Social Buttons CSS -->
    <link href="../../SB-Admin2/vendor/bootstrap-social/bootstrap-social.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../SB-Admin2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../SB-Admin2/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="../../JavaScript/CustomFiles/findProduct.js"></script>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"
					></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
                <a class="navbar-brand" href="indexUser.html">Reklamationsmanagement
					Tool</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">

                        <?php include "fillMessagesDropdown.php" ?>

                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">

                        <?php include "fillTasksDropdown.php" ?>

                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>

                    <?php include "../LogOut/logoutDropdown.php" ?>

                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="dashboardUser.php"><i class="fa fa-dashboard fa-fw"></i>
								Dashboard</a></li>
                        <li><a href="newReturn.php"><i class="fa fa-plus fa-fw"></i>
								Neue Reklamation</a></li>
                        <li><a href="complaintsUser.php"><i class="fa fa-envelope fa-fw"></i>
								Meine Reklamationen</a></li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Neue Reklamation erfassen
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="col-md-6">
                <form role="form">
                    <output> Bitte geben Sie in das nachfolgende Feld Ihre erhaltene Lieferscheinnummer ein</output>
                    <br><br>
                    <div class="form-group input-group">
                        <input id="productNr" type="text" class="form-control" placeholder="Lieferscheinnummer">
                        <span class="input-group-btn">
					<button onclick="findProduct()" class="btn btn-default" type="button"><i class="fa fa-search" ></i>
					</button>
				</span>
                    </div>
                </form>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <!-- /#wrapper -->
        <!-- jQuery -->
        <script src="../../JavaScript/IndexFiles/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../../JavaScript/IndexFiles/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../JavaScript/IndexFiles/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../JavaScript/IndexFiles/sb-admin-2.js"></script>
    </div>
</body>

</html>
