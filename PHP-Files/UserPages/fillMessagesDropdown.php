<?php 
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");

    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $con->set_charset("utf8");
        $queryMessages = 
        "SELECT * FROM `messages` WHERE dateSend  IN (SELECT MAX(m.dateSend) FROM messages m WHERE m.receiver=? GROUP BY complaint);";
        $stmt = mysqli_prepare($con,$queryMessages);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['userName']);
        if(!mysqli_stmt_execute($stmt)){
            die('Error: ' . mysqli_error($con));
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $messages = 0;
            mysqli_stmt_bind_result($stmt, $sender, $receiver, $complaint, $content, $isRead, $dateSend);
            while(mysqli_stmt_fetch($stmt) && $messages < 5){
                echo('<li>
                            <a href="#">
                                <div>
                                    <strong>'.$sender.'</strong> <span class="pull-right text-muted">
										<em> Auftrag '.$complaint.'</em>
									</span>
                                </div>
                                <div>'.$content.'</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    ');
                $messages++;
            }
            if($messages > 0){
                echo('<li>
                        <a class="text-center" href="complaintsUser.php"> <strong>Zu den Reklamationen</strong> 
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>');
            }
        }
    }
?>
