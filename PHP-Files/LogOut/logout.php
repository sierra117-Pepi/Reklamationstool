<?php
    session_unset($_SESSION['userName']);
    session_destroy($_SESSION['userName']);
    header("Location:../Login/login_html.php");
    exit();
?>
