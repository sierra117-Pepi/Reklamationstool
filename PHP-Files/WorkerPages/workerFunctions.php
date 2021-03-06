<?php
    session_start();
    if (isset($_POST['function'])) {
        switch($_POST['function']){
            case 1:
                if(isset($_POST['employee']) && isset($_POST['complaintNr'])){
                    if(taskHasNoWorker(htmlspecialchars($_POST['complaintNr']))){
                        addWrokerToTask(htmlspecialchars($_POST['employee']), htmlspecialchars($_POST['complaintNr']));
                    }
                }
                break;
            case 2:
                if(isset($_POST['complaintNr'])){
                    echo(createChat(htmlspecialchars($_POST['complaintNr'])));
                }
                break;
            case 3:
                if(isset($_POST['complaintNr']) && isset($_POST['content']) && isset($_POST['timeZone'])){
                    echo(insertMessage(htmlspecialchars($_POST['complaintNr']),htmlspecialchars($_POST['content']), htmlspecialchars($_POST['timeZone'])));
                }
                break;
            case 4:
                if(isset($_POST['complaintNr']) && isset($_POST['status']) && isset($_POST['issued']) && isset($_POST['taken']) && isset($_POST['reasonSchachinger']) && isset($_POST['measureSchachinger']) && isset($_POST['measureAvoid'])){
                    echo(updateComplaint(htmlspecialchars($_POST['complaintNr']), htmlspecialchars($_POST['status']), htmlspecialchars($_POST['issued']), htmlspecialchars($_POST['taken']), htmlspecialchars($_POST['reasonSchachinger']), htmlspecialchars($_POST['measureSchachinger']), htmlspecialchars($_POST['measureAvoid'])));
                }
        }
    }

    function updateComplaint($complaintNr, $status, $issued, $taken, $reasonSchachinger, $measureSchachinger, $measureAvoid){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryUpdate = "UPDATE complaints SET nr=?, status=?, reasonSchachinger=?, measureSchachinger=?, measureAvoid=?, issued=?, take=? WHERE nr=?;";
            $stmt = mysqli_prepare($con,$queryUpdate);
            mysqli_stmt_bind_param($stmt, "dsssssss", $complaintNr, $status, $reasonSchachinger, $measureSchachinger, $measureAvoid, $issued, $taken, $complaintNr);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            }
        }
    }

    function taskHasNoWorker($complaint){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
           header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $query = "SELECT employee FROM complaints WHERE nr=?;";
            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,"d",$complaint);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmt, $emp);
                while(mysqli_stmt_fetch($stmt)){
                    if($emp == ''){
                        return true;
                    }
                }
                return false;
            }
        }
    }
    
    function addWrokerToTask($employee, $complaint){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryAdd = "UPDATE complaints SET employee=?, status = 'In Bearbeitung Offen', take=? WHERE nr=?;";
            $stmt = mysqli_prepare($con,$queryAdd);
            $taken = date("Y-m-d H:i:sa");
            mysqli_stmt_bind_param($stmt, "sss", $employee, $taken, $complaint);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            }
        }
    }

    function createChat($complaint){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
           header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryMessages = "SELECT * FROM messages WHERE complaint=? ORDER BY dateSend ASC;";
            $stmt = mysqli_prepare($con,$queryMessages);
            mysqli_stmt_bind_param($stmt,"d",$complaint);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                setUnreadMessageToRead($complaint);
                $messages = array(array());
                $row = 0;
                mysqli_stmt_bind_result($stmt, $sender, $receiver, $complaint, $content, $isRead, $dateSend);
                while(mysqli_stmt_fetch($stmt)){
                    $messages[$row][0] = $sender;
                    $messages[$row][1] = $complaint;
                    $messages[$row][2] = $content;
                    $messages[$row][3] = $isRead;
                    $messages[$row][4] = $dateSend;
                    $messages[$row][5] = checkIfOwnerIsWorkerForComplaintMessage($sender,$complaint);
                    $row++;
                }
                $json_messages = json_encode($messages);
                return $json_messages;
            }
        }
    }

    function setUnreadMessageToRead($complaint){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryUpdate = "UPDATE messages SET isRead='1' WHERE receiver=? && complaint=?;";
            $stmt = mysqli_prepare($con,$queryUpdate);
            mysqli_stmt_bind_param($stmt, "sd", $_SESSION['userName'], $complaint);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            }
        }
    }

    function checkIfOwnerIsWorkerForComplaintMessage($sender){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
           header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $query = "SELECT isWorker FROM users WHERE name=?";
            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,"s", $sender);
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

    function insertMessage($complaintNr, $content, $timeZone){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryComplaint = "SELECT customer, employee FROM complaints WHERE nr=?;";
            $stmt = mysqli_prepare($con,$queryComplaint);
            mysqli_stmt_bind_param($stmt,"d",$complaintNr);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmt, $customer, $employee);
                $loggedIn = $_SESSION['userName'];
                while(mysqli_stmt_fetch($stmt)){
                    if($employee == $loggedIn){
                        insertMessageIntoTableMessages($employee, $customer, $content, $complaintNr, $timeZone);
                    } 
                }
            }
        }
    }
                         
    function insertMessageIntoTableMessages($sender, $receiver, $content, $complaintNr, $timeZone){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryComplaint = 
            "INSERT INTO `messages` (`sender`,`receiver` ,`complaint`, `content`, `isRead`, `dateSend`) VALUES (?,?,?,?,'0',?)";
            $stmt = mysqli_prepare($con,$queryComplaint);
            date_default_timezone_set($timeZone);
            mysqli_stmt_bind_param($stmt,"ssdss",$sender, $receiver, $complaintNr, $content, date("Y-m-d H:i:s P"));
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            }
        }
    }  
?>
