<?php
    
    if(isset($_SESSION['userName'])){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");

        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryComplaints = "SELECT nr, type, employee FROM complaints WHERE customer=?";
            $stmtComplaints = mysqli_prepare($con,$queryComplaints);
            mysqli_stmt_bind_param($stmtComplaints, "s", $_SESSION['userName']);
            if(!mysqli_stmt_execute($stmtComplaints)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmtComplaints, $nr, $type, $employee);
                echo('<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>    
                                        <th>Lieferschein Nr.</th>
                                        <th>Betreuer</th>
                                        <th>Art</th>
                                        <th>Nachrichten</th>
                                        <th>Details</th>
                                    </thead>
                                    <tbody>');
                while(mysqli_stmt_fetch($stmtComplaints)){
                    $buttonStyle = styleButton(checkForUnreadMessages($nr));
                    echo('<tr>
                                <td>'.$nr.'</td>
                                <td>'.$employee.'</th>
                                <td>'.$type.'</td>
                                <td class="center">
                                    <button type="button" id="'.$nr.'" class="'.$buttonStyle.'" data-toggle="modal" data-target="#myModal" onclick="fillChatInfoForModal(this.id)"><i class="fa fa-comments"></i>
                                </td>
                                <td>
                                    <button type="button" id="'.$nr.'"class="btn btn-info btn-circle" onclick="openInfoWindow(this.id)"><i class="fa fa-info"></i>
                                </td>
                            </tr>');
                }
                echo('</tbody></table>');
            }
        }
    } else {
        header("Location:../Login/login_html.php");
        exit();
    }

    function checkForUnreadMessages($complaint){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryMessages = "
            SELECT isRead, receiver FROM messages WHERE dateSend = (SELECT MAX(m.dateSend) FROM messages m WHERE m.complaint = ?);";
            $stmtMessages = mysqli_prepare($con,$queryMessages);
            mysqli_stmt_bind_param($stmtMessages, "d", $complaint);
            if(!mysqli_stmt_execute($stmtMessages)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmtMessages, $isRead, $receiver);
                while(mysqli_stmt_fetch($stmtMessages)){
                    if(!$isRead){
                        if($_SESSION['userName'] == $receiver){
                            return false;
                        }
                    }
                }
                return true;
            }
        }
    }

    function styleButton($hasUnreadMessages){
        switch($hasUnreadMessages){
            case true: 
                return "btn btn-success btn-circle";
            case false: 
                return "btn btn-danger btn-circle";
        }
    }
?>
