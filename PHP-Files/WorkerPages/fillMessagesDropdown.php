<?php 
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $queryMessages = "SELECT m.sender, m.receiver, m.complaint, m.content, m.isRead, m.dateSend FROM messages m JOIN users u ON m.sender = u.name WHERE m.isRead = true AND (u.isWorker = false OR u.isAdmin = false) AND receiver=? ORDER BY m.dateSend DESC;";
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
										<em>Gestern</em>
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
                        <a class="text-center" href="tasksAdmin.php"> <strong>Zu den Aufträgen</strong> 
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>');
            }
        }
    }
?>
