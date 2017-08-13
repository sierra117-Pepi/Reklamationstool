<?php 
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");

    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $con->set_charset("utf8");
        $queryMessages = "SELECT m.sender, m.receiver, m.complaint, m.content, m.isRead, m.dateSend FROM messages m WHERE m.dateSend IN (SELECT MAX(m1.dateSend) FROM messages m1 GROUP BY m1.complaint);";
        $stmt = mysqli_prepare($con,$queryMessages);
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
            echo('<li>
                    <a class="text-center" href="tasksAdmin.php"> <strong>Zu den Aufträgen</strong> 
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>');
        }
    }
?>
