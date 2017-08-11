<?php 
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
    $con->set_charset("utf8");
    
    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $query = "SELECT complaint FROM messages WHERE dateSend IN (SELECT MAX(m.dateSend) FROM messages m WHERE m.receiver=?)";
        $stmt = mysqli_prepare($con,$query);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['userName']);
        if(!mysqli_stmt_execute($stmt)){
            die('Error: ' . mysqli_error($con));
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $messages = 0;
            mysqli_stmt_bind_result($stmt, $complaint);
            while(mysqli_stmt_fetch($stmt)){
                createLatestChat($complaint);
            }
        }
    }

    function createLatestChat($complaint){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        $con->set_charset("utf8");
    
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $query = "SELECT * FROM messages WHERE complaint=? ORDER BY dateSend ASC";
            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt, "d", $complaint);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                $setUL = 0;
                mysqli_stmt_bind_result($stmt, $sender, $receiver, $complaint, $content, $isRead, $dateSend);
                while(mysqli_stmt_fetch($stmt)){
                    
                    if($setUL == 0){
                        echo('<ul class="chat" name="'.$complaint.'" id="complaint">');
                        $setUL++;
                    }
                    
                    if(chgeckIfPersonIsWorker($sender)){
                        echo('<li class="right clearfix">
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted"> <i class="fa fa-clock-o fa-fw"></i>'.calculateDifference($dateSend).'</small> 
                                            <strong class="pull-right primary-font">'.$sender.'</strong>
                                        </div>
                                        <p>'.$content.'</p>
                                    </div>
                               </li>');
                    } else {
                        echo('<li class="left clearfix">
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">'.$sender.'</strong> 
                                            <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i>'.calculateDifference($dateSend).'</small>
                                        </div>
                                        <p>'.$content.'</p>
                                    </div>
                               </li>');
                    }
                }
                echo('</ul>');
            }
        }
    }

    function chgeckIfPersonIsWorker($person){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        $con->set_charset("utf8");
        
        if(mysqli_connect_errno()){
           header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $query = "SELECT isWorker FROM users WHERE name=?";
            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,"s", $person);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmt, $isWorker);
                while(mysqli_stmt_fetch($stmt)){
                   return $isWorker;
                }
               return false;
            }
        }
    }

    function calculateDifference($timeSend) {
        $date = time();
        $messageDate = strtotime($timeSend);

        $seconds = $date - $messageDate ;
        
        $days = floor($seconds / (3600 * 24));
        $hrs = floor($seconds / 3600);
        $mnts = floor(($seconds - ($hrs * 3600)) / 60);
        $secs = $seconds - ($hrs * 3600) - ($mnts * 60);
        
        if ($days > 0) {
            return $days . " Tage";
        } else if ($hrs > 0) {
            return $hrs . " Stunden";
        } else if ($mnts > 0) {
            return $mnts . " Minuten";
        } else {
            return round($secs, 0, PHP_ROUND_HALF_UP) . " Sekunden";
        }
    }
?>
