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
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="GET" action="login.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group ">
                                    <input class="form-control" placeholder="Password" name="pwd" type="password">
                                </div>
                                <!--
                                <div class="checkbox ">
                                    <label> <input id="remember " type="checkbox "
										value="Remember Me "
									>Remember Me
									</label>
                                </div>-->
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
    <!-- /#wrapper -->

    <!-- External Includes -->
    <?php include "../ExternalSources/body-footer-includes.php"; ?>
</body>

</html>
