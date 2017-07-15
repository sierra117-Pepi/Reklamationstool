<?php
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $query = "SELECT COUNT(*)AS unreadMessages FROM messages m WHERE isRead = false;";
        $stmt = mysqli_prepare($con,$query);
        if(!mysqli_stmt_execute($stmt)){
            die('Error: ' . mysqli_error($con));
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            mysqli_stmt_bind_result($stmt, $unreadMessages);
            while(mysqli_stmt_fetch($stmt)){
                echo("<div class='huge'>".$unreadMessages."</div>");   
            }
        }
    }
?>
