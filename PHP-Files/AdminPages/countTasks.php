<?php
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $query = "SELECT COUNT(nr)AS notYetTakenTasks FROM complaints WHERE employee = '';";
        $stmt = mysqli_prepare($con,$query);
        if(!mysqli_stmt_execute($stmt)){
            die('Error: ' . mysqli_error($con));
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            mysqli_stmt_bind_result($stmt, $notYetTakenTasks);
            while(mysqli_stmt_fetch($stmt)){
                echo("<div class='huge'>".$notYetTakenTasks."</div>");   
            }
        }
    }
?>
