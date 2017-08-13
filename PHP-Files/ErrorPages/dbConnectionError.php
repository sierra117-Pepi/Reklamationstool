<?php header("Access-Control-Allow-Origin: *"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Reklamationsmanagment Tool</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../CSS/Login/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../CSS/Login/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../CSS/Login/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                <a class="navbar-brand" href="indexAdmin.html">Reklamationsmanagement</a>
            </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="../Login/login_html.php"><i class="fa fa-pencil fa-fw"></i>Zur&uuml;ck zum Login</a></li>
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datenbankverbindung
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills">
                            <li><button href="#profile-pills" data-toggle="tab" class="btn btn-danger">Fehler</button>
                            </li>
                            <li><button href="#messages-pills" data-toggle="tab" class="btn btn-info">Information</button>
                            </li>
                            <li><button href="#settings-pills" data-toggle="tab" class="btn btn-primary">Kontaktdaten</button>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade" id="profile-pills">
                                <div class="alert alert-danger">
                                    <p>Die Verbindung zum Datenbank ist fehlgeschlagen!</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="messages-pills">
                                <div class="alert alert-info">
                                    <p>Bitte überprüfen Sie die Internetverbindung.</p>
                                    <p>Falls diese stimmt und Sie trotzdem noch die selbe Fehler bekommen, dann haben ist die Datenbank im Moment nicht erreichbar</p>
                                    <p>Bitte kontaktieren Sie uns diesbezüglich oder probieren Sie es später weider.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings-pills">
                                <div class="alert alert-info">
                                    <p>Tel: </p>
                                    <p>......</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /#row -->
    </div>
    <!-- /#page-wrapper -->

    <!-- External Includes -->
    <?php include "../ExternalSources/body-footer-includes.php"; ?>
</body>

</html>
