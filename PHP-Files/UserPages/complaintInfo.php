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

    <!-- Custom CSS -->
    <link href="../../CSS/navbar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom JS -->
    <script src="../../JavaScript/CustomFiles/complaintInfo.js" type="text/javascript"></script>
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
                <p class="navbar-brand">Reklamationsmanagement</p>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <button class="dropdown-toggle btn-circle" data-toggle="dropdown"> <i class="fa fa-envelope fa-fw"></i> </button>
                    <ul class="dropdown-menu dropdown-messages">

                        <?php include "fillMessagesDropdown.php" ?>

                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <button class="dropdown-toggle btn-circle" data-toggle="dropdown"> <i class="fa fa-tasks fa-fw"></i> </button>
                    <ul class="dropdown-menu dropdown-tasks">

                        <?php include "fillTasksDropdown.php" ?>

                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <button class="dropdown-toggle btn-circle" data-toggle="dropdown"> <i class="fa fa-user fa-fw"></i> </button>
                    <?php include "../LogOut/logoutDropdown.php" ?>

                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-li">
                            <a href="dashboardUser.php">
                                <button class="btn-circle"><i class="fa fa-dashboard fa-fw"></i></button>
                                <p class="description">Dashboard</p>
                            </a>
                        </li>
                        <li class="sidebar-li">
                            <a href="newReturn.php">
                                <button class="btn-circle"><i class="fa fa-plus fa-fw"></i></button>
                                <p class="description">Neue Reklamation</p>
                            </a>
                        </li>
                        <li class="sidebar-li">
                            <a href="complaintsUser.php">
                                <button class="btn-circle"><i class="fa fa-envelope fa-fw"></i></button>
                                <p class="description">Meine Reklamationen</p>
                            </a>
                        </li>
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
                <div class="col-lg-6">
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
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mitarbeiter Details
                        </div>
                        <div class="panel-body fixed-panel">
                            <p id="employee">

                            </p>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="disabledSelect">Produktnummer</label>
                            <input class="form-control" id="complaintNr" type="text" placeholder="" disabled>
                            <label for="disabledSelect">Beschreibung</label>
                            <input class="form-control" id="details" type="text" placeholder="" disabled>
                            <label for="disabledSelect">Typ</label>
                            <input class="form-control" id="type" type="text" placeholder="" disabled>
                        </div>
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset>
                        <div class="form-group">
                            <label>Status</label>
                            <input class="form-control" id="status" type="text" placeholder="" disabled>
                            <label for="disabledSelect">Auftragsdatum</label>
                            <div class='input-group date' id='issuedCalendar'>
                                <input type='text' id="issued" class="form-control" disabled/>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <label for="disabledSelect">Mitarbeiterzuwesiung</label>
                            <div class='input-group date' id='takeCalendar'>
                                <input type='text' id="taken" class="form-control" disabled/>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </fieldset>
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
