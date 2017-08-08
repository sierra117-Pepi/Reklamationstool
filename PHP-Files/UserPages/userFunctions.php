<?php
    session_start();
    if(isset($_POST['function'])){
        switch($_POST['function']){
            case 1: 
                if(isset($_POST['complaintNr']) && isset($_POST['content']) && isset($_POST['timeZone'])){
                    setMessagesToRead(htmlspecialchars($_POST['complaintNr']));
                    echo(insertMessageDashBoard(htmlspecialchars($_POST['complaintNr']),htmlspecialchars($_POST['content']), htmlspecialchars($_POST['timeZone'])));
                }
                break;
            case 2:
                if(isset($_POST['productNr'])){
                    echo(findProduct(htmlspecialchars($_POST['productNr'])));
                }
                break;
            case 3:
                if(isset($_POST['productNr']) && isset($_POST['type']) && isset($_POST['details']) && isset($_POST['date'])){
                    echo(createCase(htmlspecialchars($_POST['productNr']),htmlspecialchars($_POST['type']), htmlspecialchars($_POST['details'])));
                }
                break;
            case 4:
                if(isset($_POST['complaintNr'])){
                    echo(createChat(htmlspecialchars($_POST['complaintNr'])));
                }
                break;
            case 5:
                if(isset($_POST['complaintNr']) && isset($_POST['content']) && isset($_POST['timeZone'])){
                    echo(insertMessage(htmlspecialchars($_POST['complaintNr']),htmlspecialchars($_POST['content']), htmlspecialchars($_POST['timeZone'])));
                }
                break;
        }
    }
    
    function insertMessageDashBoard($complaintNr, $content, $timeZone){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
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
                    if($customer == $loggedIn){
                        insertMessageIntoTableMessages($customer, $employee, $content, $complaintNr, $timeZone);
                    }
                }
            }
        }
    }
                                  
    function setMessagesToRead($complaintNr){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $queryUpdate = "UPDATE messages SET isRead=1 WHERE receiver=? AND complaint=?;";
            $stmt = mysqli_prepare($con,$queryUpdate);
            $user = $_SESSION['userName'];
            mysqli_stmt_bind_param($stmt,"sd", $user, $complaintNr);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            }
        }
    }

    function findProduct($productNr){
        if(!productIsInComplaints($productNr)){
            $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");

             if(mysqli_connect_errno()){
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                $query = "SELECT* FROM products p WHERE nr=?;";
                $stmt = mysqli_prepare($con,$query);
                mysqli_stmt_bind_param($stmt,"d",$productNr);
                if(!mysqli_stmt_execute($stmt)){
                    die('Error: ' . mysqli_error($con));
                    header("Location:../ErrorPages/dbConnectionError.php");
                    exit();
                } else {
                    $productInfo = array();
                    mysqli_stmt_bind_result($stmt, $nr, $name, $details);
                    while(mysqli_stmt_fetch($stmt)){
                        $productInfo['productNr'] = $nr;
                        $productInfo['productName'] = $name;
                        $productInfo['productDetails'] = $details;
                    }
                    return json_encode($productInfo);
                }
            }
        } 
    }

    function productIsInComplaints($productNr){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");

        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $query = "SELECT nr FROM complaints WHERE nr=?;";
            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,"d",$productNr);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmt, $nr);
                while(mysqli_stmt_fetch($stmt)){
                    return true;
                }
                return false;
            }
        } 
    }

    function createCase($productNr, $type, $details){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $queryComplaint = 
            "INSERT INTO `complaints` (`nr`, `customer`, `employee`, `status`, `type`, `description`, `reasonSchachinger`, `measureSchachinger`, `measureAvoid`, `issued`, `take`) VALUES (?,?,'','Offen',?,?, 'kein Auswahl', 'kein Auswahl', 'kein Auswahl',?, NULL);";
            $customer = $_SESSION['userName'];
            $stmt = mysqli_prepare($con,$queryComplaint);
            date_default_timezone_set($timeZone);
            mysqli_stmt_bind_param($stmt,"sssss",$productNr, $customer, $type, $details, date("Y-m-d H:i:s P"));
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
                    if($customer == $loggedIn){
                        insertMessageIntoTableMessages($customer, $employee, $content, $complaintNr, $timeZone);
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
