<?php
    session_unset();
    session_destroy();
    header("Location:../Login/login_html.php");
    exit();
?>
