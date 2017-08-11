<?php
    if (isset($_POST['complaintNr'])) {
        echo(fillPageInforForComplaint(htmlspecialchars($_POST['complaintNr'])));
    }
    
    function fillPageInforForComplaint($complaintNr){   
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        $con->set_charset("utf8");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $query = "SELECT c.nr, c.customer, c.employee, c.status, c.type, c.description, c.reasonSchachinger, c.measureSchachinger, c.measureAvoid, c.issued, c.take, p.name, p.details FROM complaints c JOIN products p ON c.nr = p.nr WHERE c.nr=?";
            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,"d", $complaintNr);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                $complaintInfo = array();
                //$string = "";
                mysqli_stmt_bind_result($stmt, $nr, $customer, $employee, $status, $type, $description, $reasonSchachinger, $measureSchachinger, $measureAvoid, $issued, $take, $name, $details);
                while(mysqli_stmt_fetch($stmt)){
                    $complaintInfo["nr"] = $nr;
                    $complaintInfo["customer"] = $customer;
                    $complaintInfo["employee"] = $employee;
                    $complaintInfo["status"] = $status;
                    $complaintInfo["type"] = $type;
                    $complaintInfo["description"] = $description;
                    $complaintInfo["reasonSchachinger"] = $reasonSchachinger;
                    $complaintInfo["measureSchachinger"] = $measureSchachinger;
                    $complaintInfo["measureAvoid"] = $measureAvoid;
                    $complaintInfo["issued"] = $issued;
                    $complaintInfo["take"] = $take;
                    $complaintInfo["name"] = $name;
                    $complaintInfo["details"] = $details;
                    /*$string = $nr . ":" . $customer . ":" . $employee . ":" . $status . ":" . $type . ":" . $description . ":" . $reasonSchachinger . ":" . $measureSchachinger . ":" . $measureAvoid . ":" . $issued . ":" . $take . ":" . $name . ":" . $details;*/           
                }
                //return $string;
                $json_complaintInfo = json_encode($complaintInfo);
                return $json_complaintInfo;
            }
        }
    }
?>
