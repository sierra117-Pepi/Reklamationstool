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

    <!-- Datetimepicker -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="../../JavaScript/bower_components/moment/min/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../JavaScript/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="../../JavaScript/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

    <!-- MetisMenu CSS -->
    <link href="../../CSS/Login/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../CSS/Login/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../CSS/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../CSS/Login/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="../../JavaScript/CustomFiles/productInfo.js" type="text/javascript"></script>
</head>

<body id="body">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"
					></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
                <a class="navbar-brand" href="indexAdmin.html">Reklamationsmanagement</a>
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
                        <ul class="nav" id="side-menu">
                            <li><a href="dashboardUser.php"><i class="fa fa-dashboard fa-fw"></i>
								Dashboard</a></li>
                            <li><a href="newReturn.php"><i class="fa fa-plus fa-fw"></i>
								Neue Reklamation</a></li>
                            <li><a href="complaintsUser.php"><i class="fa fa-envelope fa-fw"></i>
								Meine Reklamationen</a></li>
                        </ul>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
    </div>
    <!-- /#wrapper -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Details zum Auftrag</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form role="form">
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Produkt Information
                        </div>
                        <div class="panel-body fixed-panel">
                            <p id="name">

                            </p>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <fieldset>
                        <div class="form-group">
                            <label for="disabledSelect">Produktnummer</label>
                            <input class="form-control" id="complaintNr" type="text" placeholder="" disabled>
                            <label for="disabledSelect">Beschreibung</label>
                            <input class="form-control" id="details" type="text" placeholder="">
                            <label for="disabledSelect">Typ</label>
                            <select class="form-control" id="type">
                                <option>Retoure</option>
                                <option>Reklamation</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <button type="button" id="update-btn" class="btn btn-primary" onclick="createCase()">Fall erstellen</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /#page-wrapper -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../JavaScript/IndexFiles/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../JavaScript/IndexFiles/sb-admin-2.js"></script>
</body>

</html>
