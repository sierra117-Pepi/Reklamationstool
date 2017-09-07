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

    <title>Arbeiter-Sicht</title>

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

    <!-- notify js -->
    <script src="../../JavaScript/notify/bootstrap-notify.js" type="text/javascript"></script>

    <!-- Custom JS -->
    <script src="../../JavaScript/CustomFiles/complaintDetailsWorker.js" type="text/javascript"></script>
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
                            <a href="dashboardWorker.php">
                                <button class="btn-circle"><i class="fa fa-dashboard fa-fw"></i></button>
                                <p class="description">Aufträge Übersicht</p>
                            </a>
                        </li>
                        <li class="sidebar-li">
                            <a href="tasksWorker.php">
                                <button class="btn-circle"><i class="fa fa-tasks fa-fw"></i></button>
                                <p class="description">Meine Aufträge</p>
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
                <div class="col-lg-4">
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
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kunde Details
                        </div>
                        <div class="panel-body fixed-panel">
                            <p id="client">

                            </p>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
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
                <div class="col-lg-4">
                    <fieldset>
                        <div class="form-group">
                            <label>Status</label>
                            <select id="status" class="form-control">
                                <option>Offen</option>
                                <option>In Bearbeitung Offen</option>
                                <option>Abgeschlossen - Berechtigt</option>
                                <option>Abgeschlossen - Unberechtigt</option>
                            </select>
                            <label for="disabledSelect">Auftragsdatum</label>
                            <div class='input-group date' id='issuedCalendar'>
                                <input type='text' id="issued" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <label for="disabledSelect">Mitarbeiterzuwesiung</label>
                            <div class='input-group date' id='takeCalendar'>
                                <input type='text' id="taken" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset>
                        <div class="form-group">
                            <label>Grund l. Schachinger</label>
                            <select id="reasonSchachinger" class="form-control">
				                <option>Keine Auswahl</option>
                                <option>Reklamation unberechtigt</option>
                                <option>Reklamation berechtigt</option>
                            </select>
                            <label>Gegenma&szlig;nahme Schachinger</label>
                            <select id="measureSchachinger" class="form-control">
                                <option>Keine Auswahl</option>
                                <option >Keine Aktion</option>
                                <option>Nachlieferung</option>
                                <option>Abholung</option>
                                <option>Anderes</option>
                            </select>
                            <label>Gegenma&szlig;nahme zur Vermeidung</label>
                            <input class="form-control" id="measureAvoid" type="text" placeholder="" />
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <button type="button" id="update-btn" class="btn btn-primary" onclick="updateInformationForComplaint()">Aktualisieren</button>
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
