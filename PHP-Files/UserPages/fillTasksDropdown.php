<?php 
    if(isset($_SESSION['userName'])){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryComplaints = "SELECT nr, customer, employee, status FROM complaints WHERE customer=? ORDER BY issued DESC;";
            $stmt = mysqli_prepare($con,$queryComplaints);
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['userName']);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                $complaints = 0;
                mysqli_stmt_bind_result($stmt, $nr, $customer, $employee, $status);
                while(mysqli_stmt_fetch($stmt) && $complaints < 5){
                    $bar = displayProgressForComplaintStatus($status);
                    $progress = getProgressForComplaint($status);
                    echo('<li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>'.$nr.'</strong> 
                                        <span class="pull-right text-muted">'.$status.'</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="'.$bar.'" role="progressbar" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress.'%">
                                            <span class="sr-only">'.$progress.'% Abgeschlossen (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>    
                        </li>
                        <li class="divider"></li>');
                    $complaints++;
                }
                if($complaints > 0){
                    echo('<li>
                            <a class="text-center" href="complaintsUser.php"> <strong>Zu den Reklamationen</strong> 
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>');
                }
            }
        }
    } else {
        header("Location:../Login/login_html.php");
        exit();
    }

    function displayProgressForComplaintStatus($status){
        switch($status){
            case "Offen":
                return "progress-bar progress-bar-info";
            case "In Bearbeitung Offen":
                return "progress-bar progress-bar-warning";
            case "Abgeschlossen - Berechtigt":
                return "progress-bar progress-bar-success";
            case "Abgeschlossen - Unberechtigt":
                return "progress-bar progress-bar-danger";
        }
    }   

    function getProgressForComplaint($status){
        switch($status){
            case "Offen":
                return "0";
            case "In Bearbeitung Offen":
                return "50";
            case "Abgeschlossen - Berechtigt":
                return "100";
            case "Abgeschlossen - Unberechtigt":
                return "100";
        }
    }   
?>
